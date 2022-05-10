import 'package:flutter/material.dart';
import 'package:flutter_esdm/blocs/update_berita/update_berita_bloc.dart';
import 'package:flutter_esdm/models/LapBeritaHotNews.dart';
import 'package:flutter_esdm/models/LapBeritaNegatif.dart';
import 'package:flutter_esdm/models/LapBeritaNetral.dart';
import 'package:flutter_esdm/models/LapBeritaPositif.dart';
import 'package:flutter_esdm/utils/uidata.dart';
import 'package:flutter_esdm/widget/card_widget.dart';
import 'package:flutter_esdm/widget/loading_widget.dart';
import 'package:flutter_esdm/widget/nested_scrollable_widget.dart';
import 'package:flutter_swiper/flutter_swiper.dart';
import 'package:url_launcher/url_launcher.dart';
class UpdateBeritaPage extends StatelessWidget {
  List<String> listUrl = [];
  Future<void> _launchURL(BuildContext ctx,String url) async {
    if (await canLaunch(url)) {
      await launch(url);
    } else {
      Scaffold.of(ctx).showSnackBar( SnackBar(
        content: Text("Failed to open Browser, please try again later."),
        duration: Duration(seconds: 3),
        action: SnackBarAction(
          label: 'OK',
          textColor: Colors.yellow,
          onPressed: () {},
        ),
      ));
    }
  }

