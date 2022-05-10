import 'package:flutter/material.dart';
import 'package:flutter_esdm/utils/session.dart';

class SplashPage extends StatefulWidget {
  @override
  _SplashPageState createState() => _SplashPageState();
}

class _SplashPageState extends State<SplashPage> {
  @override
  void initState() {
    init();    
    super.initState();
  }
  init() async{
    if (await Session.getIsLogin()) {
      new Future.delayed(const Duration(seconds: 3), () {
        Navigator.of(context)
            .pushNamedAndRemoveUntil('/home', (Route<dynamic> route) => false);
      });
    }else{
      new Future.delayed(const Duration(seconds: 3), () {
        Navigator.of(context)
            .pushNamedAndRemoveUntil('/login', (Route<dynamic> route) => false);
      });
    }
  }
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Container(
        alignment: Alignment.center,
        child: Image(image: AssetImage("assets/logo.png"),width: MediaQuery.of(context).size.width/2,),
      ),
    );
  }
}