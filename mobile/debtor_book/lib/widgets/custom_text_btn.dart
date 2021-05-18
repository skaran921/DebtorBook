import 'package:debtor_book/configs/config.dart';
import 'package:flutter/material.dart';
import 'package:velocity_x/velocity_x.dart';

class CustomTextButton extends StatelessWidget {
  final String text;
  final VoidCallback? onPressed;

  const CustomTextButton({Key? key, required this.text, this.onPressed}) : super(key: key);
  @override
  Widget build(BuildContext context) {
    return ElevatedButton(
            style: TextButton.styleFrom(padding: EdgeInsets.symmetric(vertical: 12.0)),
            onPressed: onPressed,
            child: text.text.xl.fontFamily(Configs.fontFamily!).white.make())
        .wFull(context);
  }
}
