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
import com.simwaspihk.activity.AdminTravelInsertActivity;
import com.simwaspihk.data.remote.api.model.travel.TravelData;
import java.util.List;

public class TravelAdapter extends Adapter<TravelAdapter.HolderData> {
    private Context ctx;
    private List<TravelData> mList;

    class HolderData extends ViewHolder {
        TravelData dm;
        private TextView kodePihk;
        private TextView namaPimpinan;
        private TextView name;

        public HolderData(View v) {
            super(v);
            this.name = (TextView) v.findViewById(R.id.tvName);
            this.kodePihk = (TextView) v.findViewById(R.id.tvKodePihk);
            this.namaPimpinan = (TextView) v.findViewById(R.id.tvNamaPimpinan);
            v.setOnClickListener(new OnClickListener() {
                public void onClick(View v) {
                    Intent goInput = new Intent(TravelAdapter.this.ctx, AdminTravelInsertActivity.class);
                    goInput.putExtra("user_id", HolderData.this.dm.getUserId());
                    goInput.putExtra("users_id", HolderData.this.dm.getUsersId());
                    goInput.putExtra("status", HolderData.this.dm.getStatus());
                    goInput.putExtra("name", HolderData.this.dm.getName());
                    goInput.putExtra("nama_pimpinan", HolderData.this.dm.getNamaPimpinan());
                    goInput.putExtra("email", HolderData.this.dm.getEmail());
                    goInput.putExtra("profile_pic", HolderData.this.dm.getProfilePic());
                    goInput.putExtra("user_type", HolderData.this.dm.getUserType());
                    goInput.putExtra("jml_jamaah", HolderData.this.dm.getJmlJamaah());
                    goInput.putExtra("no_hp", HolderData.this.dm.getNoHp());
                    goInput.putExtra("alamat", HolderData.this.dm.getAlamat());
                    goInput.putExtra("no_telp", HolderData.this.dm.getNoTelp());
                    goInput.putExtra("no_sk", HolderData.this.dm.getNoSk());
                    goInput.putExtra("masa_berlaku", HolderData.this.dm.getMasaBerlaku());
                    goInput.putExtra("tgl_berangkat", HolderData.this.dm.getTglBerangkat());
                    goInput.putExtra("tgl_pulang", HolderData.this.dm.getTglPulang());
                    goInput.putExtra("nm_petugas_kemenag", HolderData.this.dm.getNmPetugasKemenag());
                    goInput.putExtra("tel_petugas_kemenag", HolderData.this.dm.getTelPetugasKemenag());
                    goInput.putExtra("nm_petugas_pihk", HolderData.this.dm.getNmPetugasPihk());
                    goInput.putExtra("tel_petugas_pihk", HolderData.this.dm.getTelPetugasPihk());
                    goInput.putExtra("nm_petugas_pembimbing", HolderData.this.dm.getNmPetugasPembimbing());
                    goInput.putExtra("tel_petugas_pembimbing", HolderData.this.dm.getTelPetugasPembimbing());
                    goInput.putExtra("nm_petugas_kes", HolderData.this.dm.getNmPetugasKes());
                    goInput.putExtra("tel_petugas_kes", HolderData.this.dm.getTelPetugasKes());
                    goInput.putExtra("hotel_makkah", HolderData.this.dm.getHotelMakkah());
                    goInput.putExtra("hotel_madinah", HolderData.this.dm.getHotelMadinah());
                    goInput.putExtra("hotel_jeddah", HolderData.this.dm.getHotelJeddah());
                    goInput.putExtra("hotel_transit", HolderData.this.dm.getHotelTransit());
                    goInput.putExtra("email_pihk", HolderData.this.dm.getEmailPihk());
                    goInput.putExtra("asosiasi", HolderData.this.dm.getAsosiasi());
                    goInput.putExtra("katering_makkah", HolderData.this.dm.getKateringMakkah());
                    goInput.putExtra("katering_madinah", HolderData.this.dm.getKateringMadinah());
                    goInput.putExtra("katering_jeddah", HolderData.this.dm.getKateringJeddah());
                    goInput.putExtra("katering_transit", HolderData.this.dm.getKateringTransit());
                    goInput.putExtra("transfortasi", HolderData.this.dm.getTransfortasi());
                    goInput.putExtra("harga_vip", HolderData.this.dm.getHargaVip());
                    goInput.putExtra("harga_standard", HolderData.this.dm.getHargaStandard());
                    goInput.putExtra("perwakilan_arab", HolderData.this.dm.getPerwakilanArab());
                    goInput.putExtra("tel_perwakilan_arab", HolderData.this.dm.getTelPerwakilanArab());
                    goInput.putExtra("rute_perjalanan", HolderData.this.dm.getRutePerjalanan());
                    goInput.putExtra("lama_penyelengaraan", HolderData.this.dm.getLamaPenyelengaraan());
                    goInput.putExtra("tinggal_jkt_sa_jkt", HolderData.this.dm.getTinggalJktSaJkt());
                    goInput.putExtra("tinggal_madinah", HolderData.this.dm.getTinggalMadinah());
                    goInput.putExtra("tinggal_makkah", HolderData.this.dm.getTinggalMakkah());
                    TravelAdapter.this.ctx.startActivity(goInput);
                }
            });
        }
    }

    public TravelAdapter(Context ctx, List<TravelData> mList) {
        this.ctx = ctx;
        this.mList = mList;
    }

    public HolderData onCreateViewHolder(ViewGroup parent, int viewType) {
        return new HolderData(LayoutInflater.from(parent.getContext()).inflate(R.layout.list_admin_travel, parent, false));
    }

    public void onBindViewHolder(HolderData holder, int position) {
        TravelData dm = (TravelData) this.mList.get(position);
        holder.name.setText(dm.getName());
        holder.namaPimpinan.setText(dm.getNamaPimpinan());
        holder.kodePihk.setText(dm.getKodePihk());
        holder.dm = dm;
    }

    public int getItemCount() {
        return this.mList.size();
    }
}
