import 'package:flutter/material.dart' show Color;
import 'package:google_fonts/google_fonts.dart';
import 'package:shared_preferences/shared_preferences.dart';

class Configs {
  /// colors
  static const Color primaryColor = Color(0xFF0f23ca);
  static const Color whiteColor = Color(0xFFFFFFFF);
  static const Color blackColor = Color(0xFF111111);
  static const Color lightWhiteColor = Color(0xFFFAFAFA);
  static const Color grayColor = Color(0xFFa7a6ac);
  static const Color whiteGrayColor = Color(0xFFF1F1F1);
  static const Color whiteIndigo = Color(0xFFF9fafc);

  /// fontFamily
  static String? fontFamily = GoogleFonts.poppins().fontFamily;

  /// shared preferences
  static late SharedPreferences prefs;
  static const String loginPrefs = "loginPrefs";

  /// base url config
  static const String baseUrl = "http://172.20.10.3/debtorbook/api/server.php";
  static const String baseUrl1 = "http://192.168.43.138/debtorbook/api/server.php";
}
