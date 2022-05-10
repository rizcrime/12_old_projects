package com.example.esdm.UpdateBerita.Netral;

import android.content.Context;
import android.support.v7.widget.RecyclerView;
import android.text.Html;
import android.text.Spannable;
import android.text.TextPaint;
import android.text.style.URLSpan;
import android.text.style.UnderlineSpan;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import com.example.esdm.R;

import java.util.ArrayList;

public class AdapterNetral extends RecyclerView.Adapter<AdapterNetral.ExampleViewHolder> {
    private Context mContext;
    private ArrayList<ModelNetral> mExampleList;

    public AdapterNetral(Context context, ArrayList<ModelNetral> exampleList) {
        mContext = context;
        mExampleList = exampleList;
    }

    public AdapterNetral(ArrayList<ModelNetral> mExampleList) {
        this.mExampleList = mExampleList;
    }

    @Override
    public ExampleViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View v = LayoutInflater.from(mContext).inflate(R.layout.isi1, parent, false);
        return new ExampleViewHolder(v);
    }

    @Override
    public void onBindViewHolder(ExampleViewHolder holder, int position) {
        ModelNetral currentItem = mExampleList.get(position);

        String nGunungApi = currentItem.getmGunungApi1();
        String nUrl = currentItem.getmUrl();
        String content = "<a href=\""+nUrl+"\">"+ nGunungApi +"<a/>";
        Spannable s = (Spannable) Html.fromHtml(content);
        for (URLSpan u: s.getSpans(0, s.length(), URLSpan.class)) {
            s.setSpan(new UnderlineSpan() {
                public void updateDrawState(TextPaint tp) {
                    tp.setUnderlineText(false);
                }
            }, s.getSpanStart(u), s.getSpanEnd(u), 0);
        }
        holder.firemountain.setText(s);
//        holder.firemountain.setText(Html.fromHtml("<a href=\""+nUrl+"\">"+ nGunungApi +"<a/>"));

    }

    public void updateList(ArrayList<ModelNetral> list){
        mExampleList = list;
        notifyDataSetChanged();
    }

    @Override
    public int getItemCount() {
        return mExampleList.size();
    }

    public class ExampleViewHolder extends RecyclerView.ViewHolder {

        public TextView firemountain;

        public ExampleViewHolder(View itemView) {
            super(itemView);

            firemountain = itemView.findViewById(R.id.berita1);

        }
    }
}
