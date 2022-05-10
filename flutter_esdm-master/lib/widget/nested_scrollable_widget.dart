import 'package:flutter/material.dart';
import 'package:flutter_esdm/blocs/global_bloc.dart';
class NestedScrollableWidget extends StatelessWidget {
  int itemCount;
  EdgeInsetsGeometry padding;
  Function(BuildContext,int) itemBuilder;
  NestedScrollableWidget({@required this.itemCount,@required this.itemBuilder,this.padding});
  @override
  Widget build(BuildContext context) {
    GlobalBloc globalBloc = GlobalBloc();
    return StreamBuilder(
        initialData: true,
        stream: globalBloc.scrollStream,
        builder: (BuildContext ctx, AsyncSnapshot<bool> snapshotScroll) {
          ScrollController childScrollController = ScrollController();
          return Listener(
            onPointerUp: (event){
              globalBloc.changeScroll(true);
            },
            onPointerMove: (event){
              double movement = event.delta.dy;
              double scrollPosition = childScrollController.position.pixels;
              double maxScrollPosition = childScrollController.position.maxScrollExtent;
              if(scrollPosition == 0.0){
                if(movement < 0.0){
                  globalBloc.changeScroll(true);
                }else if(movement > 0.0){
                  globalBloc.changeScroll(false);
                }
              }else if(scrollPosition == maxScrollPosition){
                if(movement > 0.0){
                  globalBloc.changeScroll(true);
                }else if(movement < 0.0){
                  globalBloc.changeScroll(false);
                }
              }
            },
            child: ListView.builder(
              padding: padding,
              controller: childScrollController,
              physics: snapshotScroll.data ? ClampingScrollPhysics() : NeverScrollableScrollPhysics(),
              shrinkWrap: true,
              itemCount: itemCount,
              itemBuilder: itemBuilder
            ),
          );
        },
        
      );
  }
}