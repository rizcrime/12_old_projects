package com.example.esdm.Pusdatin;

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
import com.example.esdm.Pusdatin.BeritaOpec.Adapter8;
import com.example.esdm.Pusdatin.BeritaOpec.Model8;
import com.example.esdm.Pusdatin.HargaBatubara.Adapter9;
import com.example.esdm.Pusdatin.HargaBatubara.Model9;
import com.example.esdm.Pusdatin.HargaBbm.Adapter6;
import com.example.esdm.Pusdatin.HargaBbm.Model6;
import com.example.esdm.Pusdatin.HargaMineral.Adapter10;
import com.example.esdm.Pusdatin.HargaMineral.Model10;
import com.example.esdm.Pusdatin.Icp.Adapter2;
import com.example.esdm.Pusdatin.Icp.Model2;
import com.example.esdm.Pusdatin.LiftingTahun.Adapter5;
import com.example.esdm.Pusdatin.LiftingTahun.Model5;
import com.example.esdm.Pusdatin.PenyaluranPremium.Adapter7;
import com.example.esdm.Pusdatin.PenyaluranPremium.Model7;
import com.example.esdm.Pusdatin.ProdEkuivalen.Adapter4;
import com.example.esdm.Pusdatin.ProdEkuivalen.Model4;
import com.example.esdm.Pusdatin.ProdGas.Adapter3;
import com.example.esdm.Pusdatin.ProdGas.Model3;
import com.example.esdm.Pusdatin.ProdMinyak.Adapter;
import com.example.esdm.Pusdatin.ProdMinyak.Model;
import com.example.esdm.Pusdatin.StatusKetenagalistrikan.Adapter11;
import com.example.esdm.Pusdatin.StatusKetenagalistrikan.Model11;
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

public class PusdatinActivity extends AppCompatActivity{

