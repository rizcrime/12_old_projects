import 'package:flutter/material.dart';
import 'package:flutter_esdm/blocs/auth/login_bloc.dart';
import 'package:flutter_esdm/blocs/home/home_bloc.dart';
import 'package:flutter_esdm/utils/uidata.dart';
import 'package:marquee_flutter/marquee_flutter.dart';
class HomePage extends StatelessWidget {
  HomeBloc homeBloc = HomeBloc();
  Widget btn(int index,BuildContext ctx,String imageName,String txt,String routeName){
    return InkWell(
      onTap: () => homeBloc.setAsZooom(ctx,index,routeName),
      child: Card(
        color: UIData.colorYellow,
        semanticContainer: true,
        clipBehavior: Clip.antiAliasWithSaveLayer,
        shape: RoundedRectangleBorder(
          borderRadius: BorderRadius.circular(10.0),
        ),
        elevation: 5,
        margin: EdgeInsets.all(10),
        child: Container(
          width: MediaQuery.of(ctx).size.width/2-20,
          padding: EdgeInsets.all(8),
          child: Column(
              children: <Widget>[
                Container(
                  width: MediaQuery.of(ctx).size.width/2-50,
                  height: MediaQuery.of(ctx).size.width/2-50,
                  decoration: BoxDecoration(
                    color: Colors.white,
                    border: Border.all(color: Colors.black,width: 2),
                    borderRadius: BorderRadius.circular(10)
                  ),
                  child: Stack(
                    alignment: Alignment.center,
                    children: <Widget>[
                      StreamBuilder(
                        initialData: [false,false,false,false],
                        stream: homeBloc.zoomStream,
                        builder: (BuildContext context, AsyncSnapshot<List<bool>> snapshot) {
                          double position = 0;
                          double padding = 50;
                          if(index == 3){
                            padding = snapshot.data.elementAt(index) ? 20 : 35;
                            return AnimatedPadding(
                              duration: Duration(milliseconds: 500),
                              padding: EdgeInsets.all(padding),
                              child: Image.asset(
                                "assets/$imageName",
                                fit: BoxFit.fill,
                                width: MediaQuery.of(ctx).size.width/2-50,
                                height: MediaQuery.of(ctx).size.width/2-50,
                              )
                            );
                          }else{
                            position = snapshot.data.elementAt(index) ? -20 : 0;
                            return AnimatedPositioned(
                              duration: Duration(milliseconds: 500),
                              left: position,
                              top: position,
                              right: position,
                              bottom: position,
                              child: Image.asset("assets/$imageName",fit: BoxFit.fill,)
                            );
                          }
                        },
                      )
                    ],
                  ),
                  // child: Image(image: AssetImage("assets/$imageName"),)
                ),
                SizedBox(height: 5,),
                Container(
                  padding: EdgeInsets.all(5),
                  width: MediaQuery.of(ctx).size.width/2-50,
                  decoration: BoxDecoration(
                    color: Colors.black,
                  ),
                  child: Text(txt,style: TextStyle(color: Colors.white, fontSize: 18),textAlign: TextAlign.center,),
                )
              ],
            ),
        ),
),
    );
  }
  @override
  Widget build(BuildContext context) {
    LoginBloc loginBloc = LoginBloc();
    return Scaffold(
      body: Stack(
        children: <Widget>[
          Positioned(
            left: 20,
            top: 50,
            child: Container(
              width: 50,
              child: ClipRRect(
                borderRadius: BorderRadius.circular(5),
                child: RaisedButton(
                  padding: EdgeInsets.all(10),
                  color: UIData.colorYellow,
                  child: Image(image: AssetImage("assets/back-button.png"),),
                  onPressed: ()=> loginBloc.onLogout(context),
                ),
              ),
            ),
          ),
          Column(
            mainAxisAlignment: MainAxisAlignment.center,
            crossAxisAlignment: CrossAxisAlignment.center,
            children: <Widget>[
              Row(
                children: <Widget>[
                  btn(0,context,"geologi.png", "Update Harian ESDM","/update_harian_esdm"),
                  btn(1,context,"esdm.png", "Update Kegeologian","/update_kegeologian")
                ],
              ),
              Row(
                children: <Widget>[
                  btn(2,context,"berita.png", "Update Berita","/update_berita"),
                  btn(3,context,"history-clock.png", "History","/history")
                ],
              ),
            ],
          ),
          Positioned(
            bottom: 20,
            child: Container(
              color: Colors.black,
              width: MediaQuery.of(context).size.width,
              height: 35,
              child:  MarqueeWidget(
                  text: UIData.txtWelcome,
                  textStyle: TextStyle(color: Colors.white,fontSize: 18 ),
                ),
            ),
          )
        ],
      ),
    );
  }
}