package com.example.esdm.HistoryGeologi.GeoBumi;

import android.content.Context;
import android.support.v7.widget.RecyclerView;
import android.text.Html;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import com.example.esdm.R;

import java.util.ArrayList;

public class Adapter2 extends RecyclerView.Adapter<Adapter2.ExampleViewHolder> {
    private Context mContext2;
    private ArrayList<Model2> mExampleList2;

    public Adapter2(Context context, ArrayList<Model2> exampleList) {
        mContext2 = context;
        mExampleList2 = exampleList;
    }

        public Adapter2(ArrayList<Model2> mExampleList) {
        this.mExampleList2 = mExampleList;
    }

    @Override
    public ExampleViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View v = LayoutInflater.from(mContext2).inflate(R.layout.isi6, parent, false);
        return new ExampleViewHolder(v);
    }

    @Override
    public void onBindViewHolder(ExampleViewHolder holder, int position) {
        Model2 currentItem = mExampleList2.get(position);

        String nTanggal = currentItem.getmTanggal2();
        String nLokasiGempa = currentItem.getmLokasiGempa2();
        String nInformasigempa = currentItem.getmInformasiGempa2();
        String nKondisigeologi2 = currentItem.getmKondisiGeologi2();
        String nPenyebabgempa2 = currentItem.getmPenyebabGempa2();
        String nDampakgempa2 = currentItem.getmDampakGempa2();
        String nRekomendasi2 = currentItem.getmRekomendasi2();

        holder.date.setText(Html.fromHtml("<b>"+"Tanggal :<br>"+"</b>" + nTanggal));
        holder.location.setText(Html.fromHtml("<b>"+"Lokasi Gempa Bumi :<br>"+"</b>" + nLokasiGempa));
        holder.information.setText(Html.fromHtml("<b>"+"Informasi Gempa Bumi:<br>"+"</b>" + nInformasigempa));
        holder.condition.setText(Html.fromHtml("<b>"+"Kondisi Geologi Terdekat :<br>"+"</b>" + nKondisigeologi2));
        holder.reason.setText(Html.fromHtml("<b>"+"Rekomendasi :<br>"+"</b>" + nPenyebabgempa2));
        holder.decision.setText(Html.fromHtml("<b>"+"Penyebab Gempa Bumi :<br>"+"</b>" + nDampakgempa2));
        holder.recomendation.setText(Html.fromHtml("<b>"+"Dampak Gempa Bumi :<br>"+"</b>" + nRekomendasi2));

    }

        public void updateList(ArrayList<Model2> list){
        mExampleList2 = list;
        notifyDataSetChanged();
    }

    @Override
    public int getItemCount() {
        return mExampleList2.size();
    }

    public class ExampleViewHolder extends RecyclerView.ViewHolder {

        public TextView date, location, information, condition, reason, decision, recomendation;

        public ExampleViewHolder(View itemView) {
            super(itemView);

            date = itemView.findViewById(R.id.tanggal);
            location = itemView.findViewById(R.id.berita1);
            information = itemView.findViewById(R.id.berita2);
            condition = itemView.findViewById(R.id.berita3);
            reason = itemView.findViewById(R.id.berita4);
            decision = itemView.findViewById(R.id.berita5);
            recomendation = itemView.findViewById(R.id.berita6);

        }
    }
}
