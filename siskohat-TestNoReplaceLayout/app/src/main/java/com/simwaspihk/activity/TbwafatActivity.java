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
import com.simwaspihk.adapter.TbwafatAdapter;
import com.simwaspihk.data.remote.api.ApiServices;
import com.simwaspihk.data.remote.api.Retroserver;
import com.simwaspihk.data.remote.api.model.tbwafat.DataTbwafat;
import com.simwaspihk.data.remote.api.model.tbwafat.TbwafatResponse;
import java.util.ArrayList;
import java.util.List;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class TbwafatActivity extends AppCompatActivity {
    private FloatingActionButton fab;
    private Adapter mAdapter;
    private List<DataTbwafat> mItems = new ArrayList();
    private LayoutManager mManager;
    private RecyclerView mRecycler;
    ProgressDialog pd;

    /* Access modifiers changed, original: protected */
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView((int) R.layout.activity_tbwafat);
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
                TbwafatActivity.this.startActivity(new Intent(TbwafatActivity.this, TbwafatInsertActivity.class));
            }
        });
        ((ApiServices) Retroserver.getClient().create(ApiServices.class)).getTbwafat().enqueue(new Callback<TbwafatResponse>() {
            public void onResponse(Call<TbwafatResponse> call, Response<TbwafatResponse> response) {
                TbwafatActivity.this.pd.hide();
                Log.d("RETRO", "RESPONSE : " + ((TbwafatResponse) response.body()).getData());
                TbwafatActivity.this.mItems = ((TbwafatResponse) response.body()).getData();
                TbwafatActivity.this.mAdapter = new TbwafatAdapter(TbwafatActivity.this, TbwafatActivity.this.mItems);
                TbwafatActivity.this.mRecycler.setAdapter(TbwafatActivity.this.mAdapter);
                TbwafatActivity.this.mAdapter.notifyDataSetChanged();
            }

            public void onFailure(Call<TbwafatResponse> call, Throwable t) {
                TbwafatActivity.this.pd.hide();
                Log.d("RETRO", "FAILED : respon gagal");
            }
        });
    }
}