    LinearLayout layar1, layar2, layar3, layar4, layar5, layar6, layar7, layar8, layar9, layar10, layar11;
    Button prodminyak, icp, prodekuivalen, prodgas, liftingtahun, hargabbm, progrespenyaluran, beritaopec, hargabatubara,
            hargamineral, status;
    DatePickerDialog datePickerDialog1, datePickerDialog2, datePickerDialog3, datePickerDialog4, datePickerDialog5,
            datePickerDialog6, datePickerDialog7, datePickerDialog8, datePickerDialog9, datePickerDialog10, datePickerDialog11;
    SimpleDateFormat dateFormatter1, dateFormatter2, dateFormatter3, dateFormatter4, dateFormatter5,
            dateFormatter6, dateFormatter7, dateFormatter8, dateFormatter9, dateFormatter10, dateFormatter11;
    EditText tvDateResult1, tvDateResult2, tvDateResult3, tvDateResult4, tvDateResult5,
            tvDateResult6, tvDateResult7, tvDateResult8, tvDateResult9, tvDateResult10, tvDateResult11;
    ImageView btDatePicker1, btDatePicker2, btDatePicker3, btDatePicker4, btDatePicker5,
            btDatePicker6, btDatePicker7, btDatePicker8, btDatePicker9, btDatePicker10, btDatePicker11;
    RecyclerView mRecyclerView1, mRecyclerView2, mRecyclerView3, mRecyclerView4, mRecyclerView5,
            mRecyclerView6, mRecyclerView7, mRecyclerView8, mRecyclerView9, mRecyclerView10, mRecyclerView11;
    Adapter mExampleAdapter1;
    Adapter2 mExampleAdapter2;
    Adapter3 mExampleAdapter3;
    Adapter4 mExampleAdapter4;
    Adapter5 mExampleAdapter5;
    Adapter6 mExampleAdapter6;
    Adapter7 mExampleAdapter7;
    Adapter8 mExampleAdapter8;
    Adapter9 mExampleAdapter9;
    Adapter10 mExampleAdapter10;
    Adapter11 mExampleAdapter11;
    ArrayList<Model> mExampleList;
    ArrayList<Model2> mExampleList2;
    ArrayList<Model3> mExampleList3;
    ArrayList<Model4> mExampleList4;
    ArrayList<Model5> mExampleList5;
    ArrayList<Model6> mExampleList6;
    ArrayList<Model7> mExampleList7;
    ArrayList<Model8> mExampleList8;
    ArrayList<Model9> mExampleList9;
    ArrayList<Model10> mExampleList10;
    ArrayList<Model11> mExampleList11;
    RequestQueue mRequestQueue;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_pusdatin);

        prodminyak = findViewById(R.id.btn1);
        icp = findViewById(R.id.btn2);
        prodgas = findViewById(R.id.btn3);
        prodekuivalen = findViewById(R.id.btn4);
        liftingtahun = findViewById(R.id.btn5);
        hargabbm = findViewById(R.id.btn6);
        progrespenyaluran = findViewById(R.id.btn7);
        beritaopec = findViewById(R.id.btn8);
        hargabatubara = findViewById(R.id.btn9);
        hargamineral = findViewById(R.id.btn10);
        status = findViewById(R.id.btn11);

        layar1 = findViewById(R.id.layout1);
        layar2 = findViewById(R.id.layout2);
        layar3 = findViewById(R.id.layout3);
        layar4 = findViewById(R.id.layout4);
        layar5 = findViewById(R.id.layout5);
        layar6 = findViewById(R.id.layout6);
        layar7 = findViewById(R.id.layout7);
        layar8 = findViewById(R.id.layout8);
        layar9 = findViewById(R.id.layout9);
        layar10 = findViewById(R.id.layout10);
        layar11 = findViewById(R.id.layout11);

        mRecyclerView1 = findViewById(R.id.recycler1);
        mRecyclerView2 = findViewById(R.id.recycler2);
        mRecyclerView3 = findViewById(R.id.recycler3);
        mRecyclerView4 = findViewById(R.id.recycler4);
        mRecyclerView5 = findViewById(R.id.recycler5);
        mRecyclerView6 = findViewById(R.id.recycler6);
        mRecyclerView7 = findViewById(R.id.recycler7);
        mRecyclerView8 = findViewById(R.id.recycler8);
        mRecyclerView9 = findViewById(R.id.recycler9);
        mRecyclerView10 = findViewById(R.id.recycler10);
        mRecyclerView11 = findViewById(R.id.recycler11);

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

        mRecyclerView6.setHasFixedSize(true);
        mRecyclerView6.setLayoutManager(new LinearLayoutManager(this));

        mRecyclerView7.setHasFixedSize(true);
        mRecyclerView7.setLayoutManager(new LinearLayoutManager(this));

        mRecyclerView8.setHasFixedSize(true);
        mRecyclerView8.setLayoutManager(new LinearLayoutManager(this));

        mRecyclerView9.setHasFixedSize(true);
        mRecyclerView9.setLayoutManager(new LinearLayoutManager(this));

        mRecyclerView10.setHasFixedSize(true);
        mRecyclerView10.setLayoutManager(new LinearLayoutManager(this));

        mRecyclerView11.setHasFixedSize(true);
        mRecyclerView11.setLayoutManager(new LinearLayoutManager(this));

        mExampleList = new ArrayList<>();
        mExampleList2 = new ArrayList<>();
        mExampleList3 = new ArrayList<>();
        mExampleList4 = new ArrayList<>();
        mExampleList5 = new ArrayList<>();
        mExampleList6 = new ArrayList<>();
        mExampleList7 = new ArrayList<>();
        mExampleList8 = new ArrayList<>();
        mExampleList9 = new ArrayList<>();
        mExampleList10 = new ArrayList<>();
        mExampleList11 = new ArrayList<>();

        mRequestQueue = Volley.newRequestQueue(this);

        prodminyak.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(layar1.getVisibility() == View.VISIBLE)
                    layar1.setVisibility(View.GONE);
                else
                    layar1.setVisibility(View.VISIBLE);
                    layar2.setVisibility(View.GONE);
                    layar10.setVisibility(View.GONE);
                    layar9.setVisibility(View.GONE);
                    layar8.setVisibility(View.GONE);
                    layar7.setVisibility(View.GONE);
                    layar6.setVisibility(View.GONE);
                    layar5.setVisibility(View.GONE);
                    layar4.setVisibility(View.GONE);
                    layar3.setVisibility(View.GONE);
                    layar11.setVisibility(View.GONE);
            }
        });

        icp.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(layar2.getVisibility() == View.VISIBLE)
                    layar2.setVisibility(View.GONE);
                else
                    layar2.setVisibility(View.VISIBLE);
                    layar11.setVisibility(View.GONE);
                    layar10.setVisibility(View.GONE);
                    layar9.setVisibility(View.GONE);
                    layar8.setVisibility(View.GONE);
                    layar7.setVisibility(View.GONE);
                    layar6.setVisibility(View.GONE);
                    layar5.setVisibility(View.GONE);
                    layar4.setVisibility(View.GONE);
                    layar3.setVisibility(View.GONE);
                    layar1.setVisibility(View.GONE);
            }
        });

        prodgas.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(layar3.getVisibility() == View.VISIBLE)
                    layar3.setVisibility(View.GONE);
                else
                    layar3.setVisibility(View.VISIBLE);
                    layar2.setVisibility(View.GONE);
                    layar10.setVisibility(View.GONE);
                    layar9.setVisibility(View.GONE);
                    layar8.setVisibility(View.GONE);
                    layar7.setVisibility(View.GONE);
                    layar6.setVisibility(View.GONE);
                    layar5.setVisibility(View.GONE);
                    layar4.setVisibility(View.GONE);
                    layar11.setVisibility(View.GONE);
                    layar1.setVisibility(View.GONE);
            }
        });

        prodekuivalen.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(layar4.getVisibility() == View.VISIBLE)
                    layar4.setVisibility(View.GONE);
                else
                    layar4.setVisibility(View.VISIBLE);
                    layar2.setVisibility(View.GONE);
                    layar10.setVisibility(View.GONE);
                    layar9.setVisibility(View.GONE);
                    layar8.setVisibility(View.GONE);
                    layar7.setVisibility(View.GONE);
                    layar6.setVisibility(View.GONE);
                    layar5.setVisibility(View.GONE);
                    layar11.setVisibility(View.GONE);
                    layar3.setVisibility(View.GONE);
                    layar1.setVisibility(View.GONE);
            }
        });

        liftingtahun.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(layar5.getVisibility() == View.VISIBLE)
                    layar5.setVisibility(View.GONE);
                else
                    layar5.setVisibility(View.VISIBLE);
                    layar2.setVisibility(View.GONE);
                    layar10.setVisibility(View.GONE);
                    layar9.setVisibility(View.GONE);
                    layar8.setVisibility(View.GONE);
                    layar7.setVisibility(View.GONE);
                    layar6.setVisibility(View.GONE);
                    layar11.setVisibility(View.GONE);
                    layar4.setVisibility(View.GONE);
                    layar3.setVisibility(View.GONE);
                    layar1.setVisibility(View.GONE);
            }
        });

        hargabbm.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(layar6.getVisibility() == View.VISIBLE)
                    layar6.setVisibility(View.GONE);
                else
                    layar6.setVisibility(View.VISIBLE);
                    layar2.setVisibility(View.GONE);
                    layar10.setVisibility(View.GONE);
                    layar9.setVisibility(View.GONE);
                    layar8.setVisibility(View.GONE);
                    layar7.setVisibility(View.GONE);
                    layar11.setVisibility(View.GONE);
                    layar5.setVisibility(View.GONE);
                    layar4.setVisibility(View.GONE);
                    layar3.setVisibility(View.GONE);
                    layar1.setVisibility(View.GONE);
            }
        });

        progrespenyaluran.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(layar7.getVisibility() == View.VISIBLE)
                    layar7.setVisibility(View.GONE);
                else
                    layar7.setVisibility(View.VISIBLE);
                    layar2.setVisibility(View.GONE);
                    layar10.setVisibility(View.GONE);
                    layar9.setVisibility(View.GONE);
                    layar8.setVisibility(View.GONE);
                    layar11.setVisibility(View.GONE);
                    layar6.setVisibility(View.GONE);
                    layar5.setVisibility(View.GONE);
                    layar4.setVisibility(View.GONE);
                    layar3.setVisibility(View.GONE);
                    layar1.setVisibility(View.GONE);
            }
        });

        beritaopec.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(layar8.getVisibility() == View.VISIBLE)
                    layar8.setVisibility(View.GONE);
                else
                    layar8.setVisibility(View.VISIBLE);
                    layar2.setVisibility(View.GONE);
                    layar10.setVisibility(View.GONE);
                    layar9.setVisibility(View.GONE);
                    layar11.setVisibility(View.GONE);
                    layar7.setVisibility(View.GONE);
                    layar6.setVisibility(View.GONE);
                    layar5.setVisibility(View.GONE);
                    layar4.setVisibility(View.GONE);
                    layar3.setVisibility(View.GONE);
                    layar1.setVisibility(View.GONE);
            }
        });

        hargabatubara.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(layar9.getVisibility() == View.VISIBLE)
                    layar9.setVisibility(View.GONE);
                else
                    layar9.setVisibility(View.VISIBLE);
                    layar2.setVisibility(View.GONE);
                    layar10.setVisibility(View.GONE);
                    layar11.setVisibility(View.GONE);
                    layar8.setVisibility(View.GONE);
                    layar7.setVisibility(View.GONE);
                    layar6.setVisibility(View.GONE);
                    layar5.setVisibility(View.GONE);
                    layar4.setVisibility(View.GONE);
                    layar3.setVisibility(View.GONE);
                    layar1.setVisibility(View.GONE);
            }
        });

        hargamineral.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(layar10.getVisibility() == View.VISIBLE)
                    layar10.setVisibility(View.GONE);
                else
                    layar10.setVisibility(View.VISIBLE);
                    layar2.setVisibility(View.GONE);
                    layar11.setVisibility(View.GONE);
                    layar9.setVisibility(View.GONE);
                    layar8.setVisibility(View.GONE);
                    layar7.setVisibility(View.GONE);
                    layar6.setVisibility(View.GONE);
                    layar5.setVisibility(View.GONE);
                    layar4.setVisibility(View.GONE);
                    layar3.setVisibility(View.GONE);
                    layar1.setVisibility(View.GONE);
            }
        });

        status.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(layar11.getVisibility() == View.VISIBLE)
                    layar11.setVisibility(View.GONE);
                else
                    layar11.setVisibility(View.VISIBLE);
                    layar2.setVisibility(View.GONE);
                    layar10.setVisibility(View.GONE);
                    layar9.setVisibility(View.GONE);
                    layar8.setVisibility(View.GONE);
                    layar7.setVisibility(View.GONE);
                    layar6.setVisibility(View.GONE);
                    layar5.setVisibility(View.GONE);
                    layar4.setVisibility(View.GONE);
                    layar3.setVisibility(View.GONE);
                    layar1.setVisibility(View.GONE);

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
        //MEMBUAT DATEPICKER4
        dateFormatter4 = new SimpleDateFormat("yyyy-MM-dd", Locale.US);
        tvDateResult4 = (EditText) findViewById(R.id.tv_dateresult4);
        btDatePicker4 = (ImageView) findViewById(R.id.bt_datepicker4);
        btDatePicker4.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                showDateDialog4();
            }
        });
        //MEMBUAT DATEPICKER5
        dateFormatter5 = new SimpleDateFormat("yyyy-MM-dd", Locale.US);
        tvDateResult5 = (EditText) findViewById(R.id.tv_dateresult5);
        btDatePicker5 = (ImageView) findViewById(R.id.bt_datepicker5);
        btDatePicker5.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) { showDateDialog5();
            }
        });
        //MEMBUAT DATEPICKER6
        dateFormatter6 = new SimpleDateFormat("yyyy-MM-dd", Locale.US);
        tvDateResult6 = (EditText) findViewById(R.id.tv_dateresult6);
        btDatePicker6 = (ImageView) findViewById(R.id.bt_datepicker6);
        btDatePicker6.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                showDateDialog6();
            }
        });
        //MEMBUAT DATEPICKER7
        dateFormatter7 = new SimpleDateFormat("yyyy-MM-dd", Locale.US);
        tvDateResult7 = (EditText) findViewById(R.id.tv_dateresult7);
        btDatePicker7 = (ImageView) findViewById(R.id.bt_datepicker7);
        btDatePicker7.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                showDateDialog7();
            }
        });
        //MEMBUAT DATEPICKER8
        dateFormatter8 = new SimpleDateFormat("yyyy-MM-dd", Locale.US);
        tvDateResult8 = (EditText) findViewById(R.id.tv_dateresult8);
        btDatePicker8 = (ImageView) findViewById(R.id.bt_datepicker8);
        btDatePicker8.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                showDateDialog8();
            }
        });
        //MEMBUAT DATEPICKER9
        dateFormatter9 = new SimpleDateFormat("yyyy-MM-dd", Locale.US);
        tvDateResult9 = (EditText) findViewById(R.id.tv_dateresult9);
        btDatePicker9 = (ImageView) findViewById(R.id.bt_datepicker9);
        btDatePicker9.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                showDateDialog9();
            }
        });
        //MEMBUAT DATEPICKER10
        dateFormatter10 = new SimpleDateFormat("yyyy-MM-dd", Locale.US);
        tvDateResult10 = (EditText) findViewById(R.id.tv_dateresult10);
        btDatePicker10 = (ImageView) findViewById(R.id.bt_datepicker10);
        btDatePicker10.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                showDateDialog10();
            }
        });
        //MEMBUAT DATEPICKER11
        dateFormatter11 = new SimpleDateFormat("yyyy-MM-dd", Locale.US);
        tvDateResult11 = (EditText) findViewById(R.id.tv_dateresult11);
        btDatePicker11 = (ImageView) findViewById(R.id.bt_datepicker11);
        btDatePicker11.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                showDateDialog11();
            }
        });

