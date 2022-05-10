package com.simwaspihk.admin.bottomNavigation.page;

import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentTransaction;
import android.support.v7.app.AppCompatActivity;
import com.simwaspihk.R;
import com.simwaspihk.admin.bottomNavigation.page.AdminNavigationBar.BottomNavigationMenuClickListener;
import java.util.ArrayList;
import java.util.List;

public class AdminNavigationBarHolderActivity extends AppCompatActivity implements BottomNavigationMenuClickListener {
    private AdminNavigationBar mBottomNav;
    private List<NavigationPage> mNavigationPageList = new ArrayList();

    /* Access modifiers changed, original: protected */
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView((int) R.layout.activity_admin_navigation_bar_holder);
    }

    public void setupBottomBarHolderActivity(List<NavigationPage> pages) {
        if (pages.size() != 4) {
            throw new RuntimeException("List of NavigationPage must contain 4 members.");
        }
        this.mNavigationPageList = pages;
        this.mBottomNav = new AdminNavigationBar(this, pages, this);
        setupFragments();
    }

    private void setupFragments() {
        FragmentTransaction fragmentTransaction = getSupportFragmentManager().beginTransaction();
        fragmentTransaction.replace(R.id.adminFrameLayout, ((NavigationPage) this.mNavigationPageList.get(0)).getFragment());
        fragmentTransaction.commit();
    }

    public void onClickedOnBottomNavigationMenu(int menuType) {
        Fragment fragment = null;
        switch (menuType) {
            case 0:
                fragment = ((NavigationPage) this.mNavigationPageList.get(0)).getFragment();
                break;
            case 1:
                fragment = ((NavigationPage) this.mNavigationPageList.get(1)).getFragment();
                break;
            case 2:
                fragment = ((NavigationPage) this.mNavigationPageList.get(2)).getFragment();
                break;
            case 3:
                fragment = ((NavigationPage) this.mNavigationPageList.get(3)).getFragment();
                break;
        }
        if (fragment != null) {
            FragmentTransaction fragmentTransaction = getSupportFragmentManager().beginTransaction();
            fragmentTransaction.replace(R.id.adminFrameLayout, fragment);
            fragmentTransaction.commit();
        }
    }
}
