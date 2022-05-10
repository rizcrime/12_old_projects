import 'package:flutter/material.dart';
import 'package:template/blocs/global_bloc.dart';
import 'package:template/blocs/note/note_bloc.dart';
import 'package:template/models/Note.dart';
import 'package:template/pages/note/add_note_page.dart';
import 'package:template/pages/note/history_note_page.dart';
import 'package:template/pages/note/widget/card_widget.dart';
import 'package:template/utils/global_function.dart';
import 'package:template/utils/uidata.dart';
import 'package:template/widgets/base_container_widget.dart';
import 'package:template/widgets/loading_widget.dart';
class NotePage extends StatefulWidget {
  String roleId;
  NotePage({this.roleId});
  @override
  _NotePageState createState() => _NotePageState();
}

class _NotePageState extends State<NotePage> with SingleTickerProviderStateMixin{
  validRole(){
    return widget.roleId == UIData.sekretarisId;
  }
  TabController _tabController;
  NoteBloc noteBloc;
  @override
  void initState() {
    _tabController = new TabController(vsync: this, length: 2);
    super.initState();
    noteBloc = NoteBloc(isGetData: true);
  }
  @override
  Widget build(BuildContext context) {
    return Stack(
      children: <Widget>[
        Scaffold(
          appBar: AppBar(
            title: Text("Note"),
            actions: <Widget>[
              validRole() ?InkWell(
                onTap: () => GlobalFunction.changePage(context, AddNotePage(noteBloc: this.noteBloc,isValid: validRole(),)),
                child: Padding(
                  padding: EdgeInsets.symmetric(horizontal:15),
                  child: Icon(Icons.add),
                ),
              ):Container()
            ],
          ),
          body: BaseContainerWidget(
            child: Stack(
              children: <Widget>[
                Container(
                  color: Colors.white.withOpacity(0.8),
                  child: TabBar(
                    controller: _tabController,
                    indicatorColor: UIData.bcContactColor,
                    tabs: <Widget>[
                      Tab(child: Text("MAIN NOTE",textAlign: TextAlign.center,),),
                      Tab(child: Text("HISTORY",textAlign: TextAlign.center,),),
                    ],
                  ),
                ),
                Container(
                  margin: EdgeInsets.only(top: 50),
                  child: TabBarView(
                    controller: _tabController,
                    children: <Widget>[
                      StreamBuilder(
                        stream: noteBloc.listNoteStream,
                        builder: (BuildContext ctxStream, AsyncSnapshot<List<Note>> snapshot){
                          if(!snapshot.hasData) return Container();
                          var data = snapshot.data;
                          return ListView.separated(
                            itemCount: data.length,
                            padding: EdgeInsets.all(10),
                            itemBuilder: (BuildContext ctxList, int index){
                              return CardWidget(note: data[index],onTap:() => GlobalFunction.changePage(context, AddNotePage(note: data[index],noteBloc: this.noteBloc,isValid: validRole(),)),noteBloc: this.noteBloc,isValidRole: validRole(),);
                            }, separatorBuilder: (BuildContext context, int index) => SizedBox(height: 10,),
                          );
                        },
                      ),
                      StreamBuilder(
                        stream: noteBloc.listNoteStream,
                        builder: (BuildContext ctxStream, AsyncSnapshot<List<Note>> snapshot){
                          if(!snapshot.hasData) return Container();
                          var data = snapshot.data;
                          return ListView.separated(
                            itemCount: data.length,
                            padding: EdgeInsets.all(10),
                            itemBuilder: (BuildContext ctxList, int index){
                              return CardWidget(note:data[index],onTap: () => GlobalFunction.changePage(context, HistoryNotePage(data[index])),isValidRole: validRole());
                            }, separatorBuilder: (BuildContext context, int index) => SizedBox(height: 10,),
                          );
                        },
                      ),
                    ],
                  ),
                )
              ],
            ),
          ),
        ),
        StreamBuilder(
          initialData: true,
          stream: GlobalBloc.loadingStream,
          builder: (ctxLoading,snapshot){
            return LoadingWidget(snapshot.data);
          },
        ),
      ],
    );
  }
}