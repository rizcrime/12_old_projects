package com.simwaspihk.activity;

import android.os.Bundle;
import android.support.design.widget.TabLayout;
import android.support.design.widget.TabLayout.OnTabSelectedListener;
import android.support.design.widget.TabLayout.Tab;
import android.support.design.widget.TabLayout.TabLayoutOnPageChangeListener;
import android.support.v4.view.ViewPager;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.RecyclerView;
import android.support.v7.widget.Toolbar;
import android.view.Menu;
import android.view.MenuItem;
import com.simwaspihk.R;
import com.simwaspihk.adapter.PageAdapter;
import com.simwaspihk.data.remote.api.model.tbsakit.DataTbsakit;
import java.util.ArrayList;
import java.util.List;

public class JemaahSakitActivity extends AppCompatActivity {
    private ArrayList<List<DataTbsakit>> data;
    private RecyclerView recyclerView;

    /* Access modifiers changed, original: protected */
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView((int) R.layout.activity_jemaahsakit);
        setSupportActionBar((Toolbar) findViewById(R.id.toolbar));
        TabLayout tabLayout = (TabLayout) findViewById(R.id.tab_layout);
        tabLayout.addTab(tabLayout.newTab().setText((CharSequence) "Form"));
        tabLayout.addTab(tabLayout.newTab().setText((CharSequence) "List Jemaah"));
        tabLayout.addTab(tabLayout.newTab().setText((CharSequence) "Profile Jemaah"));
        tabLayout.setTabGravity(0);
        final ViewPager viewPager = (ViewPager) findViewById(R.id.pager);
        viewPager.setAdapter(new PageAdapter(getSupportFragmentManager(), tabLayout.getTabCount()));
        viewPager.addOnPageChangeListener(new TabLayoutOnPageChangeListener(tabLayout));
        tabLayout.setOnTabSelectedListener(new OnTabSelectedListener() {
            public void onTabSelected(Tab tab) {
                viewPager.setCurrentItem(tab.getPosition());
            }

            public void onTabUnselected(Tab tab) {
            }

            public void onTabReselected(Tab tab) {
            }
        });
    }

    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.menu_main, menu);
        return true;
    }

    public boolean onOptionsItemSelected(MenuItem item) {
        if (item.getItemId() == R.id.action_settings) {
            return true;
        }
        return super.onOptionsItemSelected(item);
    }
}
