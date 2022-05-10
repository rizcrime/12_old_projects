package com.example.esdm.HistoryPusdatin.HargaMineral;

import android.content.Context;
import android.support.v7.widget.RecyclerView;
import android.text.Html;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import com.example.esdm.R;

import java.util.ArrayList;

public class Adapter10 extends RecyclerView.Adapter<Adapter10.ExampleViewHolder> {
    private Context mContext;
    private ArrayList<Model10> mExampleList10;

    public Adapter10(Context context, ArrayList<Model10> exampleList) {
        mContext = context;
        mExampleList10 = exampleList;
    }

    public Adapter10(ArrayList<Model10> mExampleList) {
        this.mExampleList10 = mExampleList;
    }

    @Override
    public ExampleViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View v = LayoutInflater.from(mContext).inflate(R.layout.isi3, parent, false);
        return new ExampleViewHolder(v);
    }

    @Override
    public void onBindViewHolder(ExampleViewHolder holder, int position) {
        Model10 currentItem = mExampleList10.get(position);

        String nTanggal = currentItem.getmTanggal10();
        String nJenis = currentItem.getmHarga10();
        String nBbm = currentItem.getmSumber10();

        holder.date.setText(Html.fromHtml("<b>"+"Tanggal :<br>"+"</b>" + nTanggal));
        holder.kind.setText(Html.fromHtml("<b>"+"Harga :<br>"+"</b>" + nJenis ));
        holder.fuel.setText(Html.fromHtml("<b>"+"Sumber :<br>"+"</b>" + nBbm));
    }

    public void updateList(ArrayList<Model10> list){
        mExampleList10 = list;
        notifyDataSetChanged();
    }

    @Override
    public int getItemCount() {
        return mExampleList10.size();
    }

    public class ExampleViewHolder extends RecyclerView.ViewHolder {

        public TextView date, kind, fuel;

        public ExampleViewHolder(View itemView) {
            super(itemView);

            date = itemView.findViewById(R.id.tanggal);
            kind = itemView.findViewById(R.id.berita1);
            fuel = itemView.findViewById(R.id.berita2);

        }
    }
}
