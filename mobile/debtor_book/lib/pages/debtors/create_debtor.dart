import 'package:debtor_book/widgets/custom_header.dart';
import 'package:debtor_book/widgets/custom_page_header.dart';
import 'package:debtor_book/widgets/custom_text_btn.dart';
import 'package:debtor_book/widgets/custom_text_field.dart';
import 'package:flutter/material.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';
import 'package:velocity_x/velocity_x.dart';

class CreateDebtorPage extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: SafeArea(
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            CustomAppHeader(
              title: "Home",
            ),
            20.0.heightBox,
            CustomPageHeader(icon: FontAwesomeIcons.solidPlusSquare, label: "Create Debtor"),
            20.0.heightBox,
            Expanded(
                child: Form(
              child: ListView(
                physics: BouncingScrollPhysics(),
                children: [
                  CustomTextField(hintText: "Full Name"),
                  10.0.heightBox,
                  CustomTextField(hintText: "Mobile No"),
                  10.0.heightBox,
                  CustomTextField(hintText: "Email"),
                  10.0.heightBox,
                  CustomTextField(hintText: "Address"),
                  20.0.heightBox,
                  CustomTextButton(
                    text: "Create",
                    onPressed: () {},
                  )
                ],
              ),
            ))
          ],
        ).p(16),
      ),
    );
  }
}
