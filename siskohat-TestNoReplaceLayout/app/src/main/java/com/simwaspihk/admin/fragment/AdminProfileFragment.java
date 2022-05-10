package com.simwaspihk.admin.fragment;

import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences.Editor;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v7.app.AlertDialog.Builder;
import android.support.v7.widget.RecyclerView;
import android.support.v7.widget.RecyclerView.LayoutManager;
import android.view.LayoutInflater;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.ImageButton;
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

public class AdminProfileFragment extends Fragment {
    TextView actionLogout;
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

    public static AdminProfileFragment newInstance() {
        return new AdminProfileFragment();
    }

    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setHasOptionsMenu(true);
    }

    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        View v = inflater.inflate(R.layout.fragment_admin_profile, container, false);
        this.spinner = (ProgressBar) v.findViewById(R.id.progressBar1);
        this.spinner.setVisibility(View.VISIBLE);
        this.tvProfileUID = (TextView) v.findViewById(R.id.tvProfileUID);
        this.etProfileName = (TextView) v.findViewById(R.id.etProfileName);
        this.etProfileNoIzin = (TextView) v.findViewById(R.id.etProfileNoIzin);
        this.etProfileMasaBerlaku = (TextView) v.findViewById(R.id.etProfileMasaBerlaku);
        this.etProfileAlamat = (TextView) v.findViewById(R.id.etProfileAlamat);
        this.etProfileTelp = (TextView) v.findViewById(R.id.etProfileTelp);
        this.etProfileEmail = (TextView) v.findViewById(R.id.etProfileEmail);
        this.etProfileAsosiasi = (TextView) v.findViewById(R.id.etProfileAsosiasi);
        this.actionLogout = (TextView) v.findViewById(R.id.action_logout);
        this.actionLogout.setOnClickListener(new OnClickListener() {
            public void onClick(View v) {
                Builder builder = new Builder(AdminProfileFragment.this.getActivity());
                View view = LayoutInflater.from(AdminProfileFragment.this.getActivity()).inflate(R.layout.dialog_logout, null);
                ImageButton imageButton = (ImageButton) view.findViewById(R.id.image);
                ((TextView) view.findViewById(R.id.title)).setText("Warning!");
                imageButton.setImageResource(R.drawable.ic_launcher);
                builder.setPositiveButton((CharSequence) "Iya", new DialogInterface.OnClickListener() {
                    public void onClick(DialogInterface dialogInterface, int i) {
                        Editor editor = AdminProfileFragment.this.getActivity().getSharedPreferences("userInfo", 0).edit();
                        editor.clear();
                        editor.apply();
                        Prefs.clear();
                        AdminProfileFragment.this.startActivity(new Intent(AdminProfileFragment.this.getActivity().getApplicationContext(), Login.class));
                        AdminProfileFragment.this.getActivity().finish();
                    }
                });
                builder.setNegativeButton((CharSequence) "Tidak", new DialogInterface.OnClickListener() {
                    public void onClick(DialogInterface dialogInterface, int i) {
                        Toast.makeText(AdminProfileFragment.this.getActivity(), "Logout dibatalkan", Toast.LENGTH_SHORT).show();
                    }
                });
                builder.setView(view);
                builder.show();
            }
        });
        this.apiServices = Utils.getBAS();
        initProfiles();
        return v;
    }

    private void initProfiles() {
        this.spinner.setVisibility(View.VISIBLE);
        this.apiServices.requestProfiles(Prefs.getInt("user_id", 0)).enqueue(new Callback<ResponseProfile>() {
            public void onResponse(Call<ResponseProfile> call, Response<ResponseProfile> response) {
                AdminProfileFragment.this.spinner.setVisibility(View.GONE);
                if (response.isSuccessful()) {
                    AdminProfileFragment.this.tvProfileUID.setText(((ResponseProfile) response.body()).getUserId());
                    AdminProfileFragment.this.etProfileName.setText(((ResponseProfile) response.body()).getName());
                    AdminProfileFragment.this.etProfileNoIzin.setText(((ResponseProfile) response.body()).getNoSk());
                    AdminProfileFragment.this.etProfileMasaBerlaku.setText(((ResponseProfile) response.body()).getMasaBerlaku());
                    AdminProfileFragment.this.etProfileAlamat.setText(((ResponseProfile) response.body()).getAlamat());
                    AdminProfileFragment.this.etProfileTelp.setText(((ResponseProfile) response.body()).getNoTelp());
                    AdminProfileFragment.this.etProfileEmail.setText(((ResponseProfile) response.body()).getEmail());
                    AdminProfileFragment.this.etProfileAsosiasi.setText(((ResponseProfile) response.body()).getAsosiasi());
                    return;
                }
                Toast.makeText(AdminProfileFragment.this.getActivity(), response.message().toString(), Toast.LENGTH_SHORT).show();
            }

            public void onFailure(Call<ResponseProfile> call, Throwable t) {
                AdminProfileFragment.this.spinner.setVisibility(View.GONE);
                Toast.makeText(AdminProfileFragment.this.getActivity(), t.getMessage().toString(), Toast.LENGTH_SHORT).show();
            }
        });
    }

    private void initUpdate() {
        this.spinner.setVisibility(View.VISIBLE);
        this.apiServices.updateProfiles(Prefs.getInt("user_id", 0), this.etProfileName.getText().toString(), this.etProfilePimpinan.getText().toString(), this.etProfileNoIzin.getText().toString(), this.etProfileMasaBerlaku.getText().toString(), this.etProfileAlamat.getText().toString(), this.etProfileTelp.getText().toString(), this.etProfileEmail.getText().toString(), this.etProfileAsosiasi.getText().toString()).enqueue(new Callback<ResponseUpdateProfiles>() {
            public void onResponse(Call<ResponseUpdateProfiles> call, Response<ResponseUpdateProfiles> response) {
                AdminProfileFragment.this.spinner.setVisibility(View.GONE);
                if (response.isSuccessful()) {
                    String returns = ((ResponseUpdateProfiles) response.body()).getStatus().toString();
                    String msg = ((ResponseUpdateProfiles) response.body()).getMsg();
                    if (returns.equals("Success")) {
                        Toast.makeText(AdminProfileFragment.this.getActivity(), msg, Toast.LENGTH_SHORT).show();
                    } else {
                        Toast.makeText(AdminProfileFragment.this.getActivity(), msg, Toast.LENGTH_SHORT).show();
                    }
                }
            }

            public void onFailure(Call<ResponseUpdateProfiles> call, Throwable t) {
                AdminProfileFragment.this.spinner.setVisibility(View.GONE);
                Toast.makeText(AdminProfileFragment.this.getActivity(), t.getMessage().toString(), Toast.LENGTH_SHORT).show();
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
