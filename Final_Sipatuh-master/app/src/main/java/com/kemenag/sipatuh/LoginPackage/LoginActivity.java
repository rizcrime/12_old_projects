package com.kemenag.sipatuh.LoginPackage;

import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.util.Base64;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.DefaultRetryPolicy;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.Volley;
import com.kemenag.sipatuh.BuildConfig;
import com.kemenag.sipatuh.DashboardWeb.DashboardActivity;
import com.kemenag.sipatuh.MainActivity;
import com.kemenag.sipatuh.R;
import com.kemenag.sipatuh.PublicPackage.SessionManager;

import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedInputStream;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.IOException;
import java.io.InputStream;
import java.security.KeyManagementException;
import java.security.KeyStore;
import java.security.KeyStoreException;
import java.security.NoSuchAlgorithmException;
import java.security.SecureRandom;
import java.security.cert.Certificate;
import java.security.cert.CertificateException;
import java.security.cert.CertificateFactory;
import java.security.cert.X509Certificate;
import java.util.HashMap;
import java.util.Map;

import javax.net.ssl.HostnameVerifier;
import javax.net.ssl.HttpsURLConnection;
import javax.net.ssl.SSLContext;
import javax.net.ssl.SSLSession;
import javax.net.ssl.TrustManager;
import javax.net.ssl.TrustManagerFactory;
import javax.net.ssl.X509TrustManager;

public class LoginActivity extends AppCompatActivity {

    private EditText editTextEmail;
    private EditText editTextPassword;
    private Button buttonLogin;
    private Button login_petugas;
    private ProgressDialog pDialog;
    private TextView versionNumber;

    SessionManager session;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        session = new SessionManager(getApplicationContext());

        pDialog = new ProgressDialog(this);
        editTextEmail = (EditText) findViewById(R.id.editTextEmail);
        editTextPassword = (EditText) findViewById(R.id.editTextPassword);
//        login_petugas = (Button)findViewById(R.id.login_petugas);
        buttonLogin = (Button)findViewById(R.id.buttonLogin);


//        login_petugas.setOnClickListener(new View.OnClickListener() {
//            @Override
//            public void onClick(View v) {
//                Intent i = new Intent(LoginActivity.this, DashboardActivity.class);
//                startActivity(i);
//            }
//        });
        buttonLogin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                login();
            }
        });

        setVersion();

        // Ignore SSL Certificate
        NukeSSLCerts.nuke();
