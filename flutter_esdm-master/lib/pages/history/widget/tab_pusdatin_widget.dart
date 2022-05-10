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
import 'package:flutter_esdm/widget/nested_scrollable_widget.dart';
class TabPusdatinWidget extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    UpdateHarianESDMBloc updateHarianESDMBloc = new UpdateHarianESDMBloc();
    GlobalBloc globalBloc = GlobalBloc();
    globalBloc.setListExpandCount(10);
    return Stack(
      children: <Widget>[
        ListView(
          padding: EdgeInsets.zero,
          children: <Widget>[
            AccordionWidget(0,globalBloc,"PRODUKSI MINYAK",
              Column(
                children: <Widget>[
                  DatePickerWidget(onChange: (DateTime date){
                    updateHarianESDMBloc.onChange("lap_pusdatin_prod_minyak", date,isList: true);
                  }),
                  ConstrainedBox(
                    constraints: BoxConstraints(
                      minHeight: 0,
                      minWidth: MediaQuery.of(context).size.width,
                      maxHeight: 500,
                      maxWidth: MediaQuery.of(context).size.width
                    ),
                    child: StreamBuilder(
                      stream: updateHarianESDMBloc.listLapPusdatinProdMinyakStream,
                      builder: (context, AsyncSnapshot<List<LapPusdatinProdMinyak>> snapshot) {
                        if (snapshot.hasData) {
                          return NestedScrollableWidget(
                            padding: EdgeInsets.zero,
                            itemCount: snapshot.data.length,
                            itemBuilder: (ctx,i){
                              var data = snapshot.data[i];
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
                                  SizedBox(height: 20,)
                                ],
                              );
                            },
                          );
                        }
                        return Container();
                      }),
                  ),
                ],
              )
            ),
            AccordionWidget(1,globalBloc,"ICP",
              Column(
                children: <Widget>[
                  DatePickerWidget(onChange: (DateTime date){
                    updateHarianESDMBloc.onChange("lap_pusdatin_icp", date,isList: true);
                  }),
                  ConstrainedBox(
                    constraints: BoxConstraints(
                      minHeight: 0,
                      minWidth: MediaQuery.of(context).size.width,
                      maxHeight: 500,
                      maxWidth: MediaQuery.of(context).size.width
                    ),
                    child: StreamBuilder(
                      stream: updateHarianESDMBloc.listLapPusdatinIcpStream,
                      builder: (context, AsyncSnapshot<List<LapPusdatinIcp>> snapshot) {
                        if (snapshot.hasData) {
                          return NestedScrollableWidget(
                            padding: EdgeInsets.zero,
                            itemCount: snapshot.data.length,
                            itemBuilder: (ctx,i){
                              var data = snapshot.data[i];
                              if (["",null].contains(data.idLaporan)) return Container();
                              return Column(
                                children: <Widget>[
                                  CardWidget("Tanggal : ",data.tanggalLaporan.toString()),
                                  CardWidget("Keterangan : ",data.keterangan),
                                  SizedBox(height: 20,)
                                ],
                              );
                            },
                          );
                        }
                        return Container();
                      }),
                  ),
                ],
              )
            ),
            AccordionWidget(2,globalBloc,"PRODUKSI GAS",
              Column(
                children: <Widget>[
                  DatePickerWidget(onChange: (DateTime date){
                    updateHarianESDMBloc.onChange("lap_pusdatin_prod_gas", date,isList: true);
                  }),
                  ConstrainedBox(
                    constraints: BoxConstraints(
                      minHeight: 0,
                      minWidth: MediaQuery.of(context).size.width,
                      maxHeight: 500,
                      maxWidth: MediaQuery.of(context).size.width
                    ),
                    child: StreamBuilder(
                      stream: updateHarianESDMBloc.listLapPusdatinProdGasStream,
                      builder: (context, AsyncSnapshot<List<LapPusdatinProdGas>> snapshot) {
                        if (snapshot.hasData) {
                          return NestedScrollableWidget(
                            padding: EdgeInsets.zero,
                            itemCount: snapshot.data.length,
                            itemBuilder: (ctx,i){
                              var data = snapshot.data[i];
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
                                  SizedBox(height: 20,)
                                ],
                              );
                            },
                          );
                        }
                        return Container();
                      }),
                  ),
                ],
              )
            ),
            AccordionWidget(3,globalBloc,"PRODUKSI EKUIVALEN MINYAK DAN GAS",
              Column(
                children: <Widget>[
                  DatePickerWidget(onChange: (DateTime date){
                    updateHarianESDMBloc.onChange("lap_pusdatin_prod_ekui_migas", date,isList: true);
                  }),
                  ConstrainedBox(
                    constraints: BoxConstraints(
                      minHeight: 0,
                      minWidth: MediaQuery.of(context).size.width,
                      maxHeight: 500,
                      maxWidth: MediaQuery.of(context).size.width
                    ),
                    child: StreamBuilder(
                      stream: updateHarianESDMBloc.listLapPusdatinProdEkuiMigasStream,
                      builder: (context, AsyncSnapshot<List<LapPusdatinProdEkuiMigas>> snapshot) {
                        if (snapshot.hasData) {
                          return NestedScrollableWidget(
                            padding: EdgeInsets.zero,
                            itemCount: snapshot.data.length,
                            itemBuilder: (ctx,i){
                              var data = snapshot.data[i];
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
                                  SizedBox(height: 20,)
                                ],
                              );
                            },
                          );
                        }
                        return Container();
                      }),
                  ),
                ],
              )
            ),
            AccordionWidget(4,globalBloc,"LIFTING TAHUN BERJALAN",
              Column(
                children: <Widget>[
                  DatePickerWidget(onChange: (DateTime date){
                    updateHarianESDMBloc.onChange("lap_pusdatin_lift_tb", date,isList: true);
                  }),
                  ConstrainedBox(
                    constraints: BoxConstraints(
                      minHeight: 0,
                      minWidth: MediaQuery.of(context).size.width,
                      maxHeight: 500,
                      maxWidth: MediaQuery.of(context).size.width
                    ),
                    child: StreamBuilder(
                      stream: updateHarianESDMBloc.listLapPusdatinLiftTbStream,
                      builder: (context, AsyncSnapshot<List<LapPusdatinLiftTb>> snapshot) {
                        if (snapshot.hasData) {
                          return NestedScrollableWidget(
                            padding: EdgeInsets.zero,
                            itemCount: snapshot.data.length,
                            itemBuilder: (ctx,i){
                              var data = snapshot.data[i];
                              if (["",null].contains(data.idLaporan)) return Container();
                              return Column(
                                children: <Widget>[
                                  CardWidget("Tanggal : ",data.tanggalLaporan.toString()),
                                  CardWidget("Lifting Minyak Bumi : ",data.liftMb),
                                  CardWidget("Posisi Stock hari ini : ",data.posisiStock),
                                  CardWidget("Saluran Gas : ",data.salurGas),
                                  SizedBox(height: 20,)
                                ],
                              );
                            },
                          );
                        }
                        return Container();
                      }),
                  ),
                ],
              )
            ),
            AccordionWidget(5,globalBloc,"HARGA BBM",
              Column(
                children: <Widget>[
                  DatePickerWidget(onChange: (DateTime date){
                    updateHarianESDMBloc.onChange("lap_pusdatin_harga_bbm", date,isList: true);
                  }),
                  ConstrainedBox(
                    constraints: BoxConstraints(
                      minHeight: 0,
                      minWidth: MediaQuery.of(context).size.width,
                      maxHeight: 500,
                      maxWidth: MediaQuery.of(context).size.width
                    ),
                    child: StreamBuilder(
                      stream: updateHarianESDMBloc.listLapPusdatinHargaBbmStream,
                      builder: (context, AsyncSnapshot<List<LapPusdatinHargaBbm>> snapshot) {
                        if (snapshot.hasData) {
                          return NestedScrollableWidget(
                            padding: EdgeInsets.zero,
                            itemCount: snapshot.data.length,
                            itemBuilder: (ctx,i){
                              var data = snapshot.data[i];
                              if (["",null].contains(data.idLaporan)) return Container();
                              return Column(
                                children: <Widget>[
                                  CardWidget("Tanggal : ",data.tanggalLaporan.toString()),
                                  CardWidget("Jenis Tertentu : ",data.jenisTertentu),
                                  CardWidget("BBM Umum : ",data.bbmUmum),
                                  CardWidget("Program Indonesia Satu Harga : ",data.progIndSatuHrg),
                                  CardWidget("Harga Per-negara : ",data.hargaPernegara),
                                  SizedBox(height: 20,)
                                ],
                              );
                            },
                          );
                        }
                        return Container();
                      }),
                  ),
                ],
              )
            ),
            AccordionWidget(6,globalBloc,"BERITA OPEC HARIAN",
              Column(
                children: <Widget>[
                  DatePickerWidget(onChange: (DateTime date){
                    updateHarianESDMBloc.onChange("lap_pusdatin_berita_opec_harian", date,isList: true);
                  }),
                  ConstrainedBox(
                    constraints: BoxConstraints(
                      minHeight: 0,
                      minWidth: MediaQuery.of(context).size.width,
                      maxHeight: 500,
                      maxWidth: MediaQuery.of(context).size.width
                    ),
                    child: StreamBuilder(
                      stream: updateHarianESDMBloc.listLapPusdatinBeritaOpecHarianStream,
                      builder: (context, AsyncSnapshot<List<LapPusdatinBeritaOpecHarian>> snapshot) {
                        if (snapshot.hasData) {
                          return NestedScrollableWidget(
                            padding: EdgeInsets.zero,
                            itemCount: snapshot.data.length,
                            itemBuilder: (ctx,i){
                              var data = snapshot.data[i];
                              if (["",null].contains(data.idLaporan)) return Container();
                              return Column(
                                children: <Widget>[
                                  CardWidget("Tanggal : ",data.tanggalLaporan.toString()),
                                  CardWidget("Berita : ",data.berita), 
                                  SizedBox(height: 20,)
                                ],
                              );
                            },
                          );
                        }
                        return Container();
                      }),
                  ),
                ],
              )
            ),
            AccordionWidget(7,globalBloc,"HARGA BATU BARA ACUAN",
              Column(
                children: <Widget>[
                  DatePickerWidget(onChange: (DateTime date){
                    updateHarianESDMBloc.onChange("lap_pusdatin_harga_bb_acuan", date,isList: true);
                  }),
                  ConstrainedBox(
                    constraints: BoxConstraints(
                      minHeight: 0,
                      minWidth: MediaQuery.of(context).size.width,
                      maxHeight: 500,
                      maxWidth: MediaQuery.of(context).size.width
                    ),
                    child: StreamBuilder(
                      stream: updateHarianESDMBloc.listLapPusdatinHargaBbAcuanStream,
                      builder: (context, AsyncSnapshot<List<LapPusdatinHargaBbAcuan>> snapshot) {
                        if (snapshot.hasData) {
                          return NestedScrollableWidget(
                            padding: EdgeInsets.zero,
                            itemCount: snapshot.data.length,
                            itemBuilder: (ctx,i){
                              var data = snapshot.data[i];
                              if (["",null].contains(data.idLaporan)) return Container();
                              return Column(
                                children: <Widget>[
                                  CardWidget("Tanggal : ",data.tanggalLaporan.toString()),
                                  CardWidget("Harga : ",data.harga), 
                                  CardWidget("Sumber : ",data.sumber), 
                                  SizedBox(height: 20,)
                                ],
                              );
                            },
                          );
                        }
                        return Container();
                      }),
                  ),
                ],
              )
            ),
            AccordionWidget(8,globalBloc,"HARGA MINERAL ACUAN",
              Column(
                children: <Widget>[
                  DatePickerWidget(onChange: (DateTime date){
                    updateHarianESDMBloc.onChange("lap_pusdatin_harga_mineral_acuan", date,isList: true);
                  }),
                  ConstrainedBox(
                    constraints: BoxConstraints(
                      minHeight: 0,
                      minWidth: MediaQuery.of(context).size.width,
                      maxHeight: 500,
                      maxWidth: MediaQuery.of(context).size.width
                    ),
                    child: StreamBuilder(
                      stream: updateHarianESDMBloc.listLapPusdatinHargaMineralAcuanStream,
                      builder: (context, AsyncSnapshot<List<LapPusdatinHargaMineralAcuan>> snapshot) {
                        if (snapshot.hasData) {
                          return NestedScrollableWidget(
                            padding: EdgeInsets.zero,
                            itemCount: snapshot.data.length,
                            itemBuilder: (ctx,i){
                              var data = snapshot.data[i];
                              if (["",null].contains(data.idLaporan)) return Container();
                              return Column(
                                children: <Widget>[
                                  CardWidget("Tanggal : ",data.tanggalLaporan.toString()),
                                  CardWidget("Harga : ",data.harga), 
                                  CardWidget("Sumber : ",data.sumber), 
                                  SizedBox(height: 20,)
                                ],
                              );
                            },
                          );
                        }
                        return Container();
                      }),
                  ),
                ],
              )
            ),
            AccordionWidget(9,globalBloc,"STATUS KETENAGALISTRIKAN",
              Column(
                children: <Widget>[
                  DatePickerWidget(onChange: (DateTime date){
                    updateHarianESDMBloc.onChange("lap_pusdatin_stts_tl", date,isList: true);
                  }),
                  ConstrainedBox(
                    constraints: BoxConstraints(
                      minHeight: 0,
                      minWidth: MediaQuery.of(context).size.width,
                      maxHeight: 500,
                      maxWidth: MediaQuery.of(context).size.width
                    ),
                    child: StreamBuilder(
                      stream: updateHarianESDMBloc.listLapPusdatinSttsTlStream,
                      builder: (context, AsyncSnapshot<List<LapPusdatinSttsTl>> snapshot) {
                        if (snapshot.hasData) {
                          return NestedScrollableWidget(
                            padding: EdgeInsets.zero,
                            itemCount: snapshot.data.length,
                            itemBuilder: (ctx,i){
                              var data = snapshot.data[i];
                              if (["",null].contains(data.idLaporan)) return Container();
                              return Column(
                                children: <Widget>[
                                  CardWidget("Tanggal : ",data.tanggalLaporan.toString()),
                                  CardWidget("Status : ",data.status),  
                                  SizedBox(height: 20,)
                                ],
                              );
                            },
                          );
                        }
                        return Container();
                      }),
                  ),
                ],
              )
            ),
          
          ],
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