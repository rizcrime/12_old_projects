import 'package:flutter/material.dart';
import 'package:template/blocs/auth/login_bloc.dart';
import 'package:template/blocs/global_bloc.dart';
import 'package:template/utils/uidata.dart';
import 'package:template/utils/validator.dart';
import 'package:template/widgets/base_container_widget.dart';
import 'package:template/widgets/custom_text_form_field_widget.dart';
import 'package:template/widgets/loading_widget.dart';

class LoginPage extends StatefulWidget {
  @override
  _LoginPageState createState() => _LoginPageState();
}

class _LoginPageState extends State<LoginPage> with ValidationMixin{
  final GlobalKey<FormState> _formKey = new GlobalKey<FormState>();
  LoginBloc loginBloc = LoginBloc();
  @override
  Widget build(BuildContext context) {
    return Stack(
      children: <Widget>[
        Scaffold(
          appBar: AppBar(
            title: Text("Sign In"),
          ),
          body: Form(
            key: _formKey,
            child: BaseContainerWidget(
              child: ListView(
                shrinkWrap: true,
                children: <Widget>[
                  Column(
                    crossAxisAlignment: CrossAxisAlignment.center,
                    children: <Widget>[
                      SizedBox(height: 20,),
                      Image(
                        image: AssetImage("assets/icon.png"),
                        width: MediaQuery.of(context).size.width / 2.5,
                      ),
                      Container(
                        padding: EdgeInsets.all(10),
                        margin: EdgeInsets.all(10),
                        color: UIData.containerColor,
                        child: Column(
                          children: <Widget>[
                            CustomTextFormFieldWidget(
                                labelText: "User Code",
                                validator: validateRequired,
                                onSaved: loginBloc.saveCode,
                            ),
                            // StreamBuilder(
                            //   initialData: true,
                            //   stream: loginBloc.showPasswordStream,
                            //   builder: (BuildContext context, AsyncSnapshot<bool> snapshot) {
                            //     return TextFormField(
                            //       decoration: new InputDecoration(
                            //         labelText: "Password",
                            //         suffixIcon: InkWell(
                            //           onTap: ()=> loginBloc.changeVisibility(snapshot.data),
                            //           child: Icon(snapshot.data ? Icons.visibility_off : Icons.visibility),
                            //         )
                            //       ),
                            //       obscureText: snapshot.data,
                            //       validator: validateRequired,
                            //       onSaved: loginBloc.savePassword,
                            //     );
                            //   },
                            // ),
                            SizedBox(height: 20,),
                            MaterialButton(
                              padding: EdgeInsets.symmetric(vertical: 15),
                              onPressed: ()=> loginBloc.doLogin(_formKey),
                              color: UIData.accentColor,
                              minWidth: double.infinity,
                              child: Text("SIGN IN",textAlign: TextAlign.center,),
                            ),
                            SizedBox(height: 10,),
                            MaterialButton(
                              padding: EdgeInsets.symmetric(vertical: 15),
                              onPressed: () => Navigator.of(context).pushNamed("/forgot_code"),
                              color: UIData.darkPrimaryColor,
                              minWidth: double.infinity,
                              child: Text("FORGOT CODE",textAlign: TextAlign.center,),
                            ),
                          ],
                        ),
                      )
                    ],
                  )
                ],
              ),
            ),
          ),
        ),
        StreamBuilder(
          initialData: false,
          stream: GlobalBloc.loadingStream,
          builder: (ctxLoad,snapshot) => LoadingWidget(snapshot.data),
        ),
      ],
    );
  }
}