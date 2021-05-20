import 'package:debtor_book/configs/config.dart';
import 'package:flutter/material.dart';

class CustomTextField extends StatelessWidget {
  final String hintText;
  final bool isObsecureText;
  final TextInputType? kbdType;
  const CustomTextField({Key? key, required this.hintText, this.isObsecureText = false, this.kbdType}) : super(key: key);
  @override
  Widget build(BuildContext context) {
    return TextFormField(
      keyboardType: kbdType ?? TextInputType.text,
      obscureText: isObsecureText,
      style: TextStyle(color: Configs.grayColor, fontWeight: FontWeight.w400, fontSize: 16.0, fontFamily: Configs.fontFamily),
      decoration: InputDecoration(
        hintText: "$hintText",
      ),
    );
  }
}
