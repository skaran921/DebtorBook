import 'package:debtor_book/configs/config.dart';
import 'package:debtor_book/configs/constants/route_constants.dart';
import 'package:debtor_book/configs/constants/text_constants.dart';
import 'package:debtor_book/configs/router.dart';
import 'package:debtor_book/configs/themes.dart';
import 'package:debtor_book/controllers/theme_controller.dart';
import 'package:debtor_book/utils/utils.dart';
import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:get/get.dart';
import 'package:shared_preferences/shared_preferences.dart';

Future<void> main() async {
  WidgetsFlutterBinding.ensureInitialized();
  SystemChrome.setSystemUIOverlayStyle(SystemUiOverlayStyle(statusBarColor: Colors.transparent));
  Configs.prefs = await SharedPreferences.getInstance();
  runApp(DebtorBookApp());
}

class DebtorBookApp extends StatelessWidget {
  final ThemeController _themeController = Get.put(ThemeController(), tag: "_themeController");
  @override
  Widget build(BuildContext context) {
    return Obx(
      () => MaterialApp(
        debugShowCheckedModeBanner: false,
        title: TextConstants.appTitle,
        theme: _themeController.darkMode.value ? MyThemes.darkTheme() : MyThemes.lightTheme(),
        darkTheme: MyThemes.darkTheme(),
        onGenerateRoute: onGenerateRoute,
        initialRoute: isUserLoggedIn() ? RouteConstant.dashboardPage : RouteConstant.loginPage,
      ),
    );
  }
}
