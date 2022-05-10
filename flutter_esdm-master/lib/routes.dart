
import 'package:flutter/material.dart';
import 'package:flutter_esdm/pages/auth/login_page.dart';
import 'package:flutter_esdm/pages/history/history_page.dart';
import 'package:flutter_esdm/pages/home/home_page.dart';
import 'package:flutter_esdm/pages/splash/splash_page.dart';
import 'package:flutter_esdm/pages/update_berita/update_berita_page.dart';
import 'package:flutter_esdm/pages/update_harian_esdm/update_harian_esdm_page.dart';
import 'package:flutter_esdm/pages/update_kegeologian/update_kegeologian_page.dart';

final routes = <String, WidgetBuilder>{
  '/': (BuildContext context) => new SplashPage(),
  '/login': (BuildContext context) => new LoginPage(),
  '/home': (BuildContext context) => new HomePage(),
  '/update_harian_esdm': (BuildContext context) => new UpdateHarianESDMPage(),
  '/update_kegeologian': (BuildContext context) => new UpdateKegeologianPage(),
  '/update_berita': (BuildContext context) => new UpdateBeritaPage(),
  '/history': (BuildContext context) => new HistoryPage(),
};
