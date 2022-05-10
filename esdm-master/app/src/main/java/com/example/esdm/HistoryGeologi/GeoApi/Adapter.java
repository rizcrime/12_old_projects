package com.example.esdm.HistoryGeologi.GeoApi;

import android.content.Context;
import android.support.v7.widget.RecyclerView;
import android.text.Html;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import com.example.esdm.R;

import java.util.ArrayList;

public class Adapter extends RecyclerView.Adapter<Adapter.ExampleViewHolder> {
    private Context mContext;
    private ArrayList<Model> mExampleList;

    public Adapter(Context context, ArrayList<Model> exampleList) {
        mContext = context;
        mExampleList = exampleList;
    }

    public Adapter(ArrayList<Model> mExampleList) {
        this.mExampleList = mExampleList;
    }

    @Override
    public ExampleViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View v = LayoutInflater.from(mContext).inflate(R.layout.isi6, parent, false);
        return new ExampleViewHolder(v);
    }

    @Override
    public void onBindViewHolder(ExampleViewHolder holder, int position) {
        Model currentItem = mExampleList.get(position);

        String nTanggal = currentItem.getmTanggal1();
        String nGunungApi = currentItem.getmGunungApi1();
        String nTingkatAktifitas = currentItem.getmTingkatAktifitas1();
        String nKeterangan = currentItem.getmKeterangan1();
        String nRekomendasi = currentItem.getmRekomendasi1();
        String nVona = currentItem.getmVona1();
        String nDetail = currentItem.getmDetail1();

        holder.date.setText(Html.fromHtml("<b>"+"Tanggal :<br>"+"</b>" + nTanggal));
        holder.firemountain.setText(Html.fromHtml("<b>"+"Nama Gunung :<br>"+"</b>" + nGunungApi));
        holder.levelaktivity.setText(Html.fromHtml("<b>"+"Jenis Tingkatan :<br>"+"</b>" + nTingkatAktifitas));
        holder.descript.setText(Html.fromHtml("<b>"+"Keterangan :<br>"+"</b>" + nKeterangan));
        holder.recomend.setText(Html.fromHtml("<b>"+"Rekomendasi :<br>"+"</b>" + nRekomendasi));
        holder.nova.setText(Html.fromHtml("<b>"+"Nova :<br>"+"</b>" + nVona));
        holder.detail.setText(Html.fromHtml("<b>"+"Detail :<br>"+"</b>" + nDetail));

    }

    public void updateList(ArrayList<Model> list){
        mExampleList = list;
        notifyDataSetChanged();
    }

    @Override
    public int getItemCount() {
        return mExampleList.size();
    }

    public class ExampleViewHolder extends RecyclerView.ViewHolder {

        public TextView date, firemountain, levelaktivity, descript, recomend, nova, detail;

        public ExampleViewHolder(View itemView) {
            super(itemView);

            date = itemView.findViewById(R.id.tanggal);
            firemountain = itemView.findViewById(R.id.berita1);
            levelaktivity = itemView.findViewById(R.id.berita2);
            descript = itemView.findViewById(R.id.berita3);
            recomend = itemView.findViewById(R.id.berita4);
            nova = itemView.findViewById(R.id.berita5);
            detail = itemView.findViewById(R.id.berita6);

        }
    }
}
