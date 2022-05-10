package com.simwaspihk.admin.fragment;

import android.app.ProgressDialog;
import android.os.Bundle;
import android.support.v4.app.Fragment;
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
import java.util.List;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class AdminFragment extends Fragment {
    ApiServices apiServices;
    private List<DataItem> dataItems;
    LayoutManager layoutManager;
    NewsAdapter newsAdapter;
    RecyclerView recyclerView;

    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }

    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        return inflater.inflate(R.layout.activity_admin, container, false);
    }

    private void initNews() {
        final ProgressDialog pDialog = ProgressDialog.show(getActivity(), "Please Wait...", "Loading Data", false, false);
        this.apiServices.requestNews().enqueue(new Callback<ResponseNews>() {
            public void onResponse(Call<ResponseNews> call, Response<ResponseNews> response) {
                pDialog.dismiss();
                if (response.isSuccessful()) {
                    AdminFragment.this.dataItems = ((ResponseNews) response.body()).getData();
                    AdminFragment.this.newsAdapter = new NewsAdapter(AdminFragment.this.dataItems, R.layout.container_news, AdminFragment.this.getActivity());
                    AdminFragment.this.recyclerView.setAdapter(AdminFragment.this.newsAdapter);
                    AdminFragment.this.newsAdapter.notifyDataSetChanged();
                    return;
                }
                Toast.makeText(AdminFragment.this.getActivity(), response.message().toString(), Toast.LENGTH_SHORT).show();
            }

            public void onFailure(Call<ResponseNews> call, Throwable t) {
                pDialog.dismiss();
                Toast.makeText(AdminFragment.this.getActivity(), t.getMessage().toString(), Toast.LENGTH_SHORT).show();
            }
        });
    }
}
