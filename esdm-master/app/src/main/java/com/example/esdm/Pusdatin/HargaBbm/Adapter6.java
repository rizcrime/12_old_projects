package com.example.esdm.Pusdatin.HargaBbm;

import android.content.Context;
import android.support.v7.widget.RecyclerView;
import android.text.Html;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import com.example.esdm.R;

import java.util.ArrayList;

public class Adapter6 extends RecyclerView.Adapter<Adapter6.ExampleViewHolder> {
    private Context mContext;
    private ArrayList<Model6> mExampleList6;

    public Adapter6(Context context, ArrayList<Model6> exampleList) {
        mContext = context;
        mExampleList6 = exampleList;
    }

    public Adapter6(ArrayList<Model6> mExampleList) {
        this.mExampleList6 = mExampleList;
    }

    @Override
    public ExampleViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View v = LayoutInflater.from(mContext).inflate(R.layout.isi5, parent, false);
        return new ExampleViewHolder(v);
    }

    @Override
    public void onBindViewHolder(ExampleViewHolder holder, int position) {
        Model6 currentItem = mExampleList6.get(position);

        String nTanggal = currentItem.getmTanggal6();
        String nJenis = currentItem.getmJenis6();
        String nBbm = currentItem.getmBbm6();
        String nProg = currentItem.getmProg6();
        String nHarga = currentItem.getmHarga6();

        holder.date.setText(Html.fromHtml("<b>"+"Tanggal :<br>"+"</b>" + nTanggal));
        holder.kind.setText(Html.fromHtml("<b>"+"Jenis Tertentu :<br>"+"</b>" + nJenis ));
        holder.fuel.setText(Html.fromHtml("<b>"+"BBM Umum :<br>"+"</b>" + nBbm));
        holder.prog.setText(Html.fromHtml("<b>"+"Program Indonesia Satu Harga :<br>"+"</b>" + nProg));
        holder.price.setText(Html.fromHtml("<b>"+"Harga Per-negara:<br>"+"</b>" + nHarga));
    }

    public void updateList(ArrayList<Model6> list){
        mExampleList6 = list;
        notifyDataSetChanged();
    }

    @Override
    public int getItemCount() {
        return mExampleList6.size();
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
