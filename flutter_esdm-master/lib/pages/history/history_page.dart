import 'package:flutter/material.dart';
import 'package:flutter_esdm/pages/history/widget/tab_kegeologian_widget.dart';
import 'package:flutter_esdm/pages/history/widget/tab_pusdatin_widget.dart';
class HistoryPage extends StatefulWidget {

  @override
  _HistoryPageState createState() => _HistoryPageState();
}

class _HistoryPageState extends State<HistoryPage> with SingleTickerProviderStateMixin{
  TabController _tabController;
  ScrollController _scrollController;
  @override
  void initState() {
    this.setStateTab();
    _scrollController = ScrollController();

    super.initState();
  }
  @override
  void dispose() {
    _tabController.dispose();
    _scrollController.dispose();
    super.dispose();
  }
  void setStateTab(){
    _tabController = new TabController(vsync: this, length: 2);
  }
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text("History",style: TextStyle(color: Colors.white),),
        bottom: TabBar(
          controller: _tabController,
          indicatorColor: Colors.cyan,
          tabs: <Widget>[
            Tab(child: Text("UPDATE HARIAN ESDM",textAlign: TextAlign.center,style: TextStyle(fontSize: 13, color: Colors.white),),),
            Tab(child: Text("UPDATE KEGEOLOGIAN",textAlign: TextAlign.center,style: TextStyle(fontSize: 13, color: Colors.white),),),
            // Tab(child: Text("UPDATE BERITA",textAlign: TextAlign.center,style: TextStyle(fontSize: 13, color: Colors.white),),),
          ],
        ),
      ),
      body: TabBarView(
        controller: _tabController,
        children: <Widget>[
          TabPusdatinWidget(),
          TabKegeologianWidget(),
          // Container(),
        ],
      ),
    );
    // return Scaffold(
    //   body: NestedScrollView(
    //     headerSliverBuilder: (BuildContext context, bool innerBoxIsScrolled) {
    //       return <Widget>[
    //         SliverAppBar(
    //           title: Text("History",style: TextStyle(color: Colors.white),),
    //           pinned: true,
    //           floating: true,
    //           forceElevated: innerBoxIsScrolled,
    //           bottom: TabBar(
    //             controller: _tabController,
    //             indicatorColor: Colors.cyan,
    //             tabs: <Widget>[
    //               Tab(child: Text("UPDATE HARIAN ESDM",textAlign: TextAlign.center,style: TextStyle(fontSize: 13, color: Colors.white),),),
    //               Tab(child: Text("UPDATE KEGEOLOGIAN",textAlign: TextAlign.center,style: TextStyle(fontSize: 13, color: Colors.white),),),
    //               // Tab(child: Text("UPDATE BERITA",textAlign: TextAlign.center,style: TextStyle(fontSize: 13, color: Colors.white),),),
    //             ],
    //           ),
    //         )
    //       ];
    //     },
    //     body: TabBarView(
    //       controller: _tabController,
    //       children: <Widget>[
    //         TabPusdatinWidget(),
    //         TabKegeologianWidget(),
    //         // Container(),
    //       ],
    //     ),
    //   ),
    // );
  
  }
}