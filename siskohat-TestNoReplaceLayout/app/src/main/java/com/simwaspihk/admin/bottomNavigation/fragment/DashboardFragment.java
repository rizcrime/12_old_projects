package com.simwaspihk.admin.bottomNavigation.fragment;

import android.app.ProgressDialog;
import android.content.Context;
import android.os.Bundle;
import android.support.design.widget.TabLayout;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentManager;
import android.support.v4.app.FragmentPagerAdapter;
import android.support.v4.view.ViewPager;
import android.support.v7.widget.RecyclerView;
import android.support.v7.widget.RecyclerView.LayoutManager;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Toast;
import com.daimajia.slider.library.SliderLayout;
import com.simwaspihk.R;
import com.simwaspihk.adapter.NewsAdapter;
import com.simwaspihk.admin.fragment.BarChartFrag;
import com.simwaspihk.admin.fragment.PieChartFrag;
import com.simwaspihk.data.remote.api.ApiServices;
import com.simwaspihk.data.remote.api.model.news.DataItem;
import com.simwaspihk.data.remote.api.model.news.ResponseNews;
import java.util.ArrayList;
import java.util.List;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class DashboardFragment extends Fragment {
    ApiServices apiServices;
    private List<DataItem> dataItems;
    LayoutManager layoutManager;
    private OnFragmentInteractionListener listener;
    NewsAdapter newsAdapter;
    RecyclerView recyclerView;

    public interface OnFragmentInteractionListener {
    }

    static class Adapter extends FragmentPagerAdapter {
        private final List<Fragment> mFragmentList = new ArrayList();
        private final List<String> mFragmentTitleList = new ArrayList();

        public Adapter(FragmentManager manager) {
            super(manager);
        }

        public Fragment getItem(int position) {
            return (Fragment) this.mFragmentList.get(position);
        }

        public int getCount() {
            return this.mFragmentList.size();
        }

        public void addFragment(Fragment fragment, String title) {
            this.mFragmentList.add(fragment);
            this.mFragmentTitleList.add(title);
        }

        public CharSequence getPageTitle(int position) {
            return (CharSequence) this.mFragmentTitleList.get(position);
        }
    }

    public static DashboardFragment newInstance() {
        return new DashboardFragment();
    }

    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setRetainInstance(true);
    }

    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.activity_admin_dashboard, container, false);
        ViewPager viewPager = (ViewPager) view.findViewById(R.id.viewpager);
        setupViewPager(viewPager);
        SliderLayout mDemoSlider = (SliderLayout) view.findViewById(R.id.adminSlider);
        ((TabLayout) view.findViewById(R.id.tablayout)).setupWithViewPager(viewPager);
        return view;
    }

    private void setupViewPager(ViewPager viewPager) {
        Adapter adapter = new Adapter(getChildFragmentManager());
        adapter.addFragment(new BarChartFrag(), "Graph 1");
        adapter.addFragment(new PieChartFrag(), "Graph 2");
        viewPager.setAdapter(adapter);
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

    private void initNews() {
        final ProgressDialog pDialog = ProgressDialog.show(getActivity(), "Please Wait...", "Loading Data", false, false);
        this.apiServices.requestNews().enqueue(new Callback<ResponseNews>() {
            public void onResponse(Call<ResponseNews> call, Response<ResponseNews> response) {
                pDialog.dismiss();
                if (response.isSuccessful()) {
                    DashboardFragment.this.dataItems = ((ResponseNews) response.body()).getData();
                    DashboardFragment.this.newsAdapter = new NewsAdapter(DashboardFragment.this.dataItems, R.layout.container_news, DashboardFragment.this.getActivity());
                    DashboardFragment.this.recyclerView.setAdapter(DashboardFragment.this.newsAdapter);
                    DashboardFragment.this.newsAdapter.notifyDataSetChanged();
                    return;
                }
                Toast.makeText(DashboardFragment.this.getActivity(), response.message().toString(), 0).show();
            }

            public void onFailure(Call<ResponseNews> call, Throwable t) {
                pDialog.dismiss();
                Toast.makeText(DashboardFragment.this.getActivity(), t.getMessage().toString(), 0).show();
            }
        });
    }
}
