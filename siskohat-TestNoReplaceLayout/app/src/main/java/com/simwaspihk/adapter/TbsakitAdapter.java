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
import com.simwaspihk.activity.TbsakitInsertActivity;
import com.simwaspihk.data.remote.api.model.tbsakit.DataTbsakit;
import java.util.List;

public class TbsakitAdapter extends Adapter<TbsakitAdapter.HolderData> {
    private Context ctx;
    private List<DataTbsakit> mList;

    class HolderData extends ViewHolder {
        DataTbsakit dm;
        private TextView namaJemaah;
        private TextView noPasport;
        private TextView tglRawat;

        public HolderData(View v) {
            super(v);
            this.namaJemaah = (TextView) v.findViewById(R.id.tvNamaJemaah);
            this.noPasport = (TextView) v.findViewById(R.id.tvNoPasport);
            this.tglRawat = (TextView) v.findViewById(R.id.tvTglRawat);
            v.setOnClickListener(new OnClickListener() {
                public void onClick(View v) {
                    Intent goInput = new Intent(TbsakitAdapter.this.ctx, TbsakitInsertActivity.class);
                    goInput.putExtra("id", HolderData.this.dm.getId());
                    goInput.putExtra("user_id", HolderData.this.dm.getUserId());
                    goInput.putExtra("no_pasport", HolderData.this.dm.getNoPasport());
                    goInput.putExtra("nama_jemaah", HolderData.this.dm.getNamaJemaah());
                    goInput.putExtra("tgl_lahir", HolderData.this.dm.getTglLahir());
                    goInput.putExtra("tgl_rawat", HolderData.this.dm.getTglRawat());
                    goInput.putExtra("rumah_sakit", HolderData.this.dm.getRumahSakit());
                    goInput.putExtra("sebab", HolderData.this.dm.getSebab());
                    goInput.putExtra("keterangan", HolderData.this.dm.getKeterangan());
                    TbsakitAdapter.this.ctx.startActivity(goInput);
                }
            });
        }
    }

    public TbsakitAdapter(Context ctx, List<DataTbsakit> mList) {
        this.ctx = ctx;
        this.mList = mList;
    }

    public HolderData onCreateViewHolder(ViewGroup parent, int viewType) {
        return new HolderData(LayoutInflater.from(parent.getContext()).inflate(R.layout.list_tbsakit, parent, false));
    }

    public void onBindViewHolder(HolderData holder, int position) {
        DataTbsakit dm = (DataTbsakit) this.mList.get(position);
        holder.noPasport.setText(dm.getNoPasport());
        holder.namaJemaah.setText(dm.getNamaJemaah());
        holder.tglRawat.setText(dm.getTglRawat());
        holder.dm = dm;
    }

    public int getItemCount() {
        return this.mList.size();
    }
}
