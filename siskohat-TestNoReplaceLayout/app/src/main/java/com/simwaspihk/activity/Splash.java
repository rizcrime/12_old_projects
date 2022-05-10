package com.simwaspihk.activity;

import android.content.Intent;
import android.os.Build.VERSION;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.animation.AnimationUtils;
import android.widget.ImageView;
import com.pixplicity.easyprefs.library.Prefs;
import com.simwaspihk.R;
import com.simwaspihk.admin.bottomNavigation.AdminNavigationActivity;

public class Splash extends AppCompatActivity {
    String check;

    /* Access modifiers changed, original: protected */
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView((int) R.layout.activity_splash);
        ((ImageView) findViewById(R.id.imageView)).startAnimation(AnimationUtils.loadAnimation(getApplicationContext(), R.anim.fade));
        new Thread() {
            public void run() {
                try {
                    this.sleep(3000);
                    Intent i;
                    if (Prefs.getString("user_type", "").equals("admin")) {
                        i = new Intent(Splash.this, AdminNavigationActivity.class);
                        i.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK);
                        i.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
                        Splash.this.startActivity(i);
                        Splash.this.overridePendingTransition(17432576, 17432577);
                        Splash.this.finish();
                        super.run();
                    } else if (Prefs.getString("user_type", "").equals("member")) {
                        i = new Intent(Splash.this, DevMainActivity.class);
                        i.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK);
                        i.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
                        Splash.this.startActivity(i);
                        Splash.this.overridePendingTransition(17432576, 17432577);
                        Splash.this.finish();
                        super.run();
                    } else {
                        Intent startMain = new Intent(Splash.this, Login.class);
                        startMain.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK);
                        startMain.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
                        Splash.this.startActivity(startMain);
                        Splash.this.overridePendingTransition(17432576, 17432577);
                        Splash.this.finish();
                        super.run();
                        if (VERSION.SDK_INT >= 16) {
                            Splash.this.finishAffinity();
                        }
                    }
                } catch (InterruptedException e) {
                    e.printStackTrace();
                }
            }
        }.start();
    }
}
