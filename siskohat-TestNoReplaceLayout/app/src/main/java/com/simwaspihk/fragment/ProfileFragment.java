package com.simwaspihk.fragment;

import android.app.ProgressDialog;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentTransaction;
import android.support.v7.widget.RecyclerView;
import android.support.v7.widget.RecyclerView.LayoutManager;
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
import com.simwaspihk.adapter.NewsAdapter;
import com.simwaspihk.data.remote.api.ApiServices;
import com.simwaspihk.data.remote.api.model.news.DataItem;
import com.simwaspihk.data.remote.api.model.profiles.response.ResponseProfile;
import com.simwaspihk.data.remote.api.model.profiles.update.ResponseUpdateProfiles;
import com.simwaspihk.other.Utils;
import java.util.List;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class ProfileFragment extends Fragment {
    ApiServices apiServices;
    Button btnBack;
    Button btnUpdate;
    private List<DataItem> dataItems;
    EditText etProfileAlamat;
    EditText etProfileAsosiasi;
    EditText etProfileEmail;
    EditText etProfileFax;
    EditText etProfileMasaBerlaku;
    EditText etProfileName;
    EditText etProfileNoIzin;
    EditText etProfilePimpinan;
    EditText etProfileTelp;
    LayoutManager layoutManager;
    NewsAdapter newsAdapter;
    RecyclerView recyclerView;
    TextView tvProfileUID;

    public static ProfileFragment newInstance() {
        return new ProfileFragment();
    }

    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }

    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        View v = inflater.inflate(R.layout.fragment_profile, container, false);
        this.btnUpdate = (Button) v.findViewById(R.id.btnUpdate);
        this.btnUpdate.setOnClickListener(new OnClickListener() {
            public void onClick(View view) {
                ProfileFragment.this.initUpdate();
            }
        });
        this.btnBack = (Button) v.findViewById(R.id.btnBack);
        this.btnBack.setOnClickListener(new OnClickListener() {
            public void onClick(View view) {
                Fragment newFragment = new DataFragment();
                FragmentTransaction transaction = ProfileFragment.this.getActivity().getSupportFragmentManager().beginTransaction();
                transaction.replace(R.id.fragment_profile, newFragment);
                transaction.addToBackStack(null);
                transaction.commit();
            }
        });
        this.tvProfileUID = (TextView) v.findViewById(R.id.tvProfileUID);
        this.etProfileName = (EditText) v.findViewById(R.id.etProfileName);
        this.etProfilePimpinan = (EditText) v.findViewById(R.id.etProfilePimpinan);
        this.etProfileNoIzin = (EditText) v.findViewById(R.id.etProfileNoIzin);
        this.etProfileMasaBerlaku = (EditText) v.findViewById(R.id.etProfileMasaBerlaku);
        this.etProfileAlamat = (EditText) v.findViewById(R.id.etProfileAlamat);
        this.etProfileTelp = (EditText) v.findViewById(R.id.etProfileTelp);
        this.etProfileFax = (EditText) v.findViewById(R.id.etProfileFax);
        this.etProfileEmail = (EditText) v.findViewById(R.id.etProfileEmail);
        this.etProfileAsosiasi = (EditText) v.findViewById(R.id.etProfileAsosiasi);
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
                    ProfileFragment.this.tvProfileUID.setText(((ResponseProfile) response.body()).getUserId());
                    ProfileFragment.this.etProfileName.setText(((ResponseProfile) response.body()).getName());
                    ProfileFragment.this.etProfilePimpinan.setText(((ResponseProfile) response.body()).getNamaPimpinan());
                    ProfileFragment.this.etProfileNoIzin.setText(((ResponseProfile) response.body()).getNoSk());
                    ProfileFragment.this.etProfileMasaBerlaku.setText(((ResponseProfile) response.body()).getMasaBerlaku());
                    ProfileFragment.this.etProfileAlamat.setText(((ResponseProfile) response.body()).getAlamat());
                    ProfileFragment.this.etProfileTelp.setText(((ResponseProfile) response.body()).getNoTelp());
                    ProfileFragment.this.etProfileEmail.setText(((ResponseProfile) response.body()).getEmail());
                    ProfileFragment.this.etProfileAsosiasi.setText(((ResponseProfile) response.body()).getAsosiasi());
                    return;
                }
                Toast.makeText(ProfileFragment.this.getActivity(), response.message().toString(), 0).show();
            }

            public void onFailure(Call<ResponseProfile> call, Throwable t) {
                pDialog.dismiss();
                Toast.makeText(ProfileFragment.this.getActivity(), t.getMessage().toString(), 0).show();
            }
        });
    }

    private void initUpdate() {
        final ProgressDialog pDialog = ProgressDialog.show(getActivity(), "Please Wait...", "updating data", false, false);
        this.apiServices.updateProfiles(Prefs.getInt("user_id", 0), this.etProfileName.getText().toString(), this.etProfilePimpinan.getText().toString(), this.etProfileNoIzin.getText().toString(), this.etProfileMasaBerlaku.getText().toString(), this.etProfileAlamat.getText().toString(), this.etProfileTelp.getText().toString(), this.etProfileEmail.getText().toString(), this.etProfileAsosiasi.getText().toString()).enqueue(new Callback<ResponseUpdateProfiles>() {
            public void onResponse(Call<ResponseUpdateProfiles> call, Response<ResponseUpdateProfiles> response) {
                pDialog.dismiss();
                if (response.isSuccessful()) {
                    String returns = ((ResponseUpdateProfiles) response.body()).getStatus().toString();
                    String msg = ((ResponseUpdateProfiles) response.body()).getMsg();
                    if (returns.equals("Success")) {
                        Toast.makeText(ProfileFragment.this.getActivity(), msg, 0).show();
                    } else {
                        Toast.makeText(ProfileFragment.this.getActivity(), msg, 0).show();
                    }
                }
            }

            public void onFailure(Call<ResponseUpdateProfiles> call, Throwable t) {
                pDialog.dismiss();
                Toast.makeText(ProfileFragment.this.getActivity(), t.getMessage().toString(), 0).show();
            }
        });
    }
}
