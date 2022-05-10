package com.simwaspihk.adapter;

/**
 * Created by Lenovo on 11/18/2017.
 */


import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentManager;
import android.support.v4.app.FragmentStatePagerAdapter;

import com.simwaspihk.fragment.jemaahSakit.duaFragment;
import com.simwaspihk.fragment.jemaahSakit.satuFragment;
import com.simwaspihk.fragment.jemaahSakit.tigaFragment;

public class PageAdapter extends FragmentStatePagerAdapter {
    int mNumOfTabs;

    public PageAdapter(FragmentManager fm, int NumOfTabs) {
        super(fm);
        this.mNumOfTabs = NumOfTabs;
    }

    @Override
    public Fragment getItem(int position) {

        switch (position) {
            case 0:
                satuFragment tab1 = new satuFragment();
                return tab1;
            case 1:
                duaFragment tab2 = new duaFragment();
                return tab2;
            case 2:
                tigaFragment tab3 = new tigaFragment();
                return tab3;
            default:
                return null;
        }
    }

    @Override
    public int getCount() {
        return mNumOfTabs;
    }
}
