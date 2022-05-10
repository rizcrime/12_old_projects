package com.simwaspihk.admin.bottomNavigation.fragment;

import android.content.Context;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v7.widget.AppCompatButton;
import android.view.LayoutInflater;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.ViewGroup;
import com.simwaspihk.R;

public class SecondFragment extends Fragment {
    private OnFragmentInteractionListener listener;

    public interface OnFragmentInteractionListener {
        void onClicked();
    }

    public static SecondFragment newInstance() {
        return new SecondFragment();
    }

    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }

    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fragment_second, container, false);
        ((AppCompatButton) view.findViewById(R.id.button)).setOnClickListener(new OnClickListener() {
            public void onClick(View view) {
                SecondFragment.this.listener.onClicked();
            }
        });
        return view;
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
