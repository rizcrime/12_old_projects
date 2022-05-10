package com.simwaspihk.activity;

import android.os.Bundle;
import android.support.v4.app.FragmentActivity;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.view.MenuItem;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;
import com.bumptech.glide.Glide;
import com.pixplicity.easyprefs.library.Prefs;
import com.simwaspihk.R;

public class NewsDetailActivity extends AppCompatActivity {
    ImageView ivNewsDetail;
    Toolbar toolbar;
    TextView tvNewsDetail;

    /* Access modifiers changed, original: protected */
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView((int) R.layout.activity_news_detail);
        this.toolbar = (Toolbar) findViewById(R.id.toolbar);
        this.tvNewsDetail = (TextView) findViewById(R.id.tvNewsDetail);
        this.tvNewsDetail.setText(Prefs.getString("news_detail_details", ""));
        this.ivNewsDetail = (ImageView) findViewById(R.id.ivNewsDetail);
        this.ivNewsDetail.setOnClickListener(new OnClickListener() {
            public void onClick(View view) {
                Toast.makeText(NewsDetailActivity.this, Prefs.getString("news_detail_images", ""), 0).show();
            }
        });
        Glide.with((FragmentActivity) this).load(Prefs.getString("news_detail_images", "")).placeholder((int) R.drawable.ic_error).error((int) R.drawable.ic_error).into(this.ivNewsDetail);
        setSupportActionBar(this.toolbar);
        getSupportActionBar().setHomeButtonEnabled(true);
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        getSupportActionBar().setTitle(Prefs.getString("news_detail_titles", ""));
    }

    public boolean onOptionsItemSelected(MenuItem item) {
        if (item.getItemId() != 16908332) {
            return super.onOptionsItemSelected(item);
        }
        onBackPressed();
        return true;
    }
}
