import 'package:flutter/material.dart';
import 'package:template/blocs/mail/mail_bloc.dart';
import 'package:template/models/Mail.dart';
import 'package:template/utils/api.dart';
import 'package:template/utils/uidata.dart';

class ListMailPage extends StatelessWidget {
  MailBloc mailBloc;
  String companyId;
  ListMailPage(this.mailBloc,this.companyId);
  @override
  Widget build(BuildContext context) {
    mailBloc.getData();
    return Scaffold(
      appBar: AppBar(
        title: Text("Choose Template"),
      ),
      body: StreamBuilder(
        stream: mailBloc.listTemplateStream,
        builder: (BuildContext ctxStream, AsyncSnapshot<List<Mail>> snapshot){
          if(!snapshot.hasData) return Container();
          return ListView.builder(
            itemCount: snapshot.data.length,
            itemBuilder: (ctxList,i){
              return ListTile(
                onTap: (){
                  mailBloc.updateUrl(ApiProvider.CORE_URL+"/mail?companyId=$companyId&id=${snapshot.data[i].id}");
                  Navigator.of(context).pop();
                },
                // onTap: (){
                  // if(type == "template"){
                  //   mailBloc.openTemplate(context,setContent,snapshot.data[i]);
                  // }else if(type == "pdf"){
                  //   mailBloc.sendPdf(snapshot.data[i]);
                  // }
                // },
                leading: Icon(Icons.insert_drive_file),
                title: Text(snapshot.data[i].name),
                trailing: PopupMenuButton(
                  onSelected: (val) => mailBloc.doAction(context, val, snapshot.data[i]),
                  icon: Icon(Icons.more_vert,color: UIData.bcContactColor,),
                  itemBuilder: (BuildContext popUpContext) {
                    return [
                      PopupMenuItem(
                        value: "send",
                        child: Text("Send"),
                      ),
                      PopupMenuItem(
                        value: "delete",
                        child: Text("Delete"),
                      )
                    ];
                  },
                ),
              );
            },
          );
        },
      ),
    );
  }
}