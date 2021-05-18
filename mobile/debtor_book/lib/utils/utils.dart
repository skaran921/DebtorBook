import 'package:flutter/material.dart';

extension stringExtension on String {
  Widget toAssetsImage({double width, double height}) {
    return Image.asset(
      "assets/images/$this",
      width: width,
      height: height,
    );
  }
}

extension iconExtension on IconData {
  Widget toIcon({Color color, double size}) => Icon(
        this,
        color: color,
        size: size,
      );
}
