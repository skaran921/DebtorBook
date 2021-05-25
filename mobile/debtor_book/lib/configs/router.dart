import 'package:debtor_book/configs/constants/route_constants.dart';
import 'package:debtor_book/pages/debtors/create_debtor.dart';
import 'package:debtor_book/pages/forgot_password/forgot_password.dart';
import 'package:debtor_book/pages/home/home_page.dart';
import 'package:debtor_book/pages/login/login_page.dart';
import 'package:debtor_book/pages/settings/setting_page.dart';
import 'package:debtor_book/pages/transactions/pay/payment.dart';
import 'package:debtor_book/pages/transactions/received/received.dart';
import 'package:flutter/material.dart';

Route _buildRoute(Widget route) => MaterialPageRoute(builder: (context) => route);

Route<dynamic> onGenerateRoute(RouteSettings settings) {
  switch (settings.name) {
    case RouteConstant.homePage:
      return _buildRoute(HomePage());
    case RouteConstant.loginPage:
      return _buildRoute(LoginPage());
    case RouteConstant.forgotPasswordPage:
      return _buildRoute(ForgotPassword());
    case RouteConstant.receivedPage:
      return _buildRoute(ReceivedPage());
    case RouteConstant.paymentPage:
      return _buildRoute(PaymentPage());
    case RouteConstant.createDebtorPage:
      return _buildRoute(CreateDebtorPage());
    case RouteConstant.settingPage:
      return _buildRoute(SettingPage());

    default:
      return _buildRoute(LoginPage());
  }
}
