import 'package:flutter/material.dart';
import 'package:flutter_esdm/blocs/auth/login_bloc.dart';
import 'package:flutter_esdm/utils/session.dart';
import 'package:flutter_esdm/utils/uidata.dart';
import 'package:flutter_esdm/utils/validator.dart';
import 'package:flutter_esdm/widget/loading_widget.dart';
class LoginPage extends StatefulWidget{

  @override
  _LoginPageState createState() => _LoginPageState();
}

class _LoginPageState extends State<LoginPage> with ValidationMixin{
  final GlobalKey<FormState> _formKey = new GlobalKey<FormState>();
  LoginBloc loginBloc;
  
  @override
  void initState() {
    loginBloc = LoginBloc();
    init();
    super.initState();
  }

  @override
  void dispose() {
    loginBloc.dispose();
    super.dispose();
  }

  init() async {
    if (await Session.getIsLogin()) {
      Navigator.of(context)
          .pushNamedAndRemoveUntil('/home', (Route<dynamic> route) => false);
    }
  }
  
  InputBorder borderText({Color bColor = Colors.black}){
    return 
          OutlineInputBorder(
            borderSide:  BorderSide(color: bColor, width: 2.0),
          );
  }
  FocusNode usernameFocusNode = FocusNode();
  FocusNode passwordFocusNode = FocusNode();
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      resizeToAvoidBottomPadding: false,
      body: Form(
        key: _formKey,
        child: Stack(
          children: <Widget>[
            Positioned(
              bottom: 0,
              child: Container(
                width: MediaQuery.of(context).size.width,
                height: 80,
                color: Colors.black,
                child: Center(
                  child: Text(UIData.txtFooter,
                    style: TextStyle(color: Colors.white,fontSize: 10),
                    textAlign: TextAlign.center),
                ),
              ),
            ),
            Center(
              child: Container(
                width: MediaQuery.of(context).size.width - 100,
                child: Column(
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: <Widget>[
                    Image(
                      image: AssetImage("assets/logo.png"),
                      width: MediaQuery.of(context).size.width/2,
                      ),
                    SizedBox(height: 25,),
                    TextFormField(
                      focusNode: usernameFocusNode,
                      textInputAction: TextInputAction.next,
                      onFieldSubmitted: (str){
                        usernameFocusNode.unfocus();
                        passwordFocusNode.requestFocus();
                      },
                      autofocus: true,
                      style: TextStyle(fontSize: 16.0, color: Colors.black),
                      decoration: InputDecoration(
                        enabledBorder: borderText(),
                        disabledBorder: borderText(),
                        errorBorder: borderText(),
                        focusedBorder: borderText(),
                        focusedErrorBorder: borderText(),
                        contentPadding: EdgeInsets.all(12.0),
                        fillColor: Colors.white,
                        filled: true,
                        hintText: "Username",
                        border: InputBorder.none,
                        suffixIcon: Icon(Icons.person,size: 25,color: Colors.black,),
                      ),
                      keyboardType: TextInputType.text,
                      maxLines: 1,
                      validator: validateRequired,
                      onSaved: loginBloc.updateusername,
                      // obscureText: true,
                    ),
                    SizedBox(height:10),
                    TextFormField(
                      focusNode: passwordFocusNode,
                      style: TextStyle(fontSize: 16.0, color: Colors.black),
                      decoration: InputDecoration(
                        enabledBorder: borderText(),
                        disabledBorder: borderText(),
                        errorBorder: borderText(),
                        focusedBorder: borderText(),
                        focusedErrorBorder: borderText(),
                        contentPadding: EdgeInsets.all(12.0),
                        fillColor: Colors.white,
                        filled: true,
                        hintText: "Password",
                        border: InputBorder.none,
                        suffixIcon: Icon(Icons.lock,size: 25,color: Colors.black,),
                      ),
                      keyboardType: TextInputType.text,
                      maxLines: 1,
                      obscureText: true,
                      validator: validateRequired,
                      onSaved: loginBloc.updatePassword,
                    ),
                    SizedBox(height: 20,),
                    RaisedButton(
                      child: Container(
                          width: MediaQuery.of(context).size.width,
                          child: Text("MASUK",textAlign: TextAlign.center,),
                        ),
                      color: UIData.colorYellow,
                      // onPressed: () => Navigator.of(context).pushNamed('/home'),
                      onPressed: ()=>loginBloc.onLogin(this._formKey),
                    ) 
                  ],
                ),
              ),
            ),
            StreamBuilder(
                initialData: false,
                stream: loginBloc.loadingStream,
                builder: (BuildContext ctx, AsyncSnapshot<bool> snapshot) {
                  return LoadingWidget(snapshot.data);
                }),

          ],
        ),
      ),
    );
  }
}