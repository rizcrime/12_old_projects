import 'package:flutter/material.dart';
import 'package:flutter_esdm/blocs/global_bloc.dart';
import 'package:flutter_esdm/blocs/update_kegeologian/update_kegeologian_bloc.dart';
import 'package:flutter_esdm/models/LapGeologiGempaBumi.dart';
import 'package:flutter_esdm/models/LapGeologiGunungApi.dart';
import 'package:flutter_esdm/widget/accordion_widget.dart';
import 'package:flutter_esdm/widget/card_widget.dart';
import 'package:flutter_esdm/widget/date_picker_widget.dart';
import 'package:flutter_esdm/widget/loading_widget.dart';
import 'package:flutter_esdm/widget/nested_scrollable_widget.dart';
class TabKegeologianWidget extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    UpdateKegeologianBloc updateKegeologianBloc = UpdateKegeologianBloc();
    GlobalBloc globalBloc = GlobalBloc();
    globalBloc.setListExpandCount(3);
    return Stack(
      children: <Widget>[
        ListView(
          padding: EdgeInsets.zero,
          children: <Widget>[
            AccordionWidget(0,globalBloc,"GUNUNG API",
              Column(
                children: <Widget>[
                  DatePickerWidget(onChange: (DateTime date){
                    updateKegeologianBloc.onChange("lap_geologi_gunung_api", date,isList: true);
                  }),
                  ConstrainedBox(
                    constraints: BoxConstraints(
                      minHeight: 0,
                      minWidth: MediaQuery.of(context).size.width,
                      maxHeight: 500,
                      maxWidth: MediaQuery.of(context).size.width
                    ),
                    child: StreamBuilder(
                      stream: updateKegeologianBloc.listLapGeologiGunungApiStream,
                      builder: (context, AsyncSnapshot<List<LapGeologiGunungApi>> snapshot) {
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
                                  CardWidget("Nama Gunung : ",data.namaGunung),
                                  CardWidget("Jenis Tingkatan : ",data.level),
                                  CardWidget("Keterangan : ",data.keterangan),
                                  CardWidget("Rekomendasi : ",data.rekomendasi),
                                  CardWidget("Vona : ",data.vona),
                                  CardWidget("Detail : ",data.detail),
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
            AccordionWidget(1,globalBloc,"GEMPA BUMI",
              Column(
                children: <Widget>[
                  DatePickerWidget(onChange: (DateTime date){
                    updateKegeologianBloc.onChange("lap_geologi_gempa_bumi", date,isList: true);
                  }),
                  ConstrainedBox(
                    constraints: BoxConstraints(
                      minHeight: 0,
                      minWidth: MediaQuery.of(context).size.width,
                      maxHeight: 500,
                      maxWidth: MediaQuery.of(context).size.width
                    ),
                    child: StreamBuilder(
                      stream: updateKegeologianBloc.listLapGeologiGempaBumiStream,
                      builder: (context, AsyncSnapshot<List<LapGeologiGempaBumi>> snapshot) {
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
                                  CardWidget("Lokasi Gempa Bumi : ",data.lokasi),
                                  CardWidget("Informasi Gempa Bumi : ",data.informasi),
                                  CardWidget("Kondisi Geologi Terdekat : ",data.kondisiGeologiDt),
                                  CardWidget("Rekomendasi : ",data.rekomendasi),
                                  CardWidget("Penyebab Gempa Bumi : ",data.penyebabGempa),
                                  CardWidget("Dampak Gempa Bumi : ",data.dampakGempa),
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
            AccordionWidget(2,globalBloc,"GERAKAN TANAH",
              Column(
                children: <Widget>[
                  DatePickerWidget(onChange: (DateTime date){
                    updateKegeologianBloc.onChange("lap_geologi_gunung_api", date,isList: true);
                  }),
                  ConstrainedBox(
                    constraints: BoxConstraints(
                      minHeight: 0,
                      minWidth: MediaQuery.of(context).size.width,
                      maxHeight: 500,
                      maxWidth: MediaQuery.of(context).size.width
                    ),
                    child: StreamBuilder(
                      stream: updateKegeologianBloc.listLapGeologiGunungApiStream,
                      builder: (context, AsyncSnapshot<List<LapGeologiGunungApi>> snapshot) {
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
                                  CardWidget("Kondisi Geologi Terdekat : ",data.keterangan),
                                  CardWidget("Rekomendasi : ",data.detail),
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
          stream: updateKegeologianBloc.loadingStream,
          builder: (BuildContext ctx, AsyncSnapshot<bool> snapshot) {
            return LoadingWidget(snapshot.data);
        }),
      ],
      
    );
  }
}