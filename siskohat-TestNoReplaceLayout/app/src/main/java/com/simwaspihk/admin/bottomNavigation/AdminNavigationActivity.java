package com.simwaspihk.admin.bottomNavigation;

import android.content.DialogInterface;
import android.content.DialogInterface.OnClickListener;
import android.os.Bundle;
import android.support.v4.content.ContextCompat;
import android.support.v7.app.AlertDialog.Builder;
import android.widget.Toast;
import com.simwaspihk.R;
import com.simwaspihk.admin.bottomNavigation.fragment.DashboardFragment;
import com.simwaspihk.admin.bottomNavigation.fragment.DashboardFragment.OnFragmentInteractionListener;
import com.simwaspihk.admin.bottomNavigation.fragment.ThirdFragment;
import com.simwaspihk.admin.bottomNavigation.page.AdminNavigationBarHolderActivity;
import com.simwaspihk.admin.bottomNavigation.page.NavigationPage;
import com.simwaspihk.admin.fragment.AdminProfileFragment;
import com.simwaspihk.fragment.TravelFragment;
import java.util.ArrayList;
import java.util.List;

public class AdminNavigationActivity extends AdminNavigationBarHolderActivity implements OnFragmentInteractionListener, TravelFragment.OnFragmentInteractionListener {
    /* Access modifiers changed, original: protected */
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        NavigationPage page1 = new NavigationPage("Dashboard", ContextCompat.getDrawable(this, R.drawable.ic_dashboard_line_black), DashboardFragment.newInstance());
        NavigationPage page2 = new NavigationPage("Travel", ContextCompat.getDrawable(this, R.drawable.ic_travel_line_black), TravelFragment.newInstance());
        NavigationPage page3 = new NavigationPage("Evaluasi", ContextCompat.getDrawable(this, R.drawable.ic_evaluasi_line_black), ThirdFragment.newInstance());
        NavigationPage page4 = new NavigationPage("Profile", ContextCompat.getDrawable(this, R.drawable.ic_profile_line_black), AdminProfileFragment.newInstance());
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

    public void onBackPressed() {
        Builder alert = new Builder(this);
        alert.setTitle((CharSequence) "Anda yakin ingin menutup aplikasi?");
        alert.setPositiveButton((CharSequence) "Tutup", new OnClickListener() {
            public void onClick(DialogInterface dialog, int whichButton) {
                System.exit(0);
            }
        });
        alert.setNegativeButton((CharSequence) "Batal", new OnClickListener() {
            public void onClick(DialogInterface dialog, int whichButton) {
            }
        });
        alert.show();
    }
}
