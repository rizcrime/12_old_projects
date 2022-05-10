package com.kemenag.sipatuh;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.CardView;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.widget.Toast;

import com.kemenag.sipatuh.BerangkatTanahAir.BerangkatTanahAirActivity;
import com.kemenag.sipatuh.HotelTransitMakkah.HotelMakkahActivity;
import com.kemenag.sipatuh.Kasus.KasusActivity;
import com.kemenag.sipatuh.KedatanganArafah.KedatanganArafahActivity;
import com.kemenag.sipatuh.KedatanganJeddah.KedatanganJeddahActivity;
import com.kemenag.sipatuh.KedatanganMadinah.KedatanganMadinahActivity;
import com.kemenag.sipatuh.KedatanganMakkah.KedatanganMakkahActivity;
import com.kemenag.sipatuh.KedatanganMina.KedatanganMinaActivity;
import com.kemenag.sipatuh.KedatanganTanahAir.DatangTanahAirActivity;
import com.kemenag.sipatuh.KedatanganTarwiyah.KedatanganTarwiyah;
import com.kemenag.sipatuh.KepulanganArrab.KepulanganArrabActivity;
import com.kemenag.sipatuh.LoginPackage.LoginActivity;
import com.kemenag.sipatuh.LoginPackage.Preferences;

public class MainActivity extends AppCompatActivity {

    CardView berangkat_tanah_air, kedatangan_madinah, kedatangan_jeddah, kedatangan_makkah,
                kepulangan_arab, kedatangan_tanah_air, kedatangan_mina, kepulangan_arafah, kasus,
            kedatangan_tarwiyah, hotel_transit_makkah;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        berangkat_tanah_air = (CardView)findViewById(R.id.berangkat_tanah_air);
        kedatangan_madinah = (CardView)findViewById(R.id.kedatangan_madinah);
        kedatangan_jeddah = (CardView)findViewById(R.id.kedatangan_jeddah);
        kedatangan_makkah = (CardView)findViewById(R.id.kedatangan_makkah);
        kepulangan_arab = (CardView)findViewById(R.id.kepulangan_arab);
        kedatangan_tanah_air = (CardView)findViewById(R.id.kedatangan_tanah_air);
        kasus = (CardView)findViewById(R.id.kasus);
        kedatangan_mina = (CardView)findViewById(R.id.kedatanga_mina);
        kepulangan_arafah = (CardView)findViewById(R.id.kepulangan_arafah);
        kedatangan_tarwiyah = findViewById(R.id.kedatangan_tarwiyah);
        hotel_transit_makkah = findViewById(R.id.hotel_transit_makkah);

        berangkat_tanah_air.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent siji = new Intent(MainActivity.this, BerangkatTanahAirActivity.class);
                startActivity(siji);
            }
        });

        kedatangan_madinah.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent loro = new Intent(MainActivity.this, KedatanganMadinahActivity.class);
                startActivity(loro);
            }
        });

        kedatangan_jeddah.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent telu = new Intent(MainActivity.this, KedatanganJeddahActivity.class);
                startActivity(telu);
            }
        });

        kedatangan_makkah.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent papat = new Intent(MainActivity.this, KedatanganMakkahActivity.class);
                startActivity(papat);
            }
        });

        kepulangan_arab.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent limo = new Intent(MainActivity.this, KepulanganArrabActivity.class);
                startActivity(limo);
            }
        });

        kedatangan_tanah_air.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent pitu = new Intent(MainActivity.this, DatangTanahAirActivity.class);
                startActivity(pitu);
            }
        });

        kedatangan_mina.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent tuju = new Intent(MainActivity.this, KedatanganMinaActivity.class);
                startActivity(tuju);
            }
        });

        kepulangan_arafah.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent wolu = new Intent(MainActivity.this, KedatanganArafahActivity.class);
                startActivity(wolu);
            }
        });

        kasus.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent songo = new Intent(MainActivity.this, KasusActivity.class);
                startActivity(songo);
            }
        });

        kedatangan_tarwiyah.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent songo = new Intent(MainActivity.this, KedatanganTarwiyah.class);
                startActivity(songo);
            }
        });

        hotel_transit_makkah.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent songo = new Intent(MainActivity.this, HotelMakkahActivity.class);
                startActivity(songo);
            }
        });

    }

    //MEMBUAT MENU LOGOUT
    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        MenuInflater inflater = getMenuInflater();
        inflater.inflate(R.menu.menu_main_act, menu);
        return true;
    }
    public boolean onOptionsItemSelected(MenuItem item) {
        if (item.getItemId()==R.id.logout){
            Preferences.clearLoggedInUser(getBaseContext());
            startActivity(new Intent(this, LoginActivity.class));
            Toast.makeText(this, "Anda Berhasil Logout", Toast.LENGTH_SHORT).show();
            finish();
        }
        return true;
    }
}
