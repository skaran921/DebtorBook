import 'package:debtor_book/controllers/debtor_controller.dart';
import 'package:debtor_book/widgets/custom_header.dart';
import 'package:debtor_book/widgets/custom_page_header.dart';
import 'package:debtor_book/widgets/custom_text_btn.dart';
import 'package:debtor_book/widgets/custom_text_field.dart';
import 'package:flutter/material.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';
import 'package:get/get.dart';
import 'package:velocity_x/velocity_x.dart';

class CreateDebtorPage extends StatelessWidget {
  final _formKey = GlobalKey<FormState>();
  final TextEditingController _fullName = TextEditingController();
  final TextEditingController _mobileNo = TextEditingController();
  final TextEditingController _email = TextEditingController();
  final TextEditingController _address = TextEditingController();
  final _debtorController = Get.find<DebtorController>(tag: "_debtorController");
  void handleDebtorForm(BuildContext context) {
    if (_formKey.currentState!.validate()) {
      _debtorController.createDebtor(context, _fullName.text, _email.text, _mobileNo.text, _address.text, () {
        _fullName.clear();
        _mobileNo.clear();
        _email.clear();
        _address.clear();
      });
    }
  }

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
              key: _formKey,
              child: ListView(
                physics: BouncingScrollPhysics(),
                children: [
                  CustomTextField(
                      hintText: "Full Name",
                      prefixIcon: FontAwesomeIcons.userAlt,
                      controller: _fullName,
                      validator: (value) {
                        if (value!.isEmpty) return "Debtor Name Required";
                        return null;
                      }),
                  10.0.heightBox,
                  CustomTextField(
                      prefixIcon: FontAwesomeIcons.mobileAlt,
                      hintText: "Mobile No",
                      controller: _mobileNo,
                      validator: (value) {
                        if (value!.isEmpty) return "Mobile No. Required";
                        if (value.length != 10) return "10 Digits Required";
                        return null;
                      }),
                  10.0.heightBox,
                  CustomTextField(
                      prefixIcon: FontAwesomeIcons.envelope, hintText: "Email", controller: _email, validator: (value) {}),
                  10.0.heightBox,
                  CustomTextField(
                      prefixIcon: FontAwesomeIcons.addressCard, hintText: "Address", controller: _address, validator: (value) {}),
                  20.0.heightBox,
                  CustomTextButton(
                    text: "Create",
                    onPressed: () {
                      handleDebtorForm(context);
                    },
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
