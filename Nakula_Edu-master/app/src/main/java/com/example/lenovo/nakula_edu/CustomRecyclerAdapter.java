package com.example.lenovo.nakula_edu;

import android.content.Context;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;
import android.widget.Toast;

import java.util.List;


public class CustomRecyclerAdapter extends RecyclerView.Adapter<CustomRecyclerAdapter.ViewHolder> {

    private Context context;
    private List<PersonUtils> personUtils;

    public CustomRecyclerAdapter(Context context, List personUtils) {
        this.context = context;
        this.personUtils = personUtils;
    }

    @Override
    public ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View v = LayoutInflater.from(parent.getContext()).inflate(R.layout.recyclerview_tagihan_pembayaran, parent, false);
        ViewHolder viewHolder = new ViewHolder(v);
        return viewHolder;
    }

    @Override
    public void onBindViewHolder(ViewHolder holder, int position) {
        holder.itemView.setTag(personUtils.get(position));

        PersonUtils pu = personUtils.get(position);

        holder.bulan.setText(pu.getBulan());
        holder.nominal.setText(pu.getNominal());
        holder.status.setText(pu.getStatus());

    }

    @Override
    public int getItemCount() {
        return personUtils.size();
    }

    public class ViewHolder extends RecyclerView.ViewHolder{

        public TextView bulan;
        public TextView nominal;
        public TextView status;

        public ViewHolder(View itemView) {
            super(itemView);

            bulan = (TextView) itemView.findViewById(R.id.bulan);
            nominal= (TextView) itemView.findViewById(R.id.nominal);
            status = (TextView) itemView.findViewById(R.id.status);

            itemView.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {
                    PersonUtils cpu = (PersonUtils) view.getTag();
                    Toast.makeText(view.getContext(), cpu.getBulan()+" "+cpu.getNominal()+" "+ cpu.getStatus(), Toast.LENGTH_SHORT).show();

                }
            });

        }
    }

}