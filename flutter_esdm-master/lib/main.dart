import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:flutter_esdm/routes.dart';
import 'package:flutter_esdm/utils/uidata.dart';

void main() => runApp(MyApp());

class MyApp extends StatelessWidget {
  // This widget is the root of your application.
  @override
  Widget build(BuildContext context) {
    MaterialColor primaryBlack = MaterialColor(
          0xFF000000,
          <int, Color>{
            50: Colors.black,
            100: Colors.black,
            200: Colors.black,
            300: Colors.black,
            350: Colors.black, // only for raised button while pressed in light theme
            400: Colors.black,
            500: Colors.black,
            600: Colors.black,
            700: Colors.black,
            800: Colors.black,
            850: Colors.black, // only for background color in dark theme
            900: Colors.black,
          },
        );
    SystemChrome.setSystemUIOverlayStyle(SystemUiOverlayStyle(
      statusBarColor: Colors.black
    ));
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      title: UIData.appName,
      routes: routes,
      theme: ThemeData(
        primarySwatch: primaryBlack,
      ),
      // home: MyHomePage(title: 'Flutter Demo Home Page'),
    );
  }
}
