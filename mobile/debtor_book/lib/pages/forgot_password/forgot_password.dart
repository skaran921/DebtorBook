import 'package:debtor_book/configs/config.dart';
import 'package:debtor_book/widgets/custom_text_btn.dart';
import 'package:debtor_book/widgets/custom_text_field.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:velocity_x/velocity_x.dart';

class ForgotPassword extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return SafeArea(
      child: Scaffold(
        body: SingleChildScrollView(
          padding: EdgeInsets.all(16.0),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              GestureDetector(
                onTap: () {
                  Navigator.pop(context);
                },
                child: Row(
                  children: [
                    Icon(
                      Icons.arrow_back_ios,
                      color: Configs.primaryColor.withOpacity(0.8),
                    ),
                    "Login".text.color(Configs.primaryColor.withOpacity(0.8)).semiBold.make(),
                  ],
                ),
              ),
              10.0.heightBox,
              "Forgot Password".text.xl3.color(Configs.grayColor).make(),
              20.0.heightBox,
              CustomTextField(hintText: "Registerd Email", kbdType: TextInputType.emailAddress),
              20.0.heightBox,
              CustomTextButton(text: "Send OTP", onPressed: () {}),
              20.0.heightBox,
              CupertinoFormSection(
                header: Row(
                  children: [
                    Icon(Icons.check_circle),
                    " Verify OTP".text.lg.fontFamily(Configs.fontFamily!).make(),
                  ],
                ),
                children: [
                  CustomTextField(hintText: "OTP"),
                  CustomTextField(hintText: "New Password", isObsecureText: true),
                  20.0.heightBox,
                  CustomTextButton(text: "Change Password", onPressed: () {}),
                ],
              ),
            ],
          ),
        ),
      ),
    );
  }
}
