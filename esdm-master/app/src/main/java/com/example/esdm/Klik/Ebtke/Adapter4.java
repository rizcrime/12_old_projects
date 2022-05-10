package com.example.esdm.Klik.Ebtke;

import android.content.Context;
import android.support.v7.widget.RecyclerView;
import android.text.Html;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import com.example.esdm.R;

import java.util.ArrayList;

public class Adapter4 extends RecyclerView.Adapter<Adapter4.ExampleViewHolder> {
    private Context mContext;
    private ArrayList<Model4> mExampleList4;

    public Adapter4(Context context, ArrayList<Model4> exampleList) {
        mContext = context;
        mExampleList4 = exampleList;
    }

    public Adapter4(ArrayList<Model4> mExampleList) {
        this.mExampleList4 = mExampleList;
    }


    @Override
    public ExampleViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View v = LayoutInflater.from(mContext).inflate(R.layout.isi4, parent, false);
        return new ExampleViewHolder(v);
    }

    @Override
    public void onBindViewHolder(ExampleViewHolder holder, int position) {
        Model4 currentItem = mExampleList4.get(position);

        String nBerita4 = currentItem.getmBerita4();
        String nJenis4 = currentItem.getmJenis4();
        String nUrl4 = currentItem.getmUrl4();

        holder.news4.setText(Html.fromHtml("<b>"+"Berita :<br>"+"</b>" + nBerita4));
        holder.kind4.setText(Html.fromHtml("<b>"+"Jenis :<br>"+"</b>" + nJenis4));
        holder.url4.setText(Html.fromHtml("<b>"+"URL:<br>"+"</b>" + nUrl4));
    }

    public void updateList(ArrayList<Model4> list){
        mExampleList4 = list;
        notifyDataSetChanged();
    }

    @Override
    public int getItemCount() {
        return mExampleList4.size();
    }

    public class ExampleViewHolder extends RecyclerView.ViewHolder {

        public TextView news4, kind4, url4;

        public ExampleViewHolder(View itemView) {
            super(itemView);

            news4 = itemView.findViewById(R.id.berita1);
            kind4 = itemView.findViewById(R.id.berita2);
            url4 = itemView.findViewById(R.id.berita3);

        }
    }
}
