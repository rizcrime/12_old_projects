import 'package:flutter/widgets.dart';
import 'package:flutter_esdm/utils/bloc_provider.dart';
import 'package:rxdart/rxdart.dart';

class HomeBloc extends Object implements BlocBase {
  @override
  void dispose() {
    _zoomController.close();
  }
  BehaviorSubject<List<bool>> _zoomController = BehaviorSubject<List<bool>>();
  Stream<List<bool>> get zoomStream => _zoomController.stream;

  setAsZooom(BuildContext context,int index,String routeName){
    List<bool> allList = [false,false,false,false];
    allList[index] = true;
    _zoomController.sink.add(allList);
    Future.delayed(Duration(seconds: 1),(){
      Navigator.of(context).pushNamed(routeName);
      allList[index] = false;
      _zoomController.sink.add(allList);
    });
  }
}