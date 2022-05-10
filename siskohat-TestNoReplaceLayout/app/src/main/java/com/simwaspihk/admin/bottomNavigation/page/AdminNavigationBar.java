package com.simwaspihk.admin.bottomNavigation.page;

import android.content.Context;
import android.support.v4.content.ContextCompat;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.AppCompatImageView;
import android.support.v7.widget.AppCompatTextView;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.LinearLayout;
import com.simwaspihk.R;
import java.util.ArrayList;
import java.util.List;

public class AdminNavigationBar implements OnClickListener {
    public static final int MENU_BAR_1 = 0;
    public static final int MENU_BAR_2 = 1;
    public static final int MENU_BAR_3 = 2;
    public static final int MENU_BAR_4 = 3;
    private AppCompatActivity mActivity;
    private Context mContext;
    private AppCompatImageView mImageViewBar1;
    private AppCompatImageView mImageViewBar2;
    private AppCompatImageView mImageViewBar3;
    private AppCompatImageView mImageViewBar4;
    private LinearLayout mLLBar1;
    private LinearLayout mLLBar2;
    private LinearLayout mLLBar3;
    private LinearLayout mLLBar4;
    private BottomNavigationMenuClickListener mListener;
    private List<NavigationPage> mNavigationPageList = new ArrayList();
    private AppCompatTextView mTextViewBar1;
    private AppCompatTextView mTextViewBar2;
    private AppCompatTextView mTextViewBar3;
    private AppCompatTextView mTextViewBar4;
    private View mViewBar1;
    private View mViewBar2;
    private View mViewBar3;
    private View mViewBar4;

    public interface BottomNavigationMenuClickListener {
        void onClickedOnBottomNavigationMenu(int i);
    }

    public AdminNavigationBar(Context mContext, List<NavigationPage> pages, BottomNavigationMenuClickListener listener) {
        this.mContext = mContext;
        this.mActivity = (AppCompatActivity) mContext;
        this.mListener = listener;
        this.mNavigationPageList = pages;
        this.mLLBar1 = (LinearLayout) this.mActivity.findViewById(R.id.linearLayoutBar1);
        this.mLLBar2 = (LinearLayout) this.mActivity.findViewById(R.id.linearLayoutBar2);
        this.mLLBar3 = (LinearLayout) this.mActivity.findViewById(R.id.linearLayoutBar3);
        this.mLLBar4 = (LinearLayout) this.mActivity.findViewById(R.id.linearLayoutBar4);
        this.mImageViewBar1 = (AppCompatImageView) this.mActivity.findViewById(R.id.imageViewBar1);
        this.mImageViewBar2 = (AppCompatImageView) this.mActivity.findViewById(R.id.imageViewBar2);
        this.mImageViewBar3 = (AppCompatImageView) this.mActivity.findViewById(R.id.imageViewBar3);
        this.mImageViewBar4 = (AppCompatImageView) this.mActivity.findViewById(R.id.imageViewBar4);
        this.mImageViewBar1.setImageDrawable(((NavigationPage) this.mNavigationPageList.get(0)).getIcon());
        this.mImageViewBar2.setImageDrawable(((NavigationPage) this.mNavigationPageList.get(1)).getIcon());
        this.mImageViewBar3.setImageDrawable(((NavigationPage) this.mNavigationPageList.get(2)).getIcon());
        this.mImageViewBar4.setImageDrawable(((NavigationPage) this.mNavigationPageList.get(3)).getIcon());
        this.mTextViewBar1 = (AppCompatTextView) this.mActivity.findViewById(R.id.textViewBar1);
        this.mTextViewBar2 = (AppCompatTextView) this.mActivity.findViewById(R.id.textViewBar2);
        this.mTextViewBar3 = (AppCompatTextView) this.mActivity.findViewById(R.id.textViewBar3);
        this.mTextViewBar4 = (AppCompatTextView) this.mActivity.findViewById(R.id.textViewBar4);
        this.mTextViewBar1.setText(((NavigationPage) this.mNavigationPageList.get(0)).getTitle());
        this.mTextViewBar2.setText(((NavigationPage) this.mNavigationPageList.get(1)).getTitle());
        this.mTextViewBar3.setText(((NavigationPage) this.mNavigationPageList.get(2)).getTitle());
        this.mTextViewBar4.setText(((NavigationPage) this.mNavigationPageList.get(3)).getTitle());
        this.mLLBar1.setOnClickListener(this);
        this.mLLBar2.setOnClickListener(this);
        this.mLLBar3.setOnClickListener(this);
        this.mLLBar4.setOnClickListener(this);
    }

