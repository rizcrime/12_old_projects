package com.simwaspihk.activity;

import android.app.ProgressDialog;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.RecyclerView;
import android.support.v7.widget.RecyclerView.LayoutManager;
import android.view.MenuItem;
import android.view.View;
import android.view.View.OnClickListener;
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

public class ReportActivity extends AppCompatActivity {
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

    /* Access modifiers changed, original: protected */
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView((int) R.layout.fragment_profile);
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        this.btnUpdate = (Button) findViewById(R.id.btnUpdate);
        this.btnUpdate.setOnClickListener(new OnClickListener() {
            public void onClick(View view) {
                ReportActivity.this.initUpdate();
            }
        });
        this.btnBack = (Button) findViewById(R.id.btnBack);
        this.btnBack.setVisibility(View.GONE);
        this.tvProfileUID = (TextView) findViewById(R.id.tvProfileUID);
        this.etProfileName = (EditText) findViewById(R.id.etProfileName);
        this.etProfilePimpinan = (EditText) findViewById(R.id.etProfilePimpinan);
        this.etProfileNoIzin = (EditText) findViewById(R.id.etProfileNoIzin);
        this.etProfileMasaBerlaku = (EditText) findViewById(R.id.etProfileMasaBerlaku);
        this.etProfileAlamat = (EditText) findViewById(R.id.etProfileAlamat);
        this.etProfileTelp = (EditText) findViewById(R.id.etProfileTelp);
        this.etProfileFax = (EditText) findViewById(R.id.etProfileFax);
        this.etProfileEmail = (EditText) findViewById(R.id.etProfileEmail);
        this.etProfileAsosiasi = (EditText) findViewById(R.id.etProfileAsosiasi);
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
                    ReportActivity.this.tvProfileUID.setText(((ResponseProfile) response.body()).getUserId());
                    ReportActivity.this.etProfileName.setText(((ResponseProfile) response.body()).getName());
                    ReportActivity.this.etProfilePimpinan.setText(((ResponseProfile) response.body()).getNamaPimpinan());
                    ReportActivity.this.etProfileNoIzin.setText(((ResponseProfile) response.body()).getNoSk());
                    ReportActivity.this.etProfileMasaBerlaku.setText(((ResponseProfile) response.body()).getMasaBerlaku());
                    ReportActivity.this.etProfileAlamat.setText(((ResponseProfile) response.body()).getAlamat());
                    ReportActivity.this.etProfileTelp.setText(((ResponseProfile) response.body()).getNoTelp());
                    ReportActivity.this.etProfileEmail.setText(((ResponseProfile) response.body()).getEmail());
                    ReportActivity.this.etProfileAsosiasi.setText(((ResponseProfile) response.body()).getAsosiasi());
                    return;
                }
                Toast.makeText(ReportActivity.this, response.message().toString(), 0).show();
            }

            public void onFailure(Call<ResponseProfile> call, Throwable t) {
                pDialog.dismiss();
                Toast.makeText(ReportActivity.this, t.getMessage().toString(), 0).show();
            }
        });
    }

    private void initUpdate() {
        final ProgressDialog pDialog = ProgressDialog.show(this, "Please Wait...", "updating data", false, false);
        this.apiServices.updateProfiles(Prefs.getInt("user_id", 0), this.etProfileName.getText().toString(), this.etProfilePimpinan.getText().toString(), this.etProfileNoIzin.getText().toString(), this.etProfileMasaBerlaku.getText().toString(), this.etProfileAlamat.getText().toString(), this.etProfileTelp.getText().toString(), this.etProfileEmail.getText().toString(), this.etProfileAsosiasi.getText().toString()).enqueue(new Callback<ResponseUpdateProfiles>() {
            public void onResponse(Call<ResponseUpdateProfiles> call, Response<ResponseUpdateProfiles> response) {
                pDialog.dismiss();
                if (response.isSuccessful()) {
                    String returns = ((ResponseUpdateProfiles) response.body()).getStatus().toString();
                    String msg = ((ResponseUpdateProfiles) response.body()).getMsg();
                    if (returns.equals("Success")) {
                        Toast.makeText(ReportActivity.this, msg, 0).show();
                    } else {
                        Toast.makeText(ReportActivity.this, msg, 0).show();
                    }
                }
            }

            public void onFailure(Call<ResponseUpdateProfiles> call, Throwable t) {
                pDialog.dismiss();
                Toast.makeText(ReportActivity.this, t.getMessage().toString(), 0).show();
            }
        });
    }
}
