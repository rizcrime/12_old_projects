import 'package:flutter/material.dart';
import 'package:flutter_esdm/blocs/global_bloc.dart';
import 'package:flutter_esdm/blocs/update_harian_esdm/update_harian_esdm_bloc.dart';
import 'package:flutter_esdm/models/LapPusdatinBeritaOpecHarian.dart';
import 'package:flutter_esdm/models/LapPusdatinHargaBbAcuan.dart';
import 'package:flutter_esdm/models/LapPusdatinHargaBbm.dart';
import 'package:flutter_esdm/models/LapPusdatinHargaMineralAcuan.dart';
import 'package:flutter_esdm/models/LapPusdatinIcp.dart';
import 'package:flutter_esdm/models/LapPusdatinLiftTb.dart';
import 'package:flutter_esdm/models/LapPusdatinProdEkuiMigas.dart';
import 'package:flutter_esdm/models/LapPusdatinProdGas.dart';
import 'package:flutter_esdm/models/LapPusdatinProdMinyak.dart';
import 'package:flutter_esdm/models/LapPusdatinProgPenyPremJamali.dart';
import 'package:flutter_esdm/models/LapPusdatinSttsTl.dart';
import 'package:flutter_esdm/utils/global_function.dart';
import 'package:flutter_esdm/widget/accordion_widget.dart';
import 'package:flutter_esdm/widget/card_widget.dart';
import 'package:flutter_esdm/widget/date_picker_widget.dart';
import 'package:flutter_esdm/widget/loading_widget.dart';
class UpdateHarianESDMPage extends StatelessWidget {

