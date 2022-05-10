package com.simwaspihk.activity;

import android.app.DatePickerDialog;
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
import android.widget.ImageButton;
import android.widget.ProgressBar;
import android.widget.RadioButton;
import android.widget.RadioGroup;
import android.widget.Toast;
import com.simwaspihk.R;
import com.simwaspihk.data.remote.api.ApiServices;
import com.simwaspihk.data.remote.api.Retroserver;
import com.simwaspihk.data.remote.api.model.travel.TravelResponse;
import java.text.SimpleDateFormat;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class AdminTravelInsertActivity extends AppCompatActivity {
    ImageButton btnTglLahir;
    ImageButton btnTglRawat;
    Button btndelete;
    Button btnsave;
    Button btnupdate;
    private SimpleDateFormat dateFormatter;
    private DatePickerDialog datePickerDialog;
    String date_time = "";
    EditText etEmail;
    EditText etKodePihk;
    EditText etName;
    EditText etPassword;
    int mDay;
    int mMonth;
    int mYear;
    ProgressDialog pd;
    RadioButton rbStatusAktif;
    RadioButton rbStatusTidakAktif;
    RadioButton rbUserType;
    RadioGroup rgStatus;
    RadioGroup rgUserType;
    private ProgressBar spinner;
    EditText usersId;

    /* Access modifiers changed, original: protected */
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView((int) R.layout.activity_admin_travel_insert);
        this.spinner = (ProgressBar) findViewById(R.id.progressBar1);
        this.spinner.setVisibility(View.GONE);
        this.usersId = (EditText) findViewById(R.id.etUserId);
        this.etName = (EditText) findViewById(R.id.etName);
        this.rgStatus = (RadioGroup) findViewById(R.id.rgStatus);
        this.rgUserType = (RadioGroup) findViewById(R.id.rgUserType);
        this.rbStatusAktif = (RadioButton) findViewById(R.id.rbStatusAktif);
        this.rbStatusTidakAktif = (RadioButton) findViewById(R.id.rbStatusTidakAktif);
        this.rbUserType = (RadioButton) findViewById(R.id.rbUserType);
        this.etEmail = (EditText) findViewById(R.id.etEmail);
        this.etPassword = (EditText) findViewById(R.id.etPassword);
        this.etKodePihk = (EditText) findViewById(R.id.etKodePihk);
        this.btnupdate = (Button) findViewById(R.id.btnUpdate);
        this.btnsave = (Button) findViewById(R.id.btn_insertdata);
        this.btndelete = (Button) findViewById(R.id.btnhapus);
        Intent data = getIntent();
        final String iddata = data.getStringExtra("user_id");
        if (iddata != null) {
            this.btnsave.setVisibility(View.GONE);
            this.usersId.setEnabled(false);
            this.btnupdate.setVisibility(View.VISIBLE);
            this.btndelete.setVisibility(View.VISIBLE);
            this.usersId.setText(data.getStringExtra("users_id"));
            this.etName.setText(data.getStringExtra("name"));
            this.rbStatusAktif.setText(data.getStringExtra("status"));
            this.rbStatusTidakAktif.setText(data.getStringExtra("status"));
            this.etEmail.setText(data.getStringExtra("email"));
            this.rbUserType.setText(data.getStringExtra("user_type"));
            this.etPassword.setText(data.getStringExtra("password"));
            this.etKodePihk.setText(data.getStringExtra("kode_pihk"));
        }
        this.btndelete.setOnClickListener(new OnClickListener() {
            public void onClick(View v) {
                AdminTravelInsertActivity.this.spinner.setVisibility(View.VISIBLE);
                ((ApiServices) Retroserver.getClient().create(ApiServices.class)).deleteTravel(iddata).enqueue(new Callback<TravelResponse>() {
                    public void onResponse(Call<TravelResponse> call, Response<TravelResponse> response) {
                        Log.d("Retro", "onResponse");
                        Toast.makeText(AdminTravelInsertActivity.this, "Data diHapus", Toast.LENGTH_LONG).show();
                        AdminTravelInsertActivity.this.startActivity(new Intent(AdminTravelInsertActivity.this, AdminTravelActivity.class));
                        AdminTravelInsertActivity.this.spinner.setVisibility(View.GONE);
                    }

                    public void onFailure(Call<TravelResponse> call, Throwable t) {
                        AdminTravelInsertActivity.this.spinner.setVisibility(View.GONE);
                        Log.d("Retro", "onFailure");
                    }
                });
            }
        });
        this.btnupdate.setOnClickListener(new OnClickListener() {
            public void onClick(View v) {
                AdminTravelInsertActivity.this.spinner.setVisibility(View.GONE);
                ((ApiServices) Retroserver.getClient().create(ApiServices.class)).updateTravel(iddata, AdminTravelInsertActivity.this.usersId.getText().toString(), AdminTravelInsertActivity.this.etName.getText().toString(), AdminTravelInsertActivity.this.rbStatusAktif.getText().toString(), AdminTravelInsertActivity.this.rbStatusTidakAktif.getText().toString(), AdminTravelInsertActivity.this.etEmail.getText().toString(), AdminTravelInsertActivity.this.rbUserType.getText().toString(), AdminTravelInsertActivity.this.etPassword.getText().toString(), AdminTravelInsertActivity.this.etKodePihk.getText().toString()).enqueue(new Callback<TravelResponse>() {
                    public void onResponse(Call<TravelResponse> call, Response<TravelResponse> response) {
                        Log.d("Retro", "TbsaranResponse");
                        Toast.makeText(AdminTravelInsertActivity.this, "Data Berhasil di Update", Toast.LENGTH_LONG).show();
                        new Handler().postDelayed(new Runnable() {
                            public void run() {
                                AdminTravelInsertActivity.this.startActivity(new Intent(AdminTravelInsertActivity.this, AdminTravelActivity.class));
                            }
                        }, 100);
                        AdminTravelInsertActivity.this.spinner.setVisibility(View.GONE);
                    }

                    public void onFailure(Call<TravelResponse> call, Throwable t) {
                        AdminTravelInsertActivity.this.spinner.setVisibility(View.GONE);
                        Log.d("Retro", "OnFailure");
                    }
                });
            }
        });
        this.btnsave.setOnClickListener(new OnClickListener() {
            public void onClick(View v) {
                AdminTravelInsertActivity.this.spinner.setVisibility(View.VISIBLE);
                ((ApiServices) Retroserver.getClient().create(ApiServices.class)).sendTravel(AdminTravelInsertActivity.this.usersId.getText().toString(), AdminTravelInsertActivity.this.etName.getText().toString(), AdminTravelInsertActivity.this.rbStatusAktif.getText().toString(), AdminTravelInsertActivity.this.rbStatusTidakAktif.getText().toString(), AdminTravelInsertActivity.this.etEmail.getText().toString(), AdminTravelInsertActivity.this.rbUserType.getText().toString(), AdminTravelInsertActivity.this.etPassword.getText().toString(), AdminTravelInsertActivity.this.etKodePihk.getText().toString()).enqueue(new Callback<TravelResponse>() {
                    public void onResponse(Call<TravelResponse> call, Response<TravelResponse> response) {
                        AdminTravelInsertActivity.this.spinner.setVisibility(View.GONE);
                        if (!response.isSuccessful()) {
                            return;
                        }
                        if (((TravelResponse) response.body()).getStatus().equals("Success")) {
                            Toast.makeText(AdminTravelInsertActivity.this, "Data Berhasil di Simpan", Toast.LENGTH_LONG).show();
                            new Handler().postDelayed(new Runnable() {
                                public void run() {
                                    AdminTravelInsertActivity.this.startActivity(new Intent(AdminTravelInsertActivity.this, AdminTravelActivity.class));
                                }
                            }, 100);
                            return;
                        }
                        Toast.makeText(AdminTravelInsertActivity.this, "GAGAL", Toast.LENGTH_LONG).show();
                    }

                    public void onFailure(Call<TravelResponse> call, Throwable t) {
                        AdminTravelInsertActivity.this.spinner.setVisibility(View.GONE);
                        Toast.makeText(AdminTravelInsertActivity.this, t.getMessage().toString(), Toast.LENGTH_SHORT).show();
                    }
                });
            }
        });
    }
}
