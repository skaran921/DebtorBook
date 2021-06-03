import 'package:debtor_book/repository/api_call_helper.dart';
import 'package:debtor_book/utils/utils.dart';

class DebtorRepo {
  Future<dynamic> createDebtor(String name, String mobile, String email, String address) async {
    Map<String, dynamic> param = {
      "ROUTE": "/debtor/create",
      'JWT': getUserToken(),
      "NAME": name,
      "EMAIL": email,
      "MOBILE": mobile,
      "ADDRESS": address
    };
    return await ApiCallHelper.post(param);
  }

  // getAllActiveDebtors
  Future<dynamic> getAllActiveDebtors() async {
    Map<String, dynamic> param = {
      "ROUTE": "/debtor/read",
      'JWT': getUserToken(),
    };
    return await ApiCallHelper.post(param);
  }
}
