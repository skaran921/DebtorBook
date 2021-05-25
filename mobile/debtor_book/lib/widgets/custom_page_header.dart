import 'package:debtor_book/configs/config.dart';
import 'package:flutter/material.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';
import 'package:velocity_x/velocity_x.dart';
import 'package:debtor_book/utils/utils.dart';

class CustomPageHeader extends StatelessWidget {
  final IconData icon;
  final String label;

  const CustomPageHeader({Key? key, required this.icon, required this.label}) : super(key: key);
  @override
  Widget build(BuildContext context) {
    return Row(
      children: [
        FontAwesomeIcons.solidPlusSquare.toIcon(color: Configs.grayColor),
        "  $label".text.xl4.color(Configs.grayColor).make(),
      ],
    );
  }
}
