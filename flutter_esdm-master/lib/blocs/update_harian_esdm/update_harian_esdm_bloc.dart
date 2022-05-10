import 'dart:convert';

import 'package:dio/dio.dart';
import 'package:flutter/material.dart';
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
import 'package:flutter_esdm/utils/api.dart';
import 'package:flutter_esdm/utils/bloc_provider.dart';
import 'package:flutter_esdm/utils/uidata.dart';
import 'package:rxdart/rxdart.dart';
import 'package:intl/intl.dart';

class UpdateHarianESDMBloc extends Object implements BlocBase {
  BuildContext context;
  GlobalKey<ScaffoldState> key;
  @override
  void dispose() {
    _loadingController.close();
    _lapPusdatinProdMinyakController.close();
    _lapPusdatinIcpController.close();
    _lapPusdatinProdGasController.close();
    _lapPusdatinProdEkuiMigasController.close();
    _lapPusdatinLiftTbController.close();
    _lapPusdatinHargaBbmController.close();
    // _lapPusdatinProgPenyPremJamaliController.close();
    _lapPusdatinBeritaOpecHarianController.close();
    _lapPusdatinHargaBbAcuanController.close();
    _lapPusdatinHargaMineralAcuanController.close();
    _lapPusdatinSttsTlController.close();
    _listLapPusdatinProdMinyakController.close();
    _listLapPusdatinIcpController.close();
    _listLapPusdatinProdGasController.close();
    _listLapPusdatinProdEkuiMigasController.close();
    _listLapPusdatinLiftTbController.close();
    _listLapPusdatinHargaBbmController.close();
    // _listLapPusdatinProgPenyPremJamaliController.close();
    _listLapPusdatinBeritaOpecHarianController.close();
    _listLapPusdatinHargaBbAcuanController.close();
    _listLapPusdatinHargaMineralAcuanController.close();
    _listLapPusdatinSttsTlController.close();
  }
  UpdateHarianESDMBloc({this.key}){
    getData();
  }
  final _loadingController = BehaviorSubject<bool>();
  Stream<bool> get loadingStream => _loadingController.stream;
  
  List<LapPusdatinProdMinyak> lapPusdatinProdMinyakList = [];
  BehaviorSubject<LapPusdatinProdMinyak> _lapPusdatinProdMinyakController = BehaviorSubject<LapPusdatinProdMinyak>();
  Stream<LapPusdatinProdMinyak> get lapPusdatinProdMinyakStream => _lapPusdatinProdMinyakController.stream;
  BehaviorSubject<List<LapPusdatinProdMinyak>> _listLapPusdatinProdMinyakController = BehaviorSubject<List<LapPusdatinProdMinyak>>();
  Stream<List<LapPusdatinProdMinyak>> get listLapPusdatinProdMinyakStream => _listLapPusdatinProdMinyakController.stream;
  
  List<LapPusdatinIcp> lapPusdatinIcpList = [];
  BehaviorSubject<LapPusdatinIcp> _lapPusdatinIcpController = BehaviorSubject<LapPusdatinIcp>();
  Stream<LapPusdatinIcp> get lapPusdatinIcpStream => _lapPusdatinIcpController.stream;
  BehaviorSubject<List<LapPusdatinIcp>> _listLapPusdatinIcpController = BehaviorSubject<List<LapPusdatinIcp>>();
  Stream<List<LapPusdatinIcp>> get listLapPusdatinIcpStream => _listLapPusdatinIcpController.stream;
  
  List<LapPusdatinProdGas> lapPusdatinProdGasList = [];
  BehaviorSubject<LapPusdatinProdGas> _lapPusdatinProdGasController = BehaviorSubject<LapPusdatinProdGas>();
  Stream<LapPusdatinProdGas> get lapPusdatinProdGasStream => _lapPusdatinProdGasController.stream;
  BehaviorSubject<List<LapPusdatinProdGas>> _listLapPusdatinProdGasController = BehaviorSubject<List<LapPusdatinProdGas>>();
  Stream<List<LapPusdatinProdGas>> get listLapPusdatinProdGasStream => _listLapPusdatinProdGasController.stream;
  
  List<LapPusdatinProdEkuiMigas> lapPusdatinProdEkuiMigasList = [];
  BehaviorSubject<LapPusdatinProdEkuiMigas> _lapPusdatinProdEkuiMigasController = BehaviorSubject<LapPusdatinProdEkuiMigas>();
  Stream<LapPusdatinProdEkuiMigas> get lapPusdatinProdEkuiMigasStream => _lapPusdatinProdEkuiMigasController.stream;
  BehaviorSubject<List<LapPusdatinProdEkuiMigas>> _listLapPusdatinProdEkuiMigasController = BehaviorSubject<List<LapPusdatinProdEkuiMigas>>();
  Stream<List<LapPusdatinProdEkuiMigas>> get listLapPusdatinProdEkuiMigasStream => _listLapPusdatinProdEkuiMigasController.stream;
  
