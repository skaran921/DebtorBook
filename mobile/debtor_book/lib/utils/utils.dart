import 'package:debtor_book/configs/config.dart';
import 'package:flutter/material.dart';
import 'package:jwt_decoder/jwt_decoder.dart';

extension stringExtension on String {
  Widget toPNG({double? width, double? height}) {
    return Image.asset(
      "assets/images/$this.png",
      width: width,
      height: height,
    );
  }

  String toRupeeSign() => "₹";
}

extension iconExtension on IconData {
  Widget toIcon({Color? color, double? size}) => Icon(
        this,
        color: color,
        size: size,
      );
}

void hideKbd(BuildContext context) {
  FocusScope.of(context).unfocus();
}

Map<String, dynamic> decodeJwtToken() {
  var jwtToken = Configs.prefs.getString(Configs.loginPrefs);
  return JwtDecoder.decode(jwtToken!);
}

bool isUserLoggedIn() {
  if (Configs.prefs.getString(Configs.loginPrefs) != null && Configs.prefs.getString(Configs.loginPrefs)!.isNotEmpty) {
    return true;
  }
  return false;
}

String getUserToken() {
  return Configs.prefs.getString(Configs.loginPrefs) ?? "";
}
