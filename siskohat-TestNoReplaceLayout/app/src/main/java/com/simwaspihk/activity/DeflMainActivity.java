package com.simwaspihk.activity;

import android.content.Intent;
import android.content.SharedPreferences.Editor;
import android.os.Bundle;
import android.os.Handler;
import android.support.design.widget.NavigationView;
import android.support.design.widget.NavigationView.OnNavigationItemSelectedListener;
import android.support.design.widget.TabLayout;
import android.support.design.widget.TabLayout.OnTabSelectedListener;
import android.support.design.widget.TabLayout.Tab;
import android.support.design.widget.TabLayout.TabLayoutOnPageChangeListener;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentActivity;
import android.support.v4.app.FragmentTabHost;
import android.support.v4.app.FragmentTransaction;
import android.support.v4.view.ViewPager;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBarDrawerToggle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;
import com.bumptech.glide.Glide;
import com.bumptech.glide.load.engine.DiskCacheStrategy;
import com.daimajia.slider.library.Animations.DescriptionAnimation;
import com.daimajia.slider.library.SliderLayout;
import com.daimajia.slider.library.SliderLayout.PresetIndicators;
import com.daimajia.slider.library.SliderLayout.Transformer;
import com.daimajia.slider.library.SliderTypes.BaseSliderView;
import com.daimajia.slider.library.SliderTypes.BaseSliderView.OnSliderClickListener;
import com.daimajia.slider.library.SliderTypes.BaseSliderView.ScaleType;
import com.daimajia.slider.library.SliderTypes.TextSliderView;
import com.daimajia.slider.library.Tricks.ViewPagerEx.OnPageChangeListener;
import com.pixplicity.easyprefs.library.Prefs;
import com.simwaspihk.R;
import com.simwaspihk.adapter.PagerAdapter;
import com.simwaspihk.fragment.DevHomeFragment;
import com.simwaspihk.other.CircleTransform;
import java.util.HashMap;

public class DeflMainActivity extends AppCompatActivity implements OnSliderClickListener, OnPageChangeListener {
    private static final String TAG_HOME = "home";
    public static String CURRENT_TAG = TAG_HOME;
    private static final String TAG_PHOTOS = "photos";
    public static int navItemIndex = 0;
    private static final String urlNavHeaderBg = "https://static.vecteezy.com/system/resources/previews/000/126/906/non_2x/ka-bah-with-blue-background-vector.jpg";
    private static final String urlProfileImg = "http://simwaspihk.com/assets/images/user_1496473001.png";
    private String[] activityTitles;
    private DrawerLayout drawer;
    private ImageView imgNavHeaderBg;
    private ImageView imgProfile;
    private SliderLayout mDemoSlider;
    private DrawerLayout mDrawerLayout;
    private Handler mHandler;
    private FragmentTabHost mTabHost;
    private View navHeader;
    private NavigationView navigationView;
    private boolean shouldLoadHomeFragOnBackPress = true;
    private Toolbar toolbar;
    private TextView txtName;
    private TextView txtWebsite;

    /* Access modifiers changed, original: protected */
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView((int) R.layout.def_activity_main);
        this.toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(this.toolbar);
        this.mDemoSlider = (SliderLayout) findViewById(R.id.slider);
        HashMap<String, String> url_maps = new HashMap();
        url_maps.put("Welcome in", "http://simwaspihk.com/assets/images/slide1.jpg");
        url_maps.put("Best Platform Helper", "http://simwaspihk.com/assets/images/slide2.jpg");
        url_maps.put("Hajj App", "http://simwaspihk.com/assets/images/slide3.jpg");
        for (String name : url_maps.keySet()) {
            TextSliderView textSliderView = new TextSliderView(this);
            textSliderView.description(name).image((String) url_maps.get(name)).setScaleType(ScaleType.Fit).setOnSliderClickListener(this);
            textSliderView.bundle(new Bundle());
            textSliderView.getBundle().putString("extra", name);
            this.mDemoSlider.addSlider(textSliderView);
        }
        this.mDemoSlider.setPresetTransformer(Transformer.Accordion);
        this.mDemoSlider.setPresetIndicator(PresetIndicators.Center_Bottom);
        this.mDemoSlider.setCustomAnimation(new DescriptionAnimation());
        this.mDemoSlider.setDuration(4000);
        this.mDemoSlider.addOnPageChangeListener(this);
        this.mHandler = new Handler();
        this.drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        this.navigationView = (NavigationView) findViewById(R.id.nav_view);
        this.navHeader = this.navigationView.getHeaderView(0);
        this.txtName = (TextView) this.navHeader.findViewById(R.id.name);
        this.txtWebsite = (TextView) this.navHeader.findViewById(R.id.website);
        this.imgNavHeaderBg = (ImageView) this.navHeader.findViewById(R.id.img_header_bg);
        this.imgProfile = (ImageView) this.navHeader.findViewById(R.id.img_profile);
        this.activityTitles = getResources().getStringArray(R.array.nav_item_activity_titles);
        loadNavHeader();
        setUpNavigationView();
        TabLayout tabLayout = (TabLayout) findViewById(R.id.tablayout);
        tabLayout.addTab(tabLayout.newTab().setText((CharSequence) "NEWS"));
        tabLayout.setTabGravity(0);
        final ViewPager viewPager = (ViewPager) findViewById(R.id.viewpager);
        viewPager.setAdapter(new PagerAdapter(getSupportFragmentManager(), tabLayout.getTabCount()));
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

