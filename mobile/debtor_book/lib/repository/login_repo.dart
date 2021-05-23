import 'dart:async';
import 'dart:convert';
import 'dart:io';

import 'package:debtor_book/repository/api_call_helper.dart';

class LoginRepo {
  Future<dynamic> authenticateUser(String email, String password) async {
    Map<String, dynamic> param = {"ROUTE": "/login", "EMAIL": email, "PASSWORD": password};
    return await ApiCallHelper.post(param);
  }
}
