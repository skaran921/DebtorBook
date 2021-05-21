import 'package:debtor_book/configs/config.dart';
import 'package:debtor_book/utils/utils.dart';
import 'package:flutter/material.dart';
import 'package:velocity_x/velocity_x.dart';

class CustomBottomNavigationBar extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return VxBox(
        child: Row(
      mainAxisAlignment: MainAxisAlignment.spaceAround,
      children: [
        TextButton(
            onPressed: () {},
            child:
                "${"".toRupeeSign()} Pay     ".text.white.color(Configs.primaryColor).xl2.fontFamily(Configs.fontFamily!).make()),
        VerticalDivider(
          color: Configs.grayColor,
        ),
        TextButton(
            onPressed: () {},
            child: "${"".toRupeeSign()} Received".text.color(Configs.primaryColor).xl2.fontFamily(Configs.fontFamily!).make()),
      ],
    )).roundedLg.white.margin(EdgeInsets.all(10)).shadowSm.border(color: Colors.transparent).make().h(80);
  }
}
