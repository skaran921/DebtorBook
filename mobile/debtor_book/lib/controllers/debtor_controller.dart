import 'package:debtor_book/models/Debtor.dart';
import 'package:debtor_book/repository/debtor_repo.dart';
import 'package:debtor_book/widgets/custom_alerts.dart';
import 'package:flutter/material.dart' show BuildContext, VoidCallback;
import 'package:get/get.dart';

class DebtorController extends GetxController {
  var isLoading = false.obs;
  List<Debtor> debtors = <Debtor>[];

  // create
  createDebtor(BuildContext context, String name, String email, String mobile, String address, VoidCallback callback) async {
    isLoading.value = true;
    var response = await DebtorRepo().createDebtor(name, mobile, email, address);

    if (response.containsKey('err') && response['err'] == "X") {
      // error msg
      CustomAlerts.simpleErrorAlert(context, response['msg']);
    } else {
      callback();
      CustomAlerts.simpleSuccessAlert(context, response['msg']);
    }
    isLoading.value = false;
  }

  // read
  getAllActiveDebtors() async {}

  Debtor getDebtorById(String debtorId) {
    return debtors.firstWhere((debtor) => debtor.debtorId == debtorId);
  }

  // update
  updateDebtor(int index, String debtorId, String name, String email, String mobile, String address) {
    debtors[index].fullName = name;
    debtors[index].email = email;
    debtors[index].mobile = mobile;
    debtors[index].address = address;
  }

  // delete
  removeDebtor(int index, String debtorId) {
    debtors.removeAt(index);
  }
}
