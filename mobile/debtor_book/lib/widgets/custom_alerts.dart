import 'package:debtor_book/configs/config.dart';
import 'package:flutter/material.dart';
import 'package:lottie/lottie.dart';

class CustomAlerts {
  static AlertDialog customAlertDialog(String msg, String lottieAsset, VoidCallback onPressed, {bool errorAlert = false}) {
    return AlertDialog(
      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(5.0)),
      content: Column(
        mainAxisSize: MainAxisSize.min,
        children: [
          Align(
            heightFactor: 0.7,
            child: LottieBuilder.asset(
              "$lottieAsset",
              width: 200,
              height: 200,
              fit: BoxFit.cover,
            ),
          ),
          Text(
            "$msg",
            style: TextStyle(fontFamily: Configs.fontFamily, fontSize: 16.0, color: Configs.grayColor),
          ),
          SizedBox(height: 4.0),
          ElevatedButton(
              onPressed: onPressed,
              child: Text(
                "Close",
                style: TextStyle(fontFamily: Configs.fontFamily, fontSize: 16.0),
              ))
        ],
      ),
    );
  }

  static Future simpleSuccessAlert(BuildContext context, String msg) async {
    final isOpened = ValueNotifier<bool>(false);
    return await showDialog(
      context: context,
      builder: (context) => ValueListenableBuilder(
          valueListenable: isOpened,
          builder: (context, bool value, child) => WillPopScope(
              onWillPop: () async => value,
              child: customAlertDialog(msg, "assets/lottie/s2.json", () {
                isOpened.value = false;
                Navigator.pop(context);
              }))),
    );
  }

  static Future simpleErrorAlert(BuildContext context, String msg) async {
    final isOpened = ValueNotifier<bool>(false);
    return await showDialog(
      context: context,
      builder: (context) => ValueListenableBuilder(
          valueListenable: isOpened,
          builder: (context, bool value, child) => WillPopScope(
              onWillPop: () async => value,
              child: customAlertDialog(msg, "assets/lottie/e2.json", () {
                isOpened.value = false;
                Navigator.pop(context);
              }))),
    );
  }
}
