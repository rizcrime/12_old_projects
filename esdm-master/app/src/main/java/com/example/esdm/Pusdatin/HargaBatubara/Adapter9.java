package com.example.esdm.Pusdatin.HargaBatubara;

import android.content.Context;
import android.support.v7.widget.RecyclerView;
import android.text.Html;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import com.example.esdm.R;

import java.util.ArrayList;

public class Adapter9 extends RecyclerView.Adapter<Adapter9.ExampleViewHolder> {
    private Context mContext;
    private ArrayList<Model9> mExampleList9;

    public Adapter9(Context context, ArrayList<Model9> exampleList) {
        mContext = context;
        mExampleList9 = exampleList;
    }

    public Adapter9(ArrayList<Model9> mExampleList) {
        this.mExampleList9 = mExampleList;
    }

    @Override
    public ExampleViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View v = LayoutInflater.from(mContext).inflate(R.layout.isi3, parent, false);
        return new ExampleViewHolder(v);
    }

    @Override
    public void onBindViewHolder(ExampleViewHolder holder, int position) {
        Model9 currentItem = mExampleList9.get(position);

        String nTanggal = currentItem.getmTanggal9();
        String nHarga = currentItem.getmHarga9();
        String nSumber = currentItem.getmSumber9();

        holder.date.setText(Html.fromHtml("<b>"+"Tanggal :<br>"+"</b>" + nTanggal));
        holder.price.setText(Html.fromHtml("<b>"+"Harga :<br>"+"</b>" + nHarga));
        holder.source.setText(Html.fromHtml("<b>"+"Sumber :<br>"+"</b>" + nSumber));
    }

    public void updateList(ArrayList<Model9> list){
        mExampleList9 = list;
        notifyDataSetChanged();
    }

    @Override
    public int getItemCount() {
        return mExampleList9.size();
    }

    public class ExampleViewHolder extends RecyclerView.ViewHolder {

        public TextView date, price, source;

        public ExampleViewHolder(View itemView) {
            super(itemView);

            date = itemView.findViewById(R.id.tanggal);
            price = itemView.findViewById(R.id.berita1);
            source = itemView.findViewById(R.id.berita2);

        }
    }
}
