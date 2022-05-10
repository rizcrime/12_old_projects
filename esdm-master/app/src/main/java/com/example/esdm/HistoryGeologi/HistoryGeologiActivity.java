package com.example.esdm.HistoryGeologi;

import android.app.DatePickerDialog;
import android.support.v4.app.Fragment;
import android.os.Bundle;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.text.Editable;
import android.text.TextWatcher;
import android.util.Base64;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.ScrollView;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.Volley;
import com.example.esdm.HistoryGeologi.GeoApi.Adapter;
import com.example.esdm.HistoryGeologi.GeoApi.Model;
import com.example.esdm.HistoryGeologi.GeoBumi.Adapter2;
import com.example.esdm.HistoryGeologi.GeoBumi.Model2;
import com.example.esdm.HistoryGeologi.GeoTanah.Adapter3;
import com.example.esdm.HistoryGeologi.GeoTanah.Model3;
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

public class HistoryGeologiActivity extends Fragment {

    private LinearLayout layar1, layar2, layar3;
    private Button gunung_api, gerakan_tanah, gempa_bumi;
    private DatePickerDialog datePickerDialog1, datePickerDialog2, datePickerDialog3;
    private SimpleDateFormat dateFormatter1, dateFormatter2, dateFormatter3;
    private EditText tvDateResult1, tvDateResult2, tvDateResult3;
    private ImageView btDatePicker1, btDatePicker2, btDatePicker3;
    private RecyclerView mRecyclerView1, mRecyclerView2, mRecyclerView3;
    private Adapter mExampleAdapter1;
    private Adapter2 mExampleAdapter2;
    private Adapter3 mExampleAdapter3;
    private ArrayList<Model> mExampleList;
    private ArrayList<Model2> mExampleList2;
    private ArrayList<Model3> mExampleList3;
    private RequestQueue mRequestQueue;

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        ScrollView rootView = (ScrollView) inflater.inflate(R.layout.activity_geologi, container, false);

        gunung_api = rootView.findViewById(R.id.btn1);
        gerakan_tanah = rootView.findViewById(R.id.btn2);
        gempa_bumi = rootView.findViewById(R.id.btn3);

        layar1 = rootView.findViewById(R.id.layout1);
        layar2 = rootView.findViewById(R.id.layout2);
        layar3 = rootView.findViewById(R.id.layout3);

        mRecyclerView1 = rootView.findViewById(R.id.recycler1);
        mRecyclerView2 = rootView.findViewById(R.id.recycler2);
        mRecyclerView3 = rootView.findViewById(R.id.recycler3);

        mRecyclerView1.setHasFixedSize(true);
        mRecyclerView1.setLayoutManager(new LinearLayoutManager(getActivity()));

        mRecyclerView2.setHasFixedSize(true);
        mRecyclerView2.setLayoutManager(new LinearLayoutManager(getActivity()));

        mRecyclerView3.setHasFixedSize(true);
        mRecyclerView3.setLayoutManager(new LinearLayoutManager(getActivity()));

        mExampleList = new ArrayList<>();
        mExampleList2 = new ArrayList<>();
        mExampleList3 = new ArrayList<>();

        mRequestQueue = Volley.newRequestQueue(getActivity());

