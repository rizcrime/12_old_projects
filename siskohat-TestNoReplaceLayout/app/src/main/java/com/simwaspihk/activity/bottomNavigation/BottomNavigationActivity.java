package com.simwaspihk.activity.bottomNavigation;

import android.os.Bundle;
import android.support.v4.content.ContextCompat;
import android.widget.Toast;
import com.simwaspihk.R;
import com.simwaspihk.activity.bottomNavigation.fragment.SecondFragment;
import com.simwaspihk.activity.bottomNavigation.fragment.ThirdFragment;
import com.simwaspihk.activity.bottomNavigation.page.BottomBarHolderActivity;
import com.simwaspihk.activity.bottomNavigation.page.NavigationPage;
import com.simwaspihk.fragment.DataFragmentNew;
import com.simwaspihk.fragment.DataFragmentNew.OnFragmentInteractionListener;
import com.simwaspihk.fragment.ProfileDataFragment;
import java.util.ArrayList;
import java.util.List;

public class BottomNavigationActivity extends BottomBarHolderActivity implements OnFragmentInteractionListener, SecondFragment.OnFragmentInteractionListener {
    /* Access modifiers changed, original: protected */
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        NavigationPage page1 = new NavigationPage("Home", ContextCompat.getDrawable(this, R.drawable.ic_home_black_24dp), DataFragmentNew.newInstance());
        NavigationPage page2 = new NavigationPage("Notifikasi", ContextCompat.getDrawable(this, R.drawable.ic_notifications_black_24dp), SecondFragment.newInstance());
        NavigationPage page3 = new NavigationPage("Chat", ContextCompat.getDrawable(this, R.drawable.ic_message_text_black_24dp), ThirdFragment.newInstance());
        NavigationPage page4 = new NavigationPage("Profile", ContextCompat.getDrawable(this, R.drawable.ic_account_circle_black_24dp), ProfileDataFragment.newInstance());
        List<NavigationPage> navigationPages = new ArrayList();
        navigationPages.add(page1);
        navigationPages.add(page2);
        navigationPages.add(page3);
        navigationPages.add(page4);
        super.setupBottomBarHolderActivity(navigationPages);
    }

    public void onClicked() {
        Toast.makeText(this, "Clicked!", 0).show();
    }
}
