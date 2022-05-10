package com.simwaspihk.adapter;

import android.content.Context;
import android.content.Intent;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import com.simwaspihk.R;
import com.simwaspihk.activity.Rpt;
import com.simwaspihk.data.remote.api.ApiServices;
import com.simwaspihk.data.remote.api.model.rpt.DataItem;
import com.simwaspihk.data.remote.api.model.rpt.delete.ResponseDeleteRpt;
import com.simwaspihk.other.Utils;

import java.util.List;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

/**
 * Created by creatorbe on 6/6/17.
 */

public class RptAdapter extends RecyclerView.Adapter<RptAdapter.ViewHolder> {

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

    private List<DataItem> rpt;
    private int rowLayout;
    Context context;

    String rptId, planTgl, planPukul, planFlight, planJumlah, bandara, tgl, pukul, flight, jumlah, bandaraTransit,
            pria, wanita, sakit, lain, noUrut, rptUserId, rptName;


    // create constructor to innitilize context and data sent from MainActivity
    public RptAdapter(List<DataItem> rpt, int rowLayout, Context context) {
        this.rpt = rpt;
        this.rowLayout = rowLayout;
        this.context = context;
    }

    // Inflate the layout when viewholder created
    @Override
    public RptAdapter.ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(parent.getContext()).inflate(rowLayout, parent, false);
        return new ViewHolder(view);
    }

    // Bind data
    @Override
    public void onBindViewHolder(RptAdapter.ViewHolder myHolder, final int i) {

        rptId = rpt.get(i).getId().toString();
        planTgl = rpt.get(i).getPlanTanggal().toString();
        planPukul = rpt.get(i).getPlanPukul().toString();
        planFlight = rpt.get(i).getPlanFlight().toString();
        planJumlah = rpt.get(i).getPlanJumlah().toString();
        bandara = rpt.get(i).getBandara().toString();
        tgl = rpt.get(i).getTanggal().toString();
        pukul = rpt.get(i).getPukul().toString();
        flight = rpt.get(i).getNoFlight().toString();
        jumlah = rpt.get(i).getJumlah().toString();
        bandaraTransit = rpt.get(i).getBandaraTransit().toString();
        pria = rpt.get(i).getPria().toString();
        wanita = rpt.get(i).getWanita().toString();
        sakit = rpt.get(i).getSakit().toString();
        lain = rpt.get(i).getLain().toString();
        noUrut = rpt.get(i).getNoUrut().toString();

        myHolder.etRencanaTgl.setText(planTgl);
        myHolder.etRencanaPukul.setText(planPukul);
        myHolder.etRencanaFlight.setText(planFlight);
        myHolder.etRencanaJumlah.setText(planJumlah);
        myHolder.etRencanaBandara.setText(bandara);

        myHolder.etAktualTgl.setText(tgl);
        myHolder.etAktualPukul.setText(pukul);
        myHolder.etAktualFlight.setText(flight);
        myHolder.etAktualJumlah.setText(jumlah);
        myHolder.etAktualBandara.setText(bandaraTransit);

        myHolder.etPria.setText(pria);
        myHolder.etWanita.setText(wanita);
        myHolder.etSakit.setText(sakit);
        myHolder.etLain.setText(lain);

        myHolder.tvNoUrut.setText("No Urut : " + noUrut);

        myHolder.etRptId.setText(rptId);

        // load image into imageview using glide
//        Glide.with(context).load("http://192.168.1.7/test/images/" + current.fishImage)
//                .placeholder(R.drawable.ic_img_error)
//                .error(R.drawable.ic_img_error)
//                .into(myHolder.ivFish);

    }

    // return total item from List
    @Override
    public int getItemCount() {
//        return android.size();
        int a;

        if (rpt != null && !rpt.isEmpty()) {

            a = rpt.size();
        } else {

            a = 0;

        }

        return a;
    }


    public class ViewHolder extends RecyclerView.ViewHolder {

        EditText etRencanaTgl, etRencanaPukul, etRencanaFlight, etRencanaJumlah, etRencanaBandara,
                etAktualTgl, etAktualPukul, etAktualFlight, etAktualJumlah, etAktualBandara,
                etPria, etWanita, etSakit, etLain, etRptId;

        TextView tvNoUrut;

        Button btnUpdate, btnDelete;

        ApiServices mBas;

        // create constructor to get widget reference
        public ViewHolder(View itemView) {
            super(itemView);
            mBas = Utils.getBAS();
//            itemView.setOnClickListener(this);
            etRencanaTgl = (EditText) itemView.findViewById(R.id.etRencanaTgl);
            etRencanaPukul = (EditText) itemView.findViewById(R.id.etRencanaPukul);
            etRencanaFlight = (EditText) itemView.findViewById(R.id.etRencanaFlight);
            etRencanaJumlah = (EditText) itemView.findViewById(R.id.etRencanaJumlah);
            etRencanaBandara = (EditText) itemView.findViewById(R.id.etRencanaBandara);

            etAktualTgl = (EditText) itemView.findViewById(R.id.etAktualTgl);
            etAktualPukul = (EditText) itemView.findViewById(R.id.etAktualPukul);
            etAktualFlight = (EditText) itemView.findViewById(R.id.etAktualFlight);
            etAktualJumlah = (EditText) itemView.findViewById(R.id.etAktualJumlah);
            etAktualBandara = (EditText) itemView.findViewById(R.id.etAktualBandara);

            etPria = (EditText) itemView.findViewById(R.id.etPria);
            etWanita = (EditText) itemView.findViewById(R.id.etWanita);
            etSakit = (EditText) itemView.findViewById(R.id.etSakit);
            etLain = (EditText) itemView.findViewById(R.id.etLain);

            etRptId = (EditText) itemView.findViewById(R.id.etRptId);

            tvNoUrut = (TextView) itemView.findViewById(R.id.tvNoUrut);

            btnUpdate = (Button) itemView.findViewById(R.id.btnUpdate);
            btnUpdate.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {

//                    boolean fieldsOK = validate(new EditText[]{etRencanaTgl, etRencanaPukul,
//                            etRencanaFlight,
//                            etRencanaJumlah,
//                            etRencanaBandara,
//                            etAktualTgl,
//                            etAktualPukul,
//                            etAktualFlight,
//                            etAktualJumlah,
//                            etAktualBandara,
//                            etPria,
//                            etWanita,
//                            etSakit,
//                            etLain});
//                    if (fieldsOK) {
//                        final ProgressDialog pDialog = ProgressDialog.show(context, "Please Wait...",
//                                "Updating Data", false, false);
                    mBas.rptUpdate(etRptId.getText().toString(),
                            etRencanaTgl.getText().toString(),
                            etRencanaPukul.getText().toString(),
                            etRencanaFlight.getText().toString(),
                            etRencanaJumlah.getText().toString(),
                            etRencanaBandara.getText().toString(),
                            etAktualTgl.getText().toString(),
                            etAktualPukul.getText().toString(),
                            etAktualFlight.getText().toString(),
                            etAktualJumlah.getText().toString(),
                            etAktualBandara.getText().toString(),
                            etPria.getText().toString(),
                            etWanita.getText().toString(),
                            etSakit.getText().toString(),
                            etLain.getText().toString()).enqueue(new Callback<ResponseDeleteRpt>() {
                        @Override
                        public void onResponse(Call<ResponseDeleteRpt> call, Response<ResponseDeleteRpt> response) {
//                                pDialog.dismiss();
                            String returns = response.body().getStatus();
                            if (response.isSuccessful()) {
                                if (returns.equals("Success")) {
                                    Toast.makeText(context, returns, Toast.LENGTH_SHORT).show();
//                                        context.startActivity(new Intent(context, Rpt.class));
                                    Intent i = new Intent(context, Rpt.class);
                                    i.addFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
                                    context.startActivity(i);
                                } else {
                                    Toast.makeText(context, returns, Toast.LENGTH_SHORT).show();
                                }

                            } else {
                                Toast.makeText(context, returns, Toast.LENGTH_SHORT).show();
                            }
                        }

                        @Override
                        public void onFailure(Call<ResponseDeleteRpt> call, Throwable t) {
//                                pDialog.dismiss();
                            Toast.makeText(context, t.getMessage().toString(), Toast.LENGTH_SHORT).show();
                        }
                    });
//                    }
                }
            });

            btnDelete = (Button) itemView.findViewById(R.id.btnDelete);
            btnDelete.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {
//                    final ProgressDialog pDialog = ProgressDialog.show(context, "Please Wait...",
//                            "Updating Data", false, false);
                    mBas.rptDelete(etRptId.getText().toString()).enqueue(new Callback<ResponseDeleteRpt>() {
                        @Override
                        public void onResponse(Call<ResponseDeleteRpt> call, Response<ResponseDeleteRpt> response) {
//                            pDialog.dismiss();
                            if (response.isSuccessful()) {
                                String returns = response.body().getStatus().toString();
                                if (returns.equals("Success")) {
                                    Toast.makeText(context, returns, Toast.LENGTH_SHORT).show();
                                    Intent i = new Intent(context, Rpt.class);
                                    i.addFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
                                    context.startActivity(i);
                                } else {
                                    Toast.makeText(context, returns, Toast.LENGTH_SHORT).show();
                                }
                            } else {
                                Toast.makeText(context, response.message().toString(), Toast.LENGTH_SHORT).show();
                            }
                        }

                        @Override
                        public void onFailure(Call<ResponseDeleteRpt> call, Throwable t) {
//                            pDialog.dismiss();
                            Toast.makeText(context, t.getMessage().toString(), Toast.LENGTH_SHORT).show();
                        }
                    });
                }
            });
        }

