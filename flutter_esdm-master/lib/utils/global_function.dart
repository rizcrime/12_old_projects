import 'package:intl/intl.dart';
class GlobalFunction {
  static String withNumberFormat(String number){
    final oCcy = new NumberFormat("#,###", "en_US");
    return oCcy.format(int.parse(number)).replaceAll(",", ".");
  }
}