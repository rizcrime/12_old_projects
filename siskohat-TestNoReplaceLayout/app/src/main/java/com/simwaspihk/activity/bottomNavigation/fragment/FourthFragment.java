package com.simwaspihk.activity.bottomNavigation.fragment;

import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import com.simwaspihk.R;

public class FourthFragment extends Fragment {
    public static FourthFragment newInstance() {
        return new FourthFragment();
    }

    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        return inflater.inflate(R.layout.fragment_fourth, container, false);
    }
}
