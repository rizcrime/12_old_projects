import 'dart:convert';

import 'package:dio/dio.dart';
import 'package:flutter/material.dart';
import 'package:flutter_esdm/models/LapGeologiGempaBumi.dart';
import 'package:flutter_esdm/models/LapGeologiGerakanTanah.dart';
import 'package:flutter_esdm/models/LapGeologiGunungApi.dart';
import 'package:flutter_esdm/utils/api.dart';
import 'package:flutter_esdm/utils/bloc_provider.dart';
import 'package:flutter_esdm/utils/uidata.dart';
import 'package:rxdart/subjects.dart';
import 'package:intl/intl.dart';

class UpdateKegeologianBloc extends Object implements BlocBase {
  GlobalKey<ScaffoldState> key;
  @override
  void dispose() {
    // TODO: implement dispose
    _loadingController.close();
    _lapGeologiGunungApiController.close();
    _lapGeologiGempaBumiController.close();
    _lapGeologiGerakanTanahController.close();
    _listLapGeologiGunungApiController.close();
    _listLapGeologiGempaBumiController.close();
    _listLapGeologiGerakanTanahController.close();
  }
  UpdateKegeologianBloc({this.key}){
    getData();
  }


  final _loadingController = BehaviorSubject<bool>();
  Stream<bool> get loadingStream => _loadingController.stream;

  List<LapGeologiGunungApi> lapGeologiGunungApiList = [];
  BehaviorSubject<LapGeologiGunungApi> _lapGeologiGunungApiController = BehaviorSubject<LapGeologiGunungApi>();
  Stream<LapGeologiGunungApi> get lapGeologiGunungApiStream => _lapGeologiGunungApiController.stream;
  BehaviorSubject<List<LapGeologiGunungApi>> _listLapGeologiGunungApiController = BehaviorSubject<List<LapGeologiGunungApi>>();
  Stream<List<LapGeologiGunungApi>> get listLapGeologiGunungApiStream => _listLapGeologiGunungApiController.stream;

  List<LapGeologiGempaBumi> lapGeologiGempaBumiList = [];
  BehaviorSubject<LapGeologiGempaBumi> _lapGeologiGempaBumiController = BehaviorSubject<LapGeologiGempaBumi>();
  Stream<LapGeologiGempaBumi> get lapGeologiGempaBumiStream => _lapGeologiGempaBumiController.stream;
  BehaviorSubject<List<LapGeologiGempaBumi>> _listLapGeologiGempaBumiController = BehaviorSubject<List<LapGeologiGempaBumi>>();
  Stream<List<LapGeologiGempaBumi>> get listLapGeologiGempaBumiStream => _listLapGeologiGempaBumiController.stream;

  List<LapGeologiGerakanTanah> lapGeologiGerakanTanahList = [];
  BehaviorSubject<LapGeologiGerakanTanah> _lapGeologiGerakanTanahController = BehaviorSubject<LapGeologiGerakanTanah>();
  Stream<LapGeologiGerakanTanah> get lapGeologiGerakanTanahStream => _lapGeologiGerakanTanahController.stream;
  BehaviorSubject<List<LapGeologiGerakanTanah>> _listLapGeologiGerakanTanahController = BehaviorSubject<List<LapGeologiGerakanTanah>>();
  Stream<List<LapGeologiGerakanTanah>> get listLapGeologiGerakanTanahStream => _listLapGeologiGerakanTanahController.stream;

  getData() async{
    _loadingController.sink.add(true);
    try {
      _listLapGeologiGunungApiController.sink.add([]);
      _listLapGeologiGempaBumiController.sink.add([]);
      _listLapGeologiGerakanTanahController.sink.add([]);
      var dio = ApiProvider.init();
      Response response = await dio.get("/lap_geologi");
      if(response.statusCode == 200){
        var responseData = response.data;

        addStreamGunungApi(responseData['lap_geologi_gunung_api']);
        addStreamGempaBumi(responseData['lap_geologi_gempa_bumi']);
        addStreamGerakanTanah(responseData['lap_geologi_gerakan_tanah']);

        _loadingController.sink.add(false);

      }
    } on DioError catch (e) {
      print(e);
      if(key != null){
        key.currentState.showSnackBar(
          SnackBar(
            content: Text(e.message),
            action: SnackBarAction(label: "Retry",onPressed: ()=>getData(),textColor: UIData.colorYellow,),
          )
        );
      }
    } finally {
      _loadingController.sink.add(false);
    }
  }

