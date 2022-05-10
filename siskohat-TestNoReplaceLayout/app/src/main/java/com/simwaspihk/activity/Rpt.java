package com.simwaspihk.activity;

import android.app.Activity;
import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.support.v7.widget.RecyclerView.LayoutManager;
import android.view.MenuItem;
import android.widget.Toast;
import butterknife.ButterKnife;
import butterknife.OnClick;
import com.pixplicity.easyprefs.library.Prefs;
import com.simwaspihk.R;
import com.simwaspihk.adapter.RptAdapter;
import com.simwaspihk.data.remote.api.ApiServices;
import com.simwaspihk.data.remote.api.model.rpt.DataItem;
import com.simwaspihk.data.remote.api.model.rpt.ResponseRpt;
import com.simwaspihk.other.Utils;
import java.util.List;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class Rpt extends AppCompatActivity {
    RptAdapter adapter;
    private List<DataItem> data;
    LayoutManager layoutManager;
    ApiServices mBas;
    RecyclerView recyclerView;

    /* Access modifiers changed, original: 0000 */
    @OnClick({2131689633})
    public void inserts() {
        startActivity(new Intent(getApplicationContext(), RptInsertActivity.class));
    }

    /* Access modifiers changed, original: protected */
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView((int) R.layout.rpt);
        startActivity(new Intent(getApplicationContext(), RptInsertActivity.class));

        /*
        ButterKnife.bind((Activity) this);
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        this.recyclerView = (RecyclerView) findViewById(R.id.card_recycler_view);
        this.recyclerView.setLayoutManager(new LinearLayoutManager(this));
        this.adapter = new RptAdapter(this.data, R.layout.card_datasimwas, this);
        this.recyclerView.setAdapter(this.adapter);
        this.mBas = Utils.getBAS();
        initStatus();*/
    }

    private void initStatus() {
        final ProgressDialog pDialog = ProgressDialog.show(this, "Please Wait...", "Loading Data", false, false);
        this.mBas.rptRequest(Prefs.getInt("user_id", 0), Prefs.getString("rpt_id", "")).enqueue(new Callback<ResponseRpt>() {
            public void onResponse(Call<ResponseRpt> call, Response<ResponseRpt> response) {
                pDialog.dismiss();
                if (response.isSuccessful()) {
                    Rpt.this.data = ((ResponseRpt) response.body()).getData();
                    Rpt.this.adapter = new RptAdapter(Rpt.this.data, R.layout.card_datasimwas, Rpt.this.getApplicationContext());
                    Rpt.this.recyclerView.setAdapter(Rpt.this.adapter);
                    Rpt.this.adapter.notifyDataSetChanged();
                    return;
                }
                Toast.makeText(Rpt.this, response.message().toString(), 0).show();
            }

            public void onFailure(Call<ResponseRpt> call, Throwable t) {
                pDialog.dismiss();
                Toast.makeText(Rpt.this, t.getMessage().toString(), 0).show();
            }
        });
    }

    public boolean onOptionsItemSelected(MenuItem item) {
        if (item.getItemId() != 16908332) {
            return super.onOptionsItemSelected(item);
        }
        Intent i = new Intent(this, DevMainActivity.class);
        i.addFlags(32768);
        i.addFlags(67108864);
        startActivity(i);
        finish();
        return true;
    }
}
