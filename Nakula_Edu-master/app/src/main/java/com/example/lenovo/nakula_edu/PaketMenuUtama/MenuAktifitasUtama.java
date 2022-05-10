package com.example.lenovo.nakula_edu.PaketMenuUtama;

import android.content.Intent;
import android.support.annotation.NonNull;
import android.support.design.widget.NavigationView;
import android.support.v4.view.GravityCompat;
import android.support.v4.view.ViewPager;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBarDrawerToggle;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.support.v7.widget.Toolbar;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.widget.ImageView;
import android.widget.RelativeLayout;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.bumptech.glide.Glide;
import com.bumptech.glide.request.RequestOptions;
import com.example.lenovo.nakula_edu.List_Data;
import com.example.lenovo.nakula_edu.MyAdapter;
import com.example.lenovo.nakula_edu.PaketLogin.LoginActivity;
import com.example.lenovo.nakula_edu.PaketLogin.SQLiteHandler;
import com.example.lenovo.nakula_edu.PaketLogin.SessionManager;
import com.example.lenovo.nakula_edu.PerformaSiswaActivity;
import com.example.lenovo.nakula_edu.PresensiSiswaActivity;
import com.example.lenovo.nakula_edu.R;
import com.example.lenovo.nakula_edu.SaranKomunikasiActivity;
import com.example.lenovo.nakula_edu.TagihanPembayaranActivity;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;

import de.hdodenhof.circleimageview.CircleImageView;


public class MenuAktifitasUtama extends AppCompatActivity implements NavigationView.OnNavigationItemSelectedListener  {

    ViewPager viewPager;
    // LinearLayout sliderDotspanel;
    // private int dotscount;
    private ImageView[] dots;
    private List<String> s1 = new ArrayList<>();
    TextView title, user_name;
    private static final String TAG = MenuAktifitasUtama.class.getName();
    private DrawerLayout drawer;
    private RelativeLayout layout_search;
    private SQLiteHandler db;
    private SessionManager session;
    CircleImageView foto;
    RequestQueue rq;
    List<SliderUtils> sliderImg;
    ViewPagerAdapter viewPagerAdapter;
    String request_url = "https://nakula-edu.000webhostapp.com/take_image.php";

