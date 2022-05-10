package com.kemenag.sipatuh.PublicPackage;

import android.content.Context;
import android.graphics.Color;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.TextView;


import com.kemenag.sipatuh.R;

import java.util.List;

public class ListViewAdapter extends ArrayAdapter<DataJamaah> {

    private List<DataJamaah> heroList;

    private Context mCtx;
    private int selectedIndex;
    private int selectedColor = Color.parseColor("#1b1b1b");

    public ListViewAdapter(List<DataJamaah> heroList, Context mCtx) {
        super(mCtx, R.layout.list_items, heroList);
        this.heroList = heroList;
        this.mCtx = mCtx;
    }

    public void setSelectedIndex(int ind)
    {
        selectedIndex = ind;
        notifyDataSetChanged();
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {

        LayoutInflater inflater = LayoutInflater.from(mCtx);

        View listViewItem = inflater.inflate(R.layout.list_items, null, true);

        TextView textViewName = (TextView)listViewItem.findViewById(R.id.textViewName);
        TextView textViewImageUrl = (TextView)listViewItem.findViewById(R.id.textViewImageUrl);

        DataJamaah hero = heroList.get(position);

        textViewName.setText(hero.getNama());
        textViewImageUrl.setText(hero.getKodePorsi());
        if(hero.getStatus().equals("SAKIT")) {
            listViewItem.setBackgroundColor(Color.parseColor("#d80000"));
        } else if(hero.getStatus().equals("WAFAT")) {
            listViewItem.setBackgroundColor(Color.parseColor("#838383"));
        } else if(hero.getStatus().equals("LAIN")) {
            listViewItem.setBackgroundColor(Color.parseColor("#1e90ff"));
        }

        return listViewItem;
    }
}