  addStreamGunungApi(List<dynamic> datas){
    lapGeologiGunungApiList.clear();
    print("=========================");
    print(datas);
    print("===========================");
    for(final data in datas){
      var lapGeologiGunungApi = LapGeologiGunungApi.fromJson(jsonDecode(jsonEncode(data)));
      lapGeologiGunungApiList.add(lapGeologiGunungApi);
    }
    _lapGeologiGunungApiController.sink.add(lapGeologiGunungApiList.last);
    _listLapGeologiGunungApiController.sink.add(lapGeologiGunungApiList);
  }

  addStreamGempaBumi(List<dynamic> datas){
    lapGeologiGempaBumiList.clear();
    for(final data in datas){
      var lapGeologiGempaBumi = LapGeologiGempaBumi.fromJson(jsonDecode(jsonEncode(data)));
      lapGeologiGempaBumiList.add(lapGeologiGempaBumi);
    }
    _lapGeologiGempaBumiController.sink.add(lapGeologiGempaBumiList.last);
    _listLapGeologiGempaBumiController.sink.add(lapGeologiGempaBumiList);
  }

  addStreamGerakanTanah(List<dynamic> datas){
    lapGeologiGerakanTanahList.clear();
    for(final data in datas){
      var lapGeologiGerakanTanah = LapGeologiGerakanTanah.fromJson(jsonDecode(jsonEncode(data)));
      lapGeologiGerakanTanahList.add(lapGeologiGerakanTanah);
    }
    _lapGeologiGerakanTanahController.sink.add(lapGeologiGerakanTanahList.last);
    _listLapGeologiGerakanTanahController.sink.add(lapGeologiGerakanTanahList);
  }

  onChange(String index,DateTime date,{bool isList = false}){
    switch (index) {
      case "lap_geologi_gunung_api":
        if(isList)
          listChangeDate(_listLapGeologiGunungApiController,lapGeologiGunungApiList,date);
        else
          changeDate(_lapGeologiGunungApiController,lapGeologiGunungApiList,date,new LapGeologiGunungApi());
        break;
      case "lap_geologi_gempa_bumi":
        if(isList)
          listChangeDate(_listLapGeologiGempaBumiController,lapGeologiGempaBumiList,date);
        else
          changeDate(_lapGeologiGempaBumiController,lapGeologiGempaBumiList,date,new LapGeologiGempaBumi());
        break;
      case "lap_geologi_gerakan_tanah":
        if(isList)
          listChangeDate(_listLapGeologiGerakanTanahController,lapGeologiGerakanTanahList,date);
        else
          changeDate(_lapGeologiGerakanTanahController,lapGeologiGerakanTanahList,date,new LapGeologiGerakanTanah());
        break;
      default:
    }
  }
  changeDate(BehaviorSubject<dynamic> controller,List<dynamic>lists, DateTime date, model){
    if(date == null){
      controller.sink.add(lists.last);  
    }else{
      String formatedDate = DateFormat("yyyy-MM-dd").format(date);
      var result = lists.firstWhere((data) => data.tanggalLaporan == formatedDate,orElse: null);
      controller.sink.add(result ?? model);
    }
  }
  
  listChangeDate(BehaviorSubject<List<dynamic>> controller,List<dynamic>lists, DateTime date){
    if(date == null){
      controller.sink.add(lists);  
    }else{
      String formatedDate = DateFormat("yyyy-MM-dd").format(date);
      var result = lists.where((data) => data.tanggalLaporan == formatedDate).toList();
      controller.sink.add(result);

    }
  }
}