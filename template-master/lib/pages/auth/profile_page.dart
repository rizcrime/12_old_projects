import 'dart:io';

import 'package:cached_network_image/cached_network_image.dart';
import 'package:flutter/material.dart';
import 'package:template/blocs/auth/profile_bloc.dart';
import 'package:template/blocs/global_bloc.dart';
import 'package:template/utils/global_function.dart';
import 'package:template/utils/session.dart';
import 'package:template/utils/uidata.dart';
import 'package:template/utils/validator.dart';
import 'package:template/models/User.dart';
import 'package:template/widgets/custom_text_form_field_widget.dart';
import 'package:template/widgets/loading_widget.dart';
class ProfilePage extends StatefulWidget {
  @override
  _ProfilePageState createState() => _ProfilePageState();
}

class _ProfilePageState extends State<ProfilePage> with ValidationMixin{
  GlobalKey<FormState> _formKey = GlobalKey<FormState>();
  GlobalBloc globalBloc = GlobalBloc();
  User user;
  Map<String,String> listRole = {
    "1":"Direktur",
    "2":"General manager",
    "3":"Sekretaris",
    "4":"General Affair",
    "5":"Staff",
    "6":"Admin",
  };
  TextEditingController _roleCodeController = TextEditingController();
  ProfileBloc profileBloc;
  @override
  void initState() {
    // TODO: implement initState
    profileBloc = ProfileBloc(isGetUser: true);
    super.initState();
  }
  @override
  Widget build(BuildContext context) {
    return Stack(
      children: <Widget>[
        Scaffold(
          appBar: AppBar(
            title: Text("Profile"),
            // actions: <Widget>[
            //   InkWell(
            //     onTap: (){
            //       if(_formKey.currentState.validate()){
            //         _formKey.currentState.save();
            //         showDialog(context: context,
            //           builder: (BuildContext ctxDialog) {
            //             return AlertDialog(
            //               title: Text("Verify Role"),
            //               content: CustomTextFormFieldWidget(
            //                 readOnly: true,
            //                 labelText: "Role Code",
            //                 textEditingController: _roleCodeController,
            //               ),
            //               actions: <Widget>[
            //                 FlatButton(
            //                   child: Text("NO"),
            //                   onPressed: () {
            //                     Navigator.of(ctxDialog).pop();
            //                   },
            //                 ),
            //                 FlatButton(
            //                   child: Text("YES"),
            //                   onPressed: (){
            //                     // if(await GlobalBloc.verifyRole(_formKey, profileBloc.getRole, _roleCodeController.text)){
            //                       profileBloc.onSave(_formKey,user,globalBloc,_roleCodeController.text);
            //                       // Navigator.of(context).pop();
            //                     // }
            //                   },
            //                 ),
            //               ],
            //             );
            //           }
            //         );
            //       }
            //     },
            //     child: Padding(
            //       padding: const EdgeInsets.symmetric(horizontal:15.0),
            //       child: Icon(Icons.save),
            //     ),
            //   ),
            // ],
          ),
          body: ListView(
            children: <Widget>[
              Container(
                width: MediaQuery.of(context).size.width,
                height: 150,
                color: UIData.containerColor,
                child: StreamBuilder(
                  stream: globalBloc.uploadedFileStream,
                  builder: (BuildContext context, AsyncSnapshot<File> snapshot) {
                    Widget child;
                    if(snapshot.hasData){
                      child = ClipRRect(
                        borderRadius: BorderRadius.circular(120),
                        child: Image(image: FileImage(snapshot.data),fit: BoxFit.cover,)
                      );
                    }else{
                      child = StreamBuilder(
                        stream: profileBloc.userStream,
                        builder: (BuildContext ctxUser,AsyncSnapshot<User> userData){
                          if(!userData.hasData) return Container();
                          this.user = userData.data;
                          return CachedNetworkImage(
                              imageUrl: "${UIData.uploadDir}/user/${userData.data.userPicture}",
                              imageBuilder: (context, imageProvider) => ClipRRect(
                                borderRadius: BorderRadius.circular(120),
                                child: Image(
                                  image: imageProvider,
                                  fit: BoxFit.cover
                                ),
                              ),
                              placeholder: (context, url) => Center(child: CircularProgressIndicator()),
                              errorWidget: (context, url, error) => Center(child: Icon(Icons.person,color: Colors.white,size: 100,)),
                          );
                        },
                      );
                    }
                    return Center(
                      child: InkWell(
                        // onTap: () => globalBloc.uploadFile(),
                        child: Container(
                          width: 120,
                          height: 120,
                          decoration: BoxDecoration(
                            border: Border.all(color: Colors.black, width: 1),
                            borderRadius: BorderRadius.circular(120)
                          ),
                          child: child,
                        ),
                      ),
                    );
                  },
                ),
              ),
              Card(
                elevation: 2,
                child: Padding(
                  padding: const EdgeInsets.all(8.0),
                  child: Form(
                    key: _formKey,
                    child: StreamBuilder(
                      stream: profileBloc.userStream,
                      builder: (BuildContext ctxUser, AsyncSnapshot<User> userData){
                        if(!userData.hasData) return Container();
                        return Column(
                          children: <Widget>[
                            CustomTextFormFieldWidget(
                              readOnly: true,
                              labelText: "Name",
                              initialValue: userData.data.userName,
                            ),
                            CustomTextFormFieldWidget(
                              readOnly: true,
                              labelText: "Address",
                              keyboardType: TextInputType.multiline,
                              maxLines: null,
                              initialValue: userData.data.userAddress,
                            ),
                            CustomTextFormFieldWidget(
                              readOnly: true,
                              labelText: "Number",
                              keyboardType: TextInputType.number,
                              initialValue: userData.data.userNumber,
                            ),
                            CustomTextFormFieldWidget(
                              readOnly: true,
                              labelText: "Email",
                              keyboardType: TextInputType.emailAddress,
                              initialValue: userData.data.userEmail,
                            ),
                            CustomTextFormFieldWidget(
                              readOnly: true,
                              labelText: "Role",
                              keyboardType: TextInputType.emailAddress,
                              initialValue: listRole[userData.data.roleId],
                            ),
                            CustomTextFormFieldWidget(
                              readOnly: true,
                              labelText: "User Code",
                              initialValue: userData.data.userCode,
                            ),
                          ],
                        );
                      },
                    ),
                  ),
                ),
              )
            ],
          ),
        ),
        StreamBuilder(
          initialData: true,
          stream: GlobalBloc.loadingStream,
          builder: (ctx,isLoad){
            return LoadingWidget(isLoad.data);
          },
        )
      ],
    );
  }
}