package com.example.esdm.Klik.Ketenagalistrikan;

import android.content.Context;
import android.support.v7.widget.RecyclerView;
import android.text.Html;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import com.example.esdm.R;

import java.util.ArrayList;

public class Adapter3 extends RecyclerView.Adapter<Adapter3.ExampleViewHolder> {
    private Context mContext;
    private ArrayList<Model3> mExampleList3;

    public Adapter3(Context context, ArrayList<Model3> exampleList) {
        mContext = context;
        mExampleList3 = exampleList;
    }

    public Adapter3(ArrayList<Model3> mExampleList) {
        this.mExampleList3 = mExampleList;
    }

    @Override
    public ExampleViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View v = LayoutInflater.from(mContext).inflate(R.layout.isi4, parent, false);
        return new ExampleViewHolder(v);
    }

    @Override
    public void onBindViewHolder(ExampleViewHolder holder, int position) {
        Model3 currentItem = mExampleList3.get(position);

        String nBerita3 = currentItem.getmBerita3();
        String nJenis3 = currentItem.getmJenis3();
        String nUrl3 = currentItem.getmUrl3();

        holder.news3.setText(Html.fromHtml("<b>"+"Berita :<br>"+"</b>" + nBerita3));
        holder.kind3.setText(Html.fromHtml("<b>"+"Jenis :<br>"+"</b>" + nJenis3));
        holder.url3.setText(Html.fromHtml("<b>"+"URL:<br>"+"</b>" + nUrl3));
    }

    public void updateList(ArrayList<Model3> list){
        mExampleList3 = list;
        notifyDataSetChanged();
    }

    @Override
    public int getItemCount() {
        return mExampleList3.size();
    }

    public class ExampleViewHolder extends RecyclerView.ViewHolder {

        public TextView news3, kind3, url3;

        public ExampleViewHolder(View itemView) {
            super(itemView);

            news3 = itemView.findViewById(R.id.berita1);
            kind3 = itemView.findViewById(R.id.berita2);
            url3 = itemView.findViewById(R.id.berita3);

        }
    }
}
