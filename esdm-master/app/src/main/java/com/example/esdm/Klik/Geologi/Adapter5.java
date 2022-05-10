package com.example.esdm.Klik.Geologi;

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

        String nBerita5 = currentItem.getmBerita5();
        String nJenis5 = currentItem.getmJenis5();
        String nUrl5 = currentItem.getmUrl5();

        holder.news5.setText(Html.fromHtml("<b>"+"Berita :<br>"+"</b>" + nBerita5));
        holder.kind5.setText(Html.fromHtml("<b>"+"Jenis :<br>"+"</b>" + nJenis5));
        holder.url5.setText(Html.fromHtml("<b>"+"URL:<br>"+"</b>" + nUrl5));
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

        public TextView news5, kind5, url5;

        public ExampleViewHolder(View itemView) {
            super(itemView);

            news5 = itemView.findViewById(R.id.berita1);
            kind5 = itemView.findViewById(R.id.berita2);
            url5 = itemView.findViewById(R.id.berita3);

        }
    }
}
