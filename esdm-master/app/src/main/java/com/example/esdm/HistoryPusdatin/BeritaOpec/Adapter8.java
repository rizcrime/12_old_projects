package com.example.esdm.HistoryPusdatin.BeritaOpec;

import android.content.Context;
import android.support.v7.widget.RecyclerView;
import android.text.Html;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import com.example.esdm.R;

import java.util.ArrayList;

public class Adapter8 extends RecyclerView.Adapter<Adapter8.ExampleViewHolder> {
    private Context mContext;
    private ArrayList<Model8> mExampleList8;

    public Adapter8(Context context, ArrayList<Model8> exampleList) {
        mContext = context;
        mExampleList8 = exampleList;
    }

    public Adapter8(ArrayList<Model8> mExampleList) {
        this.mExampleList8 = mExampleList;
    }

    @Override
    public ExampleViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View v = LayoutInflater.from(mContext).inflate(R.layout.isi2, parent, false);
        return new ExampleViewHolder(v);
    }

    @Override
    public void onBindViewHolder(ExampleViewHolder holder, int position) {
        Model8 currentItem = mExampleList8.get(position);

        String nTanggal = currentItem.getmTanggal8();
        String nGunungApi = currentItem.getmBerita8();

        holder.date.setText(Html.fromHtml("<b>"+"Tanggal :<br>"+"</b>" + nTanggal));
        holder.news.setText(Html.fromHtml("<b>"+"Berita :<br>"+"</b>" + nGunungApi) + "BOPD");
    }

    public void updateList(ArrayList<Model8> list){
        mExampleList8 = list;
        notifyDataSetChanged();
    }

    @Override
    public int getItemCount() {
        return mExampleList8.size();
    }

    public class ExampleViewHolder extends RecyclerView.ViewHolder {

        public TextView date, news;

        public ExampleViewHolder(View itemView) {
            super(itemView);

            date = itemView.findViewById(R.id.tanggal);
            news = itemView.findViewById(R.id.berita1);

        }
    }
}
