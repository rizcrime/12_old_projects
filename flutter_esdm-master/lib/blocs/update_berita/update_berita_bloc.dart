import 'dart:convert';

import 'package:dio/dio.dart';
import 'package:flutter_esdm/models/LapBeritaHotNews.dart';
import 'package:flutter_esdm/models/LapBeritaNegatif.dart';
import 'package:flutter_esdm/models/LapBeritaNetral.dart';
import 'package:flutter_esdm/models/LapBeritaPositif.dart';
import 'package:flutter_esdm/utils/api.dart';
import 'package:flutter_esdm/utils/bloc_provider.dart';
import 'package:rxdart/subjects.dart';

class UpdateBeritaBloc extends Object implements BlocBase {
  @override
  void dispose() {
    // TODO: implement dispose
    _loadingController.close();
    _listLapBeritaHotNewsController.close();
    _lapBeritaHotNewsController.close();
    _listLapBeritaNegatifController.close();
    _listLapBeritaNetralController.close();
    _listLapBeritaPositifController.close();
    _activeButtonController.close();
    _scrollController.close();
  }
  UpdateBeritaBloc(){
    getData();
  }
  final _loadingController = BehaviorSubject<bool>();
  Stream<bool> get loadingStream => _loadingController.stream;

  List<LapBeritaHotNews> lapBeritaHotNewsList = [];
  BehaviorSubject<LapBeritaHotNews> _lapBeritaHotNewsController = BehaviorSubject<LapBeritaHotNews>();
  Stream<LapBeritaHotNews> get lapBeritaHotNewsStream => _lapBeritaHotNewsController.stream;
  BehaviorSubject<List<LapBeritaHotNews>> _listLapBeritaHotNewsController = BehaviorSubject<List<LapBeritaHotNews>>();
  Stream<List<LapBeritaHotNews>> get listLapBeritaHotNewsStream => _listLapBeritaHotNewsController.stream;

  List<LapBeritaNegatif> lapBeritaNegatifList = [];
  BehaviorSubject<List<LapBeritaNegatif>> _listLapBeritaNegatifController = BehaviorSubject<List<LapBeritaNegatif>>();
  Stream<List<LapBeritaNegatif>> get listLapBeritaNegatifStream => _listLapBeritaNegatifController.stream;

  List<LapBeritaNetral> lapBeritaNetralList = [];
  BehaviorSubject<List<LapBeritaNetral>> _listLapBeritaNetralController = BehaviorSubject<List<LapBeritaNetral>>();
  Stream<List<LapBeritaNetral>> get listLapBeritaNetralStream => _listLapBeritaNetralController.stream;

  List<LapBeritaPositif> lapBeritaPositifList = [];
  BehaviorSubject<List<LapBeritaPositif>> _listLapBeritaPositifController = BehaviorSubject<List<LapBeritaPositif>>();
  Stream<List<LapBeritaPositif>> get listLapBeritaPositifStream => _listLapBeritaPositifController.stream;

  final _activeButtonController = BehaviorSubject<int>();
  Stream<int> get activeButtonStream => _activeButtonController.stream;


  final _scrollController = BehaviorSubject<bool>();
  Stream<bool> get scrollStream => _scrollController.stream;

  getData() async{
    _loadingController.sink.add(true);
    try {
      _listLapBeritaHotNewsController.sink.add([]);
      _listLapBeritaNegatifController.sink.add([]);
      _listLapBeritaNetralController.sink.add([]);
      _listLapBeritaPositifController.sink.add([]);
      var dio = ApiProvider.init();
      Response response = await dio.get("/lap_berita_last_date");
      if (response.statusCode == 200) {
        var responseData = response.data;
        // print(responseData);
        addStreamHotNews(responseData['lap_berita_hot_news']);
        addStreamNegatif(responseData['lap_berita_negatif']);
        addStreamNetral(responseData['lap_berita_netral']);
        addStreamPositif(responseData['lap_berita_positif']);
      }
    } on DioError catch (e) {
      print(e);
    }finally{
      _loadingController.sink.add(false);
    }
  }

  addStreamHotNews(List<dynamic> datas){
    lapBeritaHotNewsList.clear();
    for(final data in datas){
      var lapBeritaHotNews = LapBeritaHotNews.fromJson(jsonDecode(jsonEncode(data)));
      lapBeritaHotNewsList.add(lapBeritaHotNews);
    }
    LapBeritaHotNews firstHotNews = lapBeritaHotNewsList.isNotEmpty? lapBeritaHotNewsList.elementAt(0) : LapBeritaHotNews();
    _lapBeritaHotNewsController.sink.add(firstHotNews);
    _listLapBeritaHotNewsController.sink.add(lapBeritaHotNewsList);
  }

  addStreamNegatif(List<dynamic> datas){
    lapBeritaNegatifList.clear();
    for(final data in datas){
      var lapBeritaNegatif = LapBeritaNegatif.fromJson(jsonDecode(jsonEncode(data)));
      lapBeritaNegatifList.add(lapBeritaNegatif);
    }
    _listLapBeritaNegatifController.sink.add(lapBeritaNegatifList);
  }

  addStreamNetral(List<dynamic> datas){
    lapBeritaNetralList.clear();
    for(final data in datas){
      var lapBeritaNetral = LapBeritaNetral.fromJson(jsonDecode(jsonEncode(data)));
      lapBeritaNetralList.add(lapBeritaNetral);
    }
    _listLapBeritaNetralController.sink.add(lapBeritaNetralList);
  }

  addStreamPositif(List<dynamic> datas){
    lapBeritaPositifList.clear();
    for(final data in datas){
      var lapBeritaPositif = LapBeritaPositif.fromJson(jsonDecode(jsonEncode(data)));
      lapBeritaPositifList.add(lapBeritaPositif);
    }
    _listLapBeritaPositifController.sink.add(lapBeritaPositifList);
  }

  changeSwiper(int index){
    LapBeritaHotNews data = lapBeritaHotNewsList.elementAt(index);
    _lapBeritaHotNewsController.sink.add(data);
  }

  changeActiveButton(int index){
    if(index == _activeButtonController.value)
      _activeButtonController.sink.add(0);
    else
      _activeButtonController.sink.add(index);
  }

  changeScroll(bool isScroll){
    _scrollController.sink.add(isScroll);
  }

}