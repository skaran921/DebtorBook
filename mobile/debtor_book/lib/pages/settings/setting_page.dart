import 'package:debtor_book/widgets/custom_header.dart';
import 'package:debtor_book/widgets/custom_page_header.dart';
import 'package:flutter/material.dart';
import 'package:velocity_x/velocity_x.dart';

class SettingPage extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: SafeArea(
        child: ListView(
          children: [
            CustomAppHeader(
              title: "Home",
            ),
            CustomPageHeader(icon: Icons.settings, label: "Settings")
          ],
        ).p(16),
      ),
    );
  }
}
