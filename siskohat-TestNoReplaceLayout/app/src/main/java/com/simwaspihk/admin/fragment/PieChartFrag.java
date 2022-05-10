package com.simwaspihk.admin.fragment;

import android.graphics.Typeface;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.text.SpannableString;
import android.text.style.ForegroundColorSpan;
import android.text.style.RelativeSizeSpan;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import com.android.volley.Response.ErrorListener;
import com.android.volley.Response.Listener;
import com.android.volley.RetryPolicy;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.github.mikephil.charting.charts.PieChart;
import com.github.mikephil.charting.components.Legend;
import com.github.mikephil.charting.components.Legend.LegendForm;
//import com.github.mikephil.charting.components.Legend.LegendPosition;
import com.github.mikephil.charting.data.BarEntry;
import com.github.mikephil.charting.data.Entry;
import com.github.mikephil.charting.data.PieData;
import com.github.mikephil.charting.data.PieDataSet;
import com.github.mikephil.charting.interfaces.datasets.IPieDataSet;
import com.github.mikephil.charting.utils.ColorTemplate;
import com.simwaspihk.R;
import com.simwaspihk.data.remote.api.ApiServices;
import com.simwaspihk.other.AppController;
import java.util.ArrayList;
import org.json.JSONArray;
import org.json.JSONObject;

public class PieChartFrag extends Fragment {
    public String TAG = "Pie Chart Fragment";
    ApiServices apiServices;
    private PieChart mChart;
    ArrayList<Entry> x;
    ArrayList<String> y;

    public static Fragment newInstance() {
        return new PieChartFrag();
    }

    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        View v = inflater.inflate(R.layout.fragment_simple_pie, container, false);
        this.mChart = (PieChart) v.findViewById(R.id.pieChart1);
        Typeface tf = Typeface.createFromAsset(getActivity().getAssets(), "OpenSans-Light.ttf");
        this.mChart.setCenterTextTypeface(tf);
        this.mChart.setCenterText(generateCenterText());
        this.mChart.setCenterTextSize(10.0f);
        this.mChart.setCenterTextTypeface(tf);
        this.mChart.setHoleRadius(45.0f);
        this.mChart.setTransparentCircleRadius(50.0f);
        Legend l = this.mChart.getLegend();
        l.setFormSize(10.0f);
        l.setForm(LegendForm.CIRCLE);
//        l.setPosition(LegendPosition.ABOVE_CHART_CENTER);
        l.setXEntrySpace(10.0f);
        l.setYEntrySpace(10.0f);
        this.x = new ArrayList();
        this.y = new ArrayList();
//        this.mChart.setDescription("Jumlah Posisi");
        this.mChart.animateY(2000);
        drawChart();
        return v;
    }

    private void drawChart() {
        StringRequest strReq = new StringRequest(1, "http://simwaspihk.com/api/posisi", new Listener<String>() {
            public void onResponse(String response) {
                Log.d(PieChartFrag.this.TAG, "ResponseUpdateSaran: " + response);
                String jsonResponse = "";
                try {
                    JSONArray jsonArray = new JSONArray(response);
                    for (int i = 0; i < jsonArray.length(); i++) {
                        JSONObject aso = (JSONObject) jsonArray.get(i);
                        PieChartFrag.this.x.add(new BarEntry((float) aso.getInt("embarkasi_jumlah"), i));
                        PieChartFrag.this.y.add("Indonesia");
                        PieChartFrag.this.x.add(new BarEntry((float) aso.getInt("makkah_jumlah"), i));
                        PieChartFrag.this.y.add("Mekkah");
                        PieChartFrag.this.x.add(new BarEntry((float) aso.getInt("madinah_jumlah"), i));
                        PieChartFrag.this.y.add("Madinah");
                    }
//                    IPieDataSet bardataset = new PieDataSet(this.x, "");

//                    ((PieDataSet) bardataset).setColors(ColorTemplate.VORDIPLOM_COLORS);
//                    bardataset.setValueTextColor(-7829368);
////                    bardataset.setSliceSpace(5.0f);
//                    bardataset.setValueTextSize(7.0f);
//                    PieChartFrag.this.mChart.setData(new PieData(this.y, bardataset));
                    PieChartFrag.this.mChart.invalidate();
                } catch (Exception e) {
                    e.printStackTrace();
                }
            }
        }, new ErrorListener() {
            public void onErrorResponse(VolleyError error) {
                Log.e(PieChartFrag.this.TAG, "Error: " + error.getMessage());
            }
        });
        strReq.setRetryPolicy(new RetryPolicy() {
            public void retry(VolleyError arg0) throws VolleyError {
            }

            public int getCurrentTimeout() {
                return 0;
            }

            public int getCurrentRetryCount() {
                return 0;
            }
        });
        strReq.setShouldCache(false);
//        AppController.getInstance().addToRequestQueue(strReq, "req_chart");
    }

    private SpannableString generateCenterText() {
        SpannableString s = new SpannableString("Posisi \n jamaah");
        s.setSpan(new RelativeSizeSpan(2.0f), 0, 8, 0);
        s.setSpan(new ForegroundColorSpan(-7829368), 8, s.length(), 0);
        return s;
    }
}
