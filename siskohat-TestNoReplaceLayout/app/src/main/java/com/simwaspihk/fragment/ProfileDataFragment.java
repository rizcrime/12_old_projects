package com.simwaspihk.fragment;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v7.widget.RecyclerView;
import android.support.v7.widget.RecyclerView.LayoutManager;
import android.view.LayoutInflater;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;
import com.pixplicity.easyprefs.library.Prefs;
import com.simwaspihk.R;
import com.simwaspihk.activity.ProfileActivity;
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

public class ProfileDataFragment extends Fragment {
    ApiServices apiServices;
    Button btnBack;
    Button btnUpdate;
    private List<DataItem> dataItems;
    TextView etProfileAlamat;
    TextView etProfileAsosiasi;
    TextView etProfileEmail;
    TextView etProfileFax;
    TextView etProfileMasaBerlaku;
    TextView etProfileName;
    TextView etProfileNoIzin;
    TextView etProfilePimpinan;
    TextView etProfileTelp;
    LayoutManager layoutManager;
    NewsAdapter newsAdapter;
    RecyclerView recyclerView;
    TextView tvProfileUID;

    public static ProfileDataFragment newInstance() {
        return new ProfileDataFragment();
    }

    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setHasOptionsMenu(true);
    }

    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        View v = inflater.inflate(R.layout.fragment_profile_data, container, false);
        this.tvProfileUID = (TextView) v.findViewById(R.id.tvProfileUID);
        this.etProfileName = (TextView) v.findViewById(R.id.etProfileName);
        this.etProfilePimpinan = (TextView) v.findViewById(R.id.etProfilePimpinan);
        this.etProfileNoIzin = (TextView) v.findViewById(R.id.etProfileNoIzin);
        this.etProfileMasaBerlaku = (TextView) v.findViewById(R.id.etProfileMasaBerlaku);
        this.etProfileAlamat = (TextView) v.findViewById(R.id.etProfileAlamat);
        this.etProfileTelp = (TextView) v.findViewById(R.id.etProfileTelp);
        this.etProfileFax = (TextView) v.findViewById(R.id.etProfileFax);
        this.etProfileEmail = (TextView) v.findViewById(R.id.etProfileEmail);
        this.etProfileAsosiasi = (TextView) v.findViewById(R.id.etProfileAsosiasi);
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
                    ProfileDataFragment.this.tvProfileUID.setText(((ResponseProfile) response.body()).getUserId());
                    ProfileDataFragment.this.etProfileName.setText(((ResponseProfile) response.body()).getName());
                    ProfileDataFragment.this.etProfilePimpinan.setText(((ResponseProfile) response.body()).getNamaPimpinan());
                    ProfileDataFragment.this.etProfileNoIzin.setText(((ResponseProfile) response.body()).getNoSk());
                    ProfileDataFragment.this.etProfileMasaBerlaku.setText(((ResponseProfile) response.body()).getMasaBerlaku());
                    ProfileDataFragment.this.etProfileAlamat.setText(((ResponseProfile) response.body()).getAlamat());
                    ProfileDataFragment.this.etProfileTelp.setText(((ResponseProfile) response.body()).getNoTelp());
                    ProfileDataFragment.this.etProfileEmail.setText(((ResponseProfile) response.body()).getEmail());
                    ProfileDataFragment.this.etProfileAsosiasi.setText(((ResponseProfile) response.body()).getAsosiasi());
                    return;
                }
                Toast.makeText(ProfileDataFragment.this.getActivity(), response.message().toString(), 0).show();
            }

            public void onFailure(Call<ResponseProfile> call, Throwable t) {
                pDialog.dismiss();
                Toast.makeText(ProfileDataFragment.this.getActivity(), t.getMessage().toString(), 0).show();
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
                        Toast.makeText(ProfileDataFragment.this.getActivity(), msg, 0).show();
                    } else {
                        Toast.makeText(ProfileDataFragment.this.getActivity(), msg, 0).show();
                    }
                }
            }

            public void onFailure(Call<ResponseUpdateProfiles> call, Throwable t) {
                pDialog.dismiss();
                Toast.makeText(ProfileDataFragment.this.getActivity(), t.getMessage().toString(), 0).show();
            }
        });
    }

    public void onCreateOptionsMenu(Menu menu, MenuInflater inflater) {
        inflater.inflate(R.menu.menu_profile, menu);
        super.onCreateOptionsMenu(menu, inflater);
    }

    public boolean onOptionsItemSelected(MenuItem item) {
        switch (item.getItemId()) {
            case R.id.action_edit /*2131689994*/:
                startActivity(new Intent(getActivity(), ProfileActivity.class));
                break;
        }
        return true;
    }
}
