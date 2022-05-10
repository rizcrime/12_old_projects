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
import android.widget.ProgressBar;
import android.widget.Toast;
import com.simwaspihk.R;
import com.simwaspihk.data.remote.api.ApiServices;
import com.simwaspihk.data.remote.api.Retroserver;
import com.simwaspihk.data.remote.api.model.tbsakit.TbsakitResponse;
import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Locale;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class TbsakitInsertActivity extends AppCompatActivity {
    ImageButton btnTglLahir;
    ImageButton btnTglRawat;
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
    EditText namaJemaah;
    EditText noPasport;
    ProgressDialog pd;
    EditText rumahSakit;
    EditText sebab;
    private ProgressBar spinner;
    EditText tglLahir;
    EditText tglRawat;
    EditText userId;

    /* Access modifiers changed, original: protected */
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView((int) R.layout.activity_tbsakit_insert);
        this.spinner = (ProgressBar) findViewById(R.id.progressBar1);
        this.spinner.setVisibility(View.GONE);
        this.dateFormatter = new SimpleDateFormat("yyyy-MM-dd", Locale.US);
        this.userId = (EditText) findViewById(R.id.etUserId);
        this.noPasport = (EditText) findViewById(R.id.etNoPasport);
        this.namaJemaah = (EditText) findViewById(R.id.etNamaJemaah);
        this.tglLahir = (EditText) findViewById(R.id.etTglLahir);
        this.btnTglLahir = (ImageButton) findViewById(R.id.btnTglLahir);
        this.btnTglLahir.setOnClickListener(new OnClickListener() {
            public void onClick(View view) {
                TbsakitInsertActivity.this.tglLahirDialog();
            }
        });
        this.tglRawat = (EditText) findViewById(R.id.etTglRawat);
        this.btnTglRawat = (ImageButton) findViewById(R.id.btnTglRawat);
        this.btnTglRawat.setOnClickListener(new OnClickListener() {
            public void onClick(View view) {
                TbsakitInsertActivity.this.tglRawatDialog();
            }
        });
        this.rumahSakit = (EditText) findViewById(R.id.etRumahSakit);
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
            this.tglRawat.setText(data.getStringExtra("tgl_rawat"));
            this.rumahSakit.setText(data.getStringExtra("rumah_sakit"));
            this.sebab.setText(data.getStringExtra("sebab"));
            this.keterangan.setText(data.getStringExtra("keterangan"));
        }
        this.btndelete.setOnClickListener(new OnClickListener() {
            public void onClick(View v) {
                TbsakitInsertActivity.this.spinner.setVisibility(View.VISIBLE);
                ((ApiServices) Retroserver.getClient().create(ApiServices.class)).deleteTbsakit(iddata).enqueue(new Callback<TbsakitResponse>() {
                    public void onResponse(Call<TbsakitResponse> call, Response<TbsakitResponse> response) {
                        Log.d("Retro", "onResponse");
                        Toast.makeText(TbsakitInsertActivity.this, "Data diHapus", 1).show();
                        TbsakitInsertActivity.this.startActivity(new Intent(TbsakitInsertActivity.this, TbsakitActivity.class));
                        TbsakitInsertActivity.this.spinner.setVisibility(View.GONE);
                    }

                    public void onFailure(Call<TbsakitResponse> call, Throwable t) {
                        TbsakitInsertActivity.this.spinner.setVisibility(View.GONE);
                        Log.d("Retro", "onFailure");
                    }
                });
            }
        });
        this.btnupdate.setOnClickListener(new OnClickListener() {
            public void onClick(View v) {
                TbsakitInsertActivity.this.spinner.setVisibility(View.GONE);
                ((ApiServices) Retroserver.getClient().create(ApiServices.class)).updateTbsakit(iddata, TbsakitInsertActivity.this.userId.getText().toString(), TbsakitInsertActivity.this.noPasport.getText().toString(), TbsakitInsertActivity.this.namaJemaah.getText().toString(), TbsakitInsertActivity.this.tglLahir.getText().toString(), TbsakitInsertActivity.this.tglRawat.getText().toString(), TbsakitInsertActivity.this.rumahSakit.getText().toString(), TbsakitInsertActivity.this.sebab.getText().toString(), TbsakitInsertActivity.this.keterangan.getText().toString()).enqueue(new Callback<TbsakitResponse>() {
                    public void onResponse(Call<TbsakitResponse> call, Response<TbsakitResponse> response) {
                        Log.d("Retro", "TbsaranResponse");
                        Toast.makeText(TbsakitInsertActivity.this, "Data Berhasil di Update", 1).show();
                        new Handler().postDelayed(new Runnable() {
                            public void run() {
                                TbsakitInsertActivity.this.startActivity(new Intent(TbsakitInsertActivity.this, TbsakitActivity.class));
                            }
                        }, 100);
                        TbsakitInsertActivity.this.spinner.setVisibility(View.GONE);
                    }

                    public void onFailure(Call<TbsakitResponse> call, Throwable t) {
                        TbsakitInsertActivity.this.spinner.setVisibility(View.GONE);
                        Log.d("Retro", "OnFailure");
                    }
                });
            }
        });
        this.btnsave.setOnClickListener(new OnClickListener() {
            public void onClick(View v) {
                TbsakitInsertActivity.this.spinner.setVisibility(View.VISIBLE);
                ((ApiServices) Retroserver.getClient().create(ApiServices.class)).sendTbsakit(TbsakitInsertActivity.this.userId.getText().toString(), TbsakitInsertActivity.this.noPasport.getText().toString(), TbsakitInsertActivity.this.namaJemaah.getText().toString(), TbsakitInsertActivity.this.tglLahir.getText().toString(), TbsakitInsertActivity.this.tglRawat.getText().toString(), TbsakitInsertActivity.this.rumahSakit.getText().toString(), TbsakitInsertActivity.this.sebab.getText().toString(), TbsakitInsertActivity.this.keterangan.getText().toString()).enqueue(new Callback<TbsakitResponse>() {
                    public void onResponse(Call<TbsakitResponse> call, Response<TbsakitResponse> response) {
                        TbsakitInsertActivity.this.spinner.setVisibility(View.GONE);
                        if (response.isSuccessful()) {
                            String returns = ((TbsakitResponse) response.body()).getStatus();
                            String msg = ((TbsakitResponse) response.body()).getMsg();
                            if (returns.equals("Success")) {
                                Toast.makeText(TbsakitInsertActivity.this, "Data Berhasil di Simpan", 1).show();
                                new Handler().postDelayed(new Runnable() {
                                    public void run() {
                                        TbsakitInsertActivity.this.startActivity(new Intent(TbsakitInsertActivity.this, TbsakitActivity.class));
                                    }
                                }, 100);
                                return;
                            }
                            Toast.makeText(TbsakitInsertActivity.this, "GAGAL", 1).show();
                        }
                    }

                    public void onFailure(Call<TbsakitResponse> call, Throwable t) {
                        TbsakitInsertActivity.this.spinner.setVisibility(View.GONE);
                        Toast.makeText(TbsakitInsertActivity.this, t.getMessage().toString(), 0).show();
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
                TbsakitInsertActivity.this.tglLahir.setText(TbsakitInsertActivity.this.dateFormatter.format(newDate.getTime()));
            }
        }, newCalendar.get(1), newCalendar.get(2), newCalendar.get(5));
        this.datePickerDialog.show();
    }

    private void tglRawatDialog() {
        Calendar newCalendar = Calendar.getInstance();
        this.datePickerDialog = new DatePickerDialog(this, new OnDateSetListener() {
            public void onDateSet(DatePicker view, int year, int monthOfYear, int dayOfMonth) {
                Calendar newDate = Calendar.getInstance();
                newDate.set(year, monthOfYear, dayOfMonth);
                TbsakitInsertActivity.this.tglRawat.setText(TbsakitInsertActivity.this.dateFormatter.format(newDate.getTime()));
            }
        }, newCalendar.get(1), newCalendar.get(2), newCalendar.get(5));
        this.datePickerDialog.show();
    }
}
