package com.simwaspihk.adapter;

import android.content.Context;
import android.content.Intent;
import android.support.v7.widget.RecyclerView.Adapter;
import android.support.v7.widget.RecyclerView.ViewHolder;
import android.view.LayoutInflater;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.ViewGroup;
import android.widget.TextView;
import com.simwaspihk.R;
import com.simwaspihk.activity.TbsaranInsertActivity;
import com.simwaspihk.data.remote.api.model.tbsaran.DataTbsaran;
import java.util.List;

public class TbsaranAdapter extends Adapter<TbsaranAdapter.HolderData> {
    private Context ctx;
    private List<DataTbsaran> mList;

    class HolderData extends ViewHolder {
        DataTbsaran dm;
        private TextView hambatan;
        private TextView name;

        public HolderData(View v) {
            super(v);
            this.name = (TextView) v.findViewById(R.id.tvName);
            this.hambatan = (TextView) v.findViewById(R.id.tvHambatan);
            v.setOnClickListener(new OnClickListener() {
                public void onClick(View v) {
                    Intent goInput = new Intent(TbsaranAdapter.this.ctx, TbsaranInsertActivity.class);
                    goInput.putExtra("id", HolderData.this.dm.getId());
                    goInput.putExtra("user_id", HolderData.this.dm.getUserId());
                    goInput.putExtra("name", HolderData.this.dm.getName());
                    goInput.putExtra("saran", HolderData.this.dm.getSaran());
                    goInput.putExtra("hambatan", HolderData.this.dm.getHambatan());
                    TbsaranAdapter.this.ctx.startActivity(goInput);
                }
            });
        }
    }

    public TbsaranAdapter(Context ctx, List<DataTbsaran> mList) {
        this.ctx = ctx;
        this.mList = mList;
    }

    public HolderData onCreateViewHolder(ViewGroup parent, int viewType) {
        return new HolderData(LayoutInflater.from(parent.getContext()).inflate(R.layout.list_tbsaran, parent, false));
    }

    public void onBindViewHolder(HolderData holder, int position) {
        DataTbsaran dm = (DataTbsaran) this.mList.get(position);
        holder.name.setText(dm.getName());
        holder.hambatan.setText(dm.getHambatan());
        holder.dm = dm;
    }

    public int getItemCount() {
        return this.mList.size();
    }
}
