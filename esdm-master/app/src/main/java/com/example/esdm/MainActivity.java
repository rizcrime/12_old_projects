package com.example.esdm;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.CardView;
import android.view.View;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.example.esdm.Geologi.GeologiActivity;
import com.example.esdm.History.HistoryActivityMain;
import com.example.esdm.UpdateBerita.UpdateBeritaActivity;
import com.example.esdm.LoginPackage.LoginActivity;
import com.example.esdm.Pusdatin.PusdatinActivity;

public class MainActivity extends AppCompatActivity {

    CardView iPusdatin, iGeologi, iKlik, iHistory;
    ImageView logout;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main2);

        TextView txt = findViewById(R.id.text);
        txt.setSelected(true);

        iPusdatin = findViewById(R.id.pusdatin);
        iGeologi = findViewById(R.id.geologi);
        iKlik = findViewById(R.id.klik);
        iHistory = findViewById(R.id.history);
        logout = findViewById(R.id.logout);

        iPusdatin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent topusdatin = new Intent(MainActivity.this, PusdatinActivity.class);
                startActivity(topusdatin);
            }
        });

        iGeologi.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent togeologi = new Intent(MainActivity.this, GeologiActivity.class);
                startActivity(togeologi);
            }
        });

        iKlik.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent toklik = new Intent(MainActivity.this, UpdateBeritaActivity.class);
                startActivity(toklik);
            }
        });

        iHistory.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent tohistory = new Intent(MainActivity.this, HistoryActivityMain.class);
                startActivity(tohistory);
            }
        });

        logout.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Preferences.clearLoggedInUser(getBaseContext());
                Intent tohistory = new Intent(MainActivity.this, LoginActivity.class);
                startActivity(tohistory);
                Toast.makeText(MainActivity.this, "Anda berhasil logout", Toast.LENGTH_SHORT).show();
                finish();
            }
        });

    }

}
