import 'package:debtor_book/configs/constants/route_constants.dart';
import 'package:debtor_book/configs/constants/text_constants.dart';
import 'package:flutter/material.dart';
import 'package:debtor_book/utils/utils.dart';
import 'package:debtor_book/widgets/custom_text_btn.dart';
import 'package:debtor_book/widgets/custom_text_field.dart';
import 'package:debtor_book/configs/config.dart';
import 'package:velocity_x/velocity_x.dart';

class LoginPage extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return SafeArea(
        child: Scaffold(
      body: SingleChildScrollView(
        padding: EdgeInsets.all(16.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            "undraw_Calculator_0evy".toPNG(),
            TextConstants.appTitle.text.color(Configs.primaryColor).xl4.make().centered(),
            TextConstants.signInText.text.color(Configs.grayColor).xl3.make(),
            20.0.heightBox,
            Column(
              mainAxisAlignment: MainAxisAlignment.end,
              children: [
                CustomTextField(hintText: "Email", kbdType: TextInputType.emailAddress),
                20.0.heightBox,
                CustomTextField(
                  hintText: "Password",
                  isObsecureText: true,
                ),
                20.0.heightBox,
                CustomTextButton(
                  text: TextConstants.signInText,
                  onPressed: () {},
                ),
                20.0.heightBox,
                GestureDetector(
                    onTap: () {
                      Navigator.pushNamed(context, RouteConstant.forgotPasswordPage);
                    },
                    child: TextConstants.forgotPasswordHelpText.text.gray400.make().objectTopLeft()),
              ],
            ),
          ],
        ),
      ),
    ));
  }
}
