import 'package:dio/dio.dart';
import 'package:flutter/material.dart';
import 'package:flutter_esdm/utils/api.dart';
import 'package:flutter_esdm/utils/bloc_provider.dart';
import 'package:flutter_esdm/utils/session.dart';
import 'package:rxdart/rxdart.dart';

class LoginBloc extends Object implements BlocBase{
  @override
  void dispose() {
    _usernameController.close();
    _passwordController.close();
    _loadingController.close();
  }

  //Private fields
  final _usernameController = BehaviorSubject<String>(); //RxDart's implementation of StreamController. Broadcast stream by default
  final _passwordController = BehaviorSubject<String>();
  final _loadingController = BehaviorSubject<bool>();

  //Retreive data from the stream
  Stream<String> get usernameStream => _usernameController.stream; //Return the transformed stream
  Stream<String> get passwordStream => _passwordController.stream;
  Stream<bool> get loadingStream => _loadingController.stream;

  //Merging username and password streams
  Stream<bool> get submitValid => Observable.combineLatest2(usernameStream, passwordStream, (u, p) => true);

  //Add data to the stream
  Function(String) get updateusername => _usernameController.sink.add;
  Function(String) get updatePassword => _passwordController.sink.add;

  Function(bool) get updateLoading => _loadingController.sink.add;
  
  onLogout(BuildContext context){
    Session.setIsLogin(false);
    Navigator.of(context).pushNamedAndRemoveUntil('/login', (Route<dynamic> route) => false);
  }

  Future onLogin(GlobalKey<FormState> key) async {
    FocusScope.of(key.currentContext).requestFocus(new FocusNode());

    if(key.currentState.validate()){
      key.currentState.save();
      _loadingController.sink.add(true);

      try {
        Response response;
        var dio = ApiProvider.init();

        var params = {
          "username": _usernameController.value,
          "password" : _passwordController.value,
        };
        print(params);

        response = await dio.post("/Auth/login", data: params);
        print(response);
        
        if (response.data['Status'] == "Sukses") {
          Session.setIsLogin(true);
          this.dispose();
          Navigator.of(key.currentContext).pushNamedAndRemoveUntil('/home', (Route<dynamic> route) => false);
        } else {
          Scaffold.of(key.currentContext).showSnackBar( SnackBar(
            content: Text(response.data['Message']),
            duration: Duration(seconds: 3),
            action: SnackBarAction(
              label: 'OK',
              textColor: Colors.yellow,
              onPressed: () {},
            ),
          ));
        }
      } on DioError catch (e) {
        print(e.message);
      } finally {
        _loadingController.sink.add(false);
      }

    }
  }

}