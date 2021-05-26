import 'package:debtor_book/configs/config.dart';
import 'package:debtor_book/utils/utils.dart';
import 'package:flutter/material.dart';

class CustomTextField extends StatelessWidget {
  final TextEditingController? controller;
  final String hintText;
  final bool isObsecureText;
  final TextInputType? kbdType;
  final bool readOnly;
  final VoidCallback? onTap;
  final IconData? prefixIcon;
  final String? Function(String?)? validator;
  const CustomTextField(
      {Key? key,
      required this.hintText,
      this.isObsecureText = false,
      this.kbdType,
      this.controller,
      this.readOnly = false,
      this.onTap,
      this.validator,
      this.prefixIcon})
      : super(key: key);

  @override
  Widget build(BuildContext context) {
    return TextFormField(
      controller: controller,
      keyboardType: kbdType ?? TextInputType.text,
      obscureText: isObsecureText,
      style: TextStyle(color: Configs.grayColor, fontWeight: FontWeight.w400, fontSize: 16.0, fontFamily: Configs.fontFamily),
      decoration: InputDecoration(
        prefixIcon: prefixIcon != null ? prefixIcon!.toIcon(color: Configs.grayColor) : null,
        contentPadding: EdgeInsets.symmetric(vertical: 8.0, horizontal: 8.0),
        labelText: "$hintText",
      ),
      readOnly: readOnly,
      validator: validator ?? (v) {},
      onTap: onTap ?? () {},
    );
  }
}
