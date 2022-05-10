package com.example.esdm.Klik.Migas;

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
        View v = LayoutInflater.from(mContext).inflate(R.layout.isi4, parent, false);
        return new ExampleViewHolder(v);
    }

    @Override
    public void onBindViewHolder(ExampleViewHolder holder, int position) {
        Model currentItem = mExampleList.get(position);

        String nBerita1 = currentItem.getmBerita1();
        String nJenis1 = currentItem.getmJenis1();
        String nUrl1 = currentItem.getmUrl1();


        holder.news.setText(Html.fromHtml("<b>"+"Berita :<br>"+"</b>" + nBerita1));
        holder.kind.setText(Html.fromHtml("<b>"+"Jenis :<br>"+"</b>" + nJenis1));
        holder.url.setText(Html.fromHtml("<b>"+"URL:<br>"+"</b>" + nUrl1));

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

        public TextView news, kind, url;

        public ExampleViewHolder(View itemView) {
            super(itemView);

            news = itemView.findViewById(R.id.berita1);
            kind = itemView.findViewById(R.id.berita2);
            url = itemView.findViewById(R.id.berita3);

        }
    }
}
