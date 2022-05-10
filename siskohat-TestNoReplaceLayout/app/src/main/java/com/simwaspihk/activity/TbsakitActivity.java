package com.simwaspihk.activity;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.support.design.widget.FloatingActionButton;
import android.support.v4.widget.SwipeRefreshLayout;
import android.support.v4.widget.SwipeRefreshLayout.OnRefreshListener;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.support.v7.widget.RecyclerView.Adapter;
import android.support.v7.widget.RecyclerView.LayoutManager;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.ProgressBar;
import com.simwaspihk.R;
import com.simwaspihk.adapter.TbsakitAdapter;
import com.simwaspihk.data.remote.api.ApiServices;
import com.simwaspihk.data.remote.api.Retroserver;
import com.simwaspihk.data.remote.api.model.tbsakit.DataTbsakit;
import com.simwaspihk.data.remote.api.model.tbsakit.TbsakitResponse;
import java.util.ArrayList;
import java.util.List;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class TbsakitActivity extends AppCompatActivity implements OnRefreshListener {
    private FloatingActionButton fab;
    private Adapter mAdapter;
    private List<DataTbsakit> mItems = new ArrayList();
    private LayoutManager mManager;
    private RecyclerView mRecycler;
    SwipeRefreshLayout mSwipeRefreshLayout;
    ProgressDialog pd;
    private ProgressBar spinner;

    /* Access modifiers changed, original: protected */
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView((int) R.layout.activity_tbsakit);
        this.spinner = (ProgressBar) findViewById(R.id.progressBar1);
        this.spinner.setVisibility(View.VISIBLE);
        this.mRecycler = (RecyclerView) findViewById(R.id.recyclerTemp);
        this.mManager = new LinearLayoutManager(this, 1, false);
        this.mRecycler.setLayoutManager(this.mManager);
        this.fab = (FloatingActionButton) findViewById(R.id.btnInsert);
        this.fab.setOnClickListener(new OnClickListener() {
            public void onClick(View view) {
                TbsakitActivity.this.startActivity(new Intent(TbsakitActivity.this, TbsakitInsertActivity.class));
            }
        });
        loadData();
        final SwipeRefreshLayout swipeRefreshLayout = (SwipeRefreshLayout) findViewById(R.id.swipe_container);
        swipeRefreshLayout.setColorSchemeResources(R.color.colorAccent, R.color.colorPrimaryDark);
        swipeRefreshLayout.setOnRefreshListener(new OnRefreshListener() {
            public void onRefresh() {
                swipeRefreshLayout.setRefreshing(true);
                new Handler().postDelayed(new Runnable() {
                    public void run() {
                        swipeRefreshLayout.setRefreshing(false);
                    }
                }, 1000);
            }
        });
    }

    private void loadData() {
        ((ApiServices) Retroserver.getClient().create(ApiServices.class)).getTbsakit().enqueue(new Callback<TbsakitResponse>() {
            public void onResponse(Call<TbsakitResponse> call, Response<TbsakitResponse> response) {
                TbsakitActivity.this.spinner.setVisibility(View.GONE);
                Log.d("RETRO", "RESPONSE : " + ((TbsakitResponse) response.body()).getData());
                TbsakitActivity.this.mItems = ((TbsakitResponse) response.body()).getData();
                TbsakitActivity.this.mAdapter = new TbsakitAdapter(TbsakitActivity.this, TbsakitActivity.this.mItems);
                TbsakitActivity.this.mRecycler.setAdapter(TbsakitActivity.this.mAdapter);
                TbsakitActivity.this.mAdapter.notifyDataSetChanged();
            }

            public void onFailure(Call<TbsakitResponse> call, Throwable t) {
                TbsakitActivity.this.spinner.setVisibility(View.GONE);
                Log.d("RETRO", "FAILED : respon gagal");
            }
        });
    }

    public void onRefresh() {
        loadData();
    }
}
