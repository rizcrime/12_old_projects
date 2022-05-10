package com.simwaspihk.admin.bottomNavigation.page;

import android.graphics.drawable.Drawable;
import android.support.v4.app.Fragment;

public class NavigationPage {
    private Fragment fragment;
    private Drawable icon;
    private String title;

    public NavigationPage(String title, Drawable icon, Fragment fragment) {
        this.title = title;
        this.icon = icon;
        this.fragment = fragment;
    }

    public String getTitle() {
        return this.title;
    }

    public Drawable getIcon() {
        return this.icon;
    }

    public Fragment getFragment() {
        return this.fragment;
    }
}