//        @Override
//        public void onClick(View v) {
////            ProgressDialog pDialog = new ProgressDialog(context);
////            pDialog.setMessage("Load data ...");
////            pDialog.show();
//            int i = getAdapterPosition();
//            rptId = rpt.get(i).getId().toString();
//            planTgl = rpt.get(i).getPlanTanggal().toString();
//            planPukul = rpt.get(i).getPlanPukul().toString();
//            planFlight = rpt.get(i).getPlanFlight().toString();
//            planJumlah = rpt.get(i).getPlanJumlah().toString();
//            bandara = rpt.get(i).getBandara().toString();
//            tgl = rpt.get(i).getTanggal().toString();
//            pukul = rpt.get(i).getPukul().toString();
//            flight = rpt.get(i).getNoFlight().toString();
//            jumlah = rpt.get(i).getJumlah().toString();
//            bandaraTransit = rpt.get(i).getBandaraTransit().toString();
//            pria = rpt.get(i).getPria().toString();
//            wanita = rpt.get(i).getWanita().toString();
//            sakit = rpt.get(i).getSakit().toString();
//            lain = rpt.get(i).getLain().toString();
//            noUrut = rpt.get(i).getNoUrut().toString();
//            rptUserId = rpt.get(i).getUserId().toString();
//            rptName = rpt.get(i).getName().toString();
//
//            Intent intent = new Intent(context, RptInsertActivity.class);
//            Prefs.putString("rptId",rptId);
//            Prefs.putString("planTgl",planTgl);
//            Prefs.putString("planPukul",planPukul);
//            Prefs.putString("planFlight",planFlight);
//            Prefs.putString("planJumlah",planJumlah);
//            Prefs.putString("bandara",bandara);
//            Prefs.putString("tgl",tgl);
//            Prefs.putString("pukul",pukul);
//            Prefs.putString("flight",flight);
//            Prefs.putString("jumlah",jumlah);
//            Prefs.putString("bandaraTransit",bandaraTransit);
//            Prefs.putString("pria",pria);
//            Prefs.putString("wanita",wanita);
//            Prefs.putString("sakit",sakit);
//            Prefs.putString("lain",lain);
//            Prefs.putString("noUrut",noUrut);
//            Prefs.putString("rptUserId",rptUserId);
//            Prefs.putString("rptName",rptName);
//            intent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK);
//            intent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
//            context.startActivity(intent);
//        }
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