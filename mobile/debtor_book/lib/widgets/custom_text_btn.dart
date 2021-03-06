import 'package:debtor_book/configs/config.dart';
import 'package:flutter/material.dart';
import 'package:velocity_x/velocity_x.dart';

class CustomTextButton extends StatelessWidget {
  final String text;
  final VoidCallback? onPressed;
  final bool isLoading;

  const CustomTextButton({Key? key, required this.text, this.onPressed, this.isLoading = false}) : super(key: key);
  @override
  Widget build(BuildContext context) {
    return ElevatedButton(
            style: TextButton.styleFrom(padding: EdgeInsets.symmetric(vertical: 12.0)),
            onPressed: onPressed,
            child: isLoading
                ? CircularProgressIndicator(
                    strokeWidth: 3.0,
                  )
                : text.text.xl.fontFamily(Configs.fontFamily!).white.make())
        .wFull(context);
  }
}
