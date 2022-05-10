package com.simwaspihk.adapter;

import android.content.Context;
import android.content.Intent;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.bumptech.glide.Glide;
import com.pixplicity.easyprefs.library.Prefs;
import com.simwaspihk.R;
import com.simwaspihk.activity.NewsDetailActivity;
import com.simwaspihk.data.remote.api.model.news.DataItem;

import java.util.List;

/**
 * Created by creatorbe on 6/6/17.
 */

public class NewsAdapter extends RecyclerView.Adapter<NewsAdapter.ViewHolder> {

//    @BindView(R.id.etRencanaTgl)
//    EditText etRencanaTgl;
//
//    @BindView(R.id.etRencanaPukul)
//    EditText etRencanaPukul;
//
//    @BindView(R.id.etRencanaFlight)
//    EditText etRencanaFlight;
//
//    @BindView(R.id.etRencanaJumlah)
//    EditText etRencanaJumlah;
//
//    @BindView(R.id.etRencanaBandara)
//    EditText etRencanaBandara;
//
//    @BindView(R.id.etAktualTgl)
//    EditText etAktualTgl;
//
//    @BindView(R.id.etAktualPukul)
//    EditText etAktualPukul;
//
//    @BindView(R.id.etAktualFlight)
//    EditText etAktualFlight;
//
//    @BindView(R.id.etAktualJumlah)
//    EditText etAktualJumlah;
//
//    @BindView(R.id.etAktualBandara)
//    EditText etAktualBandara;
//
//    @BindView(R.id.etPria)
//    EditText etPria;
//
//    @BindView(R.id.etWanita)
//    EditText etWanita;
//
//    @BindView(R.id.etSakit)
//    EditText etSakit;
//
//    @BindView(R.id.etLain)
//    EditText etLain;

    private List<com.simwaspihk.data.remote.api.model.news.DataItem> news;
    private int rowLayout;
    Context context;

    String sId, sTitles, sSubTitles, sDesc, sReadMore, sImage, sDetails;


    // create constructor to innitilize context and data sent from MainActivity
    public NewsAdapter(List<DataItem> news, int rowLayout, Context context) {
        this.news = news;
        this.rowLayout = rowLayout;
        this.context = context;
    }

    // Inflate the layout when viewholder created
    @Override
    public NewsAdapter.ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(parent.getContext()).inflate(rowLayout, parent, false);
        return new ViewHolder(view);
    }

    // Bind data
    @Override
    public void onBindViewHolder(NewsAdapter.ViewHolder myHolder, final int i) {

        sId = news.get(i).getId().toString();
        sTitles = news.get(i).getNewsTitle().toString();
        sSubTitles = news.get(i).getNewsTitle().toString();
        sDesc = news.get(i).getNewsHeader().toString();
        sImage = news.get(i).getNewsImage().toString();
        sDetails = news.get(i).getNewsDetail().toString();

        myHolder.newsId.setText(sId);
        myHolder.tvTitles.setText(sTitles);
        myHolder.tvSubTitles.setText(sSubTitles);
        myHolder.tvDesc.setText(sDesc);
        myHolder.tvNewsDetail.setText(sDetails);

        // load image into imageview using glide
        Glide.with(context).load(sImage)
                .placeholder(R.drawable.ic_error)
                .error(R.drawable.ic_error)
                .into(myHolder.ivImage);

    }

    // return total item from List
    @Override
    public int getItemCount() {
//        return android.size();
        int a;

        if (news != null && !news.isEmpty()) {

            a = news.size();
        } else {

            a = 0;

        }

        return a;
    }


    public class ViewHolder extends RecyclerView.ViewHolder implements View.OnClickListener{

        TextView newsId, tvTitles, tvSubTitles, tvDesc, tvReadMore, tvNewsDetail;
        ImageView ivImage;

        // create constructor to get widget reference
        public ViewHolder(View itemView) {
            super(itemView);
//            itemView.setOnClickListener(this);
            newsId = (TextView) itemView.findViewById(R.id.tvId);
            tvTitles = (TextView) itemView.findViewById(R.id.tvTitles);
            tvSubTitles = (TextView) itemView.findViewById(R.id.tvSubTitles);
            tvDesc = (TextView) itemView.findViewById(R.id.tvDesc);
            tvReadMore = (TextView) itemView.findViewById(R.id.tvReadMore);
            tvReadMore.setOnClickListener(this);
            ivImage = (ImageView) itemView.findViewById(R.id.ivImage);
            tvNewsDetail = (TextView) itemView.findViewById(R.id.tvNewsDetail);
        }

        @Override
        public void onClick(View v) {
//            ProgressDialog pDialog = new ProgressDialog(context);
//            pDialog.setMessage("Load data ...");
//            pDialog.show();
            int i = getAdapterPosition();
            sTitles = news.get(i).getNewsTitle().toString();
            sImage = news.get(i).getNewsImage().toString();
            sDetails = news.get(i).getNewsDetail().toString();

            Intent intent = new Intent(context, NewsDetailActivity.class);
            Prefs.putString("news_detail_titles",sTitles);
            Prefs.putString("news_detail_images",sImage);
            Prefs.putString("news_detail_details",sDetails);
            intent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK);
            intent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
            context.startActivity(intent);
        }
    }

    private boolean validate(EditText[] fields) {
        for (int i = 0; i < fields.length; i++) {
            EditText currentField = fields[i];
            if (currentField.getText().toString().length() <= 0) {
                Toast.makeText(context, "Please fill all field", Toast.LENGTH_SHORT).show();
                return false;
            }
        }
        return true;
    }
}