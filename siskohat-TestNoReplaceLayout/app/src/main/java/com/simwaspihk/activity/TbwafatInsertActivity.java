package com.simwaspihk.activity;

import android.app.DatePickerDialog;
import android.app.DatePickerDialog.OnDateSetListener;
import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.Toast;
import com.simwaspihk.R;
import com.simwaspihk.data.remote.api.ApiServices;
import com.simwaspihk.data.remote.api.Retroserver;
import com.simwaspihk.data.remote.api.model.tbwafat.TbwafatResponse;
import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Locale;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class TbwafatInsertActivity extends AppCompatActivity {
    ImageButton btnTglLahir;
    ImageButton btnWaktu;
    Button btndelete;
    Button btnsave;
    Button btnupdate;
    private SimpleDateFormat dateFormatter;
    private DatePickerDialog datePickerDialog;
    String date_time = "";
    EditText keterangan;
    int mDay;
    int mMonth;
    int mYear;
    EditText makan;
    EditText namaJemaah;
    EditText noPasport;
    EditText noPorsi;
    ProgressDialog pd;
    EditText sebab;
    EditText tglLahir;
    EditText userId;
    EditText waktu;

    /* Access modifiers changed, original: protected */
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView((int) R.layout.activity_tbwafat_insert);
        this.dateFormatter = new SimpleDateFormat("yyyy-MM-dd", Locale.US);
        this.userId = (EditText) findViewById(R.id.etUserId);
        this.noPasport = (EditText) findViewById(R.id.etNoPasport);
        this.namaJemaah = (EditText) findViewById(R.id.etNamaJemaah);
        this.tglLahir = (EditText) findViewById(R.id.etTglLahir);
        this.btnTglLahir = (ImageButton) findViewById(R.id.btnTglLahir);
        this.btnTglLahir.setOnClickListener(new OnClickListener() {
            public void onClick(View view) {
                TbwafatInsertActivity.this.tglLahirDialog();
            }
        });
        this.waktu = (EditText) findViewById(R.id.etWaktu);
        this.btnWaktu = (ImageButton) findViewById(R.id.btnWaktu);
        this.btnWaktu.setOnClickListener(new OnClickListener() {
            public void onClick(View view) {
                TbwafatInsertActivity.this.waktuDialog();
            }
        });
        this.noPorsi = (EditText) findViewById(R.id.etPorsi);
        this.makan = (EditText) findViewById(R.id.etMakan);
        this.sebab = (EditText) findViewById(R.id.etSebab);
        this.keterangan = (EditText) findViewById(R.id.etKeterangan);
        this.btnupdate = (Button) findViewById(R.id.btnUpdate);
        this.btnsave = (Button) findViewById(R.id.btn_insertdata);
        this.btndelete = (Button) findViewById(R.id.btnhapus);
        Intent data = getIntent();
        final String iddata = data.getStringExtra("id");
        if (iddata != null) {
            this.btnsave.setVisibility(View.GONE);
            this.userId.setEnabled(false);
            this.btnupdate.setVisibility(View.VISIBLE);
            this.btndelete.setVisibility(View.VISIBLE);
            this.userId.setText(data.getStringExtra("user_id"));
            this.noPasport.setText(data.getStringExtra("no_pasport"));
            this.namaJemaah.setText(data.getStringExtra("nama_jemaah"));
            this.tglLahir.setText(data.getStringExtra("tgl_lahir"));
            this.noPorsi.setText(data.getStringExtra("no_porsi"));
            this.waktu.setText(data.getStringExtra("waktu"));
            this.makan.setText(data.getStringExtra("makan"));
            this.sebab.setText(data.getStringExtra("sebab"));
            this.keterangan.setText(data.getStringExtra("keterangan"));
        }
        this.pd = new ProgressDialog(this);
        this.btndelete.setOnClickListener(new OnClickListener() {
            public void onClick(View v) {
                TbwafatInsertActivity.this.pd.setMessage("Loading Hapus ...");
                TbwafatInsertActivity.this.pd.setCancelable(false);
                TbwafatInsertActivity.this.pd.show();
                ((ApiServices) Retroserver.getClient().create(ApiServices.class)).deleteTbwafat(iddata).enqueue(new Callback<TbwafatResponse>() {
                    public void onResponse(Call<TbwafatResponse> call, Response<TbwafatResponse> response) {
                        Log.d("Retro", "onResponse");
                        Toast.makeText(TbwafatInsertActivity.this, "Data diHapus", 1).show();
                        TbwafatInsertActivity.this.startActivity(new Intent(TbwafatInsertActivity.this, TbwafatActivity.class));
                    }

                    public void onFailure(Call<TbwafatResponse> call, Throwable t) {
                        TbwafatInsertActivity.this.pd.hide();
                        Log.d("Retro", "onFailure");
                    }
                });
            }
        });
        this.btnupdate.setOnClickListener(new OnClickListener() {
            public void onClick(View v) {
                TbwafatInsertActivity.this.pd.setMessage("update ....");
                TbwafatInsertActivity.this.pd.setCancelable(false);
                TbwafatInsertActivity.this.pd.show();
                ((ApiServices) Retroserver.getClient().create(ApiServices.class)).updateTbwafat(iddata, TbwafatInsertActivity.this.userId.getText().toString(), TbwafatInsertActivity.this.noPasport.getText().toString(), TbwafatInsertActivity.this.namaJemaah.getText().toString(), TbwafatInsertActivity.this.tglLahir.getText().toString(), TbwafatInsertActivity.this.noPorsi.getText().toString(), TbwafatInsertActivity.this.waktu.getText().toString(), TbwafatInsertActivity.this.makan.getText().toString(), TbwafatInsertActivity.this.sebab.getText().toString(), TbwafatInsertActivity.this.keterangan.getText().toString()).enqueue(new Callback<TbwafatResponse>() {
                    public void onResponse(Call<TbwafatResponse> call, Response<TbwafatResponse> response) {
                        Log.d("Retro", "TbsaranResponse");
                        Toast.makeText(TbwafatInsertActivity.this, "Data Berhasil di Update", 1).show();
                        new Handler().postDelayed(new Runnable() {
                            public void run() {
                                TbwafatInsertActivity.this.startActivity(new Intent(TbwafatInsertActivity.this, TbwafatActivity.class));
                            }
                        }, 100);
                        TbwafatInsertActivity.this.pd.hide();
                    }

                    public void onFailure(Call<TbwafatResponse> call, Throwable t) {
                        TbwafatInsertActivity.this.pd.hide();
                        Log.d("Retro", "OnFailure");
                    }
                });
            }
        });
        this.btnsave.setOnClickListener(new OnClickListener() {
            public void onClick(View v) {
                TbwafatInsertActivity.this.pd.setMessage("send data ... ");
                TbwafatInsertActivity.this.pd.setCancelable(false);
                TbwafatInsertActivity.this.pd.show();
                ((ApiServices) Retroserver.getClient().create(ApiServices.class)).sendTbwafat(TbwafatInsertActivity.this.userId.getText().toString(), TbwafatInsertActivity.this.noPasport.getText().toString(), TbwafatInsertActivity.this.namaJemaah.getText().toString(), TbwafatInsertActivity.this.tglLahir.getText().toString(), TbwafatInsertActivity.this.noPorsi.getText().toString(), TbwafatInsertActivity.this.waktu.getText().toString(), TbwafatInsertActivity.this.makan.getText().toString(), TbwafatInsertActivity.this.sebab.getText().toString(), TbwafatInsertActivity.this.keterangan.getText().toString()).enqueue(new Callback<TbwafatResponse>() {
                    public void onResponse(Call<TbwafatResponse> call, Response<TbwafatResponse> response) {
                        TbwafatInsertActivity.this.pd.dismiss();
                        if (response.isSuccessful()) {
                            String returns = ((TbwafatResponse) response.body()).getStatus();
                            String msg = ((TbwafatResponse) response.body()).getMsg();
                            if (returns.equals("Success")) {
                                Toast.makeText(TbwafatInsertActivity.this, "Data Berhasil di Simpan", 1).show();
                                new Handler().postDelayed(new Runnable() {
                                    public void run() {
                                        TbwafatInsertActivity.this.startActivity(new Intent(TbwafatInsertActivity.this, TbwafatActivity.class));
                                    }
                                }, 100);
                                return;
                            }
                            Toast.makeText(TbwafatInsertActivity.this, "GAGAL", 1).show();
                        }
                    }

                    public void onFailure(Call<TbwafatResponse> call, Throwable t) {
                        TbwafatInsertActivity.this.pd.hide();
                        Toast.makeText(TbwafatInsertActivity.this, t.getMessage().toString(), 0).show();
                    }
                });
            }
        });
    }

    private void tglLahirDialog() {
        Calendar newCalendar = Calendar.getInstance();
        this.datePickerDialog = new DatePickerDialog(this, new OnDateSetListener() {
            public void onDateSet(DatePicker view, int year, int monthOfYear, int dayOfMonth) {
                Calendar newDate = Calendar.getInstance();
                newDate.set(year, monthOfYear, dayOfMonth);
                TbwafatInsertActivity.this.tglLahir.setText(TbwafatInsertActivity.this.dateFormatter.format(newDate.getTime()));
            }
        }, newCalendar.get(1), newCalendar.get(2), newCalendar.get(5));
        this.datePickerDialog.show();
    }

    private void waktuDialog() {
        Calendar newCalendar = Calendar.getInstance();
        this.datePickerDialog = new DatePickerDialog(this, new OnDateSetListener() {
            public void onDateSet(DatePicker view, int year, int monthOfYear, int dayOfMonth) {
                Calendar newDate = Calendar.getInstance();
                newDate.set(year, monthOfYear, dayOfMonth);
                TbwafatInsertActivity.this.waktu.setText(TbwafatInsertActivity.this.dateFormatter.format(newDate.getTime()));
            }
        }, newCalendar.get(1), newCalendar.get(2), newCalendar.get(5));
        this.datePickerDialog.show();
    }
}
