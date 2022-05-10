package com.simwaspihk.activity;

import android.app.ProgressDialog;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.MenuItem;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;
import com.pixplicity.easyprefs.library.Prefs;
import com.simwaspihk.R;
import com.simwaspihk.data.remote.api.ApiServices;
import com.simwaspihk.data.remote.api.model.profiles.response.ResponseProfile;
import com.simwaspihk.data.remote.api.model.profiles.update.ResponseUpdateProfiles;
import com.simwaspihk.other.Utils;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class ProgramActivity extends AppCompatActivity {
    ApiServices apiServices;
    Button btnBack;
    Button btnUpdate;
    EditText etProgramAirlines;
    EditText etProgramHNoTelpPerwakilan;
    EditText etProgramHargaStandart;
    EditText etProgramHargaVIP;
    EditText etProgramHari;
    EditText etProgramHotelJeddah;
    EditText etProgramHotelMadinah;
    EditText etProgramHotelMakkah;
    EditText etProgramHotelTransit;
    EditText etProgramKateringJeddah;
    EditText etProgramKateringMadinah;
    EditText etProgramKateringMakkah;
    EditText etProgramKateringTransit;
    EditText etProgramLamaTInggal;
    EditText etProgramLamaTInggalJkt;
    EditText etProgramLamaTInggalMadinah;
    EditText etProgramLamaTInggalMakkah;
    EditText etProgramNamaPetugas;
    EditText etProgramNamaPetugasKesehatan;
    EditText etProgramNamaPetugasPembimbing;
    EditText etProgramNoPetugasKesehatan;
    EditText etProgramNoPetugasPembimbing;
    EditText etProgramNoTelpPetugasKemenag;
    EditText etProgramNoTelpPetugasPihk;
    EditText etProgramPerwakilanArabSaudi;
    EditText etProgramPetugasPihk;
    EditText etProgramRuterPerjalanan;
    EditText etProgramTglBerangkat;
    EditText etProgramTglKepulangan;
    EditText etProgramTransportasi;
    TextView tvProgramUID;

    /* Access modifiers changed, original: protected */
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView((int) R.layout.fragment_program);
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        this.btnUpdate = (Button) findViewById(R.id.btnUpdate);
        this.btnUpdate.setOnClickListener(new OnClickListener() {
            public void onClick(View view) {
                ProgramActivity.this.initUpdate();
            }
        });
        this.btnBack = (Button) findViewById(R.id.btnBack);
        this.btnBack.setVisibility(View.GONE);
        this.etProgramTglBerangkat = (EditText) findViewById(R.id.etProgramTglBerangkat);
        this.etProgramTglKepulangan = (EditText) findViewById(R.id.etProgramTglKepulangan);
        this.etProgramNamaPetugas = (EditText) findViewById(R.id.etProgramNamaPetugas);
        this.etProgramNoTelpPetugasKemenag = (EditText) findViewById(R.id.etProgramNoTelpPetugasKemenag);
        this.etProgramPetugasPihk = (EditText) findViewById(R.id.etProgramPetugasPihk);
        this.etProgramNoTelpPetugasPihk = (EditText) findViewById(R.id.etProgramNoTelpPetugasPihk);
        this.etProgramNamaPetugasPembimbing = (EditText) findViewById(R.id.etProgramNamaPetugasPembimbing);
        this.etProgramNoPetugasPembimbing = (EditText) findViewById(R.id.etProgramNoPetugasPembimbing);
        this.etProgramNamaPetugasKesehatan = (EditText) findViewById(R.id.etProgramNamaPetugasKesehatan);
        this.etProgramNoPetugasKesehatan = (EditText) findViewById(R.id.etProgramNoPetugasKesehatan);
        this.etProgramAirlines = (EditText) findViewById(R.id.etProgramAirlines);
        this.etProgramHotelMakkah = (EditText) findViewById(R.id.etProgramHotelMakkah);
        this.etProgramHotelMadinah = (EditText) findViewById(R.id.etProgramHotelMadinah);
        this.etProgramHotelJeddah = (EditText) findViewById(R.id.etProgramHotelJeddah);
        this.etProgramHotelTransit = (EditText) findViewById(R.id.etProgramHotelTransit);
        this.etProgramKateringMakkah = (EditText) findViewById(R.id.etProgramKateringMakkah);
        this.etProgramKateringMadinah = (EditText) findViewById(R.id.etProgramKateringMadinah);
        this.etProgramKateringJeddah = (EditText) findViewById(R.id.etProgramKateringJeddah);
        this.etProgramKateringTransit = (EditText) findViewById(R.id.etProgramKateringTransit);
        this.etProgramTransportasi = (EditText) findViewById(R.id.etProgramTransportasi);
        this.etProgramHargaVIP = (EditText) findViewById(R.id.etProgramHargaVIP);
        this.etProgramHargaStandart = (EditText) findViewById(R.id.etProgramHargaStandart);
        this.etProgramPerwakilanArabSaudi = (EditText) findViewById(R.id.etProgramPerwakilanArabSaudi);
        this.etProgramHNoTelpPerwakilan = (EditText) findViewById(R.id.etProgramHNoTelpPerwakilan);
        this.etProgramRuterPerjalanan = (EditText) findViewById(R.id.etProgramRuterPerjalanan);
        this.etProgramHari = (EditText) findViewById(R.id.etProgramHari);
        this.etProgramLamaTInggalJkt = (EditText) findViewById(R.id.etProgramLamaTInggalJkt);
        this.etProgramLamaTInggalMadinah = (EditText) findViewById(R.id.etProgramLamaTInggalMadinah);
        this.etProgramLamaTInggalMakkah = (EditText) findViewById(R.id.etProgramLamaTInggalMakkah);
        this.etProgramLamaTInggal = (EditText) findViewById(R.id.etProgramLamaTInggal);
        this.apiServices = Utils.getBAS();
        initProfiles();
    }

    public boolean onOptionsItemSelected(MenuItem item) {
        if (item.getItemId() != 16908332) {
            return super.onOptionsItemSelected(item);
        }
        onBackPressed();
        return true;
    }

    private void initProfiles() {
        final ProgressDialog pDialog = ProgressDialog.show(this, "Please Wait...", "Loading Data", false, false);
        this.apiServices.requestProfiles(Prefs.getInt("user_id", 0)).enqueue(new Callback<ResponseProfile>() {
            public void onResponse(Call<ResponseProfile> call, Response<ResponseProfile> response) {
                pDialog.dismiss();
                if (response.isSuccessful()) {
                    ProgramActivity.this.etProgramTglBerangkat.setText(((ResponseProfile) response.body()).getTglBerangkat());
                    ProgramActivity.this.etProgramTglKepulangan.setText(((ResponseProfile) response.body()).getTglPulang());
                    ProgramActivity.this.etProgramNamaPetugas.setText(((ResponseProfile) response.body()).getNmPetugasKemenag());
                    ProgramActivity.this.etProgramNoTelpPetugasKemenag.setText(((ResponseProfile) response.body()).getTelPetugasKemenag());
                    ProgramActivity.this.etProgramPetugasPihk.setText(((ResponseProfile) response.body()).getNmPetugasPihk());
                    ProgramActivity.this.etProgramNoTelpPetugasPihk.setText(((ResponseProfile) response.body()).getTelPetugasPihk());
                    ProgramActivity.this.etProgramNamaPetugasPembimbing.setText(((ResponseProfile) response.body()).getNmPetugasPembimbing());
                    ProgramActivity.this.etProgramNoPetugasPembimbing.setText(((ResponseProfile) response.body()).getTelPetugasPembimbing());
                    ProgramActivity.this.etProgramNamaPetugasKesehatan.setText(((ResponseProfile) response.body()).getNmPetugasKes());
                    ProgramActivity.this.etProgramNoPetugasKesehatan.setText(((ResponseProfile) response.body()).getTelPetugasKes());
                    ProgramActivity.this.etProgramHotelMakkah.setText(((ResponseProfile) response.body()).getHotelMakkah());
                    ProgramActivity.this.etProgramHotelMadinah.setText(((ResponseProfile) response.body()).getHotelMadinah());
                    ProgramActivity.this.etProgramHotelJeddah.setText(((ResponseProfile) response.body()).getHotelJeddah());
                    ProgramActivity.this.etProgramHotelTransit.setText(((ResponseProfile) response.body()).getHotelTransit());
                    ProgramActivity.this.etProgramKateringMakkah.setText(((ResponseProfile) response.body()).getKateringMakkah());
                    ProgramActivity.this.etProgramKateringMadinah.setText(((ResponseProfile) response.body()).getKateringMadinah());
                    ProgramActivity.this.etProgramKateringJeddah.setText(((ResponseProfile) response.body()).getKateringJeddah());
                    ProgramActivity.this.etProgramKateringTransit.setText(((ResponseProfile) response.body()).getKateringTransit());
                    ProgramActivity.this.etProgramTransportasi.setText(((ResponseProfile) response.body()).getTransfortasi());
                    ProgramActivity.this.etProgramHargaVIP.setText(((ResponseProfile) response.body()).getHargaVip());
                    ProgramActivity.this.etProgramHargaStandart.setText(((ResponseProfile) response.body()).getHargaStandard());
                    ProgramActivity.this.etProgramPerwakilanArabSaudi.setText(((ResponseProfile) response.body()).getPerwakilanArab());
                    ProgramActivity.this.etProgramHNoTelpPerwakilan.setText(((ResponseProfile) response.body()).getTelPerwakilanArab());
                    ProgramActivity.this.etProgramRuterPerjalanan.setText(((ResponseProfile) response.body()).getRutePerjalanan());
                    ProgramActivity.this.etProgramHari.setText(((ResponseProfile) response.body()).getLamaPenyelengaraan());
                    ProgramActivity.this.etProgramLamaTInggalJkt.setText(((ResponseProfile) response.body()).getTinggalJktSaJkt());
                    ProgramActivity.this.etProgramLamaTInggalMadinah.setText(((ResponseProfile) response.body()).getTinggalMadinah());
                    ProgramActivity.this.etProgramLamaTInggalMakkah.setText(((ResponseProfile) response.body()).getTinggalMakkah());
                    ProgramActivity.this.etProgramLamaTInggal.setText(((ResponseProfile) response.body()).getLamaPenyelengaraan());
                    return;
                }
                Toast.makeText(ProgramActivity.this, response.message().toString(), 0).show();
            }

            public void onFailure(Call<ResponseProfile> call, Throwable t) {
                pDialog.dismiss();
                Toast.makeText(ProgramActivity.this, t.getMessage().toString(), 0).show();
            }
        });
    }

    private void initUpdate() {
        final ProgressDialog show = ProgressDialog.show(this, "Please Wait...", "updating data", false, false);
        this.apiServices.updateProgram(Prefs.getInt("user_id", 0), this.etProgramTglBerangkat.getText().toString(), this.etProgramTglKepulangan.getText().toString(), this.etProgramNamaPetugas.getText().toString(), this.etProgramNoTelpPetugasKemenag.getText().toString(), this.etProgramPetugasPihk.getText().toString(), this.etProgramNoTelpPetugasPihk.getText().toString(), this.etProgramNamaPetugasPembimbing.getText().toString(), this.etProgramNoPetugasPembimbing.getText().toString(), this.etProgramNamaPetugasKesehatan.getText().toString(), this.etProgramNoPetugasKesehatan.getText().toString(), this.etProgramHotelMakkah.getText().toString(), this.etProgramHotelMadinah.getText().toString(), this.etProgramHotelJeddah.getText().toString(), this.etProgramHotelTransit.getText().toString(), this.etProgramKateringMakkah.getText().toString(), this.etProgramKateringMadinah.getText().toString(), this.etProgramKateringJeddah.getText().toString(), this.etProgramKateringTransit.getText().toString(), this.etProgramTransportasi.getText().toString(), this.etProgramHargaVIP.getText().toString(), this.etProgramHargaStandart.getText().toString(), this.etProgramPerwakilanArabSaudi.getText().toString(), this.etProgramHNoTelpPerwakilan.getText().toString(), this.etProgramRuterPerjalanan.getText().toString(), this.etProgramHari.getText().toString(), this.etProgramLamaTInggalJkt.getText().toString(), this.etProgramLamaTInggalMadinah.getText().toString(), this.etProgramLamaTInggalMakkah.getText().toString()).enqueue(new Callback<ResponseUpdateProfiles>() {
            public void onResponse(Call<ResponseUpdateProfiles> call, Response<ResponseUpdateProfiles> response) {
                show.dismiss();
                if (response.isSuccessful()) {
                    String returns = ((ResponseUpdateProfiles) response.body()).getStatus().toString();
                    String msg = ((ResponseUpdateProfiles) response.body()).getMsg();
                    if (returns.equals("Success")) {
                        Toast.makeText(ProgramActivity.this, msg, 0).show();
                    } else {
                        Toast.makeText(ProgramActivity.this, msg, 0).show();
                    }
                }
            }

            public void onFailure(Call<ResponseUpdateProfiles> call, Throwable t) {
                show.dismiss();
                Toast.makeText(ProgramActivity.this, t.getMessage().toString(), 0).show();
            }
        });
    }
}
