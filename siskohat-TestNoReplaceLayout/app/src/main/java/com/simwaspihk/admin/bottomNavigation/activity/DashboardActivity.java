package com.simwaspihk.admin.bottomNavigation.activity;

import android.content.Intent;
import android.content.SharedPreferences;
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
import com.simwaspihk.activity.Login;
import com.simwaspihk.activity.ProfileDataActivity;
import com.simwaspihk.activity.TbsakitActivity;
import com.simwaspihk.activity.TbwafatActivity;
import com.simwaspihk.admin.adapter.AdminPagerAdapter;
import com.simwaspihk.admin.bottomNavigation.fragment.DashboardFragment;
import com.simwaspihk.admin.fragment.PieChartFrag;
import com.simwaspihk.fragment.NDataFragment;
import com.simwaspihk.fragment.NewsFragment;
import com.simwaspihk.fragment.NotificationsFragment;
import com.simwaspihk.fragment.SettingsFragment;
import com.simwaspihk.other.CircleTransform;
import java.util.HashMap;

public class DashboardActivity extends AppCompatActivity implements OnSliderClickListener, OnPageChangeListener {
    private static final String TAG_HOME = "home";
    public static String CURRENT_TAG = TAG_HOME;
    private static final String TAG_MOVIES = "movies";
    private static final String TAG_NOTIFICATIONS = "notifications";
    private static final String TAG_PHOTOS = "photos";
    private static final String TAG_SETTINGS = "settings";
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
        setContentView((int) R.layout.activity_admin_dashboard);
        this.toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(this.toolbar);
        this.mDemoSlider = (SliderLayout) findViewById(R.id.adminSlider);
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
        if (savedInstanceState == null) {
            navItemIndex = 0;
            CURRENT_TAG = TAG_HOME;
        }
        TabLayout tabLayout = (TabLayout) findViewById(R.id.tablayout);
        tabLayout.addTab(tabLayout.newTab().setText((CharSequence) "Graph 1"));
        tabLayout.addTab(tabLayout.newTab().setText((CharSequence) "Graph 2"));
        tabLayout.setTabGravity(0);
        final ViewPager viewPager = (ViewPager) findViewById(R.id.viewpager);
        viewPager.setAdapter(new AdminPagerAdapter(getSupportFragmentManager(), tabLayout.getTabCount()));
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
        SharedPreferences prefs = getSharedPreferences("userInfo", 0);
        String name = prefs.getString("name", null);
        String email = prefs.getString("email", null);
        this.txtName.setText(name);
        this.txtWebsite.setText(email);
        Glide.with((FragmentActivity) this).load(urlNavHeaderBg).crossFade().diskCacheStrategy(DiskCacheStrategy.ALL).into(this.imgNavHeaderBg);
        Glide.with((FragmentActivity) this).load(urlProfileImg).crossFade().thumbnail(0.5f).bitmapTransform(new CircleTransform(this)).diskCacheStrategy(DiskCacheStrategy.ALL).into(this.imgProfile);
        this.navigationView.getMenu().getItem(3).setActionView(R.layout.menu_dot);
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
                Fragment fragment = DashboardActivity.this.getDevHomeFragment();
                FragmentTransaction fragmentTransaction = DashboardActivity.this.getSupportFragmentManager().beginTransaction();
                fragmentTransaction.setCustomAnimations(17432576, 17432577);
                fragmentTransaction.replace(R.id.frame, fragment, DashboardActivity.CURRENT_TAG);
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
                return new PieChartFrag();
            case 1:
                return new NewsFragment();
            case 2:
                return new NDataFragment();
            case 3:
                return new NotificationsFragment();
            case 4:
                return new SettingsFragment();
            default:
                return new DashboardFragment();
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
                        DashboardActivity.navItemIndex = 0;
                        DashboardActivity.CURRENT_TAG = DashboardActivity.TAG_HOME;
                        break;
                    case R.id.nav_profile /*2131689985*/:
                        DashboardActivity.this.startActivity(new Intent(DashboardActivity.this, ProfileDataActivity.class));
                        break;
                    case R.id.nav_chat /*2131689986*/:
                        Toast.makeText(DashboardActivity.this, "Messenger Masih dalam Proses! :)", 0).show();
                        break;
                    case R.id.nav_sakit /*2131689987*/:
                        DashboardActivity.this.startActivity(new Intent(DashboardActivity.this, TbsakitActivity.class));
                        break;
                    case R.id.nav_wafat /*2131689988*/:
                        DashboardActivity.this.startActivity(new Intent(DashboardActivity.this, TbwafatActivity.class));
                        break;
                    case R.id.nav_privacy_policy /*2131689989*/:
                        DashboardActivity.this.drawer.closeDrawers();
                        break;
                    default:
                        DashboardActivity.navItemIndex = 0;
                        break;
                }
                if (menuItem.isChecked()) {
                    menuItem.setChecked(false);
                } else {
                    menuItem.setChecked(true);
                }
                menuItem.setChecked(true);
                DashboardActivity.this.loadDevHomeFragment();
                DashboardActivity.this.drawer.closeDrawers();
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
        if (navItemIndex == 0) {
            getMenuInflater().inflate(R.menu.main, menu);
        }
        if (navItemIndex == 3) {
            getMenuInflater().inflate(R.menu.notifications, menu);
        }
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
            Toast.makeText(getApplicationContext(), "All notifications marked as read!", 1).show();
        }
        if (id == R.id.action_clear_notifications) {
            Toast.makeText(getApplicationContext(), "Clear all notifications!", 1).show();
        }
        return super.onOptionsItemSelected(item);
    }

    public void onStop() {
        this.mDemoSlider.stopAutoCycle();
        super.onStop();
    }

    public void onSliderClick(BaseSliderView slider) {
        Toast.makeText(this, slider.getBundle().get("extra") + "", 0).show();
    }

    public void onPageScrolled(int position, float positionOffset, int positionOffsetPixels) {
    }

    public void onPageSelected(int position) {
        Log.d("Slider Demo", "Page Changed: " + position);
    }

    public void onPageScrollStateChanged(int state) {
    }
}
