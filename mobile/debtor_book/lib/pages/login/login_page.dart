import 'package:debtor_book/configs/constants/route_constants.dart';
import 'package:debtor_book/configs/constants/text_constants.dart';
import 'package:debtor_book/controllers/login_controller.dart';
import 'package:debtor_book/widgets/custom_alerts.dart';
import 'package:flutter/material.dart';
import 'package:debtor_book/utils/utils.dart';
import 'package:debtor_book/widgets/custom_text_btn.dart';
import 'package:debtor_book/widgets/custom_text_field.dart';
import 'package:debtor_book/configs/config.dart';
import 'package:get/get.dart';
import 'package:velocity_x/velocity_x.dart';

class LoginPage extends StatelessWidget {
  final LoginController _loginController = Get.put(LoginController(), tag: "_loginController");
  final TextEditingController _emailController = TextEditingController();
  final TextEditingController _passwordController = TextEditingController();
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
                CustomTextField(controller: _emailController, hintText: "Email", kbdType: TextInputType.emailAddress),
                20.0.heightBox,
                CustomTextField(controller: _passwordController, hintText: "Password", isObsecureText: true),
                20.0.heightBox,
                CustomTextButton(
                  text: TextConstants.signInText,
                  onPressed: () {
                    _loginController.authenticateUser(_emailController.text, _passwordController.text, context);
                  },
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
