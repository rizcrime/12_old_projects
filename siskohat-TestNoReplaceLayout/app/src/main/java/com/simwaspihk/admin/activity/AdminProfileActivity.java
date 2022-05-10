package com.simwaspihk.admin.activity;

import android.content.Intent;
import android.content.SharedPreferences.Editor;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.RecyclerView;
import android.support.v7.widget.RecyclerView.LayoutManager;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.ProgressBar;
import android.widget.TextView;
import android.widget.Toast;
import com.pixplicity.easyprefs.library.Prefs;
import com.simwaspihk.R;
import com.simwaspihk.activity.Login;
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

public class AdminProfileActivity extends AppCompatActivity {
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
    private ProgressBar spinner;
    TextView tvProfileUID;
    TextView tvVersion;

    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView((int) R.layout.fragment_admin_profile);
        this.tvProfileUID = (TextView) findViewById(R.id.tvProfileUID);
        this.etProfileName = (TextView) findViewById(R.id.etProfileName);
        this.etProfileNoIzin = (TextView) findViewById(R.id.etProfileNoIzin);
        this.etProfileMasaBerlaku = (TextView) findViewById(R.id.etProfileMasaBerlaku);
        this.etProfileAlamat = (TextView) findViewById(R.id.etProfileAlamat);
        this.etProfileTelp = (TextView) findViewById(R.id.etProfileTelp);
        this.etProfileEmail = (TextView) findViewById(R.id.etProfileEmail);
        this.etProfileAsosiasi = (TextView) findViewById(R.id.etProfileAsosiasi);
        this.spinner = (ProgressBar) findViewById(R.id.progressBar1);
        this.spinner.setVisibility(View.VISIBLE);
        this.apiServices = Utils.getBAS();
        initProfiles();
    }

    private void initProfiles() {
        this.spinner.setVisibility(View.VISIBLE);
        this.apiServices.requestProfiles(Prefs.getInt("user_id", 0)).enqueue(new Callback<ResponseProfile>() {
            public void onResponse(Call<ResponseProfile> call, Response<ResponseProfile> response) {
                AdminProfileActivity.this.spinner.setVisibility(View.GONE);
                if (response.isSuccessful()) {
                    AdminProfileActivity.this.tvProfileUID.setText(((ResponseProfile) response.body()).getUserId());
                    AdminProfileActivity.this.etProfileName.setText(((ResponseProfile) response.body()).getName());
                    AdminProfileActivity.this.etProfileNoIzin.setText(((ResponseProfile) response.body()).getNoSk());
                    AdminProfileActivity.this.etProfileMasaBerlaku.setText(((ResponseProfile) response.body()).getMasaBerlaku());
                    AdminProfileActivity.this.etProfileAlamat.setText(((ResponseProfile) response.body()).getAlamat());
                    AdminProfileActivity.this.etProfileTelp.setText(((ResponseProfile) response.body()).getNoTelp());
                    AdminProfileActivity.this.etProfileEmail.setText(((ResponseProfile) response.body()).getEmail());
                    AdminProfileActivity.this.etProfileAsosiasi.setText(((ResponseProfile) response.body()).getAsosiasi());
                    return;
                }
                Toast.makeText(AdminProfileActivity.this, response.message().toString(), 0).show();
            }

            public void onFailure(Call<ResponseProfile> call, Throwable t) {
                AdminProfileActivity.this.spinner.setVisibility(View.GONE);
                Toast.makeText(AdminProfileActivity.this, t.getMessage().toString(), 0).show();
            }
        });
    }

    private void initUpdate() {
        this.spinner.setVisibility(View.VISIBLE);
        this.apiServices.updateProfiles(Prefs.getInt("user_id", 0), this.etProfileName.getText().toString(), this.etProfilePimpinan.getText().toString(), this.etProfileNoIzin.getText().toString(), this.etProfileMasaBerlaku.getText().toString(), this.etProfileAlamat.getText().toString(), this.etProfileTelp.getText().toString(), this.etProfileEmail.getText().toString(), this.etProfileAsosiasi.getText().toString()).enqueue(new Callback<ResponseUpdateProfiles>() {
            public void onResponse(Call<ResponseUpdateProfiles> call, Response<ResponseUpdateProfiles> response) {
                AdminProfileActivity.this.spinner.setVisibility(View.GONE);
                if (response.isSuccessful()) {
                    String returns = ((ResponseUpdateProfiles) response.body()).getStatus().toString();
                    String msg = ((ResponseUpdateProfiles) response.body()).getMsg();
                    if (returns.equals("Success")) {
                        Toast.makeText(AdminProfileActivity.this, msg, 0).show();
                    } else {
                        Toast.makeText(AdminProfileActivity.this, msg, 0).show();
                    }
                }
            }

            public void onFailure(Call<ResponseUpdateProfiles> call, Throwable t) {
                AdminProfileActivity.this.spinner.setVisibility(View.GONE);
                Toast.makeText(AdminProfileActivity.this, t.getMessage().toString(), 0).show();
            }
        });
    }

    public boolean onOptionsItemSelected(MenuItem item) {
        switch (item.getItemId()) {
            case R.id.action_edit /*2131689994*/:
                startActivity(new Intent(this, ProfileActivity.class));
                break;
        }
        return true;
    }

    public void action_logout(View view) {
        Editor editor = getSharedPreferences("userInfo", 0).edit();
        editor.clear();
        editor.apply();
        Prefs.clear();
        startActivity(new Intent(getApplicationContext(), Login.class));
        finish();
    }
}
