package com.simwaspihk.adapter;

import android.content.Context;
import android.graphics.Color;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.TextView;

import com.simwaspihk.R;
import com.simwaspihk.model.DataJamaah;

import java.util.List;

/**
 * Created by Belal on 9/5/2017.
 */

public class ListViewAdapter extends ArrayAdapter<DataJamaah> {

    //the hero list that will be displayed
    private List<DataJamaah> heroList;

    //the context object
    private Context mCtx;
    private int selectedIndex;
    private int selectedColor = Color.parseColor("#1b1b1b");

    //here we are getting the herolist and context
    //so while creating the object of this adapter class we need to give herolist and context
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
    //this method will return the list item
    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        //getting the layoutinflater
        LayoutInflater inflater = LayoutInflater.from(mCtx);
        //ViewHolder holder;
        //creating a view with our xml layout
        View listViewItem = inflater.inflate(R.layout.list_items, null, true);

        //getting text views
        TextView textViewName = (TextView)listViewItem.findViewById(R.id.textViewName);
        TextView textViewImageUrl = (TextView)listViewItem.findViewById(R.id.textViewImageUrl);

        //Getting the hero for the specified position
        DataJamaah hero = heroList.get(position);

        //setting hero values to textviews
        textViewName.setText(hero.getNama());
        textViewImageUrl.setText(hero.getKodePorsi());
        if(hero.getStatus().equals("SAKIT")) {
            listViewItem.setBackgroundColor(Color.parseColor("#d80000"));
        } else if(hero.getStatus().equals("WAFAT")) {
            listViewItem.setBackgroundColor(Color.parseColor("#838383"));
        } else if(hero.getStatus().equals("LAIN")) {
            listViewItem.setBackgroundColor(Color.parseColor("#1e90ff"));
        }
        /*
        if(selectedIndex!= -1 && position == selectedIndex)
        {
            textViewName.setBackgroundColor(Color.TRANSPARENT);
            textViewImageUrl.setBackgroundColor(Color.TRANSPARENT);
        }
        else
        {
            textViewImageUrl.setBackgroundColor(selectedColor);
            textViewName.setBackgroundColor(selectedColor);
        }*/
        //returning the listitem
        return listViewItem;
    }
}