package com.simwaspihk.fragment;

import android.content.Intent;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentTransaction;
import android.support.v7.widget.CardView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.ViewGroup;
import android.widget.TextView;
import com.pixplicity.easyprefs.library.Prefs;
import com.simwaspihk.R;
import com.simwaspihk.activity.Rpt;
import com.simwaspihk.activity.TbsakitActivity;
import com.simwaspihk.activity.TbsaranActivity;
import com.simwaspihk.activity.TbwafatActivity;

public class RptFragment extends Fragment {
    CardView backDataHome;
    CardView rpt1;
    CardView rpt10;
    CardView rpt14;
    CardView rpt13;
    CardView rpt12;
    CardView rpt2;
    CardView rpt3;
    CardView rpt4;
    CardView rpt5;
    CardView rpt6;
    CardView rpt7;
    CardView rpt9;
    TextView tvBack;
    TextView tvRpt1;
    TextView tvRpt10;
    TextView tvRpt11;
    TextView tvRpt12;
    TextView tvRpt2;
    TextView tvRpt3;
    TextView tvRpt4;
    TextView tvRpt5;
    TextView tvRpt6;
    TextView tvRpt7;
    TextView tvRpt9;

    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }

    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        View v = inflater.inflate(R.layout.fragment_rpt, container, false);
        this.backDataHome = (CardView) v.findViewById(R.id.backDataHome);
        this.backDataHome.setOnClickListener(new OnClickListener() {
            public void onClick(View view) {
                Fragment newFragment = new DataFragmentNew();
                FragmentTransaction transaction = RptFragment.this.getActivity().getSupportFragmentManager().beginTransaction();
                transaction.replace(R.id.fragment_rpt, newFragment);
                transaction.addToBackStack(null);
                transaction.commit();
            }
        });
        this.rpt1 = (CardView) v.findViewById(R.id.rpt1);
        this.rpt1.setOnClickListener(new OnClickListener() {
            public void onClick(View view) {
                Prefs.putString("rpt_id", "Keberangkatan Tanah Air");
                RptFragment.this.startActivity(new Intent(RptFragment.this.getActivity(), Rpt.class));
            }
        });
        this.rpt2 = (CardView) v.findViewById(R.id.rpt2);
        this.rpt2.setOnClickListener(new OnClickListener() {
            public void onClick(View view) {
                Prefs.putString("rpt_id", "Kedatangan Madinah");
                RptFragment.this.startActivity(new Intent(RptFragment.this.getActivity(), Rpt.class));
            }
        });
        this.rpt3 = (CardView) v.findViewById(R.id.rpt3);
        this.rpt3.setOnClickListener(new OnClickListener() {
            public void onClick(View view) {
                Prefs.putString("rpt_id", "Kedatangan Jeddah");
                RptFragment.this.startActivity(new Intent(RptFragment.this.getActivity(), Rpt.class));
            }
        });
        this.rpt4 = (CardView) v.findViewById(R.id.rpt4);
        this.rpt4.setOnClickListener(new OnClickListener() {
            public void onClick(View view) {
                Prefs.putString("rpt_id", "Kedatangan Makkah");
                RptFragment.this.startActivity(new Intent(RptFragment.this.getActivity(), Rpt.class));
            }
        });
        this.rpt5 = (CardView) v.findViewById(R.id.rpt5);
        this.rpt5.setOnClickListener(new OnClickListener() {
            public void onClick(View view) {
                Prefs.putString("rpt_id", "Kepulangan dari Arab Saudi");
                RptFragment.this.startActivity(new Intent(RptFragment.this.getActivity(), Rpt.class));
            }
        });
        this.rpt6 = (CardView) v.findViewById(R.id.rpt6);
        this.rpt6.setOnClickListener(new OnClickListener() {
            public void onClick(View view) {
                Prefs.putString("rpt_id", "Kedatangan Tanah Air");
                RptFragment.this.startActivity(new Intent(RptFragment.this.getActivity(), Rpt.class));
            }
        });
        this.rpt7 = (CardView) v.findViewById(R.id.rpt7);
        this.rpt7.setOnClickListener(new OnClickListener() {
            public void onClick(View view) {
                Prefs.putString("rpt_id", "Kasus-Kasus");
                RptFragment.this.startActivity(new Intent(RptFragment.this.getActivity(), Rpt.class));
            }
        });
        this.rpt13 = (CardView) v.findViewById(R.id.mina);
        this.rpt13.setOnClickListener(new OnClickListener() {
            public void onClick(View view) {
                Prefs.putString("rpt_id", "Kepulangan Mina");
                RptFragment.this.startActivity(new Intent(RptFragment.this.getActivity(), Rpt.class));
            }
        });
        this.rpt14 = (CardView) v.findViewById(R.id.arafah);
        this.rpt14.setOnClickListener(new OnClickListener() {
            public void onClick(View view) {
                Prefs.putString("rpt_id", "Kepulangan Arafah");
                RptFragment.this.startActivity(new Intent(RptFragment.this.getActivity(), Rpt.class));
            }
        });
        this.rpt9 = (CardView) v.findViewById(R.id.jemaahSakit);
        this.rpt9.setOnClickListener(new OnClickListener() {
            public void onClick(View view) {
                RptFragment.this.startActivity(new Intent(RptFragment.this.getActivity(), TbsakitActivity.class));
            }
        });
        this.rpt10 = (CardView) v.findViewById(R.id.Tbwafat);
        this.rpt10.setOnClickListener(new OnClickListener() {
            public void onClick(View view) {
                RptFragment.this.startActivity(new Intent(RptFragment.this.getActivity(), TbwafatActivity.class));
            }
        });
        this.rpt12 = (CardView) v.findViewById(R.id.Tbsaran);
        this.rpt12.setOnClickListener(new OnClickListener() {
            public void onClick(View view) {
                RptFragment.this.startActivity(new Intent(RptFragment.this.getActivity(), TbsaranActivity.class));
            }
        });
        return v;
    }
}