  @override
  Widget build(BuildContext context) {
    UpdateBeritaBloc updateBeritaBloc = UpdateBeritaBloc();
    return Stack(
      children: <Widget>[
        Scaffold(
          appBar: AppBar(
            title: Text("Update Berita",style: TextStyle(color: Colors.white),),
            backgroundColor: Colors.black,
          ),
          body: ListView(
            children: <Widget>[
              StreamBuilder(
                stream: updateBeritaBloc.listLapBeritaHotNewsStream,
                builder: (BuildContext ctx, AsyncSnapshot<List<LapBeritaHotNews>> snapshot) {
                  if(!snapshot.hasData){
                    return Container();
                  }else if(snapshot.data.isEmpty){
                    return Container();
                  }
                  var datas = snapshot.data;
                  return Container(
                          width: MediaQuery.of(context).size.width,
                          height: 200,
                          child: Stack(
                            children: <Widget>[
                              Swiper(
                                onIndexChanged: updateBeritaBloc.changeSwiper,
                                control: SwiperControl(),
                                loop: false,
                                itemCount: datas.length,
                                itemBuilder: (BuildContext ctx, int index) {
                                  listUrl.add(datas[index].url);
                                  return Image(
                                      image: NetworkImage(UIData.dirImage + datas[index].image),
                                      width: MediaQuery.of(context).size.width,
                                      fit: BoxFit.cover,
                                    );
                                },
                              ),
                              Positioned(
                                right: 10,
                                bottom: 10,
                                child: 
                                  StreamBuilder(
                                    stream: updateBeritaBloc.lapBeritaHotNewsStream,
                                    builder: (BuildContext ctx, AsyncSnapshot<LapBeritaHotNews> snapshot) {
                                      return InkWell(
                                              onTap: ()=>_launchURL(context,snapshot.data?.url ?? ""),
                                              child: Container(
                                                decoration: BoxDecoration(
                                                  border: Border.all(color: Colors.white),
                                                  borderRadius: BorderRadius.circular(10),
                                                  color: Colors.black,
                                                ),
                                                padding: EdgeInsets.all(10),
                                                child: Row(
                                                  children: <Widget>[
                                                    Text("SELENGKAPNYA",style: TextStyle(color: Colors.white),),
                                                    Icon(Icons.fast_forward,color: Colors.white,),
                                                  ],
                                                ),
                                              ),
                                            );
                                  }),
                              )
                            ],
                          ),
                        );
              }),
              StreamBuilder(
                stream: updateBeritaBloc.lapBeritaHotNewsStream,
                builder: (BuildContext ctx, AsyncSnapshot<LapBeritaHotNews> snapshot) {
                  return Container(
                          padding: const EdgeInsets.all(8.0),
                          child: Text(snapshot.data?.berita ?? "",overflow: TextOverflow.ellipsis, style: TextStyle(fontSize: 18,),maxLines: 1,),
                        );
              }),
              Row(
                mainAxisAlignment: MainAxisAlignment.center,
                children: <Widget>[
                  MaterialButton(
                    padding: EdgeInsets.all(15),
                    onPressed: ()=> updateBeritaBloc.changeActiveButton(1),
                    color: UIData.colorYellow,
                    shape: RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(10)
                    ),
                    child: Text("NEGATIVE",style: TextStyle(fontWeight: FontWeight.bold),),
                  ),
                  SizedBox(width:10),
                  MaterialButton(
                    padding: EdgeInsets.all(15),
                    onPressed: ()=> updateBeritaBloc.changeActiveButton(2),
                    color: UIData.colorYellow,
                    shape: RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(10)
                    ),
                    child: Text("NETRAL",style: TextStyle(fontWeight: FontWeight.bold),),
                  ),
                  SizedBox(width:10),
                  MaterialButton(
                    padding: EdgeInsets.all(15),
                    onPressed: ()=> updateBeritaBloc.changeActiveButton(3),
                    color: UIData.colorYellow,
                    shape: RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(10)
                    ),
                    child: Text("POSITIVE",style: TextStyle(fontWeight: FontWeight.bold),),
                  ),
                ],
              ),
              StreamBuilder(
                initialData: 0,
                stream: updateBeritaBloc.activeButtonStream,
                builder: (BuildContext ctx, AsyncSnapshot<int> snapshotActiveButton) {
                  if (snapshotActiveButton.hasData) {
                    switch (snapshotActiveButton.data) {
                      case 0:
                        return Container();
                        break;
                      case 1:
                        return containerBerita(context,
                          child: StreamBuilder(
                            stream: updateBeritaBloc.listLapBeritaNegatifStream,
                            builder: (BuildContext ctx, AsyncSnapshot<List<LapBeritaNegatif>> snapshot) {
                              if(snapshot.hasData){
                                return NestedScrollableWidget(
                                  itemCount: snapshot.data.length,
                                  itemBuilder: (BuildContext ctxLV,int index){
                                    return InkWell(
                                      onTap: () => _launchURL(context,snapshot.data[index].url ?? ""),
                                      child: CardWidget("",snapshot.data[index].berita)
                                    );
                                  },
                                );
                              }
                              return Container();
                          }),
                        );
                        break;
                      case 2:
                        return containerBerita(context,
                          child: StreamBuilder(
                            stream: updateBeritaBloc.listLapBeritaNetralStream,
                            builder: (BuildContext ctx, AsyncSnapshot<List<LapBeritaNetral>> snapshot) {
                              if(snapshot.hasData){
                                return NestedScrollableWidget(
                                  itemCount: snapshot.data.length,
                                  itemBuilder: (BuildContext ctxLV,int index){
                                    return InkWell(
                                      onTap: () => _launchURL(context,snapshot.data[index].url ?? ""),
                                      child: CardWidget("",snapshot.data[index].berita)
                                    );
                                  },
                                );
                              }
                              return Container();
                          }),
                        );
                        break;
                      case 3:
                        return containerBerita(context,
                          child: StreamBuilder(
                            stream: updateBeritaBloc.listLapBeritaPositifStream,
                            builder: (BuildContext ctx, AsyncSnapshot<List<LapBeritaPositif>> snapshot) {
                              if(snapshot.hasData){
                                return NestedScrollableWidget(
                                  itemCount: snapshot.data.length,
                                  itemBuilder: (BuildContext ctxLV,int index){
                                    return InkWell(
                                      onTap: () => _launchURL(context,snapshot.data[index].url ?? ""),
                                      child: CardWidget("",snapshot.data[index].berita)
                                    );
                                  },
                                );
                              }
                              return Container();
                          }),
                        );
                        break;
                      default:
                        return Container();
                    }
                  }
                  return Container();
              }),
            ],
          ),
        ),
        StreamBuilder(
          initialData: false,
          stream: updateBeritaBloc.loadingStream,
          builder: (BuildContext ctx, AsyncSnapshot<bool> snapshot) {
            return LoadingWidget(snapshot.data);
        }),
      ],
    );
  }
  Widget containerBerita(BuildContext context,{Widget child}){
    return Center(
            child: Container(
              constraints: BoxConstraints(
                minWidth: double.infinity,
                maxHeight: MediaQuery.of(context).size.height - 220,
              ),
              decoration: BoxDecoration(
                color: UIData.colorYellow,
                borderRadius: BorderRadius.circular(10)
              ),
              margin: EdgeInsets.all(10),
              width: MediaQuery.of(context).size.width,
              padding: EdgeInsets.all(10),
              child: child,
            )
          );
  }
}