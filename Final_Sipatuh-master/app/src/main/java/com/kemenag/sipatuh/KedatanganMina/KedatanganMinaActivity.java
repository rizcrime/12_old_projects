package com.kemenag.sipatuh.KedatanganMina;

import android.app.AlertDialog;
import android.app.DatePickerDialog;
import android.app.ProgressDialog;
import android.app.TimePickerDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.text.format.DateFormat;
import android.util.Base64;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
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
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.kemenag.sipatuh.LoginPackage.AppVar;
import com.kemenag.sipatuh.MainActivity;
import com.kemenag.sipatuh.PublicPackage.DataJamaah;
import com.kemenag.sipatuh.PublicPackage.HeightListView;
import com.kemenag.sipatuh.PublicPackage.ListViewAdapter;
import com.kemenag.sipatuh.PublicPackage.SessionManager;
import com.kemenag.sipatuh.R;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.HashMap;
import java.util.List;
import java.util.Locale;
import java.util.Map;

public class KedatanganMinaActivity extends AppCompatActivity {

    HeightListView listAbsensiJamaah, SubjectListView;
    ImageView img_drop;
    SessionManager session;
    ArrayAdapter arrayAdapter ;
    String HTTP_JSON_URL;

    List<String> listString = new ArrayList<String>();