  List<LapPusdatinLiftTb> lapPusdatinLiftTbList = [];
  BehaviorSubject<LapPusdatinLiftTb> _lapPusdatinLiftTbController = BehaviorSubject<LapPusdatinLiftTb>();
  Stream<LapPusdatinLiftTb> get lapPusdatinLiftTbStream => _lapPusdatinLiftTbController.stream;
  BehaviorSubject<List<LapPusdatinLiftTb>> _listLapPusdatinLiftTbController = BehaviorSubject<List<LapPusdatinLiftTb>>();
  Stream<List<LapPusdatinLiftTb>> get listLapPusdatinLiftTbStream => _listLapPusdatinLiftTbController.stream;

  List<LapPusdatinHargaBbm> lapPusdatinHargaBbmList = [];
  BehaviorSubject<LapPusdatinHargaBbm> _lapPusdatinHargaBbmController = BehaviorSubject<LapPusdatinHargaBbm>();
  Stream<LapPusdatinHargaBbm> get lapPusdatinHargaBbmStream => _lapPusdatinHargaBbmController.stream;
  BehaviorSubject<List<LapPusdatinHargaBbm>> _listLapPusdatinHargaBbmController = BehaviorSubject<List<LapPusdatinHargaBbm>>();
  Stream<List<LapPusdatinHargaBbm>> get listLapPusdatinHargaBbmStream => _listLapPusdatinHargaBbmController.stream;

  // List<LapPusdatinProgPenyPremJamali> lapPusdatinProgPenyPremJamaliList = [];
  // BehaviorSubject<LapPusdatinProgPenyPremJamali> _lapPusdatinProgPenyPremJamaliController = BehaviorSubject<LapPusdatinProgPenyPremJamali>();
  // Stream<LapPusdatinProgPenyPremJamali> get lapPusdatinProgPenyPremJamaliStream => _lapPusdatinProgPenyPremJamaliController.stream;
  // BehaviorSubject<List<LapPusdatinProgPenyPremJamali>> _listLapPusdatinProgPenyPremJamaliController = BehaviorSubject<List<LapPusdatinProgPenyPremJamali>>();
  // Stream<List<LapPusdatinProgPenyPremJamali>> get listLapPusdatinProgPenyPremJamaliStream => _listLapPusdatinProgPenyPremJamaliController.stream;

  List<LapPusdatinBeritaOpecHarian> lapPusdatinBeritaOpecHarianList = [];
  BehaviorSubject<LapPusdatinBeritaOpecHarian> _lapPusdatinBeritaOpecHarianController = BehaviorSubject<LapPusdatinBeritaOpecHarian>();
  Stream<LapPusdatinBeritaOpecHarian> get lapPusdatinBeritaOpecHarianStream => _lapPusdatinBeritaOpecHarianController.stream;
  BehaviorSubject<List<LapPusdatinBeritaOpecHarian>> _listLapPusdatinBeritaOpecHarianController = BehaviorSubject<List<LapPusdatinBeritaOpecHarian>>();
  Stream<List<LapPusdatinBeritaOpecHarian>> get listLapPusdatinBeritaOpecHarianStream => _listLapPusdatinBeritaOpecHarianController.stream;

  List<LapPusdatinHargaBbAcuan> lapPusdatinHargaBbAcuanList = [];
  BehaviorSubject<LapPusdatinHargaBbAcuan> _lapPusdatinHargaBbAcuanController = BehaviorSubject<LapPusdatinHargaBbAcuan>();
  Stream<LapPusdatinHargaBbAcuan> get lapPusdatinHargaBbAcuanStream => _lapPusdatinHargaBbAcuanController.stream;
  BehaviorSubject<List<LapPusdatinHargaBbAcuan>> _listLapPusdatinHargaBbAcuanController = BehaviorSubject<List<LapPusdatinHargaBbAcuan>>();
  Stream<List<LapPusdatinHargaBbAcuan>> get listLapPusdatinHargaBbAcuanStream => _listLapPusdatinHargaBbAcuanController.stream;

