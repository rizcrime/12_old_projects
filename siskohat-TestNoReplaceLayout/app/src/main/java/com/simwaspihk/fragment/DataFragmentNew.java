package com.simwaspihk.fragment;

import android.content.Intent;
import android.graphics.Typeface;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentTransaction;
import android.support.v7.widget.CardView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.ViewGroup;
import android.widget.TextView;
import com.simwaspihk.R;
import com.simwaspihk.activity.ProfileDataActivity;
import com.simwaspihk.activity.ProgramActivity;

public class DataFragmentNew extends Fragment {
    private OnFragmentInteractionListener listener;
    CardView profiles;
    CardView programs;
    CardView reports;
    TextView tvProfiles;
    TextView tvProgram;
    TextView tvReports;

    public interface OnFragmentInteractionListener {
    }

    public static DataFragmentNew newInstance() {
        return new DataFragmentNew();
    }

    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }

    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        View v = inflater.inflate(R.layout.fragment_data_new, container, false);
        Typeface font = Typeface.createFromAsset(getActivity().getAssets(), "fonts/hajipintar2.ttf");
        this.profiles = (CardView) v.findViewById(R.id.cvProfile);
        this.profiles.setOnClickListener(new OnClickListener() {
            public void onClick(View view) {
                DataFragmentNew.this.startActivity(new Intent(DataFragmentNew.this.getActivity(), ProfileDataActivity.class));
            }
        });
        this.programs = (CardView) v.findViewById(R.id.cvProgram);
        this.programs.setOnClickListener(new OnClickListener() {
            public void onClick(View view) {
                DataFragmentNew.this.startActivity(new Intent(DataFragmentNew.this.getActivity(), ProgramActivity.class));
            }
        });
        this.reports = (CardView) v.findViewById(R.id.cvLaporan);
        this.reports.setOnClickListener(new OnClickListener() {
            public void onClick(View view) {
                Fragment newFragment = new RptFragment();
                FragmentTransaction transaction = DataFragmentNew.this.getActivity().getSupportFragmentManager().beginTransaction();
                transaction.replace(R.id.fragment_data, newFragment);
                transaction.addToBackStack(null);
                transaction.commit();
            }
        });
        return v;
    }
}
