package com.example.esdm.UpdateBerita;

import android.support.v4.view.ViewPager;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.text.Html;
import android.text.Spannable;
import android.text.TextPaint;
import android.text.method.LinkMovementMethod;
import android.text.style.URLSpan;
import android.text.style.UnderlineSpan;
import android.util.Base64;
import android.view.View;

import android.widget.Button;
import android.widget.ProgressBar;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.Volley;
import com.example.esdm.R;
import com.example.esdm.UpdateBerita.Hot.CustomVolleyRequest;
import com.example.esdm.UpdateBerita.Hot.SliderUtils;
import com.example.esdm.UpdateBerita.Hot.ViewPagerAdapter;
import com.example.esdm.UpdateBerita.Negative.AdapterNegative;
import com.example.esdm.UpdateBerita.Negative.ModelNegative;
import com.example.esdm.UpdateBerita.Netral.AdapterNetral;
import com.example.esdm.UpdateBerita.Netral.ModelNetral;
import com.example.esdm.UpdateBerita.Positive.AdapterPositive;
import com.example.esdm.UpdateBerita.Positive.ModelPositive;

public class UpdateBeritaActivity extends AppCompatActivity
{

    private ViewPager viewPager;
    RequestQueue rq;
    private List<SliderUtils> sliderImg;
    private ViewPagerAdapter viewPagerAdapter;
    private TextView title;
    private Button negatif, positif, netral, go;
    List<String> s1 = new ArrayList<>();
    public static final List<String> s2 = new ArrayList<>();
    RecyclerView mRecyclerView1, mRecyclerView2, mRecyclerView3;
    AdapterPositive mExampleAdapter1;
    AdapterNegative mExampleAdapter2;
    AdapterNetral mExampleAdapter3;
    ArrayList<ModelPositive> mExampleList;
    private ArrayList<ModelNegative> mExampleList2;
    private ArrayList<ModelNetral> mExampleList3;
    private RequestQueue mRequestQueue;
    private ProgressBar MobileProgressBar;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_update_berita);

        MobileProgressBar = (ProgressBar)findViewById(R.id.progressBar);

        mRequestQueue = Volley.newRequestQueue(this);

        negatif = findViewById(R.id.negative);
        positif = findViewById(R.id.positive);
        netral = findViewById(R.id.netral);

        rq = CustomVolleyRequest.getInstance(this).getRequestQueue();
        sliderImg = new ArrayList<>();
        viewPager = findViewById(R.id.viewPager);
        title = findViewById(R.id.title);

        go = findViewById(R.id.goNews);
        go.setClickable(true);
        go.setMovementMethod (LinkMovementMethod.getInstance());

        mRecyclerView1 = findViewById(R.id.daftar_berita);
        mRecyclerView1.setHasFixedSize(true);
        mRecyclerView1.setLayoutManager(new LinearLayoutManager(this));

        mRecyclerView2 = findViewById(R.id.daftar_berita2);
        mRecyclerView2.setHasFixedSize(true);
        mRecyclerView2.setLayoutManager(new LinearLayoutManager(this));

        mRecyclerView3 = findViewById(R.id.daftar_berita3);
        mRecyclerView3.setHasFixedSize(true);
        mRecyclerView3.setLayoutManager(new LinearLayoutManager(this));

        mExampleList = new ArrayList<>();
        mExampleList2 = new ArrayList<>();
        mExampleList3 = new ArrayList<>();

        mExampleAdapter1 = new AdapterPositive(mExampleList);
        mRecyclerView1.setAdapter(mExampleAdapter1);

        mExampleAdapter2 = new AdapterNegative(mExampleList2);
        mRecyclerView2.setAdapter(mExampleAdapter2);

        mExampleAdapter3 = new AdapterNetral(mExampleList3);
        mRecyclerView3.setAdapter(mExampleAdapter2);

        sendRequest();

        viewPager.addOnPageChangeListener(new ViewPager.OnPageChangeListener() {

            @Override
            public void onPageScrolled(int position, float positionOffset, int positionOffsetPixels) {
                title.setText(s1.get(position));
                String content = "<a href=\""+s2.get(position)+"\">"+ "Selengkapnya&emsp" +"<a/>";
                Spannable s = (Spannable) Html.fromHtml(content);
                for (URLSpan u: s.getSpans(0, s.length(), URLSpan.class)) {
                    s.setSpan(new UnderlineSpan() {
                        public void updateDrawState(TextPaint tp) {
                            tp.setUnderlineText(false);
                        }
                    }, s.getSpanStart(u), s.getSpanEnd(u), 0);
                }
                go.setText(s);
//                go.setText(Html.fromHtml("<a href=\""+s2.get(position)+"\">"+ "Selengkapnya&emsp" +"<a/>"));
            }

            @Override
            public void onPageSelected(int position) {

            }

            @Override
            public void onPageScrollStateChanged(int state) {

            }

        });

        positif.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(mRecyclerView1.getVisibility() == View.VISIBLE)
                    mRecyclerView1.setVisibility(View.GONE);
                else
                    mRecyclerView1.setVisibility(View.VISIBLE);
                    mRecyclerView2.setVisibility(View.GONE);
                    mRecyclerView3.setVisibility(View.GONE);
            }
        });

        negatif.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(mRecyclerView2.getVisibility() == View.VISIBLE)
                    mRecyclerView2.setVisibility(View.GONE);
                else
                    mRecyclerView2.setVisibility(View.VISIBLE);
                    mRecyclerView1.setVisibility(View.GONE);
                    mRecyclerView3.setVisibility(View.GONE);
            }
        });

        netral.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(mRecyclerView3.getVisibility() == View.VISIBLE)
                    mRecyclerView3.setVisibility(View.GONE);
                else
                    mRecyclerView3.setVisibility(View.VISIBLE);
                    mRecyclerView1.setVisibility(View.GONE);
                    mRecyclerView2.setVisibility(View.GONE);
            }
        });

    }

    public void sendRequest(){
        final String url = "http://172.16.23.34/laporan-harian-esdm/api/Lap_berita";
        MobileProgressBar.setVisibility(View.VISIBLE);
        JsonObjectRequest request = new JsonObjectRequest(Request.Method.GET, url, null,
                new Response.Listener<JSONObject>() {
                    @Override
                    public void onResponse(JSONObject response) {
                        SliderUtils sliderUtils = new SliderUtils();
                        try {
                            JSONArray jsonArray = response.getJSONArray("lap_berita_hot_news");

                            for (int i = 0; i < jsonArray.length(); i++) {
                                JSONObject hit = jsonArray.getJSONObject(i);
                                sliderUtils.setSliderImageUrl(hit.getString("IMAGE"));
                                s1.add(hit.getString("BERITA"));
                                s2.add(hit.getString("URL"));
                                MobileProgressBar.setVisibility(View.GONE);
                                sliderImg.add(sliderUtils);
                            }

                        } catch (JSONException e) {
                            e.printStackTrace();
                        }
                        viewPagerAdapter = new ViewPagerAdapter(sliderImg, UpdateBeritaActivity.this);
                        viewPager.setAdapter(viewPagerAdapter);

                        try {
                            JSONArray jsonArray = response.getJSONArray("lap_berita_positif");

                            for (int i = 0; i < jsonArray.length(); i++) {
                                JSONObject hit = jsonArray.getJSONObject(i);

                                String gunungapi1 = hit.getString("BERITA");
                                String url = hit.getString("URL");

                                mExampleList.add(new ModelPositive(gunungapi1, url));
                            }

                        } catch (JSONException e) {
                            e.printStackTrace();
                        }
                        mExampleAdapter1 = new AdapterPositive(UpdateBeritaActivity.this, mExampleList);
                        mRecyclerView1.setAdapter(mExampleAdapter1);

                        try {
                            JSONArray jsonArray = response.getJSONArray("lap_berita_negatif");

                            for (int i = 0; i < jsonArray.length(); i++) {
                                JSONObject hit = jsonArray.getJSONObject(i);

                                String gunungapi2 = hit.getString("BERITA");
                                String url = hit.getString("URL");

                                mExampleList2.add(new ModelNegative(gunungapi2, url));
                            }

                        } catch (JSONException e) {
                            e.printStackTrace();
                        }
                        mExampleAdapter2 = new AdapterNegative(UpdateBeritaActivity.this, mExampleList2);
                        mRecyclerView2.setAdapter(mExampleAdapter2);

                        try {
                            JSONArray jsonArray = response.getJSONArray("lap_berita_netral");

                            for (int i = 0; i < jsonArray.length(); i++) {
                                JSONObject hit = jsonArray.getJSONObject(i);

                                String gunungapi3 = hit.getString("BERITA");
                                String url = hit.getString("URL");

                                mExampleList3.add(new ModelNetral(gunungapi3, url));
                            }

                        } catch (JSONException e) {
                            e.printStackTrace();
                        }
                        mExampleAdapter3 = new AdapterNetral(UpdateBeritaActivity.this, mExampleList3);
                        mRecyclerView3.setAdapter(mExampleAdapter3);

            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                MobileProgressBar.setVisibility(View.GONE);
                Toast.makeText(UpdateBeritaActivity.this, "Ambil data gagal, cek koneksi internet anda", Toast.LENGTH_SHORT).show();
                error.printStackTrace();
            }
        })
        {
            @Override
            public Map<String, String> getHeaders() throws AuthFailureError {
                Map<String, String> headers = new HashMap<>();
                String credentials = "admin2:1234";
                String auth = "Basic " + Base64.encodeToString(credentials.getBytes(), Base64.NO_WRAP);
                headers.put("Content-Type", "application/json");
                headers.put("Authorization", auth);
                return headers;
            }

        };

        mRequestQueue.add(request);

    }

}