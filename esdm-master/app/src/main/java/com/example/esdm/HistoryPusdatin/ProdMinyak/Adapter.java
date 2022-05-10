package com.example.esdm.HistoryPusdatin.ProdMinyak;

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
        View v = LayoutInflater.from(mContext).inflate(R.layout.isi5, parent, false);
        return new ExampleViewHolder(v);
    }

    @Override
    public void onBindViewHolder(ExampleViewHolder holder, int position) {
        Model currentItem = mExampleList.get(position);

        String nTanggal = currentItem.getmTanggal1();
        int nJenis = currentItem.getmProdHarian1();
        int nBbm = currentItem.getmProdBulanan1();
        int nProg = currentItem.getmProdTahunan1();
        int nHarga = currentItem.getmTargetApbn1();

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

    public void updateList(ArrayList<Model> list){
        mExampleList = list;
        notifyDataSetChanged();
    }

    @Override
    public int getItemCount() {
        return mExampleList.size();
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