  List<LapPusdatinHargaMineralAcuan> lapPusdatinHargaMineralAcuanList = [];
  BehaviorSubject<LapPusdatinHargaMineralAcuan> _lapPusdatinHargaMineralAcuanController = BehaviorSubject<LapPusdatinHargaMineralAcuan>();
  Stream<LapPusdatinHargaMineralAcuan> get lapPusdatinHargaMineralAcuanStream => _lapPusdatinHargaMineralAcuanController.stream;
  BehaviorSubject<List<LapPusdatinHargaMineralAcuan>> _listLapPusdatinHargaMineralAcuanController = BehaviorSubject<List<LapPusdatinHargaMineralAcuan>>();
  Stream<List<LapPusdatinHargaMineralAcuan>> get listLapPusdatinHargaMineralAcuanStream => _listLapPusdatinHargaMineralAcuanController.stream;

  List<LapPusdatinSttsTl> lapPusdatinSttsTlList = [];
  BehaviorSubject<LapPusdatinSttsTl> _lapPusdatinSttsTlController = BehaviorSubject<LapPusdatinSttsTl>();
  Stream<LapPusdatinSttsTl> get lapPusdatinSttsTlStream => _lapPusdatinSttsTlController.stream;
  BehaviorSubject<List<LapPusdatinSttsTl>> _listLapPusdatinSttsTlController = BehaviorSubject<List<LapPusdatinSttsTl>>();
  Stream<List<LapPusdatinSttsTl>> get listLapPusdatinSttsTlStream => _listLapPusdatinSttsTlController.stream;


