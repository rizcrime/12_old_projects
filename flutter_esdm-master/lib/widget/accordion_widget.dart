import 'package:flutter/material.dart';
import 'package:flutter_esdm/blocs/global_bloc.dart';
import 'package:flutter_esdm/utils/uidata.dart';
import 'package:flutter_esdm/widget/custom_expansion_tile_widget.dart' as Custom;
class AccordionWidget extends StatelessWidget {
  String txt;
  Widget content;
  int index;
  GlobalBloc globalBloc;
  AccordionWidget(this.index,this.globalBloc,this.txt,this.content);
  @override
  Widget build(BuildContext context) {
    return StreamBuilder(
      stream: globalBloc.expandStream,
      builder: (BuildContext context, AsyncSnapshot<List<bool>> snapshot) {
        if(!snapshot.hasData) return Container();
        return Container(
          margin: EdgeInsets.all(10),
          child: ClipRRect(
            borderRadius: BorderRadius.circular(10),
            child: Custom.ExpansionPanelList(
              expansionCallback: (i,data)=>globalBloc.expansionCallback(index,data),
              children: [
                Custom.ExpansionPanel(
                  isExpanded: snapshot.data[index],
                  headerBuilder: (BuildContext context, bool isExpanded) =>
                  Container(
                    // padding: EdgeInsets.all(10),
                    // margin: EdgeInsets.symmetric(horizontal: 10),
                    decoration: BoxDecoration(
                      borderRadius: BorderRadius.circular(10),
                      color: UIData.colorYellow
                    ),
                    child: Center(child: Text(txt,textAlign: TextAlign.center,)),
                  ),
                  body: ClipRRect(
                    borderRadius: BorderRadius.circular(10),
                    child: Container(
                      width: MediaQuery.of(context).size.width,
                      padding: EdgeInsets.all(10),
                      color: Colors.orange,
                      child: content,
                    ),
                  ),
                )
              ],
            ),
          ),
        );
      },
    );
  }
}