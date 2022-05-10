package com.simwaspihk.fragment;

import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.support.design.widget.FloatingActionButton;
import android.support.v4.app.Fragment;
import android.support.v4.widget.SwipeRefreshLayout;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.support.v7.widget.RecyclerView.Adapter;
import android.support.v7.widget.RecyclerView.LayoutManager;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.ProgressBar;
import com.simwaspihk.R;
import com.simwaspihk.activity.AdminTravelInsertActivity;
import com.simwaspihk.adapter.TravelAdapter;
import com.simwaspihk.data.remote.api.ApiServices;
import com.simwaspihk.data.remote.api.Retroserver;
import com.simwaspihk.data.remote.api.model.travel.TravelData;
import com.simwaspihk.data.remote.api.model.travel.TravelResponse;
import java.util.ArrayList;
import java.util.List;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class TravelFragment extends Fragment {
    private static final String urlProfileImg = "http://simwaspihk.com/assets/images/user_1496473001.png";
    private FloatingActionButton fab;
    private ImageView imgProfile;
    private OnFragmentInteractionListener listener;
    private Adapter mAdapter;
    private List<TravelData> mItems = new ArrayList();
    private LayoutManager mManager;
    private RecyclerView mRecycler;
    SwipeRefreshLayout mSwipeRefreshLayout;
    ProgressDialog pd;
    private ProgressBar spinner;

    public interface OnFragmentInteractionListener {
        void onClicked();
    }

    public static TravelFragment newInstance() {
        return new TravelFragment();
    }

    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }

    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        View v = inflater.inflate(R.layout.fragment_admin_travel, container, false);
        this.spinner = (ProgressBar) v.findViewById(R.id.progressBar1);
        this.spinner.setVisibility(View.VISIBLE);
        this.mRecycler = (RecyclerView) v.findViewById(R.id.recyclerTemp);
        this.mRecycler.setLayoutManager(this.mManager);
        this.fab = (FloatingActionButton) v.findViewById(R.id.btnInsert);
        this.fab.setOnClickListener(new OnClickListener() {
            public void onClick(View view) {
                TravelFragment.this.startActivity(new Intent(TravelFragment.this.getActivity(), AdminTravelInsertActivity.class));
            }
        });
        loadData();
        return v;
    }

    private void loadData() {
        ((ApiServices) Retroserver.getClient().create(ApiServices.class)).getTravel().enqueue(new Callback<TravelResponse>() {
            public void onResponse(Call<TravelResponse> call, Response<TravelResponse> response) {
                TravelFragment.this.spinner.setVisibility(View.GONE);
                Log.d("RETRO", "RESPONSE : " + ((TravelResponse) response.body()).getData());
                TravelFragment.this.mItems = ((TravelResponse) response.body()).getData();
                TravelFragment.this.mRecycler.setLayoutManager(new LinearLayoutManager(TravelFragment.this.getActivity()));
                TravelFragment.this.mAdapter = new TravelAdapter(TravelFragment.this.getActivity(), TravelFragment.this.mItems);
                TravelFragment.this.mRecycler.setAdapter(TravelFragment.this.mAdapter);
                TravelFragment.this.mAdapter.notifyDataSetChanged();
            }

            public void onFailure(Call<TravelResponse> call, Throwable t) {
                TravelFragment.this.spinner.setVisibility(View.GONE);
                Log.d("RETRO", "FAILED : respon gagal");
            }
        });
    }

    public void onAttach(Context context) {
        super.onAttach(context);
        if (context instanceof OnFragmentInteractionListener) {
            this.listener = (OnFragmentInteractionListener) context;
            return;
        }
        throw new RuntimeException(context.toString() + " must implement OnFragmentInteractionListener");
    }

    public void onDetach() {
        super.onDetach();
        this.listener = null;
    }
}
