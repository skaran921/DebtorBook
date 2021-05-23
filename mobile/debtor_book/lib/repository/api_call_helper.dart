import 'dart:async';
import 'dart:convert';
import 'dart:io';
import 'package:debtor_book/configs/config.dart';
import 'package:http/http.dart' as http;

class ApiCallHelper {
  static Future post(Map<String, dynamic> param) async {
    try {
      var url = Uri.parse(Configs.baseUrl);
      var response = await http.post(url, body: param);

      // print(response.body);
      var jsonResponse = json.decode(response.body);
      if (response.statusCode == 200) {
        // print("jsonResponse $jsonResponse");
        return jsonResponse;
      } else {
        return {"msg": jsonResponse['msg'], "err": "X"};
      }
    } on HttpException {
      return {"msg": "Opps! check your network connection", "err": "X"};
    } on SocketException {
      return {"msg": "Opps! server not found!", "err": "X"};
    } on TimeoutException {
      return {"msg": "Opps! network timeout, please try again", "err": "X"};
    } catch (err, _) {
      print(err);
      print(_);
      return {"msg": "Something went wrong, please try again", "err": "X"};
    }
  }
}
