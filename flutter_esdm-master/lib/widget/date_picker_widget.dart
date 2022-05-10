import 'package:datetime_picker_formfield/datetime_picker_formfield.dart';
import 'package:flutter/material.dart';
import 'package:intl/intl.dart';
class DatePickerWidget extends StatelessWidget {
  void Function(DateTime value) onChange;
  DatePickerWidget({this.onChange});
  @override
  Widget build(BuildContext context) {
    return ListTile(
            contentPadding: EdgeInsets.zero,
            // leading: Container(
            //   decoration: BoxDecoration(
            //     borderRadius: BorderRadius.circular(10),
            //     color: Colors.white,
            //   ),
            //   padding: EdgeInsets.all(10),
            //   child: Icon(Icons.calendar_today,)
            // ),
            title: Container(
              decoration: BoxDecoration(
                borderRadius: BorderRadius.circular(10),
                color: Colors.white
              ),
              child: DateTimeField(
                format: DateFormat("yyyy-MM-dd"),
                decoration: InputDecoration(
                  hintText: "Pilih Tanggal",
                  border: InputBorder.none,
                  prefixIcon: Icon(Icons.calendar_today)
                ),
                readOnly: true,
                textAlign: TextAlign.center,
                onChanged: this.onChange,
                onShowPicker: (context, currentValue) {
                  return showDatePicker(
                      context: context,
                      firstDate: DateTime(1900),
                      initialDate: currentValue ?? DateTime.now(),
                      lastDate: DateTime(2100));
                },
              ),
            ),
          );
  }
}