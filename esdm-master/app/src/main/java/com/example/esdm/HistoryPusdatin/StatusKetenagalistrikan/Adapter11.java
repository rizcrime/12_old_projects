package com.example.esdm.HistoryPusdatin.StatusKetenagalistrikan;

import android.content.Context;
import android.support.v7.widget.RecyclerView;
import android.text.Html;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import com.example.esdm.R;

import java.util.ArrayList;

public class Adapter11 extends RecyclerView.Adapter<Adapter11.ExampleViewHolder> {
    private Context mContext;
    private ArrayList<Model11> mExampleList11;

    public Adapter11(Context context, ArrayList<Model11> exampleList) {
        mContext = context;
        mExampleList11 = exampleList;
    }

    public Adapter11(ArrayList<Model11> mExampleList) {
        this.mExampleList11 = mExampleList;
    }

    @Override
    public ExampleViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View v = LayoutInflater.from(mContext).inflate(R.layout.isi2, parent, false);
        return new ExampleViewHolder(v);
    }

    @Override
    public void onBindViewHolder(ExampleViewHolder holder, int position) {
        Model11 currentItem = mExampleList11.get(position);

        String nTanggal = currentItem.getmTanggal11();
        String nJenis = currentItem.getmStatus11();

        holder.date.setText(Html.fromHtml("<b>"+"Tanggal :<br>"+"</b>" + nTanggal));
        holder.kind.setText(Html.fromHtml("<b>"+"Status :<br>"+"</b>" + nJenis));
    }

    public void updateList(ArrayList<Model11> list){
        mExampleList11 = list;
        notifyDataSetChanged();
    }

    @Override
    public int getItemCount() {
        return mExampleList11.size();
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
