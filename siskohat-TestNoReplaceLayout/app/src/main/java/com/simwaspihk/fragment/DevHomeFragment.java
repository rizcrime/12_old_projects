package com.simwaspihk.fragment;

import android.app.ProgressDialog;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.support.v7.widget.RecyclerView.LayoutManager;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Toast;
import com.simwaspihk.R;
import com.simwaspihk.adapter.NewsAdapter;
import com.simwaspihk.data.remote.api.ApiServices;
import com.simwaspihk.data.remote.api.model.news.DataItem;
import com.simwaspihk.data.remote.api.model.news.ResponseNews;
import com.simwaspihk.other.Utils;
import java.util.List;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class DevHomeFragment extends Fragment {
    ApiServices apiServices;
    private List<DataItem> dataItems;
    LayoutManager layoutManager;
    NewsAdapter newsAdapter;
    RecyclerView recyclerView;

    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }

    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        View v = inflater.inflate(R.layout.dev_fragment_home, container, false);
        this.recyclerView = (RecyclerView) v.findViewById(R.id.recyclerview);
        this.recyclerView.setLayoutManager(new LinearLayoutManager(getActivity()));
        this.newsAdapter = new NewsAdapter(this.dataItems, R.layout.container_news, getActivity());
        this.recyclerView.setAdapter(this.newsAdapter);
        this.apiServices = Utils.getBAS();
        initNews();
        return v;
    }

    private void initNews() {
        final ProgressDialog pDialog = ProgressDialog.show(getActivity(), "Please Wait...", "Loading Data", false, false);
        this.apiServices.requestNews().enqueue(new Callback<ResponseNews>() {
            public void onResponse(Call<ResponseNews> call, Response<ResponseNews> response) {
                pDialog.dismiss();
                if (response.isSuccessful()) {
                    DevHomeFragment.this.dataItems = ((ResponseNews) response.body()).getData();
                    DevHomeFragment.this.newsAdapter = new NewsAdapter(DevHomeFragment.this.dataItems, R.layout.container_news, DevHomeFragment.this.getActivity());
                    DevHomeFragment.this.recyclerView.setAdapter(DevHomeFragment.this.newsAdapter);
                    DevHomeFragment.this.newsAdapter.notifyDataSetChanged();
                    return;
                }
                Toast.makeText(DevHomeFragment.this.getActivity(), response.message().toString(), Toast.LENGTH_SHORT).show();
            }

            public void onFailure(Call<ResponseNews> call, Throwable t) {
                pDialog.dismiss();
                Toast.makeText(DevHomeFragment.this.getActivity(), t.getMessage().toString(), Toast.LENGTH_SHORT).show();
            }
        });
    }
}
