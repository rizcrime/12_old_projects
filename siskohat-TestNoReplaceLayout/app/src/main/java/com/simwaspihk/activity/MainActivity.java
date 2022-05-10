package com.simwaspihk.activity;

import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.support.design.widget.FloatingActionButton;
import android.support.design.widget.NavigationView;
import android.support.design.widget.NavigationView.OnNavigationItemSelectedListener;
import android.support.design.widget.Snackbar;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentActivity;
import android.support.v4.app.FragmentTransaction;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBarDrawerToggle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;
import com.bumptech.glide.Glide;
import com.bumptech.glide.load.engine.DiskCacheStrategy;
import com.simwaspihk.R;
import com.simwaspihk.fragment.HomeFragment;
import com.simwaspihk.fragment.NDataFragment;
import com.simwaspihk.fragment.NewsFragment;
import com.simwaspihk.fragment.NotificationsFragment;
import com.simwaspihk.fragment.SettingsFragment;
import com.simwaspihk.other.CircleTransform;

public class MainActivity extends AppCompatActivity {
    private static final String TAG_HOME = "home";
    public static String CURRENT_TAG = TAG_HOME;
    private static final String TAG_MOVIES = "movies";
    private static final String TAG_NOTIFICATIONS = "notifications";
    private static final String TAG_PHOTOS = "photos";
    private static final String TAG_SETTINGS = "settings";
    public static int navItemIndex = 0;
    private static final String urlNavHeaderBg = "http://api.creatorbe.id/images/nav-menu-header-bg.jpg";
    private static final String urlProfileImg = "http://simwaspihk.com/api//assets/images/user_1496473001.png";
    private String[] activityTitles;
    private DrawerLayout drawer;
    private FloatingActionButton fab;
    private ImageView imgNavHeaderBg;
    private ImageView imgProfile;
    private Handler mHandler;
    private View navHeader;
    private NavigationView navigationView;
    private boolean shouldLoadHomeFragOnBackPress = true;
    private Toolbar toolbar;
    private TextView txtName;
    private TextView txtWebsite;

    /* Access modifiers changed, original: protected */
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView((int) R.layout.activity_main);
        this.toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(this.toolbar);
        this.mHandler = new Handler();
        this.drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        this.navigationView = (NavigationView) findViewById(R.id.nav_view);
        this.fab = (FloatingActionButton) findViewById(R.id.fab);
        this.navHeader = this.navigationView.getHeaderView(0);
        this.txtName = (TextView) this.navHeader.findViewById(R.id.name);
        this.txtWebsite = (TextView) this.navHeader.findViewById(R.id.website);
        this.imgNavHeaderBg = (ImageView) this.navHeader.findViewById(R.id.img_header_bg);
        this.imgProfile = (ImageView) this.navHeader.findViewById(R.id.img_profile);
        this.activityTitles = getResources().getStringArray(R.array.nav_item_activity_titles);
        this.fab.setOnClickListener(new OnClickListener() {
            public void onClick(View view) {
                Snackbar.make(view, (CharSequence) "Prototype App - We're still working on awesome work!", 0).setAction((CharSequence) "Action", null).show();
            }
        });
        loadNavHeader();
        setUpNavigationView();
        if (savedInstanceState == null) {
            navItemIndex = 0;
            CURRENT_TAG = TAG_HOME;
            loadHomeFragment();
        }
    }

    private void loadNavHeader() {
        this.txtName.setText("Heri");
        this.txtWebsite.setText("http://dev-gi.ga");
        Glide.with((FragmentActivity) this).load(urlNavHeaderBg).crossFade().diskCacheStrategy(DiskCacheStrategy.ALL).into(this.imgNavHeaderBg);
        Glide.with((FragmentActivity) this).load(urlProfileImg).crossFade().thumbnail(0.5f).bitmapTransform(new CircleTransform(this)).diskCacheStrategy(DiskCacheStrategy.ALL).into(this.imgProfile);
        this.navigationView.getMenu().getItem(3).setActionView(R.layout.menu_dot);
    }

    private void loadHomeFragment() {
        selectNavMenu();
        setToolbarTitle();
        if (getSupportFragmentManager().findFragmentByTag(CURRENT_TAG) != null) {
            this.drawer.closeDrawers();
            toggleFab();
            return;
        }
        Runnable mPendingRunnable = new Runnable() {
            public void run() {
                Fragment fragment = MainActivity.this.getHomeFragment();
                FragmentTransaction fragmentTransaction = MainActivity.this.getSupportFragmentManager().beginTransaction();
                fragmentTransaction.setCustomAnimations(R.anim.fade_in, R.anim.fade_out);
                fragmentTransaction.replace(R.id.frame, fragment, MainActivity.CURRENT_TAG);
                fragmentTransaction.commitAllowingStateLoss();
            }
        };
        if (mPendingRunnable != null) {
            this.mHandler.post(mPendingRunnable);
        }
        toggleFab();
        this.drawer.closeDrawers();
        invalidateOptionsMenu();
    }

    private Fragment getHomeFragment() {
        switch (navItemIndex) {
            case 0:
                return new HomeFragment();
            case 1:
                return new NewsFragment();
            case 2:
                return new NDataFragment();
            case 3:
                return new NotificationsFragment();
            case 4:
                return new SettingsFragment();
            default:
                return new HomeFragment();
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
                        MainActivity.navItemIndex = 0;
                        MainActivity.CURRENT_TAG = MainActivity.TAG_HOME;
                        break;
                    case R.id.nav_profile /*2131689985*/:
                        MainActivity.this.startActivity(new Intent(MainActivity.this, ProfileDataActivity.class));
                        break;
                    case R.id.nav_chat /*2131689986*/:
                        Toast.makeText(MainActivity.this, "Messenger Masih dalam Proses! :)", 0).show();
                        break;
                    case R.id.nav_sakit /*2131689987*/:
                        MainActivity.this.startActivity(new Intent(MainActivity.this, TbsakitActivity.class));
                        break;
                    case R.id.nav_wafat /*2131689988*/:
                        MainActivity.this.startActivity(new Intent(MainActivity.this, TbwafatActivity.class));
                        break;
                    case R.id.nav_privacy_policy /*2131689989*/:
                        MainActivity.this.drawer.closeDrawers();
                        break;
                    default:
                        MainActivity.navItemIndex = 0;
                        break;
                }
                if (menuItem.isChecked()) {
                    menuItem.setChecked(false);
                } else {
                    menuItem.setChecked(true);
                }
                menuItem.setChecked(true);
                MainActivity.this.loadHomeFragment();
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
            loadHomeFragment();
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
            Toast.makeText(getApplicationContext(), "Logout user!", 1).show();
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

    private void toggleFab() {
        if (navItemIndex == 0) {
            this.fab.show();
        } else {
            this.fab.hide();
        }
    }
}
