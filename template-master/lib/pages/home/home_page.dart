import 'package:flutter/material.dart';
import 'package:flutter_mailer/flutter_mailer.dart';
import 'package:template/blocs/auth/login_bloc.dart';
import 'package:template/blocs/global_bloc.dart';
import 'package:template/pages/contact/contact_page.dart';
import 'package:template/pages/mail/mail_page.dart';
import 'package:template/pages/news/news_page.dart';
import 'package:template/pages/note/note_page.dart';
import 'package:template/pages/reminder/reminder_page.dart';
import 'package:template/pages/schedule/schedule_page.dart';
import 'package:template/pages/tes_page.dart';
import 'package:template/pages/webview_page.dart';
import 'package:template/utils/api.dart';
import 'package:template/utils/global_function.dart';
import 'package:template/utils/session.dart';
import 'package:template/utils/uidata.dart';
import 'package:template/widgets/base_container_widget.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';
class HomePage extends StatelessWidget {
  LoginBloc loginBloc = LoginBloc();
  init()async{
    GlobalBloc.setRoleController(await Session.getRoleId());
  }
  @override
  Widget build(BuildContext context) {
    init();
    //Start Generate Notification
    // GlobalBloc.generateNotification();
    //End Generate Notification
    return Scaffold(
      appBar: AppBar(
        title: Text("GripWorkJourney"),
        actions: <Widget>[
          Row(
            crossAxisAlignment: CrossAxisAlignment.center,
            children: <Widget>[
              InkWell(
                onTap: () => Navigator.of(context).pushNamed("/profile"),
                child: Container(
                  margin: EdgeInsets.symmetric(horizontal: 5),
                  padding: EdgeInsets.all(5),
                  decoration: BoxDecoration(
                    color: Colors.white,
                    borderRadius: BorderRadius.circular(20)
                  ),
                  child: Icon(Icons.person)
                ),
              ),
              InkWell(
                // onTap: ()=>GlobalFunction.changePage(context, TestPage()),
                onTap: ()=>loginBloc.doLogout(context),
                child: Container(
                  margin: EdgeInsets.symmetric(horizontal: 5),
                  padding: EdgeInsets.all(5),
                  decoration: BoxDecoration(
                    color: Colors.white,
                    borderRadius: BorderRadius.circular(20)
                  ),
                  child: Icon(FontAwesomeIcons.signOutAlt)
                ),
              ),
              InkWell(
                onTap: ()=>Navigator.of(context).pushNamed("/intro"),
                child: Container(
                  margin: EdgeInsets.symmetric(horizontal: 5),
                  padding: EdgeInsets.all(5),
                  decoration: BoxDecoration(
                    color: Colors.white,
                    borderRadius: BorderRadius.circular(20)
                  ),
                  child: Icon(FontAwesomeIcons.question)
                ),
              ),
            ],
          ),
        ],
        automaticallyImplyLeading: false,
      ),
      body: BaseContainerWidget(
        child: Stack(
          alignment: Alignment.center,
          children: <Widget>[
            Image(
                image: AssetImage("assets/gwj.png"),
                width: 150,
                height: 150,
                fit: BoxFit.cover,
              ),
            Container(
              margin: const EdgeInsets.only(bottom: 245),
              child: StreamBuilder(
                initialData: "",
                stream: GlobalBloc.roleStream,
                builder: (BuildContext ctx, AsyncSnapshot<String> snapshot){
                  return InkWell(
                    onTap: (){
                      // if(["1","2","3"].contains(snapshot.data)){
                        GlobalFunction.changePage(context, ContactPage(roleId: snapshot.data,));
                        // Navigator.of(context).pushNamed("/contact");
                      // }else{
                        // GlobalFunction.showAlertDialog(context, "You don't have access to this menu");
                      // }
                    },
                    child: Image(
                      image: AssetImage("assets/kontax.png"),
                      width: 150,
                      height: 150,
                      fit: BoxFit.cover,
                    ),
                  );
                },
              ),
            ),
            Container(
              margin: const EdgeInsets.only(bottom: 245/2,left: 213),
              child: StreamBuilder(
                initialData: "",
                stream: GlobalBloc.roleStream,
                builder: (BuildContext ctx, AsyncSnapshot<String> snapshot){
                  return InkWell(
                    onTap: (){
                      // if(["1","2","3","4"].contains(snapshot.data)){
                        // Navigator.of(context).pushNamed("/reminder");
                        GlobalFunction.changePage(context, ReminderPage(roleId: snapshot.data,));
                      // }else{
                        // GlobalFunction.showAlertDialog(context, "You don't have access to this menu");
                      // }
                    },
                    child: Image(
                      image: AssetImage("assets/reminderx.png"),
                      width: 150,
                      height: 150,
                      fit: BoxFit.cover,
                    ),
                  );
                }
              ),
            ),
            Container(
              margin: const EdgeInsets.only(top: 245/2,left: 213),
              child: StreamBuilder(
                initialData: "",
                stream: GlobalBloc.roleStream,
                builder: (BuildContext ctx, AsyncSnapshot<String> snapshot){
                  return InkWell(
                    onTap: (){
                      // if(["1","2","3","4"].contains(snapshot.data)){
                        // Navigator.of(context).pushNamed("/schedule");
                        GlobalFunction.changePage(context, SchedulePage(roleId: snapshot.data,));
                      // }else{
                        // GlobalFunction.showAlertDialog(context, "You don't have access to this menu");
                      // }
                    },
                    child: Image(
                      image: AssetImage("assets/schedulex.png"),
                      width: 150,
                      height: 150,
                      fit: BoxFit.cover,
                    ),
                  );
                }
              ),
            ),
            Container(
              margin: const EdgeInsets.only(top: 245),
              child: StreamBuilder(
                initialData: "",
                stream: GlobalBloc.roleStream,
                builder: (BuildContext ctx, AsyncSnapshot<String> snapshot){
                  return InkWell(
                    onTap: (){
                      // if(["1","2","3","6"].contains(snapshot.data)){
                        // Navigator.of(context).pushNamed("/news");
                        GlobalFunction.changePage(context, NewsPage(roleId: snapshot.data,));
                      // }else{
                        // GlobalFunction.showAlertDialog(context, "You don't have access to this menu");
                      // }
                    },
                    child: Image(
                      image: AssetImage("assets/newsx.png"),
                      width: 150,
                      height: 150,
                      fit: BoxFit.cover,
                    ),
                  );
                }
              ),
            ),
            Container(
              margin: const EdgeInsets.only(top: 245/2,right: 213),
              child: StreamBuilder(
                initialData: "",
                stream: GlobalBloc.roleStream,
                builder: (BuildContext ctx, AsyncSnapshot<String> snapshot){
                  return InkWell(
                    onTap: ()=>GlobalFunction.changePage(context, NotePage(roleId: snapshot.data,)),
                    child: Image(
                      image: AssetImage("assets/notex.png"),
                      width: 150,
                      height: 150,
                      fit: BoxFit.cover,
                    ),
                  );
                }
              ),
            ),
            Container(
              margin: const EdgeInsets.only(bottom: 245/2,right: 213),
              child: StreamBuilder(
                initialData: "",
                stream: GlobalBloc.roleStream,
                builder: (BuildContext ctx, AsyncSnapshot<String> snapshot){
                  return InkWell(
                    // onTap: ()async{
                    //   final MailOptions mailOptions = MailOptions(
                    //   // body: 'a long body for the email <br> with a subset of HTML',
                    //   subject: "",
                    //   // recipients: ['example@example.com'],
                    //   // isHTML: true,
                    //   // bccRecipients: ['other@example.com'],
                    //   // ccRecipients: ['third@example.com'],
                    //   attachments: [ "http://192.168.43.240/gwj-api/upload/user/1566033966_image_cropper_1566033963845.jpg", ],
                    // );
                    // await FlutterMailer.send(mailOptions);
                    // },
                    onTap: ()async{

                      if(snapshot.data == UIData.sekretarisId){
                        // Navigator.of(context).pushNamed("/news");
                        String companyId = await Session.getCompanyId();
                        GlobalFunction.changePage(context, MailPage(companyId));
                      // }else{
                        // GlobalFunction.showAlertDialog(context, "You don't have access to this menu");
                      }else{
                        GlobalFunction.showAlertDialog(context, "You don't have access to this menu");
                      }
                    },
                    // onTap: ()=>Navigator.of(context).pushNamed("/mail"),
                    child: Image(
                      image: AssetImage("assets/mailx.png"),
                      width: 150,
                      height: 150,
                      fit: BoxFit.cover,
                    ),
                  );
                }
              ),
            ),
          ],
        ),
      ),
    );
  }
}