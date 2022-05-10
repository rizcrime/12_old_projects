package com.simwaspihk.admin.fragment;

import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import com.android.volley.Response.ErrorListener;
import com.android.volley.Response.Listener;
import com.android.volley.RetryPolicy;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.github.mikephil.charting.charts.BarChart;
import com.github.mikephil.charting.components.Description;
import com.github.mikephil.charting.data.BarData;
import com.github.mikephil.charting.data.BarDataSet;
import com.github.mikephil.charting.data.BarEntry;
import com.github.mikephil.charting.interfaces.datasets.IBarDataSet;
import com.github.mikephil.charting.utils.ColorTemplate;
import com.simwaspihk.R;
import com.simwaspihk.data.remote.api.ApiServices;
import com.simwaspihk.other.AppController;
import java.util.ArrayList;
import org.json.JSONArray;
import org.json.JSONObject;

public class BarChartFrag extends Fragment {
    public String TAG = "Chart Fragment";
    ApiServices apiServices;
    private BarChart mChart;
    ArrayList<BarEntry> x;
    ArrayList<String> y;

    public static Fragment newInstance() {
        return new BarChartFrag();
    }

    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        View v = inflater.inflate(R.layout.fragment_simple_bar, container, false);
        this.x = new ArrayList();
        this.y = new ArrayList();
        this.mChart = (BarChart) v.findViewById(R.id.barChart);
        this.mChart.setDrawGridBackground(false);
        Description description = new Description();
        description.setText("Jumlah PIHK berdasarkan Asosiasi");
        this.mChart.setDescription(description);
        this.mChart.animateY(2000);
        this.mChart.setTouchEnabled(true);
        this.mChart.setDragEnabled(true);
        this.mChart.setScaleEnabled(true);
        this.mChart.setPinchZoom(true);
        drawChart();
        return v;
    }

    private void drawChart() {
        StringRequest strReq = new StringRequest(1, "http://simwaspihk.com/api/asosiasi", new Listener<String>() {
            public void onResponse(String response) {
                Log.d(BarChartFrag.this.TAG, "ResponseUpdateSaran: " + response);
                String jsonResponse = "";
                try {
                    JSONArray jsonArray = new JSONArray(response);
                    for (int i = 0; i < jsonArray.length(); i++) {
                        JSONObject aso = (JSONObject) jsonArray.get(i);
                        int value = aso.getInt("jumlah_jamaah");
                        String date = aso.getString("asosiasi");
                        BarChartFrag.this.x.add(new BarEntry((float) value, i));
                        BarChartFrag.this.y.add(date);
                    }
                    IBarDataSet bardataset = new BarDataSet(BarChartFrag.this.x, "Asosiasi");
//                    bardataset.setColors(ColorTemplate.VORDIPLOM_COLORS);
                    ((BarDataSet) bardataset).setColors(ColorTemplate.VORDIPLOM_COLORS);
//                    BarChartFrag.this.mChart.setData(new BarData(BarChartFrag.this.y, bardataset));
                    BarChartFrag.this.mChart.setData(new BarData());
                    BarChartFrag.this.mChart.invalidate();
                } catch (Exception e) {
                    e.printStackTrace();
                }
            }
        }, new ErrorListener() {
            public void onErrorResponse(VolleyError error) {
                Log.e(BarChartFrag.this.TAG, "Error: " + error.getMessage());
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
}
