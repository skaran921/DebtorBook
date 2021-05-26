import 'package:debtor_book/configs/config.dart';
import 'package:debtor_book/configs/constants/route_constants.dart';
import 'package:debtor_book/repository/login_repo.dart';
import 'package:debtor_book/widgets/custom_alerts.dart';
import 'package:flutter/cupertino.dart';
import 'package:get/get.dart';

class LoginController extends GetxController {
  var isLoginLoading = false.obs;

  Future<void> authenticateUser(String email, String password, BuildContext context) async {
    if (!email.isEmail)
      CustomAlerts.simpleErrorAlert(context, "Email is Not Valid!");
    else if (password.isEmpty)
      CustomAlerts.simpleErrorAlert(context, "Password Required.");
    else {
      isLoginLoading.value = true;

      /// call backend service
      var response = await LoginRepo().authenticateUser(email, password);
      if (response.containsKey('err') && response['err'] == "X") {
        // error msg
        CustomAlerts.simpleErrorAlert(context, response['msg']);
        isLoginLoading.value = false;
      } else {
        /// success msg
        var jwtToken = response['jwt'];
        Configs.prefs.setString(Configs.loginPrefs, jwtToken);
        isLoginLoading.value = false;

        /// Redirect to home page
        Navigator.pushNamedAndRemoveUntil(context, RouteConstant.dashboardPage, (Route<dynamic> route) => false);
        // Navigator.pushReplacementNamed(context, RouteConstant.homePage);
        // CustomAlerts.simpleSuccessAlert(context, "You are successfully logged in");
      }
    }
  }
}