//        NukeSSLCerts.trustMe(this.getApplicationContext());
    }

    private void setVersion() {
        versionNumber = findViewById(R.id.version_number);
        versionNumber.setText("v" + BuildConfig.VERSION_NAME);
    }

    private void login() {
        final String USERNAME = editTextEmail.getText().toString().trim();
        final String PASSWORD = editTextPassword.getText().toString().trim();
        pDialog.setMessage("Login Process...");
        showDialog();
        //Creating a string request

//        URL url = new URL("https://haji.kemenag.go.id/pihk/API/Auth/login");
//        URLConnection urlConnection = url.openConnection();
//        InputStream in = urlConnection.getInputStream();
//        copyInputStreamToOutputStream(in, System.out);

        JSONObject jsonParams = new JSONObject();
        try {
            jsonParams.put(AppVar.KEY_USERNAAME, USERNAME);
            jsonParams.put(AppVar.KEY_PASSWORD, PASSWORD);
        } catch (JSONException e) {
            e.printStackTrace();
        }

        JsonObjectRequest stringRequest = new JsonObjectRequest(Request.Method.POST, AppVar.LOGIN_URL, jsonParams,
                new Response.Listener<JSONObject>() {
                    @Override
                    public void onResponse(JSONObject response) {

                        try {
                            if (response.getString("Status").equals(AppVar.LOGIN_SUCCESS)) {

                                JSONObject userData = response.getJSONObject("Data");
                                String kode_pihk = userData.getString("kode_pihk");

                                session.createLoginSession(kode_pihk);

                                hideDialog();
                                gotoCourseActivity();

                            } else {
                                hideDialog();
                                Toast.makeText(LoginActivity.this, "Invalid username or password", Toast.LENGTH_LONG).show();
                            }
                        } catch (JSONException e) {
                            e.printStackTrace();
                        }
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        hideDialog();
                        Toast.makeText(LoginActivity.this, "The server unreachable", Toast.LENGTH_LONG).show();

                    }
                }) {
//            @Override
//            protected Map<String, String> getParams() throws AuthFailureError {
//                Map<String, String> params = new HashMap<>();
//                params.put(AppVar.KEY_USERNAAME, USERNAME);
//                params.put(AppVar.KEY_PASSWORD, PASSWORD);
//
//                return params;
//            }

            @Override
            public Map<String, String> getHeaders() throws AuthFailureError {
                Map<String, String> headers = new HashMap<>();
                String credentials = "admin:1234";
                String auth = "Basic "
                        + Base64.encodeToString(credentials.getBytes(), Base64.NO_WRAP);
                //headers.put("Content-Type", "application/json");
                headers.put("Authorization", auth);
                return headers;
            }

        };

//        Volley.newRequestQueue(this).add(stringRequest);

        RequestQueue requestQueue = Volley.newRequestQueue(this);
        // Add the realibility on the connection.
        stringRequest.setRetryPolicy(new DefaultRetryPolicy(10000, 1, 1.0f));
        requestQueue.add(stringRequest);
    }

    private void gotoCourseActivity() {
        Preferences.setLoggedInUser(getBaseContext(),Preferences.getRegisteredUser(getBaseContext()));
        Preferences.setLoggedInStatus(getBaseContext(),true);
        startActivity(new Intent(getBaseContext(), MainActivity.class));
        finish();
    }

    private void showDialog() {
        if (!pDialog.isShowing())
            pDialog.show();
    }

    private void hideDialog() {
        if (pDialog.isShowing())
            pDialog.dismiss();
    }

    @Override
    protected void onStart() {
        super.onStart();
        if (Preferences.getLoggedInStatus(getBaseContext())){
            startActivity(new Intent(getBaseContext(),MainActivity.class));
            finish();
        }
    }

    public static class NukeSSLCerts {
        protected static final String TAG = "NukeSSLCerts";

        public static void nuke() {
            try {
                TrustManager[] trustAllCerts = new TrustManager[] {
                        new X509TrustManager() {
                            public X509Certificate[] getAcceptedIssuers() {
                                X509Certificate[] myTrustedAnchors = new X509Certificate[0];
                                return myTrustedAnchors;
                            }

                            @Override
                            public void checkClientTrusted(X509Certificate[] certs, String authType) {}

                            @Override
                            public void checkServerTrusted(X509Certificate[] certs, String authType) {}
                        }
                };

                SSLContext sc = SSLContext.getInstance("SSL");
                sc.init(null, trustAllCerts, new SecureRandom());
                HttpsURLConnection.setDefaultSSLSocketFactory(sc.getSocketFactory());
//                HttpsURLConnection.setDefaultHostnameVerifier(new HostnameVerifier() {
//                    @Override
//                    public boolean verify(String arg0, SSLSession arg1) {
//                        return true;
//                    }
//                });
            } catch (Exception e) {
            }
        }

        public static void trustMe(Context appContext) {
            // Load CAs from an InputStream
            // (could be from a resource or ByteArrayInputStream or ...)
            CertificateFactory cf = null;
            try {
                cf = CertificateFactory.getInstance("X.509");
            } catch (CertificateException e) {
                e.printStackTrace();
            }
            // From https://www.washington.edu/itconnect/security/ca/load-der.crt
            InputStream caInput = null;
            caInput = appContext.getResources().openRawResource(R.raw.geo);

            Certificate ca = null;
            try {
                ca = cf.generateCertificate(caInput);
                System.out.println("ca=" + ((X509Certificate) ca).getSubjectDN());
            } catch (CertificateException e) {
                e.printStackTrace();
            } finally {
                try {
                    caInput.close();
                } catch (IOException e) {
                    e.printStackTrace();
                }
            }

            // Create a KeyStore containing our trusted CAs
            String keyStoreType = KeyStore.getDefaultType();
            KeyStore keyStore = null;
            try {
                keyStore = KeyStore.getInstance(keyStoreType);
                keyStore.load(null, null);
                keyStore.setCertificateEntry("ca", ca);

            } catch (KeyStoreException e) {
                e.printStackTrace();
            } catch (CertificateException e) {
                e.printStackTrace();
            } catch (NoSuchAlgorithmException e) {
                e.printStackTrace();
            } catch (IOException e) {
                e.printStackTrace();
            }

            // Create a TrustManager that trusts the CAs in our KeyStore
            String tmfAlgorithm = TrustManagerFactory.getDefaultAlgorithm();
            TrustManagerFactory tmf = null;
            try {
                tmf = TrustManagerFactory.getInstance(tmfAlgorithm);
                tmf.init(keyStore);
            } catch (NoSuchAlgorithmException e) {
                e.printStackTrace();
            } catch (KeyStoreException e) {
                e.printStackTrace();
            }

            // Create an SSLContext that uses our TrustManager
            SSLContext context = null;
//            SSLContext TLScontext = null;
            try {
                context = SSLContext.getInstance("SSL");
                context.init(null, tmf.getTrustManagers(), null);

//                TLScontext = SSLContext.getInstance("TLS");
//                TLScontext.init(null, tmf.getTrustManagers(), null);
            } catch (NoSuchAlgorithmException e) {
                e.printStackTrace();
            } catch (KeyManagementException e) {
                e.printStackTrace();
            }

            // Tell the URLConnection to use a SocketFactory from our SSLContext
            try {
                context.init(null, tmf.getTrustManagers(), new SecureRandom());
                HttpsURLConnection.setDefaultSSLSocketFactory(context.getSocketFactory());

//                TLScontext.init(null, tmf.getTrustManagers(), new SecureRandom());
//                HttpsURLConnection.setDefaultSSLSocketFactory(TLScontext.getSocketFactory());

            } catch (KeyManagementException e) {
                e.printStackTrace();
            }

        }
    }
}