package com.example.lenovo.nakula_edu;

import android.content.Intent;
import android.os.Bundle;
import android.support.annotation.NonNull;
import android.support.design.widget.NavigationView;
import android.support.v4.view.GravityCompat;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBarDrawerToggle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.CalendarView;
import android.widget.RelativeLayout;
import android.widget.Spinner;
import android.widget.Toast;

import com.example.lenovo.nakula_edu.PaketLogin.LoginActivity;

public class PresensiSiswaActivity extends AppCompatActivity implements NavigationView.OnNavigationItemSelectedListener,
        AdapterView.OnItemSelectedListener {

    private DrawerLayout drawer;
    CalendarView calendarView;
    private RelativeLayout layout_search;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_presensi_siswa);

        layout_search = (RelativeLayout) findViewById(R.id.search_form);

        //CALENDAR VIEW BETA VERSION
        calendarView = (CalendarView)findViewById(R.id.calendar);
        calendarView.setOnDateChangeListener(new CalendarView.OnDateChangeListener() {
            @Override
            public void onSelectedDayChange(@NonNull CalendarView view, int year, int month, int dayOfMonth) {
                String date = dayOfMonth + "/" + (month+1) + "/" + year;
                Toast.makeText(PresensiSiswaActivity.this, date, Toast.LENGTH_SHORT).show();
            }
        });

        //NAVIGATION DRAWER
        NavigationView navigationView = findViewById(R.id.nav_view);
        navigationView.setNavigationItemSelectedListener(this);

        Toolbar toolbar = findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
        drawer = findViewById(R.id.drawer_layout);
        ActionBarDrawerToggle toggle = new ActionBarDrawerToggle(this, drawer, toolbar,
                R.string.navigation_drawer_open, R.string.navigation_drawer_close);
        drawer.addDrawerListener(toggle);
        navigationView.setBackgroundColor(getResources().getColor(R.color.putih));
        toggle.syncState();

        //SPINNER
        Spinner spinner = findViewById(R.id.spinner1);
        ArrayAdapter<CharSequence> adapter = ArrayAdapter.createFromResource(this,
                R.array.numbers, R.layout.spinner_item_showing);
        adapter.setDropDownViewResource(R.layout.spinner_item_drop);
        spinner.setAdapter(adapter);
        spinner.setOnItemSelectedListener(this);
        //SPINNER2
        Spinner spinner2 = findViewById(R.id.spinner2);
        ArrayAdapter<CharSequence> adapter2 = ArrayAdapter.createFromResource(this,
                R.array.semester, R.layout.spinner_item_showing);
        adapter2.setDropDownViewResource(R.layout.spinner_item_drop);
        spinner2.setAdapter(adapter2);
        spinner2.setOnItemSelectedListener(this);
    }



    //NAVIGATION DRAWER
    public boolean onNavigationItemSelected(@NonNull MenuItem item) {
        switch (item.getItemId()) {
            case R.id.logout:
                Intent logout = new Intent(PresensiSiswaActivity.this, LoginActivity.class);
                startActivity(logout);
                Toast.makeText(this, "anda berhasil logout", Toast.LENGTH_SHORT).show();
                finish();
                break;
            case R.id.performa_siswa:
                Intent performa = new Intent(PresensiSiswaActivity.this, PerformaSiswaActivity.class);
                startActivity(performa);
                finish();
                break;
            case R.id.tagihan:
                Intent tagihan = new Intent(PresensiSiswaActivity.this, TagihanPembayaranActivity.class);
                startActivity(tagihan);
                finish();
                break;
            case R.id.presensi_siswa:
                Intent presensi = new Intent(PresensiSiswaActivity.this, PresensiSiswaActivity.class);
                startActivity(presensi);
                finish();
                break;
            case R.id.feedback:
                Intent chat = new Intent(PresensiSiswaActivity.this, SaranKomunikasiActivity.class);
                startActivity(chat);
                finish();
                break;
            case R.id.agenda_sekolah:
                Toast.makeText(this, "COMING SOON BUDDY", Toast.LENGTH_SHORT).show();
                break;
            case R.id.tracking:
                Toast.makeText(this, "COMING SOON BUDDY", Toast.LENGTH_SHORT).show();
                break;
            case R.id.pengaturan:
                Toast.makeText(this, "COMING SOON BUDDY", Toast.LENGTH_SHORT).show();
                break;
        }

        drawer.closeDrawer(GravityCompat.START);
        return true;
    }

    @Override
    public void onBackPressed() {
        if (drawer.isDrawerOpen(GravityCompat.START)) {
            drawer.closeDrawer(GravityCompat.START);
        } else {
            super.onBackPressed();
        }
    }
    //MENU
    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        MenuInflater inflater = getMenuInflater();
        inflater.inflate(R.menu.drawer_menu2, menu); //your file name
        return super.onCreateOptionsMenu(menu);
    }
    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        switch(item.getItemId()) {
            case R.id.search:
                if(layout_search.getVisibility() == View.VISIBLE)
                    layout_search.setVisibility(View.GONE);
                else
                    layout_search.setVisibility(View.VISIBLE);
            default:
                return super.onOptionsItemSelected(item);
        }
    }

    //SPINNER
    @Override
    public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {
        String text = parent.getItemAtPosition(position).toString();
        Toast.makeText(parent.getContext(), text, Toast.LENGTH_SHORT).show();
    }

    @Override
    public void onNothingSelected(AdapterView<?> parent) {

    }
}