    private static final String HI = "https://nakula-edu.000webhostapp.com/nyoba2.php";
    private RecyclerView rv;
    private List<List_Data>list_data;
    private MyAdapter adapter;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.menu_aktifitas_utama);

        rv=(RecyclerView)findViewById(R.id.recycler_anak_mau);
        rv.setHasFixedSize(true);
        rv.setLayoutManager(new LinearLayoutManager(this, LinearLayoutManager.HORIZONTAL, false));
        list_data=new ArrayList<>();
        adapter=new MyAdapter(list_data,this);

        getData();

        rq = CustomVolleyRequest.getInstance(this).getRequestQueue();
        sliderImg = new ArrayList<>();
        title = (TextView)findViewById(R.id.title);
        viewPager = (ViewPager) findViewById(R.id.viewPager);
        user_name = (TextView) findViewById(R.id.nama_user);
        layout_search = (RelativeLayout) findViewById(R.id.search_form);
        foto = (CircleImageView) findViewById(R.id.image_home_profile);

        db = new SQLiteHandler(getApplicationContext());
        // session manager
        session = new SessionManager(getApplicationContext());

        HashMap<String, String> user = db.getUserDetails();
        String name = user.get("name");
        String fotprof = user.get("foto_profil");
        user_name.setText(name);

        Glide.with(getBaseContext()).load(fotprof).apply(RequestOptions.circleCropTransform()).into(foto);

        if (!session.isLoggedIn()){logoutUser();} //fungsi pengingat logout


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

        // sliderDotspanel = (LinearLayout) findViewById(R.id.SliderDots);
        sendRequest();

        viewPager.addOnPageChangeListener(new ViewPager.OnPageChangeListener() {
            @Override
            public void onPageScrolled(int position, float positionOffset, int positionOffsetPixels) {

            }

            @Override
            public void onPageSelected(int position) {

                //for(int i = 0; i< dotscount; i++){
                //dots[i].setImageDrawable(ContextCompat.getDrawable(getApplicationContext(), R.drawable.bulet_merah));
                //}
                title.setText(s1.get(position));
                //dots[position].setImageDrawable(ContextCompat.getDrawable(getApplicationContext(), R.drawable.bulet_hijau));
            }

            @Override
            public void onPageScrollStateChanged(int state) {

            }
        });

    }

    //NAVIGATION DRAWER
    public boolean onNavigationItemSelected(@NonNull MenuItem item) {
        switch (item.getItemId()) {
            case R.id.logout:
                logoutUser();
                break;
            case R.id.performa_siswa:
                Intent performa = new Intent(MenuAktifitasUtama.this, PerformaSiswaActivity.class);
                startActivity(performa);
                break;
            case R.id.tagihan:
                Intent tagihan = new Intent(MenuAktifitasUtama.this, TagihanPembayaranActivity.class);
                startActivity(tagihan);
                break;
            case R.id.presensi_siswa:
                Intent presensi = new Intent(MenuAktifitasUtama.this, PresensiSiswaActivity.class);
                startActivity(presensi);
                break;
            case R.id.feedback:
                Intent chat = new Intent(MenuAktifitasUtama.this, SaranKomunikasiActivity.class);
                startActivity(chat);
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

    //MENU SEBELAH KANAN
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

    private void logoutUser() {
        session.setLogin(false);
        db.deleteUsers();
        // Launching the login activity
        Intent intent = new Intent(MenuAktifitasUtama.this, LoginActivity.class);
        startActivity(intent);
        Toast.makeText(this, "anda berhasil logout", Toast.LENGTH_SHORT).show();
        finish();
    }

    //MEMBUAT FUNGSI UNTUK IMAGE SLIDER DARI DATABASE
    public void sendRequest(){
        JsonArrayRequest jsonArrayRequest = new JsonArrayRequest(Request.Method.GET, request_url, null,
                new Response.Listener<JSONArray>() {
                    @Override
                    public void onResponse(JSONArray response) {
                        for(int i = 0; i < response.length(); i++){
                            SliderUtils sliderUtils = new SliderUtils();
                            try {
                                JSONObject jsonObject = response.getJSONObject(i);
                                sliderUtils.setSliderImageUrl(jsonObject.getString("image_url"));
                                s1.add(jsonObject.getString("title"));

                            } catch (JSONException e) {
                                e.printStackTrace();
                            }
                            sliderImg.add(sliderUtils);
                        }
                        viewPagerAdapter = new ViewPagerAdapter(sliderImg, MenuAktifitasUtama.this);
                        viewPager.setAdapter(viewPagerAdapter);
                        //dotscount = viewPagerAdapter.getCount();
                        //dots = new ImageView[dotscount];
                /*for(int i = 0; i < dotscount; i++){
                    dots[i] = new ImageView(MenuAktifitasUtama.this);
                    dots[i].setImageDrawable(ContextCompat.getDrawable(getApplicationContext(), R.drawable.bulet_merah));
                    LinearLayout.LayoutParams params = new LinearLayout.LayoutParams(LinearLayout.LayoutParams.WRAP_CONTENT, LinearLayout.LayoutParams.WRAP_CONTENT);
                    params.setMargins(8, 0, 8, 0);
                    sliderDotspanel.addView(dots[i], params);
                }

                dots[0].setImageDrawable(ContextCompat.getDrawable(getApplicationContext(), R.drawable.bulet_hijau));*/
                    }
                }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {

            }
        });

        CustomVolleyRequest.getInstance(this).addToRequestQueue(jsonArrayRequest);
    }



    private void getData() {
        StringRequest stringRequest=new StringRequest(Request.Method.GET, HI, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    JSONObject jsonObject=new JSONObject(response);
                    JSONArray  array=jsonObject.getJSONArray("data");
                    for (int i=0; i<array.length(); i++){
                        JSONObject ob=array.getJSONObject(i);
                        List_Data ld=new List_Data(ob.getString("firstname"),ob.getString("imageurl"));
                        list_data.add(ld);
                    }
                    rv.setAdapter(adapter);
                } catch (JSONException e) {
                    e.printStackTrace();
                }

            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {

            }
        });
        RequestQueue requestQueue= Volley.newRequestQueue(this);
        requestQueue.add(stringRequest);
    }

}