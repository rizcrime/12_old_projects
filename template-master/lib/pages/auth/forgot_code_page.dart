import 'package:flutter/material.dart';
import 'package:template/blocs/auth/forgot_code_bloc.dart';
import 'package:template/blocs/auth/login_bloc.dart';
import 'package:template/blocs/global_bloc.dart';
import 'package:template/utils/uidata.dart';
import 'package:template/utils/validator.dart';
import 'package:template/widgets/base_container_widget.dart';
import 'package:template/widgets/custom_text_form_field_widget.dart';
import 'package:template/widgets/loading_widget.dart';

class ForgotCodePage extends StatefulWidget {
  @override
  _ForgotCodePageState createState() => _ForgotCodePageState();
}

class _ForgotCodePageState extends State<ForgotCodePage> with ValidationMixin{
  final GlobalKey<FormState> _formKey = new GlobalKey<FormState>();
  ForgotCodeBloc forgotCodeBloc;
  @override
  void initState() {
    forgotCodeBloc = ForgotCodeBloc();
    super.initState();
  }
  @override
  Widget build(BuildContext context) {
    return Stack(
      children: <Widget>[
        Scaffold(
          appBar: AppBar(
            title: Text("Forgot Password"),
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
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: <Widget>[
                            CustomTextFormFieldWidget(
                                labelText: "Email",
                                keyboardType: TextInputType.emailAddress,
                                validator: validateEmail,
                                onSaved: forgotCodeBloc.saveEmail,
                            ),
                            SizedBox(height: 10,),
                            MaterialButton(
                              padding: EdgeInsets.symmetric(vertical: 15),
                              onPressed: () => forgotCodeBloc.onNext(_formKey),
                              color: UIData.darkPrimaryColor,
                              minWidth: double.infinity,
                              child: Text("Next",textAlign: TextAlign.center,),
                            ),
                          ],
                        ),
                      ),],
                  )
                ],
              ),
            ),
          ),
        ),
        StreamBuilder(
          initialData: false,
          stream: GlobalBloc.loadingStream,
          builder: (ctxLoad,snapshot){
            return LoadingWidget(snapshot.data);
          },
        ),
      ],
    );
  }
}