import 'package:debtor_book/configs/config.dart';
import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';

class MyThemes {
  static String fontFamily = GoogleFonts.poppins().fontFamily;

  static ThemeData lightTheme() {
    return ThemeData(
        colorScheme: ColorScheme.light(primary: Configs.primaryColor),
        primaryColor: Configs.primaryColor,
        cardColor: Configs.whiteColor,
        buttonColor: Configs.primaryColor,
        splashColor: Colors.indigoAccent,
        canvasColor: Colors.indigo,
        scaffoldBackgroundColor: Configs.lightWhiteColor,
        accentColor: Configs.primaryColor,
        fontFamily: fontFamily,
        iconTheme: IconThemeData(color: Configs.primaryColor),
        inputDecorationTheme: InputDecorationTheme(
            filled: true,
            fillColor: Configs.whiteColor,
            prefixStyle: TextStyle(color: Configs.primaryColor),
            labelStyle:
                TextStyle(color: Configs.grayColor, fontWeight: FontWeight.w400, fontSize: 22.0, fontFamily: Configs.fontFamily),
            hintStyle: TextStyle(color: Configs.grayColor, fontSize: 16.0, fontFamily: Configs.fontFamily),
            focusColor: Configs.primaryColor,
            hoverColor: Configs.primaryColor,
            contentPadding: const EdgeInsets.all(16.0),
            focusedBorder: const UnderlineInputBorder(
                borderRadius: BorderRadius.all(Radius.circular(5.0)),
                borderSide: BorderSide(
                  color: Configs.primaryColor,
                )),
            border: const UnderlineInputBorder(
                borderRadius: BorderRadius.all(Radius.circular(5.0)),
                borderSide: BorderSide(
                  color: Configs.primaryColor,
                ))));
  }

  static ThemeData darkTheme() {
    return ThemeData(colorScheme: ColorScheme.dark(), fontFamily: fontFamily);
  }
}
