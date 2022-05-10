package com.simwaspihk.fragment;

import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentTransaction;
import android.view.LayoutInflater;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.ViewGroup;
import android.widget.LinearLayout;
import com.simwaspihk.R;

public class DataFragment extends Fragment {
    LinearLayout profiles;
    LinearLayout programs;
    LinearLayout reports;

    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }

    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        View v = inflater.inflate(R.layout.fragment_data, container, false);
        this.profiles = (LinearLayout) v.findViewById(R.id.llProfile);
        this.profiles.setOnClickListener(new OnClickListener() {
            public void onClick(View view) {
                Fragment newFragment = new ProfileFragment();
                FragmentTransaction transaction = DataFragment.this.getActivity().getSupportFragmentManager().beginTransaction();
                transaction.replace(R.id.fragment_data, newFragment);
                transaction.addToBackStack(null);
                transaction.commit();
            }
        });
        this.programs = (LinearLayout) v.findViewById(R.id.llProgram);
        this.programs.setOnClickListener(new OnClickListener() {
            public void onClick(View view) {
                Fragment newFragment = new ProgramFragment();
                FragmentTransaction transaction = DataFragment.this.getActivity().getSupportFragmentManager().beginTransaction();
                transaction.replace(R.id.fragment_data, newFragment);
                transaction.addToBackStack(null);
                transaction.commit();
            }
        });
        this.reports = (LinearLayout) v.findViewById(R.id.llLaporan);
        this.reports.setOnClickListener(new OnClickListener() {
            public void onClick(View view) {
                Fragment newFragment = new RptFragment();
                FragmentTransaction transaction = DataFragment.this.getActivity().getSupportFragmentManager().beginTransaction();
                transaction.replace(R.id.fragment_data, newFragment);
                transaction.addToBackStack(null);
                transaction.commit();
            }
        });
        return v;
    }
}