        gunung_api.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if (layar1.getVisibility() == View.VISIBLE)
                    layar1.setVisibility(View.GONE);
                else
                    layar1.setVisibility(View.VISIBLE);
                layar3.setVisibility(View.GONE);
                layar2.setVisibility(View.GONE);
            }
        });

        gerakan_tanah.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if (layar2.getVisibility() == View.VISIBLE)
                    layar2.setVisibility(View.GONE);
                else
                    layar2.setVisibility(View.VISIBLE);
                layar3.setVisibility(View.GONE);
                layar1.setVisibility(View.GONE);
            }
        });

        gempa_bumi.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if (layar3.getVisibility() == View.VISIBLE)
                    layar3.setVisibility(View.GONE);
                else
                    layar3.setVisibility(View.VISIBLE);
                layar2.setVisibility(View.GONE);
                layar1.setVisibility(View.GONE);
            }
        });

        //MEMBUAT DATEPICKER1
        dateFormatter1 = new SimpleDateFormat("yyyy-MM-dd", Locale.US);
        tvDateResult1 = (EditText) rootView.findViewById(R.id.tv_dateresult1);
        btDatePicker1 = (ImageView) rootView.findViewById(R.id.bt_datepicker1);
        btDatePicker1.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                showDateDialog1();
            }
        });
        //MEMBUAT DATEPICKER2
        dateFormatter2 = new SimpleDateFormat("yyyy-MM-dd", Locale.US);
        tvDateResult2 = (EditText) rootView.findViewById(R.id.tv_dateresult2);
        btDatePicker2 = (ImageView) rootView.findViewById(R.id.bt_datepicker2);
        btDatePicker2.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                showDateDialog2();
            }
        });
        //MEMBUAT DATEPICKER3
        dateFormatter3 = new SimpleDateFormat("yyyy-MM-dd", Locale.US);
        tvDateResult3 = (EditText) rootView.findViewById(R.id.tv_dateresult3);
        btDatePicker3 = (ImageView) rootView.findViewById(R.id.bt_datepicker3);
        btDatePicker3.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                showDateDialog3();
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

        parseJSON();
        return rootView;
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

    private void showDateDialog1(){
        Calendar newCalendar = Calendar.getInstance();
        datePickerDialog1 = new DatePickerDialog(getActivity(), new DatePickerDialog.OnDateSetListener() {

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
        datePickerDialog2 = new DatePickerDialog(getActivity(), new DatePickerDialog.OnDateSetListener() {

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
        datePickerDialog3 = new DatePickerDialog(getActivity(), new DatePickerDialog.OnDateSetListener() {

            @Override
            public void onDateSet(DatePicker view, int year, int monthOfYear, int dayOfMonth) {
                Calendar newDate = Calendar.getInstance();
                newDate.set(year, monthOfYear, dayOfMonth);
                tvDateResult3.setText(dateFormatter3.format(newDate.getTime()));
            }

        }, newCalendar.get(Calendar.YEAR), newCalendar.get(Calendar.MONTH), newCalendar.get(Calendar.DAY_OF_MONTH));
        datePickerDialog3.show();
    }


    private void parseJSON() {
        String url = "http://172.16.23.34/laporan-harian-esdm/api/lap_geologi";
        JsonObjectRequest request = new JsonObjectRequest(Request.Method.GET, url, null,
                new Response.Listener<JSONObject>() {
                    @Override
                    public void onResponse(JSONObject response) {
                        try {
                            JSONArray jsonArray = response.getJSONArray("lap_geologi_gunung_api");

                            for (int i = 0; i < jsonArray.length(); i++) {
                                JSONObject hit = jsonArray.getJSONObject(i);
                                //
                                String tanggal1 = hit.getString("TANGGAL_LAPORAN");
                                String gunungapi1 = hit.getString("ID_GUNUNG");
                                String tingkataktifitas1 = hit.getString("ID_AKTIVITAS");
                                String keterangan1 = hit.getString("KETERANGAN");
                                String rekomendasi1 = hit.getString("REKOMENDASI");
                                String vona1 = hit.getString("VONA");
                                String detail1 = hit.getString("DETAIL");

                                mExampleList.add(new Model(tanggal1, gunungapi1, tingkataktifitas1, keterangan1, rekomendasi1,
                                        vona1, detail1));
                            }
                            mExampleAdapter1 = new Adapter(getActivity(), mExampleList);
                            mRecyclerView1.setAdapter(mExampleAdapter1);

                        } catch (JSONException e) {
                            e.printStackTrace();
                        }

                        try {
                            JSONArray jsonArray = response.getJSONArray("lap_geologi_gempa_bumi");

                            for (int i = 0; i < jsonArray.length(); i++) {
                                JSONObject hit = jsonArray.getJSONObject(i);
                                //
                                String tanggal2 = hit.getString("TANGGAL_LAPORAN");
                                String gunungapi1 = hit.getString("LOKASI");
                                String tingkataktifitas1 = hit.getString("INFORMASI");
                                String keterangan1 = hit.getString("KONDISI_GEOLOGI_DT");
                                String rekomendasi1 = hit.getString("REKOMENDASI");
                                String vona1 = hit.getString("PENYEBAB_GEMPA");
                                String detail1 = hit.getString("DAMPAK_GEMPA");

                                mExampleList2.add(new Model2(tanggal2, gunungapi1, tingkataktifitas1, keterangan1, rekomendasi1,
                                        vona1, detail1));
                            }
                            mExampleAdapter2 = new Adapter2(getActivity(), mExampleList2);
                            mRecyclerView2.setAdapter(mExampleAdapter2);

                        } catch (JSONException e) {
                            e.printStackTrace();
                        }

                        try {
                            JSONArray jsonArray = response.getJSONArray("lap_geologi_gunung_api");

                            for (int i = 0; i < jsonArray.length(); i++) {
                                JSONObject hit = jsonArray.getJSONObject(i);
                                //
                                String tanggal3 = hit.getString("TANGGAL_LAPORAN");
                                String gunungapi1 = hit.getString("KETERANGAN");
                                String tingkataktifitas1 = hit.getString("DETAIL");

                                mExampleList3.add(new Model3(tanggal3, gunungapi1, tingkataktifitas1));
                            }
                            mExampleAdapter3 = new Adapter3(getActivity(), mExampleList3);
                            mRecyclerView3.setAdapter(mExampleAdapter3);

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