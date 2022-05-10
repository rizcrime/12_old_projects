import 'package:flutter/material.dart';
import 'package:flutter_esdm/widget/custom_expansion_tile_widget.dart' as Custom;
class TestExpandableView extends StatefulWidget {
  @override
  _TestExpandableViewState createState() => _TestExpandableViewState();
}

class _TestExpandableViewState extends State<TestExpandableView> {
  int _activeMeterIndex;
  @override
  Widget build(BuildContext context) {
    return Container(
      child: new ListView.builder(
        itemCount:  2,
          itemBuilder: (BuildContext context, int i) {
            return Card(
              margin:
              const EdgeInsets.fromLTRB(10.0, 15.0, 10.0, 0.0),
              child: new Custom.ExpansionPanelList(
                expansionCallback: (int index, bool status) {
                  setState(() {
                    _activeMeterIndex = _activeMeterIndex == i ? null : i;
                  });
                },
                children: [
                  new Custom.ExpansionPanel(
                      isExpanded: _activeMeterIndex == i,
                      headerBuilder: (BuildContext context,
                          bool isExpanded) =>
                      new Container(
                          padding:
                          const EdgeInsets.only(left: 15.0),
                          alignment: Alignment.centerLeft,
                          child: new Text(
                            'list-$i',
                          )),
                      body: new Container(child: new Text('content-$i'),),),
                ],
              ),
            );
          }),
    );
  }
}