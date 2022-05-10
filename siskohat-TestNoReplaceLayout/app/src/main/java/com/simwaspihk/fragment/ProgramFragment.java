package com.simwaspihk.fragment;

import android.app.ProgressDialog;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentTransaction;
import android.view.LayoutInflater;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.ViewGroup;
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

public class ProgramFragment extends Fragment {
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
    String sProgramAirlines;
    String sProgramHNoTelpPerwakilan;
    String sProgramHargaStandart;
    String sProgramHargaVIP;
    String sProgramHari;
    String sProgramHotelJeddah;
    String sProgramHotelMadinah;
    String sProgramHotelMakkah;
    String sProgramHotelTransit;
    String sProgramKateringJeddah;
    String sProgramKateringMadinah;
    String sProgramKateringMakkah;
    String sProgramKateringTransit;
    String sProgramLamaTInggal;
    String sProgramLamaTInggalJkt;
    String sProgramLamaTInggalMadinah;
    String sProgramLamaTInggalMakkah;
    String sProgramNamaPsugas;
    String sProgramNamaPsugasKesehatan;
    String sProgramNamaPsugasPembimbing;
    String sProgramNoPsugasKesehatan;
    String sProgramNoPsugasPembimbing;
    String sProgramNoTelpPsugasKemenag;
    String sProgramNoTelpPsugasPihk;
    String sProgramPerwakilanArabSaudi;
    String sProgramPsugasPihk;
    String sProgramRuterPerjalanan;
    String sProgramTglBerangkat;
    String sProgramTglKepulangan;
    String sProgramTransportasi;
    TextView tvProgramUID;

    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }

    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        View v = inflater.inflate(R.layout.fragment_program, container, false);
        this.btnUpdate = (Button) v.findViewById(R.id.btnUpdate);
        this.btnUpdate.setOnClickListener(new OnClickListener() {
            public void onClick(View view) {
                ProgramFragment.this.initUpdate();
            }
        });
        this.btnBack = (Button) v.findViewById(R.id.btnBack);
        this.btnBack.setOnClickListener(new OnClickListener() {
            public void onClick(View view) {
                Fragment newFragment = new DataFragment();
                FragmentTransaction transaction = ProgramFragment.this.getActivity().getSupportFragmentManager().beginTransaction();
                transaction.replace(R.id.fragment_program, newFragment);
                transaction.addToBackStack(null);
                transaction.commit();
            }
        });
        this.etProgramTglBerangkat = (EditText) v.findViewById(R.id.etProgramTglBerangkat);
        this.etProgramTglKepulangan = (EditText) v.findViewById(R.id.etProgramTglKepulangan);
        this.etProgramNamaPetugas = (EditText) v.findViewById(R.id.etProgramNamaPetugas);
        this.etProgramNoTelpPetugasKemenag = (EditText) v.findViewById(R.id.etProgramNoTelpPetugasKemenag);
        this.etProgramPetugasPihk = (EditText) v.findViewById(R.id.etProgramPetugasPihk);
        this.etProgramNoTelpPetugasPihk = (EditText) v.findViewById(R.id.etProgramNoTelpPetugasPihk);
        this.etProgramNamaPetugasPembimbing = (EditText) v.findViewById(R.id.etProgramNamaPetugasPembimbing);
        this.etProgramNoPetugasPembimbing = (EditText) v.findViewById(R.id.etProgramNoPetugasPembimbing);
        this.etProgramNamaPetugasKesehatan = (EditText) v.findViewById(R.id.etProgramNamaPetugasKesehatan);
        this.etProgramNoPetugasKesehatan = (EditText) v.findViewById(R.id.etProgramNoPetugasKesehatan);
        this.etProgramAirlines = (EditText) v.findViewById(R.id.etProgramAirlines);
        this.etProgramHotelMakkah = (EditText) v.findViewById(R.id.etProgramHotelMakkah);
        this.etProgramHotelMadinah = (EditText) v.findViewById(R.id.etProgramHotelMadinah);
        this.etProgramHotelJeddah = (EditText) v.findViewById(R.id.etProgramHotelJeddah);
        this.etProgramHotelTransit = (EditText) v.findViewById(R.id.etProgramHotelTransit);
        this.etProgramKateringMakkah = (EditText) v.findViewById(R.id.etProgramKateringMakkah);
        this.etProgramKateringMadinah = (EditText) v.findViewById(R.id.etProgramKateringMadinah);
        this.etProgramKateringJeddah = (EditText) v.findViewById(R.id.etProgramKateringJeddah);
        this.etProgramKateringTransit = (EditText) v.findViewById(R.id.etProgramKateringTransit);
        this.etProgramTransportasi = (EditText) v.findViewById(R.id.etProgramTransportasi);
        this.etProgramHargaVIP = (EditText) v.findViewById(R.id.etProgramHargaVIP);
        this.etProgramHargaStandart = (EditText) v.findViewById(R.id.etProgramHargaStandart);
        this.etProgramPerwakilanArabSaudi = (EditText) v.findViewById(R.id.etProgramPerwakilanArabSaudi);
        this.etProgramHNoTelpPerwakilan = (EditText) v.findViewById(R.id.etProgramHNoTelpPerwakilan);
        this.etProgramRuterPerjalanan = (EditText) v.findViewById(R.id.etProgramRuterPerjalanan);
        this.etProgramHari = (EditText) v.findViewById(R.id.etProgramHari);
        this.etProgramLamaTInggalJkt = (EditText) v.findViewById(R.id.etProgramLamaTInggalJkt);
        this.etProgramLamaTInggalMadinah = (EditText) v.findViewById(R.id.etProgramLamaTInggalMadinah);
        this.etProgramLamaTInggalMakkah = (EditText) v.findViewById(R.id.etProgramLamaTInggalMakkah);
        this.etProgramLamaTInggal = (EditText) v.findViewById(R.id.etProgramLamaTInggal);
        this.apiServices = Utils.getBAS();
        initProfiles();
        return v;
    }

    private void initProfiles() {
        final ProgressDialog pDialog = ProgressDialog.show(getActivity(), "Please Wait...", "Loading Data", false, false);
        this.apiServices.requestProfiles(Prefs.getInt("user_id", 0)).enqueue(new Callback<ResponseProfile>() {
            public void onResponse(Call<ResponseProfile> call, Response<ResponseProfile> response) {
                pDialog.dismiss();
                if (response.isSuccessful()) {
                    ProgramFragment.this.etProgramTglBerangkat.setText(((ResponseProfile) response.body()).getTglBerangkat());
                    ProgramFragment.this.etProgramTglKepulangan.setText(((ResponseProfile) response.body()).getTglPulang());
                    ProgramFragment.this.etProgramNamaPetugas.setText(((ResponseProfile) response.body()).getNmPetugasKemenag());
                    ProgramFragment.this.etProgramNoTelpPetugasKemenag.setText(((ResponseProfile) response.body()).getTelPetugasKemenag());
                    ProgramFragment.this.etProgramPetugasPihk.setText(((ResponseProfile) response.body()).getNmPetugasPihk());
                    ProgramFragment.this.etProgramNoTelpPetugasPihk.setText(((ResponseProfile) response.body()).getTelPetugasPihk());
                    ProgramFragment.this.etProgramNamaPetugasPembimbing.setText(((ResponseProfile) response.body()).getNmPetugasPembimbing());
                    ProgramFragment.this.etProgramNoPetugasPembimbing.setText(((ResponseProfile) response.body()).getTelPetugasPembimbing());
                    ProgramFragment.this.etProgramNamaPetugasKesehatan.setText(((ResponseProfile) response.body()).getNmPetugasKes());
                    ProgramFragment.this.etProgramNoPetugasKesehatan.setText(((ResponseProfile) response.body()).getTelPetugasKes());
                    ProgramFragment.this.etProgramHotelMakkah.setText(((ResponseProfile) response.body()).getHotelMakkah());
                    ProgramFragment.this.etProgramHotelMadinah.setText(((ResponseProfile) response.body()).getHotelMadinah());
                    ProgramFragment.this.etProgramHotelJeddah.setText(((ResponseProfile) response.body()).getHotelJeddah());
                    ProgramFragment.this.etProgramHotelTransit.setText(((ResponseProfile) response.body()).getHotelTransit());
                    ProgramFragment.this.etProgramKateringMakkah.setText(((ResponseProfile) response.body()).getKateringMakkah());
                    ProgramFragment.this.etProgramKateringMadinah.setText(((ResponseProfile) response.body()).getKateringMadinah());
                    ProgramFragment.this.etProgramKateringJeddah.setText(((ResponseProfile) response.body()).getKateringJeddah());
                    ProgramFragment.this.etProgramKateringTransit.setText(((ResponseProfile) response.body()).getKateringTransit());
                    ProgramFragment.this.etProgramTransportasi.setText(((ResponseProfile) response.body()).getTransfortasi());
                    ProgramFragment.this.etProgramHargaVIP.setText(((ResponseProfile) response.body()).getHargaVip());
                    ProgramFragment.this.etProgramHargaStandart.setText(((ResponseProfile) response.body()).getHargaStandard());
                    ProgramFragment.this.etProgramPerwakilanArabSaudi.setText(((ResponseProfile) response.body()).getPerwakilanArab());
                    ProgramFragment.this.etProgramHNoTelpPerwakilan.setText(((ResponseProfile) response.body()).getTelPerwakilanArab());
                    ProgramFragment.this.etProgramRuterPerjalanan.setText(((ResponseProfile) response.body()).getRutePerjalanan());
                    ProgramFragment.this.etProgramHari.setText(((ResponseProfile) response.body()).getLamaPenyelengaraan());
                    ProgramFragment.this.etProgramLamaTInggalJkt.setText(((ResponseProfile) response.body()).getTinggalJktSaJkt());
                    ProgramFragment.this.etProgramLamaTInggalMadinah.setText(((ResponseProfile) response.body()).getTinggalMadinah());
                    ProgramFragment.this.etProgramLamaTInggalMakkah.setText(((ResponseProfile) response.body()).getTinggalMakkah());
                    ProgramFragment.this.etProgramLamaTInggal.setText(((ResponseProfile) response.body()).getLamaPenyelengaraan());
                    return;
                }
                Toast.makeText(ProgramFragment.this.getActivity(), response.message().toString(), 0).show();
            }

            public void onFailure(Call<ResponseProfile> call, Throwable t) {
                pDialog.dismiss();
                Toast.makeText(ProgramFragment.this.getActivity(), t.getMessage().toString(), 0).show();
            }
        });
    }

    private void initUpdate() {
        final ProgressDialog show = ProgressDialog.show(getActivity(), "Please Wait...", "updating data", false, false);
        this.apiServices.updateProgram(Prefs.getInt("user_id", 0), this.etProgramTglBerangkat.getText().toString(), this.etProgramTglKepulangan.getText().toString(), this.etProgramNamaPetugas.getText().toString(), this.etProgramNoTelpPetugasKemenag.getText().toString(), this.etProgramPetugasPihk.getText().toString(), this.etProgramNoTelpPetugasPihk.getText().toString(), this.etProgramNamaPetugasPembimbing.getText().toString(), this.etProgramNoPetugasPembimbing.getText().toString(), this.etProgramNamaPetugasKesehatan.getText().toString(), this.etProgramNoPetugasKesehatan.getText().toString(), this.etProgramHotelMakkah.getText().toString(), this.etProgramHotelMadinah.getText().toString(), this.etProgramHotelJeddah.getText().toString(), this.etProgramHotelTransit.getText().toString(), this.etProgramKateringMakkah.getText().toString(), this.etProgramKateringMadinah.getText().toString(), this.etProgramKateringJeddah.getText().toString(), this.etProgramKateringTransit.getText().toString(), this.etProgramTransportasi.getText().toString(), this.etProgramHargaVIP.getText().toString(), this.etProgramHargaStandart.getText().toString(), this.etProgramPerwakilanArabSaudi.getText().toString(), this.etProgramHNoTelpPerwakilan.getText().toString(), this.etProgramRuterPerjalanan.getText().toString(), this.etProgramHari.getText().toString(), this.etProgramLamaTInggalJkt.getText().toString(), this.etProgramLamaTInggalMadinah.getText().toString(), this.etProgramLamaTInggalMakkah.getText().toString()).enqueue(new Callback<ResponseUpdateProfiles>() {
            public void onResponse(Call<ResponseUpdateProfiles> call, Response<ResponseUpdateProfiles> response) {
                show.dismiss();
                if (response.isSuccessful()) {
                    String returns = ((ResponseUpdateProfiles) response.body()).getStatus().toString();
                    String msg = ((ResponseUpdateProfiles) response.body()).getMsg();
                    if (returns.equals("Success")) {
                        Toast.makeText(ProgramFragment.this.getActivity(), msg, 0).show();
                    } else {
                        Toast.makeText(ProgramFragment.this.getActivity(), msg, 0).show();
                    }
                }
            }

            public void onFailure(Call<ResponseUpdateProfiles> call, Throwable t) {
                show.dismiss();
                Toast.makeText(ProgramFragment.this.getActivity(), t.getMessage().toString(), 0).show();
            }
        });
    }
}
