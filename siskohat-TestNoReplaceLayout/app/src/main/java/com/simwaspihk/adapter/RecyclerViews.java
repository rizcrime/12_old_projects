package com.simwaspihk.adapter;

import android.content.Context;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.simwaspihk.R;
import com.simwaspihk.model.Datas;

import java.util.ArrayList;


/**
 * Created by creatorbe on 5/24/17.
 */

public class RecyclerViews extends RecyclerView.Adapter<RecyclerViews.MyViewHolder> {

    ArrayList<Datas> arrayList = new ArrayList<Datas>();
    Context context;
    static final int MAP_HAJJ = 1000;
    static final int NORMAL = 2000;
    static final int WIN_LOG = 3000;
    static final int FILE_SELECT_CODE = 4000;

    public RecyclerViews(ArrayList<Datas> arrayList, Context ctx) {
        this.arrayList = arrayList;
        context = ctx;
    }

    @Override


    public MyViewHolder onCreateViewHolder(ViewGroup parent, int viewType)

    {
        View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.list_menu, parent, false);
        MyViewHolder myViewHolder = new MyViewHolder(view, context, arrayList);
        return myViewHolder;
    }

    @Override
    public void onBindViewHolder(MyViewHolder holder, int position) {
        Datas myData = arrayList.get(position);
        holder.imageView.setImageResource(myData.getImgsrc());
        holder.title.setText(myData.getName());
        holder.tags.setText(myData.getName());
    }

    @Override
    public int getItemCount() {
        return arrayList.size();
    }

    public static class MyViewHolder extends RecyclerView.ViewHolder

            implements View.OnClickListener {
        ImageView imageView;
        TextView title, tags;
        ArrayList<Datas> list = new ArrayList<Datas>();
        Context cobject;

        public MyViewHolder(View itemView, Context cob, ArrayList<Datas> lob) {
            super(itemView);
            cobject = cob;
            list = lob;
            itemView.setOnClickListener(this);
            imageView = (ImageView) itemView.findViewById(R.id.img_thumbnail);
            title = (TextView) itemView.findViewById(R.id.textView);
            tags = (TextView) itemView.findViewById(R.id.tv_titles);
        }

        @Override
        public void onClick(View v) {
            int position = getAdapterPosition();
            Datas data = list.get(position);
            String titles = data.getName();
//            if(titles.equals("Cek Keberangkatan")) {
//                NoPorsi_.intent(cobject).startForResult(NORMAL);
//            }else if(titles.equals("Peta Lokasi")){
//                MapLokasi_.intent(cobject).startForResult(MAP_HAJJ);
//            }else if(titles.equals("Jadwal Penerbangan")){
//                JadwalTab_.intent(cobject).startForResult(NORMAL);
//            }else if(titles.equals("Informasi Kesehatan")){
//                Kesehatan_.intent(cobject).start();
//            }else if(titles.equals("Haji dan Umrah")){
//                Umrah_.intent(cobject).start();
//            }else if(titles.equals("Call Center")){
//                SMS_.intent(cobject).start();
//            }else if(titles.equals("Informasi Penting")){
//                Lainnya_.intent(cobject).start();
//            }else {
//                Intent intent = new Intent(cobject, DetailsActivity.class);
//                intent.putExtra("string", "Detail Content of " + data.getName());
//                cobject.startActivity(intent);
//            }
            Toast.makeText(cobject, titles, Toast.LENGTH_SHORT).show();
        }
    }
}
