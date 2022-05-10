import 'package:flutter/material.dart';
class CardWidget extends StatelessWidget {
  String title,content;
  Color statusColor;
  CardWidget(this.title,this.content,{this.statusColor = Colors.black});
  @override
  Widget build(BuildContext context) {
    return Container(
      width: MediaQuery.of(context).size.width,
      padding: EdgeInsets.all(10),
      margin: EdgeInsets.symmetric(vertical: 2),
      decoration: BoxDecoration(
        borderRadius: BorderRadius.circular(10),
        color: Colors.white
      ),
      child: Column(
        mainAxisAlignment: MainAxisAlignment.start,
        crossAxisAlignment: CrossAxisAlignment.start,
        children: <Widget>[
          title != "" ? Text(title,style: TextStyle(color: this.statusColor,fontWeight: FontWeight.bold),):Container(),
          content != "" ? Text(content,style: TextStyle(color: this.statusColor),):Container(),
        ],
      ),
    );
  }
}