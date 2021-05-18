import 'package:debtor_book/configs/constants/route_constants.dart';
import 'package:debtor_book/configs/constants/text_constants.dart';
import 'package:debtor_book/configs/router.dart';
import 'package:debtor_book/configs/themes.dart';
import 'package:flutter/material.dart';
import 'package:flutter/services.dart';

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
      onGenerateRoute: onGenerateRoute,
      initialRoute: RouteConstant.loginPage,
    );
  }
}
