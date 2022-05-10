package com.example.esdm.Pusdatin.PenyaluranPremium;

import android.content.Context;
import android.support.v7.widget.RecyclerView;
import android.text.Html;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import com.example.esdm.R;

import java.util.ArrayList;

public class Adapter7 extends RecyclerView.Adapter<Adapter7.ExampleViewHolder> {
    private Context mContext;
    private ArrayList<Model7> mExampleList7;

    public Adapter7(Context context, ArrayList<Model7> exampleList) {
        mContext = context;
        mExampleList7 = exampleList;
    }

    public Adapter7(ArrayList<Model7> mExampleList) {
        this.mExampleList7 = mExampleList;
    }

    @Override
    public ExampleViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View v = LayoutInflater.from(mContext).inflate(R.layout.isi3, parent, false);
        return new ExampleViewHolder(v);
    }

    @Override
    public void onBindViewHolder(ExampleViewHolder holder, int position) {
        Model7 currentItem = mExampleList7.get(position);

        String nTanggal = currentItem.getmTanggal7();
        String nJenis = currentItem.getmProgress7();
        String nBbm = currentItem.getmCatatan7();

        holder.date.setText(Html.fromHtml("<b>"+"Tanggal :<br>"+"</b>" + nTanggal));
        holder.kind.setText(Html.fromHtml("<b>"+"Progress :<br>"+"</b>" + nJenis));
        holder.fuel.setText(Html.fromHtml("<b>"+"Catatan :<br>"+"</b>" + nBbm));
    }

    public void updateList(ArrayList<Model7> list){
        mExampleList7 = list;
        notifyDataSetChanged();
    }

    @Override
    public int getItemCount() {
        return mExampleList7.size();
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
