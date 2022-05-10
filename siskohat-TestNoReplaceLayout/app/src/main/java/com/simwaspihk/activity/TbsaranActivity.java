package com.simwaspihk.activity;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.support.design.widget.FloatingActionButton;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.support.v7.widget.RecyclerView.Adapter;
import android.support.v7.widget.RecyclerView.LayoutManager;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import com.simwaspihk.R;
import com.simwaspihk.adapter.TbsaranAdapter;
import com.simwaspihk.data.remote.api.ApiServices;
import com.simwaspihk.data.remote.api.Retroserver;
import com.simwaspihk.data.remote.api.model.tbsaran.DataTbsaran;
import com.simwaspihk.data.remote.api.model.tbsaran.TbsaranResponse;
import java.util.ArrayList;
import java.util.List;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class TbsaranActivity extends AppCompatActivity {
    private FloatingActionButton fab;
    private Adapter mAdapter;
    private List<DataTbsaran> mItems = new ArrayList();
    private LayoutManager mManager;
    private RecyclerView mRecycler;
    ProgressDialog pd;

    /* Access modifiers changed, original: protected */
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView((int) R.layout.activity_tbsaran);
        this.pd = new ProgressDialog(this);
        this.mRecycler = (RecyclerView) findViewById(R.id.recyclerTemp);
        this.mManager = new LinearLayoutManager(this, 1, false);
        this.mRecycler.setLayoutManager(this.mManager);
        this.pd.setMessage("Loading ...");
        this.pd.setCancelable(false);
        this.pd.show();
        this.fab = (FloatingActionButton) findViewById(R.id.btnInsert);
        this.fab.setOnClickListener(new OnClickListener() {
            public void onClick(View view) {
                TbsaranActivity.this.startActivity(new Intent(TbsaranActivity.this, TbsaranInsertActivity.class));
            }
        });
        ((ApiServices) Retroserver.getClient().create(ApiServices.class)).getTbsaran().enqueue(new Callback<TbsaranResponse>() {
            public void onResponse(Call<TbsaranResponse> call, Response<TbsaranResponse> response) {
                TbsaranActivity.this.pd.hide();
                Log.d("RETRO", "RESPONSE : " + ((TbsaranResponse) response.body()).getData());
                TbsaranActivity.this.mItems = ((TbsaranResponse) response.body()).getData();
                TbsaranActivity.this.mAdapter = new TbsaranAdapter(TbsaranActivity.this, TbsaranActivity.this.mItems);
                TbsaranActivity.this.mRecycler.setAdapter(TbsaranActivity.this.mAdapter);
                TbsaranActivity.this.mAdapter.notifyDataSetChanged();
            }

            public void onFailure(Call<TbsaranResponse> call, Throwable t) {
                TbsaranActivity.this.pd.hide();
                Log.d("RETRO", "FAILED : respon gagal");
            }
        });
    }
}
