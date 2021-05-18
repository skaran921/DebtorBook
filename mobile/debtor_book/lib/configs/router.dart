import 'package:debtor_book/configs/constants/route_constants.dart';
import 'package:debtor_book/pages/forgot_password/forgot_password.dart';
import 'package:debtor_book/pages/login/login_page.dart';
import 'package:flutter/material.dart';

Route _buildRoute(Widget route) => MaterialPageRoute(builder: (context) => route);

Route<dynamic> onGenerateRoute(RouteSettings settings) {
  switch (settings.name) {
    case RouteConstant.homePage:
      return _buildRoute(LoginPage());
    case RouteConstant.loginPage:
      return _buildRoute(LoginPage());
    case RouteConstant.forgotPasswordPage:
      return _buildRoute(ForgotPassword());
    default:
      return _buildRoute(LoginPage());
  }
}