  getData() async{
    _loadingController.sink.add(true);
    try {
      _listLapPusdatinProdMinyakController.sink.add([]);
      _listLapPusdatinIcpController.sink.add([]);
      _listLapPusdatinProdGasController.sink.add([]);
      _listLapPusdatinProdEkuiMigasController.sink.add([]);
      _listLapPusdatinLiftTbController.sink.add([]);
      _listLapPusdatinHargaBbmController.sink.add([]);
      _listLapPusdatinBeritaOpecHarianController.sink.add([]);
      _listLapPusdatinHargaBbAcuanController.sink.add([]);
      _listLapPusdatinHargaMineralAcuanController.sink.add([]);
      _listLapPusdatinSttsTlController.sink.add([]);
      var dio = ApiProvider.init();
      Response response = await dio.get("/lap_pusdatin");
      if (response.statusCode == 200) {
        var responseData = response.data;
        
        addStreamProdMinyak(responseData['lap_pusdatin_prod_minyak']);
        addStreamIcp(responseData['lap_pusdatin_icp']);
        addStreamProdGas(responseData['lap_pusdatin_prod_gas']);
        addStreamProdEkuiMigas(responseData['lap_pusdatin_prod_ekui_migas']);
        addStreamLiftTb(responseData['lap_pusdatin_lift_tb']);
        addStreamHargaBbm(responseData['lap_pusdatin_harga_bbm']);
        // addStreamProgPenyPremJamali(responseData['lap_pusdatin_prog_peny_prem_jamali']);
        addStreamBeritaOpecHarian(responseData['lap_pusdatin_berita_opec_harian']);
        addStreamHargaBbAcuan(responseData['lap_pusdatin_harga_bb_acuan']);
        addStreamHargaMineralAcuan(responseData['lap_pusdatin_harga_mineral_acuan']);
        addStreamSttsTl(responseData['lap_pusdatin_stts_tl']);
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
// Start List Menu
  addStreamProdMinyak(List<dynamic> datas){
    lapPusdatinProdMinyakList.clear();
    for(final data in datas){
      var lapPusdatinProdMinyak = LapPusdatinProdMinyak.fromJson(jsonDecode(jsonEncode(data)));
      lapPusdatinProdMinyakList.add(lapPusdatinProdMinyak);
    }
    _lapPusdatinProdMinyakController.sink.add(lapPusdatinProdMinyakList.last);
    _listLapPusdatinProdMinyakController.sink.add(lapPusdatinProdMinyakList);
  }

  addStreamIcp(List<dynamic> datas){
    lapPusdatinIcpList.clear();
    for(final data in datas){
      var lapPusdatinIcp = LapPusdatinIcp.fromJson(jsonDecode(jsonEncode(data)));
      lapPusdatinIcpList.add(lapPusdatinIcp);
    }
    _lapPusdatinIcpController.sink.add(lapPusdatinIcpList.last);
    _listLapPusdatinIcpController.sink.add(lapPusdatinIcpList);
  }

  addStreamProdGas(List<dynamic> datas){
    lapPusdatinProdGasList.clear();
    for(final data in datas){
      var lapPusdatinProdGas = LapPusdatinProdGas.fromJson(jsonDecode(jsonEncode(data)));
      lapPusdatinProdGasList.add(lapPusdatinProdGas);
    }
    _lapPusdatinProdGasController.sink.add(lapPusdatinProdGasList.last);
    _listLapPusdatinProdGasController.sink.add(lapPusdatinProdGasList);
  }

  addStreamProdEkuiMigas(List<dynamic> datas){
    lapPusdatinProdEkuiMigasList.clear();
    for(final data in datas){
      var lapPusdatinProdEkuiMigas = LapPusdatinProdEkuiMigas.fromJson(jsonDecode(jsonEncode(data)));
      lapPusdatinProdEkuiMigasList.add(lapPusdatinProdEkuiMigas);
    }
    _lapPusdatinProdEkuiMigasController.sink.add(lapPusdatinProdEkuiMigasList.last);
    _listLapPusdatinProdEkuiMigasController.sink.add(lapPusdatinProdEkuiMigasList);
  }

  addStreamLiftTb(List<dynamic> datas){
    lapPusdatinLiftTbList.clear();
    for(final data in datas){
      var lapPusdatinLiftTb = LapPusdatinLiftTb.fromJson(jsonDecode(jsonEncode(data)));
      lapPusdatinLiftTbList.add(lapPusdatinLiftTb);
    }
    _lapPusdatinLiftTbController.sink.add(lapPusdatinLiftTbList.last);
    _listLapPusdatinLiftTbController.sink.add(lapPusdatinLiftTbList);
  }

  addStreamHargaBbm(List<dynamic> datas){
    lapPusdatinHargaBbmList.clear();
    for(final data in datas){
      var lapPusdatinHargaBbm = LapPusdatinHargaBbm.fromJson(jsonDecode(jsonEncode(data)));
      lapPusdatinHargaBbmList.add(lapPusdatinHargaBbm);
    }
    _lapPusdatinHargaBbmController.sink.add(lapPusdatinHargaBbmList.last);
    _listLapPusdatinHargaBbmController.sink.add(lapPusdatinHargaBbmList);
  }

  // addStreamProgPenyPremJamali(List<dynamic> datas){
  //   lapPusdatinProgPenyPremJamaliList.clear();
  //   for(final data in datas){
  //     var lapPusdatinProgPenyPremJamali = LapPusdatinProgPenyPremJamali.fromJson(jsonDecode(jsonEncode(data)));
  //     lapPusdatinProgPenyPremJamaliList.add(lapPusdatinProgPenyPremJamali);
  //   }
  //   _lapPusdatinProgPenyPremJamaliController.sink.add(lapPusdatinProgPenyPremJamaliList.last);
  //   _listLapPusdatinProgPenyPremJamaliController.sink.add(lapPusdatinProgPenyPremJamaliList);
  // }

  addStreamBeritaOpecHarian(List<dynamic> datas){
    lapPusdatinBeritaOpecHarianList.clear();
    for(final data in datas){
      var lapPusdatinBeritaOpecHarian = LapPusdatinBeritaOpecHarian.fromJson(jsonDecode(jsonEncode(data)));
      lapPusdatinBeritaOpecHarianList.add(lapPusdatinBeritaOpecHarian);
    }
    _lapPusdatinBeritaOpecHarianController.sink.add(lapPusdatinBeritaOpecHarianList.last);
    _listLapPusdatinBeritaOpecHarianController.sink.add(lapPusdatinBeritaOpecHarianList);
  }

  addStreamHargaBbAcuan(List<dynamic> datas){
    lapPusdatinHargaBbAcuanList.clear();
    for(final data in datas){
      var lapPusdatinHargaBbAcuan = LapPusdatinHargaBbAcuan.fromJson(jsonDecode(jsonEncode(data)));
      lapPusdatinHargaBbAcuanList.add(lapPusdatinHargaBbAcuan);
    }
    _lapPusdatinHargaBbAcuanController.sink.add(lapPusdatinHargaBbAcuanList.last);
    _listLapPusdatinHargaBbAcuanController.sink.add(lapPusdatinHargaBbAcuanList);
  }

  addStreamHargaMineralAcuan(List<dynamic> datas){
    lapPusdatinHargaMineralAcuanList.clear();
    for(final data in datas){
      var lapPusdatinHargaMineralAcuan = LapPusdatinHargaMineralAcuan.fromJson(jsonDecode(jsonEncode(data)));
      lapPusdatinHargaMineralAcuanList.add(lapPusdatinHargaMineralAcuan);
    }
    _lapPusdatinHargaMineralAcuanController.sink.add(lapPusdatinHargaMineralAcuanList.last);
    _listLapPusdatinHargaMineralAcuanController.sink.add(lapPusdatinHargaMineralAcuanList);
  }

  addStreamSttsTl(List<dynamic> datas){
    lapPusdatinSttsTlList.clear();
    for(final data in datas){
      var lapPusdatinSttsTl = LapPusdatinSttsTl.fromJson(jsonDecode(jsonEncode(data)));
      lapPusdatinSttsTlList.add(lapPusdatinSttsTl);
    }
    _lapPusdatinSttsTlController.sink.add(lapPusdatinSttsTlList.last);
    _listLapPusdatinSttsTlController.sink.add(lapPusdatinSttsTlList);
  }

// End List Menu
  onChange(String index,DateTime date,{bool isList = false}){
    switch (index) {
      case "lap_pusdatin_prod_minyak":
        if(isList)
          listChangeDate(_listLapPusdatinProdMinyakController,lapPusdatinProdMinyakList,date);
        else
          changeDate(_lapPusdatinProdMinyakController,lapPusdatinProdMinyakList,date,new LapPusdatinProdMinyak());
        break;
      case "lap_pusdatin_icp":
        if(isList)
          listChangeDate(_listLapPusdatinIcpController,lapPusdatinIcpList,date);
        else
          changeDate(_lapPusdatinIcpController,lapPusdatinIcpList,date,new LapPusdatinIcp());
        break;
      case "lap_pusdatin_prod_gas":
        if(isList)
          listChangeDate(_listLapPusdatinProdGasController,lapPusdatinProdGasList,date);
        else
          changeDate(_lapPusdatinProdGasController,lapPusdatinProdGasList,date,new LapPusdatinProdGas());
        break;
      case "lap_pusdatin_prod_ekui_migas":
        if(isList)
          listChangeDate(_listLapPusdatinProdEkuiMigasController,lapPusdatinProdEkuiMigasList,date);
        else
          changeDate(_lapPusdatinProdEkuiMigasController,lapPusdatinProdEkuiMigasList,date,new LapPusdatinProdEkuiMigas());
        break;
      case "lap_pusdatin_lift_tb":
        if(isList)
          listChangeDate(_listLapPusdatinLiftTbController,lapPusdatinLiftTbList,date);
        else
          changeDate(_lapPusdatinLiftTbController,lapPusdatinLiftTbList,date,new LapPusdatinLiftTb());
        break;
      case "lap_pusdatin_harga_bbm":
        if(isList)
          listChangeDate(_listLapPusdatinHargaBbmController,lapPusdatinHargaBbmList,date);
        else
          changeDate(_lapPusdatinHargaBbmController,lapPusdatinHargaBbmList,date,new LapPusdatinHargaBbm());
        break;
      // case "lap_pusdatin_prog_peny_prem_jamali":
      //   if(isList)
      //     listChangeDate(_listLapPusdatinProgPenyPremJamaliController,lapPusdatinProgPenyPremJamaliList,date);
      //   else
      //     changeDate(_lapPusdatinProgPenyPremJamaliController,lapPusdatinProgPenyPremJamaliList,date,new LapPusdatinProgPenyPremJamali());
      //   break;
      case "lap_pusdatin_berita_opec_harian":
        if(isList)
          listChangeDate(_listLapPusdatinBeritaOpecHarianController,lapPusdatinBeritaOpecHarianList,date);
        else
          changeDate(_lapPusdatinBeritaOpecHarianController,lapPusdatinBeritaOpecHarianList,date,new LapPusdatinBeritaOpecHarian());
        break;
      case "lap_pusdatin_harga_bb_acuan":
        if(isList)
          listChangeDate(_listLapPusdatinHargaBbAcuanController,lapPusdatinHargaBbAcuanList,date);
        else
          changeDate(_lapPusdatinHargaBbAcuanController,lapPusdatinHargaBbAcuanList,date,new LapPusdatinHargaBbAcuan());
        break;
      case "lap_pusdatin_harga_mineral_acuan":
        if(isList)
          listChangeDate(_listLapPusdatinHargaMineralAcuanController,lapPusdatinHargaMineralAcuanList,date);
        else
          changeDate(_lapPusdatinHargaMineralAcuanController,lapPusdatinHargaMineralAcuanList,date,new LapPusdatinHargaMineralAcuan());
        break;
      case "lap_pusdatin_stts_tl":
        if(isList)
          listChangeDate(_listLapPusdatinSttsTlController,lapPusdatinSttsTlList,date);
        else
          changeDate(_lapPusdatinSttsTlController,lapPusdatinSttsTlList,date,new LapPusdatinSttsTl());
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