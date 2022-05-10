package com.simwaspihk.admin.adapter;

import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentManager;
import android.support.v4.app.FragmentStatePagerAdapter;
import com.simwaspihk.admin.fragment.BarChartFrag;
import com.simwaspihk.admin.fragment.PieChartFrag;

public class AdminPagerAdapter extends FragmentStatePagerAdapter {
    int mNumOfTabs;

    public AdminPagerAdapter(FragmentManager fm, int NumOfTabs) {
        super(fm);
        this.mNumOfTabs = NumOfTabs;
    }

    public Fragment getItem(int position) {
        switch (position) {
            case 0:
                return new BarChartFrag();
            case 1:
                return new PieChartFrag();
            default:
                return null;
        }
    }

    public int getCount() {
        return this.mNumOfTabs;
    }
}
