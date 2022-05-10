package com.simwaspihk.adapter;

import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentManager;
import android.support.v4.app.FragmentStatePagerAdapter;

import com.simwaspihk.fragment.DataFragment;
import com.simwaspihk.fragment.DataFragmentNew;
import com.simwaspihk.fragment.DevHomeFragment;
import com.simwaspihk.fragment.RptFragment;
import com.simwaspihk.fragment.jemaahSakit.satuFragment;

/**
 * Created by creatorbe on 6/4/17.
 */

public class PagerAdapter extends FragmentStatePagerAdapter {
    int mNumOfTabs;

    public PagerAdapter(FragmentManager fm, int NumOfTabs) {
        super(fm);
        this.mNumOfTabs = NumOfTabs;
    }

    @Override
    public Fragment getItem(int position) {

        switch (position) {
            case 0:
                DataFragmentNew tab1 = new DataFragmentNew();
                return tab1;

            case 1:
//                DataFragment tab2 = new DataFragment();
//                RptActivity tab2 = new RptActivity();
//                RptFragment tab2 = new RptFragment();
                DataFragmentNew tab2 = new DataFragmentNew();
                return tab2;
            case 2:
                RptFragment tab3 = new RptFragment();
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