    private void loadNavHeader() {
        this.txtName.setText("");
        this.txtWebsite.setText("");
        Glide.with((FragmentActivity) this).load(urlNavHeaderBg).crossFade().diskCacheStrategy(DiskCacheStrategy.ALL).into(this.imgNavHeaderBg);
        Glide.with((FragmentActivity) this).load(urlProfileImg).crossFade().thumbnail(0.5f).bitmapTransform(new CircleTransform(this)).diskCacheStrategy(DiskCacheStrategy.ALL).into(this.imgProfile);
    }

    private void loadDevHomeFragment() {
        selectNavMenu();
        setToolbarTitle();
        if (getSupportFragmentManager().findFragmentByTag(CURRENT_TAG) != null) {
            this.drawer.closeDrawers();
            return;
        }
        Runnable mPendingRunnable = new Runnable() {
            public void run() {
                Fragment fragment = DeflMainActivity.this.getDevHomeFragment();
                FragmentTransaction fragmentTransaction = DeflMainActivity.this.getSupportFragmentManager().beginTransaction();
                fragmentTransaction.setCustomAnimations(R.anim.fade_in, R.anim.fade_out);
                fragmentTransaction.replace(R.id.frame, fragment, DeflMainActivity.CURRENT_TAG);
                fragmentTransaction.commitAllowingStateLoss();
            }
        };
        if (mPendingRunnable != null) {
            this.mHandler.post(mPendingRunnable);
        }
        this.drawer.closeDrawers();
        invalidateOptionsMenu();
    }

    private Fragment getDevHomeFragment() {
        switch (navItemIndex) {
            case 0:
                return new DevHomeFragment();
            default:
                return new DevHomeFragment();
        }
    }

    private void setToolbarTitle() {
        getSupportActionBar().setTitle(this.activityTitles[navItemIndex]);
    }

    private void selectNavMenu() {
        this.navigationView.getMenu().getItem(navItemIndex).setChecked(true);
    }

    private void setUpNavigationView() {
        this.navigationView.setNavigationItemSelectedListener(new OnNavigationItemSelectedListener() {
            public boolean onNavigationItemSelected(MenuItem menuItem) {
                switch (menuItem.getItemId()) {
                    case R.id.home /*2131689476*/:
                        DeflMainActivity.navItemIndex = 0;
                        DeflMainActivity.CURRENT_TAG = DeflMainActivity.TAG_HOME;
                        break;
                    case R.id.nav_login /*2131689991*/:
                        DeflMainActivity.this.startActivity(new Intent(DeflMainActivity.this.getApplicationContext(), Login.class));
                        DeflMainActivity.this.drawer.closeDrawers();
                        break;
                    default:
                        DeflMainActivity.navItemIndex = 0;
                        break;
                }
                if (menuItem.isChecked()) {
                    menuItem.setChecked(false);
                } else {
                    menuItem.setChecked(true);
                }
                menuItem.setChecked(true);
                DeflMainActivity.this.drawer.closeDrawers();
                return true;
            }
        });
        ActionBarDrawerToggle actionBarDrawerToggle = new ActionBarDrawerToggle(this, this.drawer, this.toolbar, R.string.openDrawer, R.string.closeDrawer) {
            public void onDrawerClosed(View drawerView) {
                super.onDrawerClosed(drawerView);
            }

            public void onDrawerOpened(View drawerView) {
                super.onDrawerOpened(drawerView);
            }
        };
        this.drawer.setDrawerListener(actionBarDrawerToggle);
        actionBarDrawerToggle.syncState();
    }

    public void onBackPressed() {
        if (this.drawer.isDrawerOpen(8388611)) {
            this.drawer.closeDrawers();
        } else if (!this.shouldLoadHomeFragOnBackPress || navItemIndex == 0) {
            super.onBackPressed();
        } else {
            navItemIndex = 0;
            CURRENT_TAG = TAG_HOME;
            loadDevHomeFragment();
        }
    }

    public boolean onCreateOptionsMenu(Menu menu) {
        return true;
    }

    public boolean onOptionsItemSelected(MenuItem item) {
        int id = item.getItemId();
        if (id == R.id.action_logout) {
            Editor editor = getSharedPreferences("userInfo", 0).edit();
            editor.clear();
            editor.commit();
            Prefs.clear();
            startActivity(new Intent(getApplicationContext(), Login.class));
            finish();
            return true;
        }
        if (id == R.id.action_mark_all_read) {
            Toast.makeText(getApplicationContext(), "All notifications marked as read!", Toast.LENGTH_LONG).show();
        }
        if (id == R.id.action_clear_notifications) {
            Toast.makeText(getApplicationContext(), "Clear all notifications!", Toast.LENGTH_LONG).show();
        }
        return super.onOptionsItemSelected(item);
    }

    public void onStop() {
        this.mDemoSlider.stopAutoCycle();
        super.onStop();
    }

    public void onSliderClick(BaseSliderView slider) {
        Toast.makeText(this, slider.getBundle().get("extra") + "", Toast.LENGTH_SHORT).show();
    }

    public void onPageScrolled(int position, float positionOffset, int positionOffsetPixels) {
    }

    public void onPageSelected(int position) {
        Log.d("Slider Demo", "Page Changed: " + position);
    }

    public void onPageScrollStateChanged(int state) {
    }
}
