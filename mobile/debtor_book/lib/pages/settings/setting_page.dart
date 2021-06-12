import 'package:debtor_book/configs/config.dart';
import 'package:debtor_book/controllers/theme_controller.dart';
import 'package:debtor_book/widgets/custom_page_header.dart';
import 'package:flutter/material.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';
import 'package:get/get.dart';
import 'package:velocity_x/velocity_x.dart';
import 'package:debtor_book/utils/utils.dart';

class SettingPage extends StatelessWidget {
  final ThemeController _themeController = Get.find(tag: "_themeController");
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: SafeArea(
        child: ListView(
          children: [
            CustomPageHeader(icon: Icons.settings, label: "Settings"),
            10.0.heightBox,
            Obx(
              () => AnimatedContainer(
                duration: Duration(milliseconds: 250),
                child: ListTile(
                  leading: !_themeController.darkMode.value ? FontAwesomeIcons.sun.toIcon() : FontAwesomeIcons.moon.toIcon(),
                  title: "${!_themeController.darkMode.value ? 'Light Mode' : 'Dark Mode'}".text.color(Configs.grayColor).make(),
                  trailing: Switch(
                    onChanged: (v) {
                      _themeController.switchThemeMode();
                    },
                    value: _themeController.darkMode.value,
                  ),
                ),
              ),
            )
          ],
        ).p(16),
      ),
    );
  }
}
