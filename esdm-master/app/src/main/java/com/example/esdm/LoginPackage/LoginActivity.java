package com.example.esdm.LoginPackage;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.util.Base64;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.DefaultRetryPolicy;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import java.util.HashMap;
import java.util.Map;

import com.example.esdm.MainActivity;
import com.example.esdm.Preferences;
import com.example.esdm.R;

import org.json.JSONException;
import org.json.JSONObject;

public class LoginActivity extends AppCompatActivity {

    private EditText editTextEmail;
    private EditText editTextPassword;
    private Button buttonLogin;
    private ProgressDialog pDialog;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        pDialog = new ProgressDialog(this);
        editTextEmail = (EditText) findViewById(R.id.editTextEmail);
        editTextPassword = (EditText) findViewById(R.id.editTextPassword);

        buttonLogin = findViewById(R.id.buttonLogin);
        buttonLogin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                login();
            }
        });

    }

//    private void login() {
//        final String USERNAME = editTextEmail.getText().toString().trim();
//        final String PASSWORD = editTextPassword.getText().toString().trim();
//        pDialog.setMessage("Login Process...");
//        showDialog();
//        //Creating a string request
//        StringRequest stringRequest = new StringRequest(Request.Method.POST, AppVar.LOGIN_URL,
//                new Response.Listener<String>() {
//                    @Override
//                    public void onResponse(String response) {
//
//                        if (response.contains(AppVar.LOGIN_SUCCESS)) {
//                            hideDialog();
//                            gotoCourseActivity();
//
//                        } else {
//                            hideDialog();
//                            Toast.makeText(LoginActivity.this, "Invalid username or password", Toast.LENGTH_LONG).show();
//                        }
//                    }
//                },
//                new Response.ErrorListener() {
//                    @Override
//                    public void onErrorResponse(VolleyError error) {
//                        hideDialog();
//                        Toast.makeText(LoginActivity.this, "The server unreachable", Toast.LENGTH_LONG).show();
//
//                    }
//                }) {
//            @Override
//            protected Map<String, String> getParams() throws AuthFailureError {
//                Map<String, String> params = new HashMap<>();
//                params.put(AppVar.KEY_USERNAAME, USERNAME);
//                params.put(AppVar.KEY_PASSWORD, PASSWORD);
//
//                return params;
//            }
//            @Override
//            public Map<String, String> getHeaders() throws AuthFailureError {
//                Map<String, String> headers = new HashMap<>();
//                String credentials = "admin2:1234";
//                String auth = "Basic " + Base64.encodeToString(credentials.getBytes(), Base64.NO_WRAP);
//                headers.put("Content-Type", "application/json");
//                headers.put("Authorization", auth);
//                return headers;
//            }
//        };
//
//        Volley.newRequestQueue(this).add(stringRequest);
//
//    }

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

//                                JSONObject userData = response.getJSONObject("Data");
//                                String kode_pihk = userData.getString("kode_pihk");

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
                String credentials = "admin2:1234";
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
        startActivity(new Intent(getBaseContext(),MainActivity.class));
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

}