package com.example.esdm.Geologi.GeoTanah;

import android.content.Context;
import android.support.v7.widget.RecyclerView;
import android.text.Html;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import com.example.esdm.R;

import java.util.ArrayList;

public class Adapter3 extends RecyclerView.Adapter<Adapter3.ExampleViewHolder> {
    private Context mContext;
    private ArrayList<Model3> mExampleList3;

    public Adapter3(Context context, ArrayList<Model3> exampleList) {
        mContext = context;
        mExampleList3 = exampleList;
    }

    public Adapter3(ArrayList<Model3> mExampleList) {
        this.mExampleList3 = mExampleList;
    }

    @Override
    public ExampleViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View v = LayoutInflater.from(mContext).inflate(R.layout.isi3, parent, false);
        return new ExampleViewHolder(v);
    }

    @Override
    public void onBindViewHolder(ExampleViewHolder holder, int position) {
        Model3 currentItem = mExampleList3.get(position);

        String nTanggal = currentItem.getmTanggal3();
        String nKeterangan = currentItem.getmKeterangan3();
        String nDetail = currentItem.getmDetail3();

        holder.date.setText(Html.fromHtml("<b>"+"Tanggal :<br>"+"</b>" + nTanggal));
        holder.descript.setText(Html.fromHtml("<b>"+"Kondisi Geologi Terdekat :<br>"+"</b>" + nKeterangan));
        holder.detail.setText(Html.fromHtml("<b>"+"Rekomendasi :<br>"+"</b>" + nDetail));
    }

    public void updateList(ArrayList<Model3> list){
        mExampleList3 = list;
        notifyDataSetChanged();
    }

    @Override
    public int getItemCount() {
        return mExampleList3.size();
    }

    public class ExampleViewHolder extends RecyclerView.ViewHolder {

        public TextView date, descript, detail;

        public ExampleViewHolder(View itemView) {
            super(itemView);

            date = itemView.findViewById(R.id.tanggal);
            descript = itemView.findViewById(R.id.berita1);
            detail = itemView.findViewById(R.id.berita2);

        }
    }
}
