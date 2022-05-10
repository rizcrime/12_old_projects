package com.simwaspihk.activity;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;
import com.simwaspihk.R;
import com.simwaspihk.data.remote.api.ApiServices;
import com.simwaspihk.data.remote.api.Retroserver;
import com.simwaspihk.data.remote.api.model.tbsaran.TbsaranResponse;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class TbsaranInsertActivity extends AppCompatActivity {
    Button btndelete;
    Button btnsave;
    Button btnupdate;
    EditText hambatan;
    EditText name;
    ProgressDialog pd;
    EditText saran;
    EditText userId;

    /* Access modifiers changed, original: protected */
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView((int) R.layout.activity_tbsaran_insert);
        this.userId = (EditText) findViewById(R.id.etUserId);
        this.name = (EditText) findViewById(R.id.etName);
        this.saran = (EditText) findViewById(R.id.etSaran);
        this.hambatan = (EditText) findViewById(R.id.etHambatan);
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
            this.name.setText(data.getStringExtra("name"));
            this.saran.setText(data.getStringExtra("saran"));
            this.hambatan.setText(data.getStringExtra("hambatan"));
        }
        this.pd = new ProgressDialog(this);
        this.btndelete.setOnClickListener(new OnClickListener() {
            public void onClick(View v) {
                TbsaranInsertActivity.this.pd.setMessage("Loading Hapus ...");
                TbsaranInsertActivity.this.pd.setCancelable(false);
                TbsaranInsertActivity.this.pd.show();
                ((ApiServices) Retroserver.getClient().create(ApiServices.class)).deleteTbsaran(iddata).enqueue(new Callback<TbsaranResponse>() {
                    public void onResponse(Call<TbsaranResponse> call, Response<TbsaranResponse> response) {
                        Log.d("Retro", "onResponse");
                        Toast.makeText(TbsaranInsertActivity.this, "Data diHapus", 1).show();
                        TbsaranInsertActivity.this.startActivity(new Intent(TbsaranInsertActivity.this, TbsaranActivity.class));
                    }

                    public void onFailure(Call<TbsaranResponse> call, Throwable t) {
                        TbsaranInsertActivity.this.pd.hide();
                        Log.d("Retro", "onFailure");
                    }
                });
            }
        });
        this.btnupdate.setOnClickListener(new OnClickListener() {
            public void onClick(View v) {
                TbsaranInsertActivity.this.pd.setMessage("update ....");
                TbsaranInsertActivity.this.pd.setCancelable(false);
                TbsaranInsertActivity.this.pd.show();
                ((ApiServices) Retroserver.getClient().create(ApiServices.class)).updateTbsaran(iddata, TbsaranInsertActivity.this.userId.getText().toString(), TbsaranInsertActivity.this.name.getText().toString(), TbsaranInsertActivity.this.saran.getText().toString(), TbsaranInsertActivity.this.hambatan.getText().toString()).enqueue(new Callback<TbsaranResponse>() {
                    public void onResponse(Call<TbsaranResponse> call, Response<TbsaranResponse> response) {
                        Log.d("Retro", "TbsaranResponse");
                        Toast.makeText(TbsaranInsertActivity.this, "Data Berhasil di Update", 1).show();
                        new Handler().postDelayed(new Runnable() {
                            public void run() {
                                TbsaranInsertActivity.this.startActivity(new Intent(TbsaranInsertActivity.this, TbsaranActivity.class));
                            }
                        }, 100);
                        TbsaranInsertActivity.this.pd.hide();
                    }

                    public void onFailure(Call<TbsaranResponse> call, Throwable t) {
                        TbsaranInsertActivity.this.pd.hide();
                        Log.d("Retro", "OnFailure");
                    }
                });
            }
        });
        this.btnsave.setOnClickListener(new OnClickListener() {
            public void onClick(View v) {
                TbsaranInsertActivity.this.pd.setMessage("send data ... ");
                TbsaranInsertActivity.this.pd.setCancelable(false);
                TbsaranInsertActivity.this.pd.show();
                ((ApiServices) Retroserver.getClient().create(ApiServices.class)).sendTbsaran(TbsaranInsertActivity.this.userId.getText().toString(), TbsaranInsertActivity.this.name.getText().toString(), TbsaranInsertActivity.this.saran.getText().toString(), TbsaranInsertActivity.this.hambatan.getText().toString()).enqueue(new Callback<TbsaranResponse>() {
                    public void onResponse(Call<TbsaranResponse> call, Response<TbsaranResponse> response) {
                        TbsaranInsertActivity.this.pd.dismiss();
                        if (response.isSuccessful()) {
                            String returns = ((TbsaranResponse) response.body()).getStatus();
                            String msg = ((TbsaranResponse) response.body()).getMsg();
                            if (returns.equals("Success")) {
                                Toast.makeText(TbsaranInsertActivity.this, "Data Berhasil di Simpan", 1).show();
                                new Handler().postDelayed(new Runnable() {
                                    public void run() {
                                        TbsaranInsertActivity.this.startActivity(new Intent(TbsaranInsertActivity.this, TbsaranActivity.class));
                                    }
                                }, 100);
                                return;
                            }
                            Toast.makeText(TbsaranInsertActivity.this, "GAGAL", 1).show();
                        }
                    }

                    public void onFailure(Call<TbsaranResponse> call, Throwable t) {
                        TbsaranInsertActivity.this.pd.hide();
                        Toast.makeText(TbsaranInsertActivity.this, t.getMessage(), 0).show();
                    }
                });
            }
        });
    }
}
