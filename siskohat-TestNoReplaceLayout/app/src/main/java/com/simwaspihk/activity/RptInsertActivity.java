package com.simwaspihk.activity;

import android.app.Activity;
import android.app.AlertDialog;
import android.app.DatePickerDialog;
import android.app.DatePickerDialog.OnDateSetListener;
import android.app.ProgressDialog;
import android.app.TimePickerDialog;
import android.app.TimePickerDialog.OnTimeSetListener;
import android.content.DialogInterface;
import android.content.Intent;
import android.graphics.Color;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.RecyclerView;
import android.util.Base64;
import android.view.MenuItem;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.AdapterView;
import android.widget.Button;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.ListView;
import android.widget.TimePicker;
import android.widget.Toast;
import butterknife.BindView;
import butterknife.ButterKnife;
import butterknife.OnClick;

import com.android.volley.AuthFailureError;
import com.android.volley.NetworkResponse;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.VolleyError;
import com.android.volley.VolleyLog;
import com.android.volley.toolbox.HttpHeaderParser;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.pixplicity.easyprefs.library.Prefs;
import com.simwaspihk.R;
import com.simwaspihk.adapter.ListViewAdapter;
import com.simwaspihk.data.remote.api.ApiServices;
import com.simwaspihk.data.remote.api.model.rpt.DataItem;
import com.simwaspihk.data.remote.api.model.rpt.delete.ResponseDeleteRpt;
import com.simwaspihk.model.DataJamaah;
import com.simwaspihk.other.Utils;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.UnsupportedEncodingException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.HashMap;
import java.util.HashSet;
import java.util.List;
import java.util.Locale;
import java.util.Map;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class RptInsertActivity extends AppCompatActivity {
    String bandara;
    String bandaraTransit;
    ImageButton btnAktualPukul;
    ImageButton btnAktualTgl;
    ImageButton btnRencanaPukul;
    ImageButton btnRencanaTgl;
    Button btnGetData;
    Button btnUpdate;
    private List<DataJamaah> jamaahList;
    private List<DataItem> data;
    private SimpleDateFormat dateFormatter;
    private DatePickerDialog datePickerDialog;
    String date_time = "";
    @BindView(R.id.etAktualBandara)
    EditText etAktualBandara;
    @BindView(R.id.etAktualFlight)
    EditText etAktualFlight;
    @BindView(R.id.etAktualJumlah)
    EditText etAktualJumlah;
    @BindView(R.id.etAktualPukul)
    EditText etAktualPukul;
    @BindView(R.id.etAktualTgl)
    EditText etAktualTgl;
    @BindView(R.id.etLain)
    EditText etLain;
    @BindView(R.id.etNoUrut)
    EditText etNoUrut;
    @BindView(R.id.etPria)
    EditText etPria;
    @BindView(R.id.etRencanaBandara)
    EditText etRencanaBandara;
    @BindView(R.id.etRencanaFlight)
    EditText etRencanaFlight;
    @BindView(R.id.etRencanaJumlah)
    EditText etRencanaJumlah;
    @BindView(R.id.etRencanaPukul)
    EditText etRencanaPukul;
    @BindView(R.id.etRencanaTgl)
    EditText etRencanaTgl;
    @BindView(R.id.etSakit)
    EditText etSakit;
    @BindView(R.id.etWanita)
    EditText etWanita;
    @BindView(R.id.etKodePaket)
    EditText etKodePaket;
    String flight;
    String jumlah;
    String lain;
    ApiServices mBas;
    int mDay;
    int mHour;
    int mMinute;
    int mMonth;
    int mYear;
    String noUrut;
    String planFlight;
    String planJumlah;
    String planPukul;
    String planTgl;
    String pria;
    String pukul;
    String rptName;
    String rptUserId;
    String sakit;
    String tgl;
    String wanita;
    ListView listAbsensiJamaah;
    ArrayList<String> listAbsensi = new ArrayList<String>();

    String nm_airline;
    String transit;
    String kodePIHK ;
    String judul;
    HashSet<Integer> selectedUser;
    ListViewAdapter adapter;



    @OnClick(R.id.btnAbsensi_jamaah)
    public void absensiJamaah() {
        //Toast.makeText(RptInsertActivity.this, "Menyimpan Data", Toast.LENGTH_SHORT).show();
    }


//    @OnItemClick(R.id.listAbsensiJemaah)
//    public void clickedJamaahItem(int position) {
//        Toast.makeText(RptInsertActivity.this, position, Toast.LENGTH_SHORT).show();
//    }

    /* Access modifiers changed, original: 0000 */
    @OnClick({2131689646})
    public void updates() {
        final ProgressDialog show = ProgressDialog.show(this, "Please Wait...", "Updating Data", false, false);
        this.mBas.rptInsert(Prefs.getInt("user_id", 0), Prefs.getString("rpt_id", ""), this.etNoUrut.getText().toString(), Prefs.getInt("user_id", 0), Prefs.getString("rpt_id", ""), this.etNoUrut.getText().toString(), this.etRencanaTgl.getText().toString(), this.etRencanaPukul.getText().toString(), this.etRencanaFlight.getText().toString(), this.etRencanaJumlah.getText().toString(), this.etRencanaBandara.getText().toString(), this.etAktualTgl.getText().toString(), this.etAktualPukul.getText().toString(), this.etAktualFlight.getText().toString(), this.etAktualJumlah.getText().toString(), this.etAktualBandara.getText().toString(), this.etPria.getText().toString(), this.etWanita.getText().toString(), this.etSakit.getText().toString(),this.etLain.getText().toString()).enqueue(new Callback<ResponseDeleteRpt>() {
            public void onResponse(Call<ResponseDeleteRpt> call, Response<ResponseDeleteRpt> response) {
                show.dismiss();
                if (response.isSuccessful()) {
                    String returns = ((ResponseDeleteRpt) response.body()).getStatus().toString();
                    if (returns.equals("Success")) {
                        Toast.makeText(RptInsertActivity.this, returns, 0).show();
                        RptInsertActivity.this.startActivity(new Intent(RptInsertActivity.this, Rpt.class));
                        RptInsertActivity.this.finish();
                        return;
                    }
                    Toast.makeText(RptInsertActivity.this, returns, 0).show();
                    return;
                }
                Toast.makeText(RptInsertActivity.this, response.message().toString(), 0).show();
            }

            public void onFailure(Call<ResponseDeleteRpt> call, Throwable t) {
                show.dismiss();
                Toast.makeText(RptInsertActivity.this, t.getMessage().toString(), 0).show();
            }
        });
    }

    /* Access modifiers changed, original: protected */
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView((int) R.layout.activity_rpt_detail);
        judul = Prefs.getString("rpt_id", null);

        getSupportActionBar().setTitle((CharSequence) judul);
        ButterKnife.bind((Activity) this);
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        this.dateFormatter = new SimpleDateFormat("yyyy-MM-dd", Locale.US);
        this.etRencanaTgl = (EditText) findViewById(R.id.etRencanaTgl);
        this.btnRencanaTgl = (ImageButton) findViewById(R.id.btnRencanaTgl);
        this.btnRencanaTgl.setOnClickListener(new OnClickListener() {
            public void onClick(View view) {
                RptInsertActivity.this.showDateDialog();
            }
        });
        this.etAktualTgl = (EditText) findViewById(R.id.etAktualTgl);
        this.btnAktualTgl = (ImageButton) findViewById(R.id.btnAktualTgl);
        this.btnAktualTgl.setOnClickListener(new OnClickListener() {
            public void onClick(View view) {
                RptInsertActivity.this.showAktualDateDialog();
            }
        });
        this.etRencanaPukul = (EditText) findViewById(R.id.etRencanaPukul);
        this.btnRencanaPukul = (ImageButton) findViewById(R.id.btnRencanaPukul);
        this.btnRencanaPukul.setOnClickListener(new OnClickListener() {
            public void onClick(View view) {
                RptInsertActivity.this.showTimeDialog();
            }
        });
        this.etAktualTgl = (EditText) findViewById(R.id.etAktualTgl);
        this.btnAktualPukul = (ImageButton) findViewById(R.id.btnAktualPukul);
        this.btnAktualPukul.setOnClickListener(new OnClickListener() {
            public void onClick(View view) {
                RptInsertActivity.this.showAktualTimeDialog();
            }
        });
        this.mBas = Utils.getBAS();
        this.listAbsensiJamaah = (ListView) findViewById(R.id.listAbsensiJemaah);

        this.btnGetData = (Button)findViewById(R.id.btnAbsensi_jamaah);
        this.btnGetData.setOnClickListener(new OnClickListener() {
            @Override
            public void onClick(View view) {
                LoadDataUrut();
            }
        });

        this.btnUpdate=(Button) findViewById(R.id.btnUpdate);
        this.btnUpdate.setOnClickListener(new OnClickListener() {
            @Override
            public void onClick(View view) {
                sendWorkPostRequest();
            }
        });
        selectedUser = new HashSet<>();
        jamaahList = new ArrayList<>();
        final String[] kodePorsi = new String[1];
        final String[] status = new String[1];

        disableEditText(etRencanaTgl);
        disableEditText(etRencanaPukul);
        disableEditText(etRencanaFlight);
        disableEditText(etRencanaJumlah);
        disableEditText(etRencanaBandara);
        //listAbsensiJamaah.setChoiceMode(ListView.CHOICE_MODE_MULTIPLE_MODAL);

        this.listAbsensiJamaah.setOnItemLongClickListener(new AdapterView.OnItemLongClickListener(){
            @Override
            public boolean onItemLongClick(final AdapterView<?> parent, final View view, final int position, long id){
                final String[] listItems = {"Sakit", "Wafat", "Lain-lain", "Berangkat"};

                AlertDialog.Builder builder = new AlertDialog.Builder(RptInsertActivity.this);
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
                        listAbsensi.add(jamaahList.get(position).getKodePorsi() +"#" + status[0]);
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
    }
    private void LoadDataUrut() {

        String noUrut = etNoUrut.getText().toString();
        kodePIHK = Prefs.getString("kd_pihk", null);

        listAbsensi.clear();

        String JSON_URL ="http://10.100.88.151/new-siskohat/API/manifest/rencana_dan_jamaah?kd_pihk="+ kodePIHK + "&keberangkatan_ke=" + noUrut;
        final ProgressDialog pDialog = new ProgressDialog(this);
        pDialog.setMessage("Getting Data ...");
        pDialog.setIndeterminate(false);
        pDialog.setCancelable(true);
        pDialog.show();
        StringRequest stringRequest = new StringRequest(Request.Method.GET, JSON_URL,
                new com.android.volley.Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        //hiding the progressbar after completion
                        //progressBar.setVisibility(View.INVISIBLE);
                        pDialog.dismiss();

                        try {
                            //getting the whole json object from the response
                            JSONObject obj = new JSONObject(response);
                            //final ArrayList<String> dJamaahList = new ArrayList<String>();;
                            //we have the array named hero inside the object
                            //so here we are getting that json array
//                            JSONArray dataManifest = obj.getJSONArray("data_pramanifest");
                            JSONObject ManifestObject = obj.getJSONObject("data_pramanifest");
                            etRencanaTgl.setText(ManifestObject.getString("tanggal_berangkat"));
                            etAktualTgl.setText(ManifestObject.getString("tanggal_berangkat"));
                            etRencanaPukul.setText(ManifestObject.getString("waktu_berangkat"));
                            etAktualPukul.setText(ManifestObject.getString("waktu_berangkat"));
                            etRencanaFlight.setText(ManifestObject.getString("no_flight_brkt"));
                            etAktualFlight.setText(ManifestObject.getString("no_flight_brkt"));
                            etKodePaket.setText(ManifestObject.getString("no_flight_brkt"));
                            etRencanaBandara.setText(ManifestObject.getString("bandara_brkt"));
                            etAktualBandara.setText(ManifestObject.getString("bandara_brkt"));
                            nm_airline=ManifestObject.getString("nm_airline_brkt");
                            transit=ManifestObject.getString("bandara_transit");




                            JSONArray dataJamaah = obj.getJSONArray("data_jamaah");
                            for (int i = 0; i < dataJamaah.length(); i++) {
                                //getting the json object of the particular index inside the array
                                JSONObject jamaahObject = dataJamaah.getJSONObject(i);

                                //creating a hero object and giving them the values from json object
                                DataJamaah jamaah = new DataJamaah(jamaahObject.getString("kd_porsi"), jamaahObject.getString("nama_jamaah"));

                                //adding the hero to herolist
                                jamaahList.add(jamaah);
                                //dJamaahList.add(jamaahObject.getString("nama_jamaah"));
                            }

                            etRencanaJumlah.setText(String.valueOf(dataJamaah.length()));
                            etAktualJumlah.setText(String.valueOf(dataJamaah.length()));

                            adapter = new ListViewAdapter(jamaahList, getApplicationContext());

                            //adding the adapter to listview
                            listAbsensiJamaah.setAdapter(adapter);


                        } catch (JSONException e) {
                            e.printStackTrace();
                        }
                    }
                },
                new com.android.volley.Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        //displaying the error in toast if occurrs
                        Toast.makeText(getApplicationContext(), error.getMessage(), Toast.LENGTH_SHORT).show();
                    }
                }){
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

        //creating a request queue
        RequestQueue requestQueue = Volley.newRequestQueue(this);

        //adding the string request to request queue
        requestQueue.add(stringRequest);
    }

    private void sendWorkPostRequest() {

        try {
            String URL = "http://10.100.88.151/new-siskohat/API/manifest/aktual_dan_jamaah_keberangkatan";
            final ProgressDialog pDialog = new ProgressDialog(this);
            pDialog.setMessage("Sending Data ...");
            pDialog.setIndeterminate(false);
            pDialog.setCancelable(true);
            pDialog.show();

            JSONObject jsonBody = new JSONObject();

            jsonBody.put("kd_pihk", kodePIHK);
            jsonBody.put("keberangkatan_ke", etNoUrut.getText().toString());
            jsonBody.put("tgl_aktual", etAktualTgl.getText().toString());
            jsonBody.put("waktu_aktual", etAktualPukul.getText().toString());
            jsonBody.put("nm_airline_aktual", nm_airline);
            jsonBody.put("no_flight_aktual", etAktualFlight.getText().toString());
            jsonBody.put("no_flight_aktual", etKodePaket.getText().toString());

            jsonBody.put("bandara_transit", transit);

            for(int i=0;i<listAbsensi.size();i++){
                String[] temp;
                temp = listAbsensi.get(i).split("#");
                String kd_porsi = "jamaah_tidak_hadir[" + String.valueOf(i) +"][kd_porsi]";
                String status = "jamaah_tidak_hadir[" + String.valueOf(i) +"][status]";
                jsonBody.put(kd_porsi, temp[0]);
                jsonBody.put(status, temp[1]);
            }

            final String requestBody = jsonBody.toString();

            StringRequest stringRequest = new StringRequest(Request.Method.POST, URL, new com.android.volley.Response.Listener<String>() {
                @Override
                public void onResponse(String  response) {
                    pDialog.dismiss();

                    Toast.makeText(getApplicationContext(), "Update Data Berhasil ", Toast.LENGTH_SHORT).show();
                }
            }, new com.android.volley.Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError error) {
                    Toast.makeText(getApplicationContext(), error.getMessage(), Toast.LENGTH_SHORT).show();

                    //onBackPressed();

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
                @Override
                public String getBodyContentType() {
                    return "application/json; charset=utf-8";
                }

                @Override
                public byte[] getBody() throws AuthFailureError {
                    try {
                        return requestBody == null ? null : requestBody.getBytes("utf-8");
                    } catch (UnsupportedEncodingException uee) {
                        VolleyLog.wtf("Unsupported Encoding while trying to get the bytes of %s using %s", requestBody, "utf-8");
                        return null;
                    }
                }

                @Override
                protected com.android.volley.Response<String> parseNetworkResponse(NetworkResponse response) {
                    String responseString = "";
                    if (response != null) {
                        responseString = String.valueOf(response.statusCode);
                        // can get more details such as response.headers
                    }
                    return com.android.volley.Response.success(responseString, HttpHeaderParser.parseCacheHeaders(response));
                }
            };
            //VolleyApplication.getInstance().addToRequestQueue(jsonOblect);
            //creating a request queue
            RequestQueue requestQueue = Volley.newRequestQueue(this);

            //adding the string request to request queue
            requestQueue.add(stringRequest);

        } catch (JSONException e) {
            e.printStackTrace();
        }
        // Toast.makeText(getApplicationContext(), "done", Toast.LENGTH_LONG).show();

    }


    private void showDateDialog() {
        Calendar newCalendar = Calendar.getInstance();
        this.datePickerDialog = new DatePickerDialog(this, new OnDateSetListener() {
            public void onDateSet(DatePicker view, int year, int monthOfYear, int dayOfMonth) {
                Calendar newDate = Calendar.getInstance();
                newDate.set(year, monthOfYear, dayOfMonth);
                RptInsertActivity.this.etRencanaTgl.setText(RptInsertActivity.this.dateFormatter.format(newDate.getTime()));
            }
        }, newCalendar.get(1), newCalendar.get(2), newCalendar.get(5));
        this.datePickerDialog.show();
    }

    private void showTimeDialog() {
        Calendar c = Calendar.getInstance();
        this.mHour = c.get(11);
        this.mMinute = c.get(12);
        new TimePickerDialog(this, new OnTimeSetListener() {
            public void onTimeSet(TimePicker view, int hourOfDay, int minute) {
                RptInsertActivity.this.etRencanaPukul.setText(hourOfDay + ":" + minute);
            }
        }, this.mHour, this.mMinute, false).show();
    }

    private void showAktualDateDialog() {
        Calendar newCalendar = Calendar.getInstance();
        this.datePickerDialog = new DatePickerDialog(this, new OnDateSetListener() {
            public void onDateSet(DatePicker view, int year, int monthOfYear, int dayOfMonth) {
                Calendar newDate = Calendar.getInstance();
                newDate.set(year, monthOfYear, dayOfMonth);
                RptInsertActivity.this.etAktualTgl.setText(RptInsertActivity.this.dateFormatter.format(newDate.getTime()));
            }
        }, newCalendar.get(1), newCalendar.get(2), newCalendar.get(5));
        this.datePickerDialog.show();
    }

    private void showAktualTimeDialog() {
        Calendar c = Calendar.getInstance();
        this.mHour = c.get(11);
        this.mMinute = c.get(12);
        new TimePickerDialog(this, new OnTimeSetListener() {
            public void onTimeSet(TimePicker view, int hourOfDay, int minute) {
                RptInsertActivity.this.etAktualPukul.setText(hourOfDay + ":" + minute);
            }
        }, this.mHour, this.mMinute, false).show();
    }

    public boolean onOptionsItemSelected(MenuItem item) {
        /*
        if (item.getItemId() != 16908332) {
            return super.onOptionsItemSelected(item);
        }
        Intent i = new Intent(getApplicationContext(), Rpt.class);
        i.addFlags(67108864);
        i.addFlags(32768);
        startActivity(i);
        finish();*/
        return false;
    }

    private boolean validate(EditText[] fields) {
        for (EditText currentField : fields) {
            if (currentField.getText().toString().length() <= 0) {
                Toast.makeText(this, "Please fill all field", 0).show();
                return false;
            }
        }
        return true;
    }

    private void disableEditText(EditText editText) {
        editText.setFocusable(false);
        editText.setEnabled(false);
        //editText.setCursorVisible(false);
        //editText.setKeyListener(null);
        //editText.setBackgroundColor(Color.TRANSPARENT);
    }
}
