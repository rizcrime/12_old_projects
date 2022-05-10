import 'package:shared_preferences/shared_preferences.dart';

class Session{

  static final  String isLogin = "isLogedIn";
  // is user login session
  static Future<bool> getIsLogin()async{
    final SharedPreferences prefs = await SharedPreferences.getInstance();
    return prefs.getBool(isLogin)?? false;
  }

  static Future<bool> setIsLogin(bool value)async{
    final SharedPreferences prefs = await SharedPreferences.getInstance();
    return prefs.setBool(isLogin,value);
  }
}
