import 'package:debtor_book/configs/config.dart';
import 'package:flutter/material.dart';

class CustomTextField extends StatelessWidget {
  final String hintText;
  final bool isObsecureText;

  const CustomTextField({Key? key, required this.hintText, this.isObsecureText = false}) : super(key: key);
  @override
  Widget build(BuildContext context) {
    return TextFormField(
      obscureText: isObsecureText,
      style: TextStyle(color: Configs.grayColor, fontWeight: FontWeight.w400, fontSize: 16.0, fontFamily: Configs.fontFamily),
      decoration: InputDecoration(
        hintText: "$hintText",
      ),
    );
  }
}
