package com.example.esdm.Klik;

import android.app.DatePickerDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.text.Editable;
import android.text.TextWatcher;
import android.util.Base64;
import android.view.View;
import android.widget.Button;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.LinearLayout;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.Volley;
import com.example.esdm.Klik.Ebtke.Adapter4;
import com.example.esdm.Klik.Ebtke.Model4;
import com.example.esdm.Klik.Geologi.Adapter5;
import com.example.esdm.Klik.Geologi.Model5;
import com.example.esdm.Klik.Ketenagalistrikan.Adapter3;
import com.example.esdm.Klik.Ketenagalistrikan.Model3;
import com.example.esdm.Klik.Migas.Adapter;
import com.example.esdm.Klik.Migas.Model;
import com.example.esdm.Klik.Minerba.Adapter2;
import com.example.esdm.Klik.Minerba.Model2;
import com.example.esdm.R;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.HashMap;
import java.util.Locale;
import java.util.Map;

public class KlikActivity extends AppCompatActivity {

    LinearLayout layar1, layar2, layar3, layar4, layar5;
    Button migas, minerba, kelistrikan, ebtke, geologi, ambil1, ambil2, ambil3, ambil4, ambil5;
    DatePickerDialog datePickerDialog1, datePickerDialog2, datePickerDialog3, datePickerDialog4, datePickerDialog5;
    SimpleDateFormat dateFormatter1, dateFormatter2, dateFormatter3, dateFormatter4, dateFormatter5;
    EditText tvDateResult1, tvDateResult2, tvDateResult3, tvDateResult4, tvDateResult5;
    ImageView btDatePicker1, btDatePicker2, btDatePicker3, btDatePicker4, btDatePicker5;
    RecyclerView mRecyclerView1, mRecyclerView2, mRecyclerView3, mRecyclerView4, mRecyclerView5;
    Adapter mExampleAdapter1;
    Adapter2 mExampleAdapter2;
    Adapter3 mExampleAdapter3;
    Adapter4 mExampleAdapter4;
    Adapter5 mExampleAdapter5;
    ArrayList<Model> mExampleList;
    ArrayList<Model2> mExampleList2;
    ArrayList<Model3> mExampleList3;
    ArrayList<Model4> mExampleList4;
    ArrayList<Model5> mExampleList5;
    RequestQueue mRequestQueue;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_klik);

        migas = (Button) findViewById(R.id.btn1);
        minerba = (Button) findViewById(R.id.btn2);
        kelistrikan = (Button) findViewById(R.id.btn3);
        ebtke = (Button) findViewById(R.id.btn4);
        geologi = (Button) findViewById(R.id.btn5);

        layar1 = (LinearLayout)this.findViewById(R.id.layout1);
        layar2 = (LinearLayout)this.findViewById(R.id.layout2);
        layar3 = (LinearLayout)this.findViewById(R.id.layout3);
        layar4 = (LinearLayout)this.findViewById(R.id.layout4);
        layar5 = (LinearLayout)this.findViewById(R.id.layout5);

        ambil1 = (Button) findViewById(R.id.go1);
        ambil2 = (Button) findViewById(R.id.go2);
        ambil3 = (Button) findViewById(R.id.go3);
        ambil4 = (Button) findViewById(R.id.go4);
        ambil5 = (Button) findViewById(R.id.go5);

        mRecyclerView1 = findViewById(R.id.recycler1);
        mRecyclerView2 = findViewById(R.id.recycler2);
        mRecyclerView3 = findViewById(R.id.recycler3);
        mRecyclerView4 = findViewById(R.id.recycler4);
        mRecyclerView5 = findViewById(R.id.recycler5);

        mRecyclerView1.setHasFixedSize(true);
        mRecyclerView1.setLayoutManager(new LinearLayoutManager(this));

        mRecyclerView2.setHasFixedSize(true);
        mRecyclerView2.setLayoutManager(new LinearLayoutManager(this));

        mRecyclerView3.setHasFixedSize(true);
        mRecyclerView3.setLayoutManager(new LinearLayoutManager(this));

        mRecyclerView4.setHasFixedSize(true);
        mRecyclerView4.setLayoutManager(new LinearLayoutManager(this));

        mRecyclerView5.setHasFixedSize(true);
        mRecyclerView5.setLayoutManager(new LinearLayoutManager(this));

        mExampleList = new ArrayList<>();
        mExampleList2 = new ArrayList<>();
        mExampleList3 = new ArrayList<>();
        mExampleList4 = new ArrayList<>();
        mExampleList5 = new ArrayList<>();

        mRequestQueue = Volley.newRequestQueue(this);

        migas.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(layar1.getVisibility() == View.VISIBLE)
                    layar1.setVisibility(View.GONE);
                else if(layar2.getVisibility() == View.VISIBLE)
                    layar2.setVisibility(View.GONE);
                else if(layar3.getVisibility() == View.VISIBLE)
                    layar3.setVisibility(View.GONE);
                else if(layar4.getVisibility() == View.VISIBLE)
                    layar4.setVisibility(View.GONE);
                else if(layar5.getVisibility() == View.VISIBLE)
                    layar5.setVisibility(View.GONE);
                else
                    layar1.setVisibility(View.VISIBLE);
            }
        });

        minerba.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(layar2.getVisibility() == View.VISIBLE)
                    layar2.setVisibility(View.GONE);
                else if(layar1.getVisibility() == View.VISIBLE)
                    layar1.setVisibility(View.GONE);
                else if(layar3.getVisibility() == View.VISIBLE)
                    layar3.setVisibility(View.GONE);
                else if(layar4.getVisibility() == View.VISIBLE)
                    layar4.setVisibility(View.GONE);
                else if(layar5.getVisibility() == View.VISIBLE)
                    layar5.setVisibility(View.GONE);
                else
                    layar2.setVisibility(View.VISIBLE);
            }
        });

        kelistrikan.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(layar3.getVisibility() == View.VISIBLE)
                    layar3.setVisibility(View.GONE);
                else if(layar2.getVisibility() == View.VISIBLE)
                    layar2.setVisibility(View.GONE);
                else if(layar1.getVisibility() == View.VISIBLE)
                    layar1.setVisibility(View.GONE);
                else if(layar4.getVisibility() == View.VISIBLE)
                    layar4.setVisibility(View.GONE);
                else if(layar5.getVisibility() == View.VISIBLE)
                    layar5.setVisibility(View.GONE);
                else
                    layar3.setVisibility(View.VISIBLE);
            }
        });

        ebtke.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(layar4.getVisibility() == View.VISIBLE)
                    layar4.setVisibility(View.GONE);
                else if(layar2.getVisibility() == View.VISIBLE)
                    layar2.setVisibility(View.GONE);
                else if(layar3.getVisibility() == View.VISIBLE)
                    layar3.setVisibility(View.GONE);
                else if(layar1.getVisibility() == View.VISIBLE)
                    layar1.setVisibility(View.GONE);
                else if(layar5.getVisibility() == View.VISIBLE)
                    layar5.setVisibility(View.GONE);
                else
                    layar4.setVisibility(View.VISIBLE);
            }
        });

        geologi.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(layar5.getVisibility() == View.VISIBLE)
                    layar5.setVisibility(View.GONE);
                else if(layar2.getVisibility() == View.VISIBLE)
                    layar2.setVisibility(View.GONE);
                else if(layar3.getVisibility() == View.VISIBLE)
                    layar3.setVisibility(View.GONE);
                else if(layar4.getVisibility() == View.VISIBLE)
                    layar4.setVisibility(View.GONE);
                else if(layar1.getVisibility() == View.VISIBLE)
                    layar1.setVisibility(View.GONE);
                else
                    layar5.setVisibility(View.VISIBLE);
            }
        });

        //MEMBUAT DATEPICKER1
        dateFormatter1 = new SimpleDateFormat("yyyy-MM-dd", Locale.US);
        tvDateResult1 = (EditText) findViewById(R.id.tv_dateresult1);
        btDatePicker1 = (ImageView) findViewById(R.id.bt_datepicker1);
        btDatePicker1.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                showDateDialog1();
            }
        });
        //MEMBUAT DATEPICKER2
        dateFormatter2 = new SimpleDateFormat("yyyy-MM-dd", Locale.US);
        tvDateResult2 = (EditText) findViewById(R.id.tv_dateresult2);
        btDatePicker2 = (ImageView) findViewById(R.id.bt_datepicker2);
        btDatePicker2.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                showDateDialog2();
            }
        });
        //MEMBUAT DATEPICKER3
        dateFormatter3 = new SimpleDateFormat("yyyy-MM-dd", Locale.US);
        tvDateResult3 = (EditText) findViewById(R.id.tv_dateresult3);
        btDatePicker3 = (ImageView) findViewById(R.id.bt_datepicker3);
        btDatePicker3.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                showDateDialog3();
            }
        });
        //MEMBUAT DATEPICKER2
        dateFormatter4 = new SimpleDateFormat("yyyy-MM-dd", Locale.US);
        tvDateResult4 = (EditText) findViewById(R.id.tv_dateresult4);
        btDatePicker4 = (ImageView) findViewById(R.id.bt_datepicker4);
        btDatePicker4.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                showDateDialog4();
            }
        });
        //MEMBUAT DATEPICKER3
        dateFormatter5 = new SimpleDateFormat("yyyy-MM-dd", Locale.US);
        tvDateResult5 = (EditText) findViewById(R.id.tv_dateresult5);
        btDatePicker5 = (ImageView) findViewById(R.id.bt_datepicker5);
        btDatePicker5.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                showDateDialog5();
            }
        });

        tvDateResult1.addTextChangedListener(new TextWatcher() {
            @Override
            public void onTextChanged(CharSequence s, int start, int before, int count) {
                // TODO Auto-generated method stub
            }

            @Override
            public void beforeTextChanged(CharSequence s, int start, int count, int after) {
                // TODO Auto-generated method stub
            }

            @Override
            public void afterTextChanged(Editable s) {
                filter(s.toString());
            }
        });
        mExampleAdapter1 = new Adapter(mExampleList);
        mRecyclerView1.setAdapter(mExampleAdapter1);

        tvDateResult2.addTextChangedListener(new TextWatcher() {
            @Override
            public void onTextChanged(CharSequence s, int start, int before, int count) {
                // TODO Auto-generated method stub
            }

            @Override
            public void beforeTextChanged(CharSequence s, int start, int count, int after) {
                // TODO Auto-generated method stub
            }

            @Override
            public void afterTextChanged(Editable s) {
                filter2(s.toString());
            }
        });
        mExampleAdapter2 = new Adapter2(mExampleList2);
        mRecyclerView2.setAdapter(mExampleAdapter2);

        tvDateResult3.addTextChangedListener(new TextWatcher() {
            @Override
            public void onTextChanged(CharSequence s, int start, int before, int count) {
                // TODO Auto-generated method stub
            }

            @Override
            public void beforeTextChanged(CharSequence s, int start, int count, int after) {
                // TODO Auto-generated method stub
            }

            @Override
            public void afterTextChanged(Editable s) {
                filter3(s.toString());
            }
        });
        mExampleAdapter3 = new Adapter3(mExampleList3);
        mRecyclerView3.setAdapter(mExampleAdapter3);

        tvDateResult4.addTextChangedListener(new TextWatcher() {
            @Override
            public void onTextChanged(CharSequence s, int start, int before, int count) {
                // TODO Auto-generated method stub
            }

            @Override
            public void beforeTextChanged(CharSequence s, int start, int count, int after) {
                // TODO Auto-generated method stub
            }

            @Override
            public void afterTextChanged(Editable s) {
                filter4(s.toString());
            }
        });
        mExampleAdapter4 = new Adapter4(mExampleList4);
        mRecyclerView4.setAdapter(mExampleAdapter4);

        tvDateResult5.addTextChangedListener(new TextWatcher() {
            @Override
            public void onTextChanged(CharSequence s, int start, int before, int count) {
                // TODO Auto-generated method stub
            }

            @Override
            public void beforeTextChanged(CharSequence s, int start, int count, int after) {
                // TODO Auto-generated method stub
            }

            @Override
            public void afterTextChanged(Editable s) {
                filter5(s.toString());
            }
        });
        mExampleAdapter5 = new Adapter5(mExampleList5);
        mRecyclerView5.setAdapter(mExampleAdapter5);

        parseJSON();

    }

    void filter(String text){
        ArrayList<Model> temp = new ArrayList();
        for(Model d: mExampleList){
            //or use .equal(text) with you want equal match
            //use .toLowerCase() for better matches
            if(d.getmTanggal1().toLowerCase().contains(text)){
                temp.add(d);
            }
        }
        mExampleAdapter1.updateList(temp);
    }

    void filter2(String text){
        ArrayList<Model2> temp = new ArrayList();
        for(Model2 d: mExampleList2){
            //or use .equal(text) with you want equal match
            //use .toLowerCase() for better matches
            if(d.getmTanggal2().toLowerCase().contains(text)){
                temp.add(d);
            }
        }
        mExampleAdapter2.updateList(temp);
    }

    void filter3(String text){
        ArrayList<Model3> temp = new ArrayList();
        for(Model3 d: mExampleList3){
            //or use .equal(text) with you want equal match
            //use .toLowerCase() for better matches
            if(d.getmTanggal3().toLowerCase().contains(text)){
                temp.add(d);
            }
        }
        mExampleAdapter3.updateList(temp);
    }

    void filter4(String text){
        ArrayList<Model4> temp = new ArrayList();
        for(Model4 d: mExampleList4){
            //or use .equal(text) with you want equal match
            //use .toLowerCase() for better matches
            if(d.getmTanggal4().toLowerCase().contains(text)){
                temp.add(d);
            }
        }
        mExampleAdapter4.updateList(temp);
    }

    void filter5(String text){
        ArrayList<Model5> temp = new ArrayList();
        for(Model5 d: mExampleList5){
            //or use .equal(text) with you want equal match
            //use .toLowerCase() for better matches
            if(d.getmTanggal5().toLowerCase().contains(text)){
                temp.add(d);
            }
        }
        mExampleAdapter5.updateList(temp);
    }

    private void showDateDialog1(){
        Calendar newCalendar = Calendar.getInstance();
        datePickerDialog1 = new DatePickerDialog(this, new DatePickerDialog.OnDateSetListener() {

            @Override
            public void onDateSet(DatePicker view, int year, int monthOfYear, int dayOfMonth) {
                Calendar newDate = Calendar.getInstance();
                newDate.set(year, monthOfYear, dayOfMonth);
                tvDateResult1.setText(dateFormatter1.format(newDate.getTime()));
            }

        }, newCalendar.get(Calendar.YEAR), newCalendar.get(Calendar.MONTH), newCalendar.get(Calendar.DAY_OF_MONTH));
        datePickerDialog1.show();
    }
    private void showDateDialog2(){
        Calendar newCalendar = Calendar.getInstance();
        datePickerDialog2 = new DatePickerDialog(this, new DatePickerDialog.OnDateSetListener() {

            @Override
            public void onDateSet(DatePicker view, int year, int monthOfYear, int dayOfMonth) {
                Calendar newDate = Calendar.getInstance();
                newDate.set(year, monthOfYear, dayOfMonth);
                tvDateResult2.setText(dateFormatter2.format(newDate.getTime()));
            }

        }, newCalendar.get(Calendar.YEAR), newCalendar.get(Calendar.MONTH), newCalendar.get(Calendar.DAY_OF_MONTH));
        datePickerDialog2.show();
    }
    private void showDateDialog3(){
        Calendar newCalendar = Calendar.getInstance();
        datePickerDialog3 = new DatePickerDialog(this, new DatePickerDialog.OnDateSetListener() {

            @Override
            public void onDateSet(DatePicker view, int year, int monthOfYear, int dayOfMonth) {
                Calendar newDate = Calendar.getInstance();
                newDate.set(year, monthOfYear, dayOfMonth);
                tvDateResult3.setText(dateFormatter3.format(newDate.getTime()));
            }

        }, newCalendar.get(Calendar.YEAR), newCalendar.get(Calendar.MONTH), newCalendar.get(Calendar.DAY_OF_MONTH));
        datePickerDialog3.show();
    }
    private void showDateDialog4(){
        Calendar newCalendar = Calendar.getInstance();
        datePickerDialog4 = new DatePickerDialog(this, new DatePickerDialog.OnDateSetListener() {

            @Override
            public void onDateSet(DatePicker view, int year, int monthOfYear, int dayOfMonth) {
                Calendar newDate = Calendar.getInstance();
                newDate.set(year, monthOfYear, dayOfMonth);
                tvDateResult4.setText(dateFormatter4.format(newDate.getTime()));
            }

        }, newCalendar.get(Calendar.YEAR), newCalendar.get(Calendar.MONTH), newCalendar.get(Calendar.DAY_OF_MONTH));
        datePickerDialog4.show();
    }
    private void showDateDialog5(){
        Calendar newCalendar = Calendar.getInstance();
        datePickerDialog5 = new DatePickerDialog(this, new DatePickerDialog.OnDateSetListener() {

            @Override
            public void onDateSet(DatePicker view, int year, int monthOfYear, int dayOfMonth) {
                Calendar newDate = Calendar.getInstance();
                newDate.set(year, monthOfYear, dayOfMonth);
                tvDateResult5.setText(dateFormatter5.format(newDate.getTime()));
            }

        }, newCalendar.get(Calendar.YEAR), newCalendar.get(Calendar.MONTH), newCalendar.get(Calendar.DAY_OF_MONTH));
        datePickerDialog5.show();
    }

    private void parseJSON() {
        String url = "http://172.16.23.34/laporan-harian-esdm/api/lap_klik";
        JsonObjectRequest request = new JsonObjectRequest(Request.Method.GET, url, null,
                new Response.Listener<JSONObject>() {
                    @Override
                    public void onResponse(JSONObject response) {
                        try {
                            JSONArray jsonArray = response.getJSONArray("lap_klik_migas");

                            for (int i = 0; i < jsonArray.length(); i++) {
                                JSONObject hit = jsonArray.getJSONObject(i);
                                //
                                String date1 = hit.getString("TANGGAL_LAPORAN");
                                String berita1 = hit.getString("BERITA");
                                String jenis1 = hit.getString("JENIS");
                                String url1 = hit.getString("URL");

                                mExampleList.add(new Model(date1, berita1, jenis1, url1));

                            }
                            mExampleAdapter1 = new Adapter(KlikActivity.this, mExampleList);
                            mRecyclerView1.setAdapter(mExampleAdapter1);

                        } catch (JSONException e) {
                            e.printStackTrace();
                        }

                        try {
                            JSONArray jsonArray = response.getJSONArray("lap_klik_minerba");

                            for (int a = 0; a < jsonArray.length(); a++) {
                                JSONObject hit = jsonArray.getJSONObject(a);
                                //
                                String date2 = hit.getString("TANGGAL_LAPORAN");
                                String berita2 = hit.getString("BERITA");
                                String jenis2 = hit.getString("JENIS");
                                String url2 = hit.getString("URL");

                                mExampleList2.add(new Model2(date2, berita2, jenis2, url2));

                            }
                            mExampleAdapter2 = new Adapter2(KlikActivity.this, mExampleList2);
                            mRecyclerView2.setAdapter(mExampleAdapter2);

                        } catch (JSONException e) {
                            e.printStackTrace();
                        }

                        try {
                            JSONArray jsonArray = response.getJSONArray("lap_klik_gatrik");

                            for (int i = 0; i < jsonArray.length(); i++) {
                                JSONObject hit = jsonArray.getJSONObject(i);
                                //
                                String date3 = hit.getString("TANGGAL_LAPORAN");
                                String berita3 = hit.getString("BERITA");
                                String jenis3 = hit.getString("JENIS");
                                String url3 = hit.getString("URL");

                                mExampleList3.add(new Model3(date3, berita3, jenis3, url3));

                            }
                            mExampleAdapter3 = new Adapter3(KlikActivity.this, mExampleList3);
                            mRecyclerView3.setAdapter(mExampleAdapter3);

                        } catch (JSONException e) {
                            e.printStackTrace();
                        }

                        try {
                            JSONArray jsonArray = response.getJSONArray("lap_klik_ebtke");

                            for (int i = 0; i < jsonArray.length(); i++) {
                                JSONObject hit = jsonArray.getJSONObject(i);
                                //
                                String date4 = hit.getString("TANGGAL_LAPORAN");
                                String berita4 = hit.getString("BERITA");
                                String jenis4 = hit.getString("JENIS");
                                String url4 = hit.getString("URL");

                                mExampleList4.add(new Model4(date4, berita4, jenis4, url4));

                            }
                            mExampleAdapter4 = new Adapter4(KlikActivity.this, mExampleList4);
                            mRecyclerView4.setAdapter(mExampleAdapter4);

                        } catch (JSONException e) {
                            e.printStackTrace();
                        }

                        try {
                            JSONArray jsonArray = response.getJSONArray("lap_klik_geologi");

                            for (int i = 0; i < jsonArray.length(); i++) {
                                JSONObject hit = jsonArray.getJSONObject(i);
                                //
                                String date5 = hit.getString("TANGGAL_LAPORAN");
                                String berita5 = hit.getString("BERITA");
                                String jenis5 = hit.getString("JENIS");
                                String url5 = hit.getString("URL");

                                mExampleList5.add(new Model5(date5, berita5, jenis5, url5));

                            }
                            mExampleAdapter5 = new Adapter5(KlikActivity.this, mExampleList5);
                            mRecyclerView5.setAdapter(mExampleAdapter5);

                        } catch (JSONException e) {
                            e.printStackTrace();
                        }
                    }
                }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                error.printStackTrace();
            }
        })
        {
            @Override
            public Map<String, String> getHeaders() throws AuthFailureError {
                Map<String, String> headers = new HashMap<>();
                String credentials = "admin2:1234";
                String auth = "Basic " + Base64.encodeToString(credentials.getBytes(), Base64.NO_WRAP);
                headers.put("Content-Type", "application/json");
                headers.put("Authorization", auth);
                return headers;
            }
        };

        mRequestQueue.add(request);
    }


}