//        tvDateResult1.setText(dateFormatter1.format(new Date()));
        tvDateResult1.addTextChangedListener(new TextWatcher() {
	    @Override
            public void onTextChanged(CharSequence s, int start, int before, int count) {
                filter(s.toString());
            }

            @Override
            public void beforeTextChanged(CharSequence s, int start, int count, int after) {
//                filter(s.toString());
            }

            @Override
            public void afterTextChanged(Editable s) {
//                filter(s.toString());
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

        tvDateResult6.addTextChangedListener(new TextWatcher() {
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
                filter6(s.toString());
            }
        });
        mExampleAdapter6 = new Adapter6(mExampleList6);
        mRecyclerView6.setAdapter(mExampleAdapter6);

        tvDateResult7.addTextChangedListener(new TextWatcher() {
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
                filter7(s.toString());
            }
        });
        mExampleAdapter7 = new Adapter7(mExampleList7);
        mRecyclerView7.setAdapter(mExampleAdapter7);

        tvDateResult8.addTextChangedListener(new TextWatcher() {
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
                filter8(s.toString());
            }
        });
        mExampleAdapter8 = new Adapter8(mExampleList8);
        mRecyclerView8.setAdapter(mExampleAdapter8);

        tvDateResult9.addTextChangedListener(new TextWatcher() {
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
                filter9(s.toString());
            }
        });
        mExampleAdapter9 = new Adapter9(mExampleList9);
        mRecyclerView9.setAdapter(mExampleAdapter9);

        tvDateResult10.addTextChangedListener(new TextWatcher() {
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
                filter10(s.toString());
            }
        });
        mExampleAdapter10 = new Adapter10(mExampleList10);
        mRecyclerView10.setAdapter(mExampleAdapter10);

        tvDateResult11.addTextChangedListener(new TextWatcher() {
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
                filter11(s.toString());
            }
        });
        mExampleAdapter11 = new Adapter11(mExampleList11);
        mRecyclerView11.setAdapter(mExampleAdapter11);

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

    void filter6(String text){
        ArrayList<Model6> temp = new ArrayList();
        for(Model6 d: mExampleList6){
            //or use .equal(text) with you want equal match
            //use .toLowerCase() for better matches
            if(d.getmTanggal6().toLowerCase().contains(text)){
                temp.add(d);
            }
        }
        mExampleAdapter6.updateList(temp);
    }

    void filter7(String text){
        ArrayList<Model7> temp = new ArrayList();
        for(Model7 d: mExampleList7){
            //or use .equal(text) with you want equal match
            //use .toLowerCase() for better matches
            if(d.getmTanggal7().toLowerCase().contains(text)){
                temp.add(d);
            }
        }
        mExampleAdapter7.updateList(temp);
    }

    void filter8(String text){
        ArrayList<Model8> temp = new ArrayList();
        for(Model8 d: mExampleList8){
            //or use .equal(text) with you want equal match
            //use .toLowerCase() for better matches
            if(d.getmTanggal8().toLowerCase().contains(text)){
                temp.add(d);
            }
        }
        mExampleAdapter8.updateList(temp);
    }

    void filter9(String text){
        ArrayList<Model9> temp = new ArrayList();
        for(Model9 d: mExampleList9){
            //or use .equal(text) with you want equal match
            //use .toLowerCase() for better matches
            if(d.getmTanggal9().toLowerCase().contains(text)){
                temp.add(d);
            }
        }
        mExampleAdapter9.updateList(temp);
    }

    void filter10(String text){
        ArrayList<Model10> temp = new ArrayList();
        for(Model10 d: mExampleList10){
            //or use .equal(text) with you want equal match
            //use .toLowerCase() for better matches
            if(d.getmTanggal10().toLowerCase().contains(text)){
                temp.add(d);
            }
        }
        mExampleAdapter10.updateList(temp);
    }

    void filter11(String text){
        ArrayList<Model11> temp = new ArrayList();
        for(Model11 d: mExampleList11){
            //or use .equal(text) with you want equal match
            //use .toLowerCase() for better matches
            if(d.getmTanggal11().toLowerCase().contains(text)){
                temp.add(d);
            }
        }
        mExampleAdapter11.updateList(temp);
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
    private void showDateDialog6(){
        Calendar newCalendar = Calendar.getInstance();
        datePickerDialog6 = new DatePickerDialog(this, new DatePickerDialog.OnDateSetListener() {

            @Override
            public void onDateSet(DatePicker view, int year, int monthOfYear, int dayOfMonth) {
                Calendar newDate = Calendar.getInstance();
                newDate.set(year, monthOfYear, dayOfMonth);
                tvDateResult6.setText(dateFormatter6.format(newDate.getTime()));
            }

        }, newCalendar.get(Calendar.YEAR), newCalendar.get(Calendar.MONTH), newCalendar.get(Calendar.DAY_OF_MONTH));
        datePickerDialog6.show();
    }
    private void showDateDialog7(){
        Calendar newCalendar = Calendar.getInstance();
        datePickerDialog7 = new DatePickerDialog(this, new DatePickerDialog.OnDateSetListener() {

            @Override
            public void onDateSet(DatePicker view, int year, int monthOfYear, int dayOfMonth) {
                Calendar newDate = Calendar.getInstance();
                newDate.set(year, monthOfYear, dayOfMonth);
                tvDateResult7.setText(dateFormatter7.format(newDate.getTime()));
            }

        }, newCalendar.get(Calendar.YEAR), newCalendar.get(Calendar.MONTH), newCalendar.get(Calendar.DAY_OF_MONTH));
        datePickerDialog7.show();
    }
    private void showDateDialog8(){
        Calendar newCalendar = Calendar.getInstance();
        datePickerDialog8 = new DatePickerDialog(this, new DatePickerDialog.OnDateSetListener() {

            @Override
            public void onDateSet(DatePicker view, int year, int monthOfYear, int dayOfMonth) {
                Calendar newDate = Calendar.getInstance();
                newDate.set(year, monthOfYear, dayOfMonth);
                tvDateResult8.setText(dateFormatter8.format(newDate.getTime()));
            }

        }, newCalendar.get(Calendar.YEAR), newCalendar.get(Calendar.MONTH), newCalendar.get(Calendar.DAY_OF_MONTH));
        datePickerDialog8.show();
    }
    private void showDateDialog9(){
        Calendar newCalendar = Calendar.getInstance();
        datePickerDialog9 = new DatePickerDialog(this, new DatePickerDialog.OnDateSetListener() {

            @Override
            public void onDateSet(DatePicker view, int year, int monthOfYear, int dayOfMonth) {
                Calendar newDate = Calendar.getInstance();
                newDate.set(year, monthOfYear, dayOfMonth);
                tvDateResult9.setText(dateFormatter9.format(newDate.getTime()));
            }

        }, newCalendar.get(Calendar.YEAR), newCalendar.get(Calendar.MONTH), newCalendar.get(Calendar.DAY_OF_MONTH));
        datePickerDialog9.show();
    }
    private void showDateDialog10(){
        Calendar newCalendar = Calendar.getInstance();
        datePickerDialog10 = new DatePickerDialog(this, new DatePickerDialog.OnDateSetListener() {

            @Override
            public void onDateSet(DatePicker view, int year, int monthOfYear, int dayOfMonth) {
                Calendar newDate = Calendar.getInstance();
                newDate.set(year, monthOfYear, dayOfMonth);
                tvDateResult10.setText(dateFormatter10.format(newDate.getTime()));
            }

        }, newCalendar.get(Calendar.YEAR), newCalendar.get(Calendar.MONTH), newCalendar.get(Calendar.DAY_OF_MONTH));
        datePickerDialog10.show();
    }
    private void showDateDialog11(){
        Calendar newCalendar = Calendar.getInstance();
        datePickerDialog11 = new DatePickerDialog(this, new DatePickerDialog.OnDateSetListener() {

            @Override
            public void onDateSet(DatePicker view, int year, int monthOfYear, int dayOfMonth) {
                Calendar newDate = Calendar.getInstance();
                newDate.set(year, monthOfYear, dayOfMonth);
                tvDateResult11.setText(dateFormatter11.format(newDate.getTime()));
            }

        }, newCalendar.get(Calendar.YEAR), newCalendar.get(Calendar.MONTH), newCalendar.get(Calendar.DAY_OF_MONTH));
        datePickerDialog11.show();
    }

    private void parseJSON() {
        String url = "http://172.16.23.34/laporan-harian-esdm/api/Lap_pusdatin_last_date";
        JsonObjectRequest request = new JsonObjectRequest(Request.Method.GET, url, null,
                new Response.Listener<JSONObject>() {
                    @Override
                    public void onResponse(JSONObject response) {
                        try {
                            JSONArray jsonArray = response.getJSONArray("lap_pusdatin_prod_minyak");

                            for (int i = 0; i < jsonArray.length(); i++) {
                                JSONObject hit = jsonArray.getJSONObject(i);
                                //
                                String date = hit.getString("TANGGAL_LAPORAN");
                                int prodharian1 = hit.getInt("PROD_HARIAN");
                                int produbulanan1 = hit.getInt("PROD_BULANAN");
                                int prodtahunan1 = hit.getInt("PROD_TAHUNAN");
                                int targetapbn1 = hit.getInt("APBN");

                                mExampleList.add(new Model(date, prodharian1, produbulanan1, prodtahunan1, targetapbn1));

                            }

                            mExampleAdapter1 = new Adapter(PusdatinActivity.this, mExampleList);
                            mRecyclerView1.setAdapter(mExampleAdapter1);

                        } catch (JSONException e) {
                            e.printStackTrace();
                        }

                        try {
                            JSONArray jsonArray = response.getJSONArray("lap_pusdatin_icp");

                            for (int i = 0; i < jsonArray.length(); i++) {
                                JSONObject hit = jsonArray.getJSONObject(i);
                                //
                                String date = hit.getString("TANGGAL_LAPORAN");
                                String laporan2 = hit.getString("KETERANGAN");

                                mExampleList2.add(new Model2(date, laporan2));

                            }

                            mExampleAdapter2 = new Adapter2(PusdatinActivity.this, mExampleList2);
                            mRecyclerView2.setAdapter(mExampleAdapter2);

                        } catch (JSONException e) {
                            e.printStackTrace();
                        }

                        try {
                            JSONArray jsonArray = response.getJSONArray("lap_pusdatin_prod_gas");

                            for (int i = 0; i < jsonArray.length(); i++) {
                                JSONObject hit = jsonArray.getJSONObject(i);
                                //
                                String date = hit.getString("TANGGAL_LAPORAN");
                                int prodharian3 = hit.getInt("PROD_HARIAN");
                                int prodbulanan3 = hit.getInt("PROD_BULANAN");
                                int prodtahunan3 = hit.getInt("PROD_TAHUNAN");
                                int targetapbn3 = hit.getInt("APBN");

                                mExampleList3.add(new Model3(date, prodharian3, prodbulanan3, prodtahunan3, targetapbn3));

                            }

                            mExampleAdapter3 = new Adapter3(PusdatinActivity.this, mExampleList3);
                            mRecyclerView3.setAdapter(mExampleAdapter3);

                        } catch (JSONException e) {
                            e.printStackTrace();
                        }

                        try {
                            JSONArray jsonArray = response.getJSONArray("lap_pusdatin_prod_ekui_migas");

                            for (int i = 0; i < jsonArray.length(); i++) {
                                JSONObject hit = jsonArray.getJSONObject(i);
                                //
                                String date = hit.getString("TANGGAL_LAPORAN");
                                int prodharian4 = hit.getInt("PROD_HARIAN");
                                int prodbulanan4 = hit.getInt("PROD_BULANAN");
                                int prodtahunan4 = hit.getInt("PROD_TAHUNAN");
                                int targetapbn4 = hit.getInt("APBN");

                                mExampleList4.add(new Model4(date, prodharian4, prodbulanan4, prodtahunan4, targetapbn4));

                            }

                            mExampleAdapter4 = new Adapter4(PusdatinActivity.this, mExampleList4);
                            mRecyclerView4.setAdapter(mExampleAdapter4);

                        } catch (JSONException e) {
                            e.printStackTrace();
                        }

                        try {
                            JSONArray jsonArray = response.getJSONArray("lap_pusdatin_lift_tb");

                            for (int i = 0; i < jsonArray.length(); i++) {
                                JSONObject hit = jsonArray.getJSONObject(i);
                                //
                                String date = hit.getString("TANGGAL_LAPORAN");
                                String lifitngminyak5 = hit.getString("LIFT_MB");
                                String posisistock5 = hit.getString("POSISI_STOCK");
                                String salurgas5 = hit.getString("SALUR_GAS");

                                mExampleList5.add(new Model5(date, lifitngminyak5, posisistock5, salurgas5));

                            }

                            mExampleAdapter5 = new Adapter5(PusdatinActivity.this, mExampleList5);
                            mRecyclerView5.setAdapter(mExampleAdapter5);

                        } catch (JSONException e) {
                            e.printStackTrace();
                        }

                        try {
                            JSONArray jsonArray = response.getJSONArray("lap_pusdatin_harga_bbm");

                            for (int i = 0; i < jsonArray.length(); i++) {
                                JSONObject hit = jsonArray.getJSONObject(i);
                                //
                                String date = hit.getString("TANGGAL_LAPORAN");
                                String jenis6 = hit.getString("JENIS_TERTENTU");
                                String bbm6 = hit.getString("BBM_UMUM");
                                String prog6 = hit.getString("PROG_IND_SATU_HRG");
                                String harga6 = hit.getString("HARGA_PERNEGARA");

                                mExampleList6.add(new Model6(date, jenis6, bbm6, prog6, harga6));

                            }

                            mExampleAdapter6 = new Adapter6(PusdatinActivity.this, mExampleList6);
                            mRecyclerView6.setAdapter(mExampleAdapter6);

                        } catch (JSONException e) {
                            e.printStackTrace();
                        }

                        try {
                            JSONArray jsonArray = response.getJSONArray("lap_pusdatin_prog_peny_prem_jamali");

                            for (int i = 0; i < jsonArray.length(); i++) {
                                JSONObject hit = jsonArray.getJSONObject(i);
                                //
                                String date = hit.getString("TANGGAL_LAPORAN");
                                String progress7 = hit.getString("PROGRES");
                                String catatan7 = hit.getString("CATATAN");

                                mExampleList7.add(new Model7(date, progress7, catatan7));

                            }

                            mExampleAdapter7 = new Adapter7(PusdatinActivity.this, mExampleList7);
                            mRecyclerView7.setAdapter(mExampleAdapter7);

                        } catch (JSONException e) {
                            e.printStackTrace();
                        }

                        try {
                            JSONArray jsonArray = response.getJSONArray("lap_pusdatin_berita_opec_harian");

                            for (int i = 0; i < jsonArray.length(); i++) {
                                JSONObject hit = jsonArray.getJSONObject(i);
                                //
                                String date = hit.getString("TANGGAL_LAPORAN");
                                String berita8 = hit.getString("BERITA");

                                mExampleList8.add(new Model8(date, berita8));

                            }

                            mExampleAdapter8 = new Adapter8(PusdatinActivity.this, mExampleList8);
                            mRecyclerView8.setAdapter(mExampleAdapter8);

                        } catch (JSONException e) {
                            e.printStackTrace();
                        }

                        try {
                            JSONArray jsonArray = response.getJSONArray("lap_pusdatin_harga_bb_acuan");

                            for (int i = 0; i < jsonArray.length(); i++) {
                                JSONObject hit = jsonArray.getJSONObject(i);
                                //
                                String date = hit.getString("TANGGAL_LAPORAN");
                                String harga9 = hit.getString("HARGA");
                                String sumber9 = hit.getString("SUMBER");

                                mExampleList9.add(new Model9(date, harga9, sumber9));

                            }

                            mExampleAdapter9 = new Adapter9(PusdatinActivity.this, mExampleList9);
                            mRecyclerView9.setAdapter(mExampleAdapter9);

                        } catch (JSONException e) {
                            e.printStackTrace();
                        }

                        try {
                            JSONArray jsonArray = response.getJSONArray("lap_pusdatin_harga_mineral_acuan");

                            for (int i = 0; i < jsonArray.length(); i++) {
                                JSONObject hit = jsonArray.getJSONObject(i);
                                //
                                String date = hit.getString("TANGGAL_LAPORAN");
                                String harga10 = hit.getString("HARGA");
                                String sumber10 = hit.getString("SUMBER");

                                mExampleList10.add(new Model10(date, harga10, sumber10));

                            }

                            mExampleAdapter10 = new Adapter10(PusdatinActivity.this, mExampleList10);
                            mRecyclerView10.setAdapter(mExampleAdapter10);

                        } catch (JSONException e) {
                            e.printStackTrace();
                        }

                        try {
                            JSONArray jsonArray = response.getJSONArray("lap_pusdatin_stts_tl");

                            for (int i = 0; i < jsonArray.length(); i++) {
                                JSONObject hit = jsonArray.getJSONObject(i);
                                //
                                String date = hit.getString("TANGGAL_LAPORAN");
                                String status11 = hit.getString("STATUS");

                                mExampleList11.add(new Model11(date, status11));

                            }

                            mExampleAdapter11 = new Adapter11(PusdatinActivity.this, mExampleList11);
                            mRecyclerView11.setAdapter(mExampleAdapter11);

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
