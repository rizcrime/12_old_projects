import 'dart:io';

import 'package:dotted_border/dotted_border.dart';
import 'package:flutter/material.dart';
import 'package:template/blocs/global_bloc.dart';
import 'package:template/blocs/news/news_bloc.dart';
import 'package:template/utils/uidata.dart';
import 'package:template/utils/validator.dart';
import 'package:template/widgets/custom_text_form_field_widget.dart';
class AddNewsPage extends StatefulWidget {
  NewsBloc newsBloc;
  String roleId;
  AddNewsPage({this.newsBloc,this.roleId});
  @override
  _AddNewsPageState createState() => _AddNewsPageState();
}

class _AddNewsPageState extends State<AddNewsPage> with ValidationMixin{
  GlobalKey<FormState> _formKey = GlobalKey<FormState>();
  NewsBloc newsBloc;
  GlobalBloc globalBloc;
  validRole(){
    return widget.roleId == UIData.sekretarisId;
  }
  isGA(){
    return widget.roleId == UIData.generalAffairId;
  }
  @override
  void initState() {
    // TODO: implement initState
    super.initState();
    newsBloc  = widget.newsBloc;
    globalBloc = GlobalBloc();
  }
  @override
  Widget build(BuildContext context) {
    globalBloc.generateFocusNode(2);
    return Scaffold(
      resizeToAvoidBottomPadding: false,
      appBar: AppBar(
        title: Text("Add News"),
      ),
      body: Stack(
        children: <Widget>[
          Padding(
            padding: const EdgeInsets.all(10),
            child: Form(
              key: _formKey,
              child: Column(
                children: <Widget>[
                  InkWell(
                    onTap: () => globalBloc.uploadFile(),
                    child: DottedBorder(
                      radius: Radius.circular(50),
                      color: Colors.grey,
                      strokeWidth: 3,
                      dashPattern: [10],
                      child: Container(
                        width: MediaQuery.of(context).size.width,
                        height: 200,
                        child: Center(
                          child: StreamBuilder(
                            stream: globalBloc.uploadedFileStream,
                            builder: (BuildContext context, AsyncSnapshot<File> snapshot) {
                              if(snapshot.hasData){
                                return Image(image: FileImage(snapshot.data),fit: BoxFit.fitHeight,height: double.infinity,);
                              } 
                              return Icon(Icons.image);
                            },
                          ),
                        )
                      ),
                    ),
                  ),
                  CustomTextFormFieldWidget(
                    labelText: "Title",
                    validator: validateRequired,
                    onSaved: newsBloc.saveTitle,
                    focusNode: globalBloc.getFocusNode(0),
                    nextFocusNode: globalBloc.getFocusNode(1),
                  ),
                  CustomTextFormFieldWidget(
                    labelText: "Description",
                    maxLines: null,
                    textInputAction: TextInputAction.newline,
                    validator: validateRequired,
                    onSaved: newsBloc.saveDescription,
                    focusNode: globalBloc.getFocusNode(1),
                    nextFocusNode: new FocusNode(),
                  ),
                ],
              ),
            ),
          ),
          Align(
            alignment: FractionalOffset.bottomCenter,
            child: InkWell(
              onTap: () => newsBloc.onSave(_formKey, null,globalBloc),
              child: Container(
                padding: EdgeInsets.symmetric(vertical: 20),
                width: double.infinity,
                color: UIData.bcContactColor,
                child: Text("SUBMIT POST",textAlign: TextAlign.center,style: TextStyle(color: Colors.white),),
              ),
            ),
          )
        ],
      ),
    );
  }
}