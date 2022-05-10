package com.example.esdm.Pusdatin.ProdEkuivalen;

import android.content.Context;
import android.support.v7.widget.RecyclerView;
import android.text.Html;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import com.example.esdm.R;

import java.util.ArrayList;

public class Adapter4 extends RecyclerView.Adapter<Adapter4.ExampleViewHolder> {
    private Context mContext;
    private ArrayList<Model4> mExampleList4;

    public Adapter4(Context context, ArrayList<Model4> exampleList) {
        mContext = context;
        mExampleList4 = exampleList;
    }

    public Adapter4(ArrayList<Model4> mExampleList) {
        this.mExampleList4 = mExampleList;
    }

    @Override
    public ExampleViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View v = LayoutInflater.from(mContext).inflate(R.layout.isi5, parent, false);
        return new ExampleViewHolder(v);
    }

    @Override
    public void onBindViewHolder(ExampleViewHolder holder, int position) {
        Model4 currentItem = mExampleList4.get(position);

        String nTanggal = currentItem.getmTanggal4();
        int nJenis = currentItem.getmProdHarian4();
        int nBbm = currentItem.getmProdBulanan4();
        int nProg = currentItem.getmProdTahunan4();
        int nHarga = currentItem.getmTargetApbn4();

        holder.date.setText(Html.fromHtml("<b>"+"Tanggal :<br>"+"</b>" + nTanggal));
        holder.price.setText(Html.fromHtml("<b>"+"Target APBN :<br>"+"</b>" + nHarga + " BOPD"));
        holder.price.setTextColor(mContext.getResources().getColor(R.color.green_light));

        if (nJenis < nHarga){
            holder.kind.setTextColor(mContext.getResources().getColor(R.color.red));
            holder.kind.setText(Html.fromHtml("<b>"+"Produksi Harian :<br>"+"</b>" + nJenis + " BOPD" + "(Belum tercapai)"));
        }else {
            holder.kind.setTextColor(mContext.getResources().getColor(R.color.green_light));
            holder.kind.setText(Html.fromHtml("<b>"+"Produksi Harian :<br>"+"</b>" + nJenis + " BOPD" + "(Sudah tercapai)"));
        }

        if (nBbm < nHarga){
            holder.fuel.setTextColor(mContext.getResources().getColor(R.color.red));
            holder.fuel.setText(Html.fromHtml("<b>"+"Produksi Harian :<br>"+"</b>" + nBbm + " BOPD" + "(Belum tercapai)"));
        }else {
            holder.fuel.setTextColor(mContext.getResources().getColor(R.color.green_light));
            holder.fuel.setText(Html.fromHtml("<b>"+"Produksi Harian :<br>"+"</b>" + nBbm + " BOPD" + "(Sudah tercapai)"));
        }

        if (nProg < nHarga){
            holder.prog.setTextColor(mContext.getResources().getColor(R.color.red));
            holder.prog.setText(Html.fromHtml("<b>"+"Produksi Harian :<br>"+"</b>" + nProg + " BOPD" + "(Belum tercapai)"));
        }else {
            holder.prog.setTextColor(mContext.getResources().getColor(R.color.green_light));
            holder.prog.setText(Html.fromHtml("<b>"+"Produksi Harian :<br>"+"</b>" + nProg + " BOPD" + "(Sudah tercapai)"));
        }


    }

    public void updateList(ArrayList<Model4> list){
        mExampleList4 = list;
        notifyDataSetChanged();
    }

    @Override
    public int getItemCount() {
        return mExampleList4.size();
    }

    public class ExampleViewHolder extends RecyclerView.ViewHolder {

        public TextView date, kind, fuel, prog, price;

        public ExampleViewHolder(View itemView) {
            super(itemView);

            date = itemView.findViewById(R.id.tanggal);
            kind = itemView.findViewById(R.id.berita1);
            fuel = itemView.findViewById(R.id.berita2);
            prog = itemView.findViewById(R.id.berita3);
            price = itemView.findViewById(R.id.berita4);

        }
    }
}
