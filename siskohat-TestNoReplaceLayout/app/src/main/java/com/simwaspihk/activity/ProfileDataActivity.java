package com.simwaspihk.activity;

import android.app.ProgressDialog;
import android.content.Intent;
import android.content.SharedPreferences.Editor;
import android.os.Bundle;
import android.support.design.widget.FloatingActionButton;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.RecyclerView;
import android.support.v7.widget.RecyclerView.LayoutManager;
import android.view.MenuItem;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.ImageButton;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;
import com.pixplicity.easyprefs.library.Prefs;
import com.simwaspihk.R;
import com.simwaspihk.adapter.NewsAdapter;
import com.simwaspihk.data.remote.api.ApiServices;
import com.simwaspihk.data.remote.api.model.news.DataItem;
import com.simwaspihk.data.remote.api.model.profiles.response.ResponseProfile;
import com.simwaspihk.other.Utils;
import com.squareup.picasso.Picasso;
import java.util.List;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class ProfileDataActivity extends AppCompatActivity {
    TextView ProfilePict;
    ApiServices apiServices;
    Button btnBack;
    ImageButton btnMasaBerlaku;
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
    ImageView imgProfilePic;
    LayoutManager layoutManager;
    NewsAdapter newsAdapter;
    RecyclerView recyclerView;
    TextView tvProfileUID;

    /* Access modifiers changed, original: protected */
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView((int) R.layout.activity_profile_data);
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        ((FloatingActionButton) findViewById(R.id.btnInsert)).setOnClickListener(new OnClickListener() {
            public void onClick(View view) {
                ProfileDataActivity.this.startActivity(new Intent(ProfileDataActivity.this, ProfileActivity.class));
            }
        });
        this.etProfileMasaBerlaku = (TextView) findViewById(R.id.etProfileMasaBerlaku);
        this.tvProfileUID = (TextView) findViewById(R.id.tvProfileUID);
        this.etProfileName = (TextView) findViewById(R.id.etProfileName);
        this.etProfilePimpinan = (TextView) findViewById(R.id.etProfilePimpinan);
        this.ProfilePict = (TextView) findViewById(R.id.ProfilePict);
        String shareFact = this.ProfilePict.getText().toString();
        Picasso.with(this).load("http://simwaspihk.com/assets/images/" + "user.png").into((ImageView) findViewById(R.id.imgProfilePic));
        this.etProfileNoIzin = (TextView) findViewById(R.id.etProfileNoIzin);
        this.etProfileMasaBerlaku = (TextView) findViewById(R.id.etProfileMasaBerlaku);
        this.etProfileAlamat = (TextView) findViewById(R.id.etProfileAlamat);
        this.etProfileTelp = (TextView) findViewById(R.id.etProfileTelp);
        this.etProfileFax = (TextView) findViewById(R.id.etProfileFax);
        this.etProfileEmail = (TextView) findViewById(R.id.etProfileEmail);
        this.etProfileAsosiasi = (TextView) findViewById(R.id.etProfileAsosiasi);
        this.apiServices = Utils.getBAS();
        initProfiles();
    }

    public boolean onOptionsItemSelected(MenuItem item) {
        int id = item.getItemId();
        if (id == 16908332) {
            onBackPressed();
            return true;
        } else if (id != R.id.action_logout) {
            return super.onOptionsItemSelected(item);
        } else {
            Editor editor = getSharedPreferences("userInfo", 0).edit();
            editor.clear();
            editor.commit();
            Prefs.clear();
            startActivity(new Intent(getApplicationContext(), Login.class));
            finish();
            return true;
        }
    }

    private void initProfiles() {
        final ProgressDialog pDialog = ProgressDialog.show(this, "Please Wait...", "Loading Data", false, false);
        this.apiServices.requestProfiles(Prefs.getInt("user_id", 0)).enqueue(new Callback<ResponseProfile>() {
            public void onResponse(Call<ResponseProfile> call, Response<ResponseProfile> response) {
                pDialog.dismiss();
                if (response.isSuccessful()) {
                    ProfileDataActivity.this.tvProfileUID.setText(((ResponseProfile) response.body()).getUserId());
                    ProfileDataActivity.this.etProfileName.setText(((ResponseProfile) response.body()).getName());
                    ProfileDataActivity.this.ProfilePict.setText(((ResponseProfile) response.body()).getProfilePic());
                    ProfileDataActivity.this.etProfilePimpinan.setText(((ResponseProfile) response.body()).getNamaPimpinan());
                    ProfileDataActivity.this.etProfileNoIzin.setText(((ResponseProfile) response.body()).getNoSk());
                    ProfileDataActivity.this.etProfileMasaBerlaku.setText(((ResponseProfile) response.body()).getMasaBerlaku());
                    ProfileDataActivity.this.etProfileAlamat.setText(((ResponseProfile) response.body()).getAlamat());
                    ProfileDataActivity.this.etProfileTelp.setText(((ResponseProfile) response.body()).getNoTelp());
                    ProfileDataActivity.this.etProfileEmail.setText(((ResponseProfile) response.body()).getEmail());
                    ProfileDataActivity.this.etProfileAsosiasi.setText(((ResponseProfile) response.body()).getAsosiasi());
                    return;
                }
                Toast.makeText(ProfileDataActivity.this, response.message().toString(), Toast.LENGTH_SHORT).show();
            }

            public void onFailure(Call<ResponseProfile> call, Throwable t) {
                pDialog.dismiss();
                Toast.makeText(ProfileDataActivity.this, t.getMessage().toString(), Toast.LENGTH_SHORT).show();
            }
        });
    }
}
