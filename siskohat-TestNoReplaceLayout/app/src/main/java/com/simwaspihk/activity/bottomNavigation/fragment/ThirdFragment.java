package com.simwaspihk.activity.bottomNavigation.fragment;

import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import com.simwaspihk.R;

public class ThirdFragment extends Fragment {
    public static ThirdFragment newInstance() {
        return new ThirdFragment();
    }

    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        return inflater.inflate(R.layout.fragment_third, container, false);
    }
}
