import 'package:debtor_book/configs/config.dart';
import 'package:flutter/material.dart';
import 'package:velocity_x/velocity_x.dart';

class CustomAppHeader extends StatelessWidget {
  final String title;

  const CustomAppHeader({Key? key, this.title = "Back"}) : super(key: key);
  @override
  Widget build(BuildContext context) {
    return GestureDetector(
      onTap: () {
        Navigator.pop(context);
      },
      child: Row(
        children: [
          Icon(
            Icons.arrow_back_ios,
            color: Configs.primaryColor.withOpacity(0.8),
          ),
          "$title".text.color(Configs.primaryColor.withOpacity(0.8)).semiBold.make(),
        ],
      ),
    );
  }
}
