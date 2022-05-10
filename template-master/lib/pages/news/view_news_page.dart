import 'package:cached_network_image/cached_network_image.dart';
import 'package:flutter/material.dart';
import 'package:template/blocs/global_bloc.dart';
import 'package:template/models/News.dart';
import 'package:template/utils/uidata.dart';
import 'package:template/widgets/loading_widget.dart';
class ViewNewsPage extends StatelessWidget {
  News news;
  ViewNewsPage(this.news);
  @override
  Widget build(BuildContext context) {
    print("${UIData.uploadDir}/news/${news?.newsImage}");
    return Stack(
      children: <Widget>[
        Scaffold(
          appBar: AppBar(
            title: Text("News"),
          ),
          body: ListView(
            padding: EdgeInsets.all(20),
            children: <Widget>[
              Text(news?.newsTitle ?? "", style: TextStyle(fontWeight: FontWeight.bold,fontSize: 20),),
              Padding(
                padding: const EdgeInsets.symmetric(vertical: 10),
                child: CachedNetworkImage(
                  imageUrl: "${UIData.uploadDir}/news/${news?.newsImage}",
                  imageBuilder: (context, imageProvider) => Container(
                    child: Image(
                      image: imageProvider,
                      fit: BoxFit.contain
                    ),
                  ),
                  placeholder: (context, url) => Center(child: CircularProgressIndicator()),
                  errorWidget: (context, url, error) => Image.asset("assets/no_image.png",fit: BoxFit.contain,),
                ),
              ),
              Text(news?.newsText ?? "")
            ],
          ),
        ),
        StreamBuilder(
          initialData: true,
          stream: GlobalBloc.loadingStream,
          builder: (BuildContext ctxLoading, AsyncSnapshot<bool> snapshot){
            return LoadingWidget(snapshot.data);
          },
        )
      ],
    );
  }
}