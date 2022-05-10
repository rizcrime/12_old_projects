package com.simwaspihk.fragment;

import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentTabHost;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Toast;
import com.daimajia.slider.library.SliderLayout;
import com.daimajia.slider.library.SliderTypes.BaseSliderView;
import com.daimajia.slider.library.SliderTypes.BaseSliderView.OnSliderClickListener;
import com.daimajia.slider.library.Tricks.ViewPagerEx.OnPageChangeListener;
import com.simwaspihk.R;

public class HomeFragment extends Fragment implements OnSliderClickListener, OnPageChangeListener {
    private SliderLayout mDemoSlider;
    private FragmentTabHost mTabHost;

    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }

    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        View rootView = inflater.inflate(R.layout.fragment_home, container, false);
        this.mTabHost = (FragmentTabHost) rootView.findViewById(16908306);
        this.mTabHost.setup(getActivity(), getChildFragmentManager(), R.id.realtabcontent);
        this.mTabHost.addTab(this.mTabHost.newTabSpec("news").setIndicator("NEWS"), NewsFragment.class, null);
        this.mTabHost.addTab(this.mTabHost.newTabSpec("data").setIndicator("DATA"), NDataFragment.class, null);
        return rootView;
    }

    public void onStop() {
        this.mDemoSlider.stopAutoCycle();
        super.onStop();
    }

    public void onSliderClick(BaseSliderView slider) {
        Toast.makeText(getActivity(), slider.getBundle().get("extra") + "", 0).show();
    }

    public void onPageScrolled(int position, float positionOffset, int positionOffsetPixels) {
    }

    public void onPageSelected(int position) {
        Log.d("Slider Demo", "Page Changed: " + position);
    }

    public void onPageScrollStateChanged(int state) {
    }
}
