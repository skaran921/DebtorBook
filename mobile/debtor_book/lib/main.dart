import 'package:debtor_book/configs/config.dart';
import 'package:debtor_book/configs/constants/text_constants.dart';
import 'package:debtor_book/configs/themes.dart';
import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';
import 'package:velocity_x/velocity_x.dart';
import "package:debtor_book/utils/utils.dart";

void main() {
  WidgetsFlutterBinding.ensureInitialized();
  SystemChrome.setSystemUIOverlayStyle(SystemUiOverlayStyle(statusBarColor: Colors.transparent));
  runApp(DebtorBookApp());
}

class DebtorBookApp extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      title: TextConstants.appTitle,
      theme: MyThemes.lightTheme(),
      darkTheme: MyThemes.darkTheme(),
      home: SafeArea(
          child: Scaffold(
        body: SingleChildScrollView(
          padding: EdgeInsets.all(16.0),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              TextConstants.appTitle.text.color(Configs.primaryColor).xl4.make(),
              "Sign in".text.color(Configs.grayColor).xl2.make(),
              20.0.heightBox,
              TextFormField(
                style: TextStyle(
                    color: Configs.grayColor, fontWeight: FontWeight.w400, fontSize: 16.0, fontFamily: Configs.fontFamily),
                decoration: InputDecoration(
                  hintText: "Email",
                ),
              ),
              20.0.heightBox,
              TextFormField(
                style: TextStyle(
                    color: Configs.grayColor, fontWeight: FontWeight.w400, fontSize: 16.0, fontFamily: Configs.fontFamily),
                obscureText: true,
                decoration: InputDecoration(
                  hintText: "Password",
                ),
              ),
            ],
          ),
        ),
      )),
    );
  }
}
