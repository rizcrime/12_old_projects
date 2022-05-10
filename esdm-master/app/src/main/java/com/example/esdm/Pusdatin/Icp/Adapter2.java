package com.example.esdm.Pusdatin.Icp;

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
    private Context mContext;
    private ArrayList<Model2> mExampleList2;

    public Adapter2(Context context, ArrayList<Model2> exampleList) {
        mContext = context;
        mExampleList2 = exampleList;
    }

    public Adapter2(ArrayList<Model2> mExampleList) {
        this.mExampleList2 = mExampleList;
    }

    @Override
    public ExampleViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View v = LayoutInflater.from(mContext).inflate(R.layout.isi2, parent, false);
        return new ExampleViewHolder(v);
    }

    @Override
    public void onBindViewHolder(ExampleViewHolder holder, int position) {
        Model2 currentItem = mExampleList2.get(position);

        String nTanggal = currentItem.getmTanggal2();
        String nJenis = currentItem.getmLaporan2();

        holder.date.setText(Html.fromHtml("<b>"+"Tanggal :<br>"+"</b>" + nTanggal));
        holder.kind.setText(Html.fromHtml("<b>"+"Keterangan :<br>"+"</b>" + nJenis ));
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

        public TextView date, kind;

        public ExampleViewHolder(View itemView) {
            super(itemView);

            date = itemView.findViewById(R.id.tanggal);
            kind = itemView.findViewById(R.id.berita1);

        }
    }
}
