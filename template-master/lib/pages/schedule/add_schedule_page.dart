import 'package:flutter/material.dart';
import 'package:template/blocs/global_bloc.dart';
import 'package:template/blocs/schedule/schedule_bloc.dart';
import 'package:template/models/Schedule.dart';
import 'package:template/utils/uidata.dart';
import 'package:template/utils/validator.dart';
import 'package:template/widgets/custom_text_form_field_widget.dart';
import 'package:template/widgets/date_picker_widget.dart';
import 'package:template/widgets/loading_widget.dart';
class AddSchedulePage extends StatefulWidget {
  Schedule schedule;
  AddSchedulePage({this.schedule});
  @override
  _AddSchedulePageState createState() => _AddSchedulePageState();
}

class _AddSchedulePageState extends State<AddSchedulePage> with ValidationMixin{
  GlobalKey<FormState> _formKey = GlobalKey<FormState>();
  ScheduleBloc scheduleBloc;

  TextEditingController _contentController;
  @override
  void initState() {
    _contentController = TextEditingController(text: widget.schedule?.scheduleContent);
    
    scheduleBloc = ScheduleBloc();
    super.initState();
  }
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text("Add Schedule"),
      ),
      body: ListView(
        padding: EdgeInsets.all(10),
        children: <Widget>[
          Card(
            child: Padding(
              padding: const EdgeInsets.all(10),
              child: Form(
                key: _formKey,
                child: Column(
                  children: <Widget>[
                    DatePickerWidget(
                      onSave: scheduleBloc.saveDate,
                      validator: validateDate,
                      initialValue: widget.schedule == null ? null : DateTime.parse(widget.schedule.scheduleDate),
                    ),
                    CustomTextFormFieldWidget(
                      labelText: "Content",
                      onSaved: scheduleBloc.saveContent,
                      validator: validateRequired,
                      textEditingController: _contentController,
                    ),
                    MaterialButton(
                      minWidth: double.infinity,
                      color: UIData.darkPrimaryColor,
                      onPressed: ()=>scheduleBloc.onSave(_formKey,widget.schedule),
                      child: Text("Save"),
                    )
                  ],
                ),
              ),
            ),
          )
        ],
      ),
    );
  }
}