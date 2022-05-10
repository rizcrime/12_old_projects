import 'package:flutter_esdm/utils/bloc_provider.dart';
import 'package:rxdart/rxdart.dart';

class GlobalBloc extends Object implements BlocBase {
  @override
  void dispose() {
    _scrollController.close();
    _expandController.close();
  }
  
  final _scrollController = BehaviorSubject<bool>();
  Stream<bool> get scrollStream => _scrollController.stream;

  changeScroll(bool isScroll){
    _scrollController.sink.add(isScroll);
  }

  List<bool> listExpand = [];
  BehaviorSubject<List<bool>> _expandController = BehaviorSubject<List<bool>>();
  Stream<List<bool>> get expandStream => _expandController.stream;

  setListExpandCount(int length){
    listExpand.clear();
    for (var i = 0; i < length; i++) {
      listExpand.add(false);
    }
    _expandController.sink.add(listExpand);
  }

  expansionCallback(int index, bool status) {
    for (var i = 0; i < listExpand.length; i++) {
      listExpand[i] = false;
    }
    listExpand[index] = !status;
    _expandController.sink.add(listExpand);
  }
}