package com.example.esdm.HistoryPusdatin.LiftingTahun;

import android.content.Context;
import android.support.v7.widget.RecyclerView;
import android.text.Html;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import com.example.esdm.R;

import java.util.ArrayList;

public class Adapter5 extends RecyclerView.Adapter<Adapter5.ExampleViewHolder> {
    private Context mContext;
    private ArrayList<Model5> mExampleList5;

    public Adapter5(Context context, ArrayList<Model5> exampleList) {
        mContext = context;
        mExampleList5 = exampleList;
    }
    public Adapter5(ArrayList<Model5> mExampleList) {
        this.mExampleList5 = mExampleList;
    }


    @Override
    public ExampleViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View v = LayoutInflater.from(mContext).inflate(R.layout.isi4, parent, false);
        return new ExampleViewHolder(v);
    }

    @Override
    public void onBindViewHolder(ExampleViewHolder holder, int position) {
        Model5 currentItem = mExampleList5.get(position);

        String nTanggal = currentItem.getmTanggal5();
        String nJenis = currentItem.getmLiftingMinyak5();
        String nBbm = currentItem.getmPosisiStock5();
        String nProg = currentItem.getmSalurGas5();

        holder.date.setText(Html.fromHtml("<b>"+"Tanggal :<br>"+"</b>" + nTanggal));
        holder.kind.setText(Html.fromHtml("<b>"+"Lifting Minyak Bumi :<br>"+"</b>" + nJenis ));
        holder.fuel.setText(Html.fromHtml("<b>"+"Posisi Stock hari ini :<br>"+"</b>" + nBbm));
        holder.prog.setText(Html.fromHtml("<b>"+"Salur Gas :<br>"+"</b>" + nProg));
    }

    public void updateList(ArrayList<Model5> list){
        mExampleList5 = list;
        notifyDataSetChanged();
    }

    @Override
    public int getItemCount() {
        return mExampleList5.size();
    }

    public class ExampleViewHolder extends RecyclerView.ViewHolder {

        public TextView date, kind, fuel, prog;

        public ExampleViewHolder(View itemView) {
            super(itemView);

            date = itemView.findViewById(R.id.tanggal);
            kind = itemView.findViewById(R.id.berita1);
            fuel = itemView.findViewById(R.id.berita2);
            prog = itemView.findViewById(R.id.berita3);

        }
    }
}
