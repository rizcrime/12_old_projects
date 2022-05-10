package com.kemenag.sipatuh.Kasus;

import android.app.DatePickerDialog;
import android.app.ProgressDialog;
import android.app.TimePickerDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.text.format.DateFormat;
import android.util.Base64;
import android.view.View;
import android.widget.Button;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.TimePicker;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.DefaultRetryPolicy;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.VolleyLog;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.Volley;
import com.kemenag.sipatuh.BerangkatTanahAir.BerangkatTanahAirActivity;
import com.kemenag.sipatuh.LoginPackage.AppVar;
import com.kemenag.sipatuh.R;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.HashMap;
import java.util.Locale;
import java.util.Map;

public class KasusActivity extends AppCompatActivity {

    private ImageView setTanggal, drp_down_waktu_kasus;
    private EditText tgl_kasus, waktu_kasus, tempat_kasus, kejadian;
    private Button simpan;
    private static String TAG = KasusActivity.class.getSimpleName();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_kasus);

        setTanggal = findViewById(R.id.drp_down_tgl_kasus);
        drp_down_waktu_kasus = findViewById(R.id.drp_down_waktu_kasus);
        tgl_kasus = findViewById(R.id.tgl_kasus);
        waktu_kasus = findViewById(R.id.waktu_kasus);
        tempat_kasus = findViewById(R.id.tempat_kasus);
        kejadian = findViewById(R.id.kejadian_kasus);
        simpan = findViewById(R.id.simpan);

        simpan.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                sendWorkPostRequest();
            }
        });

        init();
    }

    private void init() {
        setTanggal.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                showDateDialog();
            }
        });
        drp_down_waktu_kasus.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                showDateDialog1();
            }
        });
    }

    private void showDateDialog(){
        Calendar newCalendar = Calendar.getInstance();
        DatePickerDialog datePickerDialog = new DatePickerDialog(this, new DatePickerDialog.OnDateSetListener() {

            @Override
            public void onDateSet(DatePicker view, int year, int monthOfYear, int dayOfMonth) {
                Calendar newDate = Calendar.getInstance();
                newDate.set(year, monthOfYear, dayOfMonth);
                tgl_kasus.setText(new SimpleDateFormat("dd-MM-yyyy", Locale.US).format(newDate.getTime()));
            }

        }, newCalendar.get(Calendar.YEAR), newCalendar.get(Calendar.MONTH), newCalendar.get(Calendar.DAY_OF_MONTH));
        datePickerDialog.show();
    }

    private void showDateDialog1(){
        Calendar mcurrentTime = Calendar.getInstance();
        TimePickerDialog mTimePicker;
        mTimePicker = new TimePickerDialog(KasusActivity.this, new TimePickerDialog.OnTimeSetListener() {
            @Override
            public void onTimeSet(TimePicker view, int selectedHour, int selectedMinute) {
                String hour = selectedHour + "";
                if (selectedHour < 10) {
                    hour = "0" + selectedHour;
                }
                String min = selectedMinute + "";
                if (selectedMinute < 10)
                    min = "0" + selectedMinute;
                waktu_kasus.setText(hour + ":" + min);
            }

        },mcurrentTime.get(Calendar.HOUR_OF_DAY), mcurrentTime.get(Calendar.MINUTE),
                DateFormat.is24HourFormat(this));
        mTimePicker.show();
    }

    private void sendWorkPostRequest() {

        String URL = AppVar.KASUS;
        final ProgressDialog pDialog = new ProgressDialog(this);
        pDialog.setMessage("Sending Data ...");
        pDialog.setIndeterminate(false);
        pDialog.setCancelable(true);
        pDialog.show();

        JSONObject jsonParams = new JSONObject();

        try {
            //Add string params
            jsonParams.put("tanggal", tgl_kasus.getText().toString());
            jsonParams.put("waktu", waktu_kasus.getText().toString());
            jsonParams.put("tempat", tempat_kasus.getText().toString());
            jsonParams.put("kejadian", kejadian.getText().toString());

            String one = tgl_kasus.getText().toString();
            String two = waktu_kasus.getText().toString();
            String three = tempat_kasus.getText().toString();
            String four = kejadian.getText().toString();


            if(one.equals("")) {
                pDialog.dismiss();
                Toast.makeText(getApplicationContext(), "Tidak boleh ada yang dikosongkan!", Toast.LENGTH_SHORT).show();
                return;
            }
            else if(two.equals("")) {
                pDialog.dismiss();
                Toast.makeText(getApplicationContext(), "Tidak boleh ada yang dikosongkan!", Toast.LENGTH_SHORT).show();
                return;
            }else if(three.equals("")) {
                pDialog.dismiss();
                Toast.makeText(getApplicationContext(), "Tidak boleh ada yang dikosongkan!", Toast.LENGTH_SHORT).show();
                return;
            }else if(four.equals("")) {
                pDialog.dismiss();
                Toast.makeText(getApplicationContext(), "Tidak boleh ada yang dikosongkan!", Toast.LENGTH_SHORT).show();
                return;
            }

        } catch (JSONException e) {
            e.printStackTrace();
        }
        JsonObjectRequest stringRequest = new JsonObjectRequest(Request.Method.POST,
                URL, jsonParams, new Response.Listener<JSONObject>() {
            @Override
            public void onResponse(JSONObject response) {
                pDialog.dismiss();
                VolleyLog.d(TAG, "Okex: " + response.toString());
                Toast.makeText(getApplicationContext(),
                        "Data berhasil ditambahkan", Toast.LENGTH_SHORT).show();
            }
        }, new com.android.volley.Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                pDialog.dismiss();

                VolleyLog.d(TAG, "Error: " + error.getMessage());
                Toast.makeText(getApplicationContext(),
                        "Menyimpan data gagal, silahkan coba lagi", Toast.LENGTH_SHORT).show();

            }
        }) {
            @Override
            public Map<String, String> getHeaders() throws AuthFailureError {
                Map<String, String> headers = new HashMap<>();
                String credentials = "admin:1234";
                String auth = "Basic "
                        + Base64.encodeToString(credentials.getBytes(), Base64.NO_WRAP);
                headers.put("Content-Type", "application/json");
                headers.put("Authorization", auth);
                return headers;
            }


        };
        RequestQueue requestQueue = Volley.newRequestQueue(this);
        stringRequest.setRetryPolicy(new DefaultRetryPolicy(10000, 1, 1.0f));
        requestQueue.add(stringRequest);

    }

}
