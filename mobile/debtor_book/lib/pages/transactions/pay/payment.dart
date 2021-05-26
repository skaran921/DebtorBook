import 'package:debtor_book/configs/config.dart';
import 'package:debtor_book/utils/utils.dart';
import 'package:debtor_book/widgets/custom_header.dart';
import 'package:debtor_book/widgets/custom_page_header.dart';
import 'package:debtor_book/widgets/custom_text_btn.dart';
import 'package:debtor_book/widgets/custom_text_field.dart';
import 'package:flutter/material.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';
import 'package:velocity_x/velocity_x.dart';

class PaymentPage extends StatelessWidget {
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
            CustomPageHeader(icon: FontAwesomeIcons.moneyBill, label: "Payment"),
            20.0.heightBox,
            Expanded(
                child: Form(
              child: ListView(
                physics: BouncingScrollPhysics(),
                children: [
                  CustomTextField(
                    prefixIcon: FontAwesomeIcons.calendarAlt,
                    hintText: "Select Date",
                  ),
                  10.0.heightBox,
                  CustomTextField(prefixIcon: FontAwesomeIcons.userAlt, hintText: "Select Debtor"),
                  10.0.heightBox,
                  CustomTextField(prefixIcon: FontAwesomeIcons.rupeeSign, hintText: "Amount"),
                  10.0.heightBox,
                  CustomTextField(prefixIcon: FontAwesomeIcons.stickyNote, hintText: "Remarks"),
                  20.0.heightBox,
                  CustomTextButton(
                    text: "Save",
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
