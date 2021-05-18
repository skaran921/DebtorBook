import 'package:flutter/material.dart';

extension stringExtension on String {
  Widget toPNG({double? width, double? height}) {
    return Image.asset(
      "assets/images/$this.png",
      width: width,
      height: height,
    );
  }
}

extension iconExtension on IconData {
  Widget toIcon({Color? color, double? size}) => Icon(
        this,
        color: color,
        size: size,
      );
}
