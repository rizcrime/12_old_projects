import 'package:flutter/material.dart';
import 'package:template/blocs/note/note_bloc.dart';
import 'package:template/models/Note.dart';
import 'package:template/utils/uidata.dart';
class CardWidget extends StatelessWidget {
  Note note;
  Function() onTap;
  NoteBloc noteBloc;
  bool isValidRole;
  CardWidget({this.note,this.onTap,this.noteBloc,this.isValidRole = false});
  @override
  Widget build(BuildContext context) {
    return InkWell(
      onTap: this.onTap,
      // onTap: () => GlobalFunction.changePage(ctx, AddNotePage(note: note,)),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: <Widget>[
          Container(
            width: double.infinity,
            color: UIData.containerColor,
            padding: EdgeInsets.symmetric(vertical: 5,horizontal: 10),
            child: Text(note.noteTitle,style: TextStyle(fontWeight: FontWeight.bold),),
          ),
          Container(
            width: double.infinity,
            height: 100,
            color: UIData.accentColor,
            padding: EdgeInsets.all(10),
            child: Stack(
              children: <Widget>[
                Text(note.noteContent,overflow: TextOverflow.ellipsis,maxLines: 2,),
                noteBloc != null ?Positioned(
                  right: 0,
                  bottom: 0,
                  child: isValidRole ? InkWell(
                    onTap: ()=>noteBloc.onDelete(context, note),
                    child: Icon(Icons.delete,color: UIData.bcContactColor,)
                  ):Container(),
                  // child: PopupMenuButton(
                  //   onSelected: (val) => noteBloc.onDelete(context, val),
                  //   icon: Icon(Icons.more_vert,color: UIData.bcContactColor,),
                  //   itemBuilder: (BuildContext popUpContext) {
                  //     return [
                  //       PopupMenuItem(
                  //         value: note,
                  //         child: Text("Delete"),
                  //       )
                  //     ];
                  //   },
                  // ),
                ) : Container()
              ],
            ),
          )
        ],
      ),
    );
  }
}