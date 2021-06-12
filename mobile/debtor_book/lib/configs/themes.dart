import 'package:debtor_book/configs/config.dart';
import 'package:flutter/material.dart';
import 'package:flutter/rendering.dart';
import 'package:google_fonts/google_fonts.dart';

class MyThemes {
  static String? fontFamily = GoogleFonts.poppins().fontFamily;

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
        bottomNavigationBarTheme: BottomNavigationBarThemeData(
          backgroundColor: Configs.whiteColor,
        ),
        // textButtonTheme: TextButtonThemeData(style: TextButton.styleFrom(backgroundColor: Configs.primaryColor)),
        elevatedButtonTheme: ElevatedButtonThemeData(
            style: ElevatedButton.styleFrom(
          side: BorderSide.none,
          shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(25.0)),
        )),
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
            enabledBorder: const UnderlineInputBorder(
                borderRadius: BorderRadius.all(Radius.circular(5.0)),
                borderSide: BorderSide(
                  color: Configs.grayColor,
                )),
            border: const UnderlineInputBorder(
                borderRadius: BorderRadius.all(Radius.circular(5.0)),
                borderSide: BorderSide(
                  color: Configs.primaryColor,
                ))));
  }

  static ThemeData darkTheme() {
    return ThemeData(
        colorScheme: ColorScheme.dark(),
        fontFamily: fontFamily,
        elevatedButtonTheme: ElevatedButtonThemeData(
            style: ElevatedButton.styleFrom(
          primary: Configs.primaryColor.withOpacity(0.7),
          side: BorderSide.none,
          shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(25.0)),
        )),
        switchTheme: SwitchThemeData(
            thumbColor: MaterialStateProperty.all(Configs.blackColor.withOpacity(0.6)),
            trackColor: MaterialStateProperty.all(Configs.primaryColor.withOpacity(0.4))),
        bottomNavigationBarTheme: BottomNavigationBarThemeData(
            unselectedItemColor: Configs.grayColor,
            backgroundColor: Colors.black,
            selectedItemColor: Configs.primaryColor.withOpacity(0.6)));
  }
}
