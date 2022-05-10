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
import com.simwaspihk.activity.TbwafatInsertActivity;
import com.simwaspihk.data.remote.api.model.tbwafat.DataTbwafat;
import java.util.List;

public class TbwafatAdapter extends Adapter<TbwafatAdapter.HolderData> {
    private Context ctx;
    private List<DataTbwafat> mList;

    class HolderData extends ViewHolder {
        DataTbwafat dm;
        private TextView namaJemaah;
        private TextView noPasport;
        private TextView noPorsi;

        public HolderData(View v) {
            super(v);
            this.namaJemaah = (TextView) v.findViewById(R.id.tvNamaJemaah);
            this.noPasport = (TextView) v.findViewById(R.id.tvNoPasport);
            this.noPorsi = (TextView) v.findViewById(R.id.tvNoPorsi);
            v.setOnClickListener(new OnClickListener() {
                public void onClick(View v) {
                    Intent goInput = new Intent(TbwafatAdapter.this.ctx, TbwafatInsertActivity.class);
                    goInput.putExtra("id", HolderData.this.dm.getId());
                    goInput.putExtra("user_id", HolderData.this.dm.getUserId());
                    goInput.putExtra("no_pasport", HolderData.this.dm.getNoPasport());
                    goInput.putExtra("nama_jemaah", HolderData.this.dm.getNamaJemaah());
                    goInput.putExtra("tgl_lahir", HolderData.this.dm.getTglLahir());
                    goInput.putExtra("no_porsi", HolderData.this.dm.getNoPorsi());
                    goInput.putExtra("waktu", HolderData.this.dm.getWaktu());
                    goInput.putExtra("sebab", HolderData.this.dm.getSebab());
                    goInput.putExtra("keterangan", HolderData.this.dm.getKeterangan());
                    TbwafatAdapter.this.ctx.startActivity(goInput);
                }
            });
        }
    }

    public TbwafatAdapter(Context ctx, List<DataTbwafat> mList) {
        this.ctx = ctx;
        this.mList = mList;
    }

    public HolderData onCreateViewHolder(ViewGroup parent, int viewType) {
        return new HolderData(LayoutInflater.from(parent.getContext()).inflate(R.layout.list_tbwafat, parent, false));
    }

    public void onBindViewHolder(HolderData holder, int position) {
        DataTbwafat dm = (DataTbwafat) this.mList.get(position);
        holder.noPasport.setText(dm.getNoPasport());
        holder.namaJemaah.setText(dm.getNamaJemaah());
        holder.noPorsi.setText(dm.getNoPorsi());
        holder.dm = dm;
    }

    public int getItemCount() {
        return this.mList.size();
    }
}
