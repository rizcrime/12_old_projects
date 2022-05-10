import 'package:flutter/material.dart';
import 'package:flutter_esdm/blocs/global_bloc.dart';
import 'package:flutter_esdm/blocs/update_kegeologian/update_kegeologian_bloc.dart';
import 'package:flutter_esdm/models/LapGeologiGempaBumi.dart';
import 'package:flutter_esdm/models/LapGeologiGerakanTanah.dart';
import 'package:flutter_esdm/models/LapGeologiGunungApi.dart';
import 'package:flutter_esdm/widget/accordion_widget.dart';
import 'package:flutter_esdm/widget/card_widget.dart';
import 'package:flutter_esdm/widget/date_picker_widget.dart';
import 'package:flutter_esdm/widget/loading_widget.dart';
class UpdateKegeologianPage extends StatefulWidget {
  @override
  _UpdateKegeologianPageState createState() => _UpdateKegeologianPageState();
}

class _UpdateKegeologianPageState extends State<UpdateKegeologianPage> {
  @override
  Widget build(BuildContext context) {
    GlobalKey<ScaffoldState> _key = GlobalKey<ScaffoldState>();
    UpdateKegeologianBloc updateKeUpdateKegeologianBloc = new UpdateKegeologianBloc(key: _key);
    GlobalBloc globalBloc = GlobalBloc();
    globalBloc.setListExpandCount(3);
    return Stack(
      children: <Widget>[
        Scaffold(
          key: _key,
          appBar: AppBar(
            // automaticallyImplyLeading: false, // Don't show the leading button
            title: Text("Update Kegeologian",style: TextStyle(color: Colors.white),),
            backgroundColor: Colors.black,
          ),
          body: ListView(
            children: <Widget>[
              AccordionWidget(0,globalBloc,"GUNUNG API",
                Column(
                  children: <Widget>[
                    // DatePickerWidget(onChange: (DateTime date){
                    //   updateKeUpdateKegeologianBloc.onChange("lap_geologi_gunung_api", date);
                    // }),
                    StreamBuilder(
                      stream: updateKeUpdateKegeologianBloc.lapGeologiGunungApiStream,
                      builder: (context, AsyncSnapshot<LapGeologiGunungApi> snapshot) {
                        if (snapshot.hasData) {
                          var data = snapshot.data;
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
                            ],
                          );
                        }
                        return Container();
                      }),
                  ],
                )
              ),
              AccordionWidget(1,globalBloc,"GEMPA BUMI",
                Column(
                  children: <Widget>[
                    // DatePickerWidget(onChange: (DateTime date){
                    //   updateKeUpdateKegeologianBloc.onChange("lap_geologi_gempa_bumi", date);
                    // }),
                    StreamBuilder(
                      stream: updateKeUpdateKegeologianBloc.lapGeologiGempaBumiStream,
                      builder: (context, AsyncSnapshot<LapGeologiGempaBumi> snapshot) {
                        if (snapshot.hasData) {
                          var data = snapshot.data;
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
                            ],
                          );
                        }
                        return Container();
                      }),
                  ],
                )
              ),
              AccordionWidget(2,globalBloc,"GERAKAN TANAH",
                Column(
                  children: <Widget>[
                    // DatePickerWidget(onChange: (DateTime date){
                    //   updateKeUpdateKegeologianBloc.onChange("lap_geologi_gunung_api", date);
                    // }),
                    StreamBuilder(
                      stream: updateKeUpdateKegeologianBloc.lapGeologiGunungApiStream,
                      builder: (context, AsyncSnapshot<LapGeologiGunungApi> snapshot) {
                        if (snapshot.hasData) {
                          var data = snapshot.data;
                          if (["",null].contains(data.idLaporan)) return Container();
                          return Column(
                            children: <Widget>[
                              CardWidget("Tanggal : ",data.tanggalLaporan.toString()),
                              CardWidget("Kondisi Geologi Terdekat : ",data.keterangan),
                              CardWidget("Rekomendasi : ",data.detail),
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
          stream: updateKeUpdateKegeologianBloc.loadingStream,
          builder: (BuildContext ctx, AsyncSnapshot<bool> snapshot) {
            return LoadingWidget(snapshot.data);
          }),
      ],
    );
  }
}