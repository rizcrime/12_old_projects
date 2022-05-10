package com.example.lenovo.nakula_edu;

import android.content.Intent;
import android.os.Bundle;
import android.support.annotation.NonNull;
import android.support.design.widget.NavigationView;
import android.support.v4.view.GravityCompat;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBarDrawerToggle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.support.v7.widget.Toolbar;
import android.util.Log;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.RelativeLayout;
import android.widget.Spinner;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.Volley;
import com.example.lenovo.nakula_edu.PaketLogin.LoginActivity;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;


public class TagihanPembayaranActivity extends AppCompatActivity implements NavigationView.OnNavigationItemSelectedListener,
        AdapterView.OnItemSelectedListener {

    RecyclerView recyclerView;
    RecyclerView.Adapter mAdapter;
    RecyclerView.LayoutManager layoutManager;

    List<PersonUtils> personUtilsList;

    RequestQueue rq;

    String request_url = "https://nakula-edu.000webhostapp.com/nyoba.php";

    private DrawerLayout drawer;
    private RelativeLayout layout_search;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_tagihan_pembayaran);

        layout_search = (RelativeLayout) findViewById(R.id.search_form);

        //PROTOTYPE FOR RECYCLER VIEW BETA
        rq = Volley.newRequestQueue(this);

        recyclerView = (RecyclerView) findViewById(R.id.recycler);
        recyclerView.setHasFixedSize(true);

        layoutManager = new LinearLayoutManager(this);

        recyclerView.setLayoutManager(layoutManager);

        personUtilsList = new ArrayList<>();

        sendRequest();



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
                Intent logout = new Intent(TagihanPembayaranActivity.this, LoginActivity.class);
                startActivity(logout);
                Toast.makeText(this, "Anda berhasil Logout", Toast.LENGTH_SHORT).show();
                finish();
                break;
            case R.id.performa_siswa:
                Intent performa = new Intent(TagihanPembayaranActivity.this, PerformaSiswaActivity.class);
                startActivity(performa);
                finish();
                break;
            case R.id.tagihan:
                Intent tagihan = new Intent(TagihanPembayaranActivity.this, TagihanPembayaranActivity.class);
                startActivity(tagihan);
                finish();
                break;
            case R.id.presensi_siswa:
                Intent presensi = new Intent(TagihanPembayaranActivity.this, PresensiSiswaActivity.class);
                startActivity(presensi);
                finish();
                break;
            case R.id.feedback:
                Intent chat = new Intent(TagihanPembayaranActivity.this, SaranKomunikasiActivity.class);
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




    public void sendRequest(){

        JsonArrayRequest jsonArrayRequest = new JsonArrayRequest(Request.Method.GET, request_url, null, new Response.Listener<JSONArray>() {
            @Override
            public void onResponse(JSONArray response) {

                for(int i = 0; i < response.length(); i++){

                    PersonUtils personUtils = new PersonUtils();

                    try {
                        JSONObject jsonObject = response.getJSONObject(i);

                        personUtils.setBulan(jsonObject.getString("firstname"));
                        personUtils.setNominal(jsonObject.getString("lastname"));
                        personUtils.setStatus(jsonObject.getString("jobprofile"));

                    } catch (JSONException e) {
                        e.printStackTrace();
                    }

                    personUtilsList.add(personUtils);

                }

                mAdapter = new CustomRecyclerAdapter(TagihanPembayaranActivity.this, personUtilsList);

                recyclerView.setAdapter(mAdapter);

            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Log.e("Volley Error: ", error.getMessage());
            }
        });

        rq.add(jsonArrayRequest);

    }

}
