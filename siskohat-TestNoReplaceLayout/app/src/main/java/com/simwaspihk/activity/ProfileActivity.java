package com.simwaspihk.activity;

import android.app.DatePickerDialog;
import android.app.DatePickerDialog.OnDateSetListener;
import android.app.ProgressDialog;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.RecyclerView;
import android.support.v7.widget.RecyclerView.LayoutManager;
import android.view.MenuItem;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.ImageButton;
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
import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.List;
import java.util.Locale;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class ProfileActivity extends AppCompatActivity {
    ApiServices apiServices;
    Button btnBack;
    ImageButton btnMasaBerlaku;
    Button btnUpdate;
    private List<DataItem> dataItems;
    private SimpleDateFormat dateFormatter;
    private DatePickerDialog datePickerDialog;
    String date_time = "";
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
    int mDay;
    int mMonth;
    int mYear;
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
                ProfileActivity.this.initUpdate();
            }
        });
        this.btnBack = (Button) findViewById(R.id.btnBack);
        this.btnBack.setVisibility(View.GONE);
        this.dateFormatter = new SimpleDateFormat("yyyy-MM-dd", Locale.US);
        this.etProfileMasaBerlaku = (EditText) findViewById(R.id.etProfileMasaBerlaku);
        this.btnMasaBerlaku = (ImageButton) findViewById(R.id.btnMasaBerlaku);
        this.btnMasaBerlaku.setOnClickListener(new OnClickListener() {
            public void onClick(View view) {
                ProfileActivity.this.showDateDialog();
            }
        });
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

    private void showDateDialog() {
        Calendar newCalendar = Calendar.getInstance();
        this.datePickerDialog = new DatePickerDialog(this, new OnDateSetListener() {
            public void onDateSet(DatePicker view, int year, int monthOfYear, int dayOfMonth) {
                Calendar newDate = Calendar.getInstance();
                newDate.set(year, monthOfYear, dayOfMonth);
                ProfileActivity.this.etProfileMasaBerlaku.setText(ProfileActivity.this.dateFormatter.format(newDate.getTime()));
            }
        }, newCalendar.get(1), newCalendar.get(2), newCalendar.get(5));
        this.datePickerDialog.show();
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
                    ProfileActivity.this.tvProfileUID.setText(((ResponseProfile) response.body()).getUserId());
                    ProfileActivity.this.etProfileName.setText(((ResponseProfile) response.body()).getName());
                    ProfileActivity.this.etProfilePimpinan.setText(((ResponseProfile) response.body()).getNamaPimpinan());
                    ProfileActivity.this.etProfileNoIzin.setText(((ResponseProfile) response.body()).getNoSk());
                    ProfileActivity.this.etProfileMasaBerlaku.setText(((ResponseProfile) response.body()).getMasaBerlaku());
                    ProfileActivity.this.etProfileAlamat.setText(((ResponseProfile) response.body()).getAlamat());
                    ProfileActivity.this.etProfileTelp.setText(((ResponseProfile) response.body()).getNoTelp());
                    ProfileActivity.this.etProfileEmail.setText(((ResponseProfile) response.body()).getEmail());
                    ProfileActivity.this.etProfileAsosiasi.setText(((ResponseProfile) response.body()).getAsosiasi());
                    return;
                }
                Toast.makeText(ProfileActivity.this, response.message().toString(), 0).show();
            }

            public void onFailure(Call<ResponseProfile> call, Throwable t) {
                pDialog.dismiss();
                Toast.makeText(ProfileActivity.this, t.getMessage().toString(), 0).show();
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
                        Toast.makeText(ProfileActivity.this, msg, 0).show();
                    } else {
                        Toast.makeText(ProfileActivity.this, msg, 0).show();
                    }
                }
            }

            public void onFailure(Call<ResponseUpdateProfiles> call, Throwable t) {
                pDialog.dismiss();
                Toast.makeText(ProfileActivity.this, t.getMessage().toString(), 0).show();
            }
        });
    }
}
