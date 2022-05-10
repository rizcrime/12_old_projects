package com.example.esdm.Klik.Minerba;

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
        View v = LayoutInflater.from(mContext).inflate(R.layout.isi4, parent, false);
        return new ExampleViewHolder(v);
    }

    @Override
    public void onBindViewHolder(ExampleViewHolder holder, int position) {
        Model2 currentItem = mExampleList2.get(position);

        String nBerita2 = currentItem.getmBerita2();
        String nJenis2 = currentItem.getmJenis2();
        String nUrl2 = currentItem.getmUrl2();

        holder.news2.setText(Html.fromHtml("<b>"+"Berita :<br>"+"</b>" + nBerita2));
        holder.kind2.setText(Html.fromHtml("<b>"+"Jenis :<br>"+"</b>" + nJenis2));
        holder.url2.setText(Html.fromHtml("<b>"+"URL :<br>"+"</b>" + nUrl2));
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

        public TextView news2, kind2, url2;

        public ExampleViewHolder(View itemView) {
            super(itemView);

            news2 = itemView.findViewById(R.id.berita1);
            kind2 = itemView.findViewById(R.id.berita2);
            url2 = itemView.findViewById(R.id.berita3);

        }
    }
}