    private List<DataJamaah> jamaahList;
//    ArrayList<String> listAbsensi = new ArrayList<String>();
    HashMap<String, String> mapAbsensi = new HashMap<>();
    ListViewAdapter adapter;
    private static String TAG = KedatanganMinaActivity.class.getSimpleName();
    private EditText kode_paket, no_urut;
    private EditText aktual_tanggal, aktual_waktu;
    private Button ambilData, simapanData;
    final String[] status = new String[1];
    private ImageView setTanggal, setWaktu;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_kedatangan_mina);

        session = new SessionManager(getApplicationContext());
        img_drop = (ImageView) findViewById(R.id.drp_down_kodpak);

        listAbsensiJamaah = findViewById(R.id.listAbsensiJemaah);
        jamaahList = new ArrayList<>();
        SubjectListView = findViewById(R.id.list_kode_paket);

        ambilData = (Button) findViewById(R.id.ambil_data);
        simapanData = (Button) findViewById(R.id.simpan);

        setTanggal = (ImageView) findViewById(R.id.bt_datepicker);
        setWaktu = (ImageView) findViewById(R.id.bt_timepicker);

        kode_paket = (EditText) findViewById(R.id.kode_paket);
        no_urut = (EditText) findViewById(R.id.no_urut);

        aktual_tanggal = (EditText) findViewById(R.id.tgl_aktual);
        aktual_waktu = (EditText) findViewById(R.id.waktu_aktual);

        HashMap<String, String> user = session.getUserDetails();
        String name = user.get(SessionManager.KEY_NAME);

        HTTP_JSON_URL = AppVar.GET_DATA_PAKET + "?kd_pihk=" + name;

        ambilData.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                LoadDataUrut();
            }
        });

        simapanData.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                sendWorkPostRequest();
            }
        });

        img_drop.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if (SubjectListView.getVisibility() == View.VISIBLE) {
                    SubjectListView.setVisibility(View.GONE);
                } else {
                    SubjectListView.setVisibility(View.VISIBLE);
                }
            }
        });

        no_urut.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                SubjectListView.setVisibility(View.GONE);
            }
        });

        this.listAbsensiJamaah.setOnItemLongClickListener(new AdapterView.OnItemLongClickListener(){
            @Override
            public boolean onItemLongClick(final AdapterView<?> parent, final View view, final int position, long id){
                final String[] listItems = {"Sakit", "Wafat", "Lain-lain", "Berangkat"};

                AlertDialog.Builder builder = new AlertDialog.Builder(KedatanganMinaActivity.this);
                builder.setTitle("Choose item");

                //final int checkedItem = 0; //this will checked the item when user open the dialog
                builder.setSingleChoiceItems(listItems, -1, new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                        status[0] = listItems[which];
                    }
                });

                builder.setPositiveButton("Set", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                        //kodePorsi[0] = jamaahList.get(position).getKodePorsi();
                        //Toast.makeText(RptInsertActivity.this, "Position: " + position, Toast.LENGTH_LONG).show();
                        mapAbsensi.put(jamaahList.get(position).getKodePorsi(), status[0]);
                        //parent.getChildAt(position).setBackgroundColor(Color.DKGRAY);
                        dialog.dismiss();
                        //adapter.setSelectedIndex(position);

                        if(status[0].equals("Sakit")) {
                            jamaahList.get(position).setStatus("SAKIT");
                        } else if(status[0].equals("Wafat")) {
                            jamaahList.get(position).setStatus("WAFAT");
                        } else if(status[0].equals("Lain-lain")) {
                            jamaahList.get(position).setStatus("LAIN");
                        }else if(status[0].equals("Berangkat")) {
                            jamaahList.get(position).setStatus("BERANGKAT");

                            mapAbsensi.remove(jamaahList.get(position).getKodePorsi());
                        }

                        adapter.notifyDataSetChanged();
                    }
                });
                builder.setNegativeButton("Cancel", null);

                AlertDialog dialog = builder.create();
                dialog.show();
                return false;
            }
        });

        requestKodePaket();

        setTanggal.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                showDateDialog();
            }
        });

        setWaktu.setOnClickListener(new View.OnClickListener() {
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
                aktual_tanggal.setText(new SimpleDateFormat("dd-MM-yyyy", Locale.US).format(newDate.getTime()));
            }

        }, newCalendar.get(Calendar.YEAR), newCalendar.get(Calendar.MONTH), newCalendar.get(Calendar.DAY_OF_MONTH));
        datePickerDialog.show();
    }


    private void showDateDialog1(){
        Calendar mcurrentTime = Calendar.getInstance();
        TimePickerDialog mTimePicker;
        mTimePicker = new TimePickerDialog(KedatanganMinaActivity.this, new TimePickerDialog.OnTimeSetListener() {
            @Override
            public void onTimeSet(TimePicker view, int selectedHour, int selectedMinute) {
                String hour = selectedHour + "";
                if (selectedHour < 10) {
                    hour = "0" + selectedHour;
                }
                String min = selectedMinute + "";
                if (selectedMinute < 10)
                    min = "0" + selectedMinute;
                aktual_waktu.setText(hour + ":" + min);
            }

        },mcurrentTime.get(Calendar.HOUR_OF_DAY), mcurrentTime.get(Calendar.MINUTE),
                DateFormat.is24HourFormat(this));
        mTimePicker.show();
    }

    private void LoadDataUrut() {

        final String noUrut = no_urut.getText().toString();
        final String kd_paket = kode_paket.getText().toString();

        mapAbsensi.clear();
        jamaahList.clear();

        String JSON_URL = AppVar.GET_MINA + "?kd_paket=" + kd_paket + "&keberangkatan_ke=" + noUrut;
        final ProgressDialog pDialog = new ProgressDialog(this);
        pDialog.setMessage("Getting Data ...");
        pDialog.setIndeterminate(false);
        pDialog.setCancelable(true);
        pDialog.show();
        StringRequest stringRequest = new StringRequest(Request.Method.GET, JSON_URL,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        pDialog.dismiss();

                        if(kd_paket.equals("")) {
                            pDialog.dismiss();
                            Toast.makeText(getApplicationContext(), "Tidak boleh ada yang dikosongkan!", Toast.LENGTH_SHORT).show();
                            return;
                        }else if(noUrut.equals("")) {
                            pDialog.dismiss();
                            Toast.makeText(getApplicationContext(), "Tidak boleh ada yang dikosongkan!", Toast.LENGTH_SHORT).show();
                            return;
                        }

                        try {
                            JSONObject obj = new JSONObject(response);
                            JSONArray dataJamaah = obj.getJSONArray("data_jamaah");

                            for (int i = 0; i < dataJamaah.length(); i++) {
                                JSONObject jamaahObject = dataJamaah.getJSONObject(i);
                                DataJamaah jamaah = new DataJamaah(jamaahObject.getString("kd_porsi"),
                                        jamaahObject.getString("nama_jamaah"));
                                jamaahList.add(jamaah);
                            }

                            adapter = new ListViewAdapter(jamaahList, getApplicationContext());
                            listAbsensiJamaah.setAdapter(adapter);

                        } catch (JSONException e) {
                            e.printStackTrace();
                        }
                    }
                },
                new com.android.volley.Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(getApplicationContext(), error.getMessage(), Toast.LENGTH_SHORT).show();
                    }
                }) {
            @Override
            public Map<String, String> getHeaders() throws AuthFailureError {
                Map<String, String> headers = new HashMap<>();
                String credentials = "admin:1234";
                String auth = "Basic " + Base64.encodeToString(credentials.getBytes(), Base64.NO_WRAP);
                headers.put("Content-Type", "application/json");
                headers.put("Authorization", auth);
                return headers;
            }
        };
        RequestQueue requestQueue = Volley.newRequestQueue(this);
        requestQueue.add(stringRequest);
    }


    private void sendWorkPostRequest() {

        String URL = AppVar.POST_MINA;
        final ProgressDialog pDialog = new ProgressDialog(this);
        pDialog.setMessage("Sending Data ...");
        pDialog.setIndeterminate(false);
        pDialog.setCancelable(true);
        pDialog.show();

        JSONObject jsonParams = new JSONObject();

        try {
            //Add string params
            jsonParams.put("kd_paket", kode_paket.getText().toString());
            jsonParams.put("keberangkatan_ke", no_urut.getText().toString());
            jsonParams.put("tgl_aktual", aktual_tanggal.getText().toString());
            jsonParams.put("waktu_aktual", aktual_waktu.getText().toString());

            String one = aktual_tanggal.getText().toString();
            String two = aktual_waktu.getText().toString();
            String five = no_urut.getText().toString();


            if(one.equals("")) {
                pDialog.dismiss();
                Toast.makeText(getApplicationContext(), "Tidak boleh ada yang dikosongkan!", Toast.LENGTH_SHORT).show();
                return;
            }
            else if(two.equals("")) {
                pDialog.dismiss();
                Toast.makeText(getApplicationContext(), "Tidak boleh ada yang dikosongkan!", Toast.LENGTH_SHORT).show();
                return;
            }else if(five.equals("")) {
                pDialog.dismiss();
                Toast.makeText(getApplicationContext(), "Tidak boleh ada yang dikosongkan!", Toast.LENGTH_SHORT).show();
                return;
            }

        } catch (JSONException e) {
            e.printStackTrace();
        }
        JSONArray array=new JSONArray();
        try {

            for(Map.Entry<String, String> entry : mapAbsensi.entrySet()) {
                String key = entry.getKey();
                String value = entry.getValue();

                JSONObject jsonParam1 =new JSONObject();

                jsonParam1.put("kd_porsi", key);
                jsonParam1.put("status", value);

                array.put(jsonParam1);
            }

        } catch (JSONException e) {
            e.printStackTrace();
        }

        try {
            jsonParams.put("jamaah_tidak_hadir",array);
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
                Intent keluar = new Intent(KedatanganMinaActivity.this, MainActivity.class);
                startActivity(keluar);
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

    private void requestKodePaket() {
        String JSON_URL = HTTP_JSON_URL;
        final ProgressDialog pDialog = new ProgressDialog(this);
        pDialog.setMessage("Getting Kode Paket Data ...");
        pDialog.setIndeterminate(false);
        pDialog.setCancelable(true);
        pDialog.show();
        JsonArrayRequest stringRequest = new JsonArrayRequest(Request.Method.GET, JSON_URL, null,
                new Response.Listener<JSONArray>() {
                    @Override
                    public void onResponse(JSONArray response) {
                        pDialog.dismiss();

                        for(int i = 0; i < response.length(); i++) {
                            try {
                                JSONObject dataPaket = response.getJSONObject(i);

                                listString.add(dataPaket.getString("kode_paket"));
                            } catch (JSONException e) {
                                e.printStackTrace();
                            }
                        }
                        arrayAdapter = new ArrayAdapter<String>(KedatanganMinaActivity.this,
                                android.R.layout.simple_dropdown_item_1line, android.R.id.text1, listString);
                        SubjectListView.setAdapter(arrayAdapter);
                        SubjectListView.setOnItemClickListener(new AdapterView.OnItemClickListener()
                        {
                            @Override
                            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                                String Item = parent.getItemAtPosition(position).toString();
                                kode_paket.setText(Item);
                                if (SubjectListView.getVisibility() == View.VISIBLE) {
                                    SubjectListView.setVisibility(View.GONE);
                                } else {
                                    SubjectListView.setVisibility(View.VISIBLE);
                                }
                            }
                        });
                    }
                },
                new com.android.volley.Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(getApplicationContext(), error.getMessage(), Toast.LENGTH_SHORT).show();
                    }
                }) {
            @Override
            public Map<String, String> getHeaders() throws AuthFailureError {
                Map<String, String> headers = new HashMap<>();
                String credentials = "admin:1234";
                String auth = "Basic " + Base64.encodeToString(credentials.getBytes(), Base64.NO_WRAP);
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
