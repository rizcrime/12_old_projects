package com.simwaspihk.activity;

import android.app.Activity;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.support.v7.widget.RecyclerView.LayoutManager;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
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

public class RptActivity extends Fragment {
    RptAdapter adapter;
    private List<DataItem> data;
    LayoutManager layoutManager;
    ApiServices mBas;
    RecyclerView recyclerView;

    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }

    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        View v = inflater.inflate(R.layout.activity_rpt, container, false);
        Activity activity = getActivity();
        this.recyclerView = (RecyclerView) v.findViewById(R.id.card_recycler_view);
        this.recyclerView.setLayoutManager(new LinearLayoutManager(activity));
        this.adapter = new RptAdapter(this.data, R.layout.card_datasimwas, activity);
        this.recyclerView.setAdapter(this.adapter);
        this.mBas = Utils.getBAS();
        initStatus();
        return v;
    }

    private void initStatus() {
        this.mBas.rptRequest(3222, "RPT 1").enqueue(new Callback<ResponseRpt>() {
            public void onResponse(Call<ResponseRpt> call, Response<ResponseRpt> response) {
                if (response.isSuccessful()) {
                    Activity activity = RptActivity.this.getActivity();
                    RptActivity.this.data = ((ResponseRpt) response.body()).getData();
                    RptActivity.this.adapter = new RptAdapter(RptActivity.this.data, R.layout.card_datasimwas, activity);
                    RptActivity.this.recyclerView.setAdapter(RptActivity.this.adapter);
                    RptActivity.this.adapter.notifyDataSetChanged();
                }
            }

            public void onFailure(Call<ResponseRpt> call, Throwable t) {
            }
        });
    }
}