    public void onClick(View view) {
        setView(view);
        if (view.getId() == R.id.linearLayoutBar1) {
            this.mListener.onClickedOnBottomNavigationMenu(0);
        } else if (view.getId() == R.id.linearLayoutBar2) {
            this.mListener.onClickedOnBottomNavigationMenu(1);
        } else if (view.getId() == R.id.linearLayoutBar3) {
            this.mListener.onClickedOnBottomNavigationMenu(2);
        } else if (view.getId() == R.id.linearLayoutBar4) {
            this.mListener.onClickedOnBottomNavigationMenu(3);
        }
    }

    private void setView(View view) {
        this.mImageViewBar1.setImageDrawable(ContextCompat.getDrawable(this.mContext, R.drawable.ic_dashboard_line_black));
        this.mImageViewBar2.setImageDrawable(ContextCompat.getDrawable(this.mContext, R.drawable.ic_travel_line_black));
        this.mImageViewBar3.setImageDrawable(ContextCompat.getDrawable(this.mContext, R.drawable.ic_evaluasi_line_black));
        this.mImageViewBar4.setImageDrawable(ContextCompat.getDrawable(this.mContext, R.drawable.ic_profile_line_black));
        this.mImageViewBar1.setColorFilter(ContextCompat.getColor(this.mContext, R.color.colorNavAccentUnselected));
        this.mImageViewBar2.setColorFilter(ContextCompat.getColor(this.mContext, R.color.colorNavAccentUnselected));
        this.mImageViewBar3.setColorFilter(ContextCompat.getColor(this.mContext, R.color.colorNavAccentUnselected));
        this.mImageViewBar4.setColorFilter(ContextCompat.getColor(this.mContext, R.color.colorNavAccentUnselected));
        this.mTextViewBar1.setTextColor(ContextCompat.getColor(this.mContext, R.color.colorNavAccentUnselected));
        this.mTextViewBar2.setTextColor(ContextCompat.getColor(this.mContext, R.color.colorNavAccentUnselected));
        this.mTextViewBar3.setTextColor(ContextCompat.getColor(this.mContext, R.color.colorNavAccentUnselected));
        this.mTextViewBar4.setTextColor(ContextCompat.getColor(this.mContext, R.color.colorNavAccentUnselected));
        if (view.getId() == R.id.linearLayoutBar1) {
            this.mImageViewBar1.setImageDrawable(ContextCompat.getDrawable(this.mContext, R.drawable.ic_dashboard_filled_black));
            this.mImageViewBar1.setColorFilter(ContextCompat.getColor(this.mContext, R.color.colorTblPrimaryDark));
            this.mTextViewBar1.setTextColor(ContextCompat.getColor(this.mContext, R.color.colorTblPrimaryDark));
        } else if (view.getId() == R.id.linearLayoutBar2) {
            this.mImageViewBar2.setImageDrawable(ContextCompat.getDrawable(this.mContext, R.drawable.ic_travel_filled_black));
            this.mImageViewBar2.setColorFilter(ContextCompat.getColor(this.mContext, R.color.colorTblPrimaryDark));
            this.mTextViewBar2.setTextColor(ContextCompat.getColor(this.mContext, R.color.colorTblPrimaryDark));
        } else if (view.getId() == R.id.linearLayoutBar3) {
            this.mImageViewBar3.setImageDrawable(ContextCompat.getDrawable(this.mContext, R.drawable.ic_evaluasi_filled_black));
            this.mImageViewBar3.setColorFilter(ContextCompat.getColor(this.mContext, R.color.colorTblPrimaryDark));
            this.mTextViewBar3.setTextColor(ContextCompat.getColor(this.mContext, R.color.colorTblPrimaryDark));
        } else if (view.getId() == R.id.linearLayoutBar4) {
            this.mImageViewBar4.setImageDrawable(ContextCompat.getDrawable(this.mContext, R.drawable.ic_profile_filled_black));
            this.mImageViewBar4.setColorFilter(ContextCompat.getColor(this.mContext, R.color.colorTblPrimaryDark));
            this.mTextViewBar4.setTextColor(ContextCompat.getColor(this.mContext, R.color.colorTblPrimaryDark));
        }
    }
}