  @override
  Widget build(BuildContext context) {
    GlobalBloc globalBloc = GlobalBloc();
    GlobalKey<ScaffoldState> _key = GlobalKey<ScaffoldState>();
    globalBloc.setListExpandCount(10);
    UpdateHarianESDMBloc updateHarianESDMBloc = new UpdateHarianESDMBloc(key:_key);
    return Stack(
      children: <Widget>[
        Scaffold(
          key: _key,
          appBar: AppBar(
            // automaticallyImplyLeading: false, // Don't show the leading button
            title: Text("Update Harian ESDM",style: TextStyle(color: Colors.white),),
            backgroundColor: Colors.black,
          ),
          body: ListView(
            children: <Widget>[
              AccordionWidget(0,globalBloc,"PRODUKSI MINYAK",
                Column(
                  children: <Widget>[
                    // DatePickerWidget(onChange: (DateTime date){
                    //   updateHarianESDMBloc.onChange("lap_pusdatin_prod_minyak", date);
                    // }),
                    StreamBuilder(
                      stream: updateHarianESDMBloc.lapPusdatinProdMinyakStream,
                      builder: (context, AsyncSnapshot<LapPusdatinProdMinyak> snapshot) {
                        if (snapshot.hasData) {
                          var data = snapshot.data;
                          if (["",null].contains(data.idLaporan)) return Container();
                          return Column(
                            children: <Widget>[
                              CardWidget("Tanggal : ",data.tanggalLaporan.toString()),
                              CardWidget(
                                "Produksi Harian : ",
                                "${GlobalFunction.withNumberFormat(data.prodHarian)} BOPD(${int.parse(data.prodHarian) < int.parse(data.apbn) ? "Belum" : "Sudah"} Tercapai)",
                                statusColor: int.parse(data.prodHarian) < int.parse(data.apbn) ? Colors.red : Colors.green),
                              CardWidget(
                                "Produksi Bulanan : ",
                                "${GlobalFunction.withNumberFormat(data.prodBulanan)} BOPD(${int.parse(data.prodBulanan) < int.parse(data.apbn) ? "Belum" : "Sudah"} Tercapai)",
                                statusColor: int.parse(data.prodBulanan) < int.parse(data.apbn) ? Colors.red : Colors.green),
                              CardWidget("Produksi Tahunan : ",
                                "${GlobalFunction.withNumberFormat(data.prodTahunan)} BOPD(${int.parse(data.prodTahunan) < int.parse(data.apbn) ? "Belum" : "Sudah"} Tercapai)",
                                statusColor: int.parse(data.prodTahunan) < int.parse(data.apbn) ? Colors.red : Colors.green),
                              CardWidget("Target APBN : ","${GlobalFunction.withNumberFormat(data.apbn)} BOPD",statusColor: Colors.black,),
                            ],
                          );
                        }
                        return Container();
                      }),
                  ],
                )
              ),
              AccordionWidget(1,globalBloc,"ICP",
                Column(
                  children: <Widget>[
                    // DatePickerWidget(onChange: (DateTime date){
                    //   updateHarianESDMBloc.onChange("lap_pusdatin_icp", date);
                    // }),
                    StreamBuilder(
                      stream: updateHarianESDMBloc.lapPusdatinIcpStream,
                      builder: (context, AsyncSnapshot<LapPusdatinIcp> snapshot) {
                        if (snapshot.hasData) {
                          var data = snapshot.data;
                          if (["",null].contains(data.idLaporan)) return Container();
                          return Column(
                            children: <Widget>[
                              CardWidget("Tanggal : ",data.tanggalLaporan.toString()),
                              CardWidget("Keterangan : ",data.keterangan),
                            ],
                          );
                        }
                        return Container();
                      }),
                  ],
                )
              ),
              AccordionWidget(2,globalBloc,"PRODUKSI GAS",
                Column(
                  children: <Widget>[
                    // DatePickerWidget(onChange: (DateTime date){
                    //   updateHarianESDMBloc.onChange("lap_pusdatin_prod_gas", date);
                    // }),
                    StreamBuilder(
                      stream: updateHarianESDMBloc.lapPusdatinProdGasStream,
                      builder: (context, AsyncSnapshot<LapPusdatinProdGas> snapshot) {
                        if (snapshot.hasData) {
                          var data = snapshot.data;
                          if (["",null].contains(data.idLaporan)) return Container();
                          print(data.toJson());
                          return Column(
                            children: <Widget>[
                              CardWidget("Tanggal : ",data.tanggalLaporan.toString()),
                              CardWidget(
                                "Produksi Harian : ",
                                "${GlobalFunction.withNumberFormat(data.prodHarian)} BOPD(${int.parse(data.prodHarian) < int.parse(data.apbn) ? "Belum" : "Sudah"} Tercapai)",
                                statusColor: int.parse(data.prodHarian) < int.parse(data.apbn) ? Colors.red : Colors.green),
                              CardWidget(
                                "Produksi Bulanan : ",
                                "${GlobalFunction.withNumberFormat(data.prodBulanan)} BOPD(${int.parse(data.prodBulanan) < int.parse(data.apbn) ? "Belum" : "Sudah"} Tercapai)",
                                statusColor: int.parse(data.prodBulanan) < int.parse(data.apbn) ? Colors.red : Colors.green),
                              CardWidget("Produksi Tahunan : ",
                                "${GlobalFunction.withNumberFormat(data.prodTahunan)} BOPD(${int.parse(data.prodTahunan) < int.parse(data.apbn) ? "Belum" : "Sudah"} Tercapai)",
                                statusColor: int.parse(data.prodTahunan) < int.parse(data.apbn) ? Colors.red : Colors.green),
                              CardWidget("Target APBN : ","${GlobalFunction.withNumberFormat(data.apbn)} BOPD",statusColor: Colors.black,),
                            ],
                          );
                        }
                        return Container();
                      }),
                  ],
                )
              ),
              AccordionWidget(3,globalBloc,"PRODUKSI EKUIVALEN MINYAK DAN GAS",
                Column(
                  children: <Widget>[
                    // DatePickerWidget(onChange: (DateTime date){
                    //   updateHarianESDMBloc.onChange("lap_pusdatin_prod_ekui_migas", date);
                    // }),
                    StreamBuilder(
                      stream: updateHarianESDMBloc.lapPusdatinProdEkuiMigasStream,
                      builder: (context, AsyncSnapshot<LapPusdatinProdEkuiMigas> snapshot) {
                        if (snapshot.hasData) {
                          var data = snapshot.data;
                          if (["",null].contains(data.idLaporan)) return Container();
                          return Column(
                            children: <Widget>[
                              CardWidget("Tanggal : ",data.tanggalLaporan.toString()),
                              CardWidget(
                                "Produksi Harian : ",
                                "${GlobalFunction.withNumberFormat(data.prodHarian)} BOPD(${int.parse(data.prodHarian) < int.parse(data.apbn) ? "Belum" : "Sudah"} Tercapai)",
                                statusColor: int.parse(data.prodHarian) < int.parse(data.apbn) ? Colors.red : Colors.green),
                              CardWidget(
                                "Produksi Bulanan : ",
                                "${GlobalFunction.withNumberFormat(data.prodBulanan)} BOPD(${int.parse(data.prodBulanan) < int.parse(data.apbn) ? "Belum" : "Sudah"} Tercapai)",
                                statusColor: int.parse(data.prodBulanan) < int.parse(data.apbn) ? Colors.red : Colors.green),
                              CardWidget("Produksi Tahunan : ",
                                "${GlobalFunction.withNumberFormat(data.prodTahunan)} BOPD(${int.parse(data.prodTahunan) < int.parse(data.apbn) ? "Belum" : "Sudah"} Tercapai)",
                                statusColor: int.parse(data.prodTahunan) < int.parse(data.apbn) ? Colors.red : Colors.green),
                              CardWidget("Target APBN : ","${GlobalFunction.withNumberFormat(data.apbn)} BOPD",statusColor: Colors.black,),
                            ],
                          );
                        }
                        return Container();
                      }),
                  ],
                )
              ),
              AccordionWidget(4,globalBloc,"LIFTING TAHUN BERJALAN",
                Column(
                  children: <Widget>[
                    // DatePickerWidget(onChange: (DateTime date){
                    //   updateHarianESDMBloc.onChange("lap_pusdatin_lift_tb", date);
                    // }),
                    StreamBuilder(
                      stream: updateHarianESDMBloc.lapPusdatinLiftTbStream,
                      builder: (context, AsyncSnapshot<LapPusdatinLiftTb> snapshot) {
                        if (snapshot.hasData) {
                          var data = snapshot.data;
                          if (["",null].contains(data.idLaporan)) return Container();
                          return Column(
                            children: <Widget>[
                              CardWidget("Tanggal : ",data.tanggalLaporan.toString()),
                              CardWidget("Lifting Minyak Bumi : ",data.liftMb),
                              CardWidget("Posisi Stock hari ini : ",data.posisiStock),
                              CardWidget("Saluran Gas : ",data.salurGas),
                            ],
                          );
                        }
                        return Container();
                      }),
                  ],
                )
              ),
              AccordionWidget(5,globalBloc,"HARGA BBM",
                Column(
                  children: <Widget>[
                    // DatePickerWidget(onChange: (DateTime date){
                    //   updateHarianESDMBloc.onChange("lap_pusdatin_harga_bbm", date);
                    // }),
                    StreamBuilder(
                      stream: updateHarianESDMBloc.lapPusdatinHargaBbmStream,
                      builder: (context, AsyncSnapshot<LapPusdatinHargaBbm> snapshot) {
                        if (snapshot.hasData) {
                          var data = snapshot.data;
                          if (["",null].contains(data.idLaporan)) return Container();
                          return Column(
                            children: <Widget>[
                              CardWidget("Tanggal : ",data.tanggalLaporan.toString()),
                              CardWidget("Jenis Tertentu : ",data.jenisTertentu),
                              CardWidget("BBM Umum : ",data.bbmUmum),
                              CardWidget("Program Indonesia Satu Harga : ",data.progIndSatuHrg),
                              CardWidget("Harga Per-negara : ",data.hargaPernegara),
                            ],
                          );
                        }
                        return Container();
                      }),
                  ],
                )
              ),
              AccordionWidget(6,globalBloc,"BERITA OPEC HARIAN",
                Column(
                  children: <Widget>[
                    // DatePickerWidget(onChange: (DateTime date){
                    //   updateHarianESDMBloc.onChange("lap_pusdatin_berita_opec_harian", date);
                    // }),
                    StreamBuilder(
                      stream: updateHarianESDMBloc.lapPusdatinBeritaOpecHarianStream,
                      builder: (context, AsyncSnapshot<LapPusdatinBeritaOpecHarian> snapshot) {
                        if (snapshot.hasData) {
                          var data = snapshot.data;
                          if (["",null].contains(data.idLaporan)) return Container();
                          return Column(
                            children: <Widget>[
                              CardWidget("Tanggal : ",data.tanggalLaporan.toString()),
                              CardWidget("Berita : ",data.berita), 
                            ],
                          );
                        }
                        return Container();
                      }),
                  ],
                )
              ),
              AccordionWidget(7,globalBloc,"HARGA BATU BARA ACUAN",
                Column(
                  children: <Widget>[
                    // DatePickerWidget(onChange: (DateTime date){
                    //   updateHarianESDMBloc.onChange("lap_pusdatin_harga_bb_acuan", date);
                    // }),
                    StreamBuilder(
                      stream: updateHarianESDMBloc.lapPusdatinHargaBbAcuanStream,
                      builder: (context, AsyncSnapshot<LapPusdatinHargaBbAcuan> snapshot) {
                        if (snapshot.hasData) {
                          var data = snapshot.data;
                          if (["",null].contains(data.idLaporan)) return Container();
                          return Column(
                            children: <Widget>[
                              CardWidget("Tanggal : ",data.tanggalLaporan.toString()),
                              CardWidget("Harga : ",data.harga), 
                              CardWidget("Sumber : ",data.sumber),  
                            ],
                          );
                        }
                        return Container();
                      }),
                  ],
                )
              ),
              AccordionWidget(8,globalBloc,"HARGA MINERAL ACUAN",
                Column(
                  children: <Widget>[
                    // DatePickerWidget(onChange: (DateTime date){
                    //   updateHarianESDMBloc.onChange("lap_pusdatin_harga_mineral_acuan", date);
                    // }),
                    StreamBuilder(
                      stream: updateHarianESDMBloc.lapPusdatinHargaMineralAcuanStream,
                      builder: (context, AsyncSnapshot<LapPusdatinHargaMineralAcuan> snapshot) {
                        if (snapshot.hasData) {
                          var data = snapshot.data;
                          if (["",null].contains(data.idLaporan)) return Container();
                          return Column(
                            children: <Widget>[
                              CardWidget("Tanggal : ",data.tanggalLaporan.toString()),
                              CardWidget("Harga : ",data.harga), 
                              CardWidget("Sumber : ",data.sumber),  
                            ],
                          );
                        }
                        return Container();
                      }),
                  ],
                )
              ),
              AccordionWidget(9,globalBloc,"STATUS KETENAGALISTRIKAN",
                Column(
                  children: <Widget>[
                    // DatePickerWidget(onChange: (DateTime date){
                    //   updateHarianESDMBloc.onChange("lap_pusdatin_stts_tl", date);
                    // }),
                    StreamBuilder(
                      stream: updateHarianESDMBloc.lapPusdatinSttsTlStream,
                      builder: (context, AsyncSnapshot<LapPusdatinSttsTl> snapshot) {
                        if (snapshot.hasData) {
                          var data = snapshot.data;
                          if (["",null].contains(data.idLaporan)) return Container();
                          return Column(
                            children: <Widget>[
                              CardWidget("Tanggal : ",data.tanggalLaporan.toString()),
                              CardWidget("Status : ",data.status),  
                            ],
                          );
                        }
                        return Container();
                      }),
                  ],
                )
              ),
            ],
          ),
        ),
        StreamBuilder(
          initialData: false,
          stream: updateHarianESDMBloc.loadingStream,
          builder: (BuildContext ctx, AsyncSnapshot<bool> snapshot) {
            return LoadingWidget(snapshot.data);
          }),
      ],
    );
  }
}