import 'package:debtor_book/models/Debtor.dart';
import 'package:debtor_book/repository/debtor_repo.dart';
import 'package:debtor_book/widgets/custom_alerts.dart';
import 'package:flutter/material.dart' show BuildContext, VoidCallback;
import 'package:get/get.dart';

class DebtorController extends GetxController {
  var isLoading = false.obs;
  var hasFetchingDebtors = false.obs;
  List<Debtor> debtors = <Debtor>[].obs;

  int get totalDebtors => debtors.length;

  @override
  void onInit() {
    super.onInit();
    hasFetchingDebtors.value = true;
    fetchAllActiveDebtors();
  }

  List<Debtor> searchDebtor(String searchValue) {
    return debtors.where((item) => item.fullName.toLowerCase().startsWith(searchValue.toLowerCase())).toList();
  }

  // create
  createDebtor(BuildContext context, String name, String email, String mobile, String address, VoidCallback callback) async {
    isLoading.value = true;
    var response = await DebtorRepo().createDebtor(name, mobile, email, address);
    print(response);
    if (response.containsKey('err') && response['err'] == "X") {
      CustomAlerts.simpleErrorAlert(context, response['msg']);
    } else {
      callback();
      CustomAlerts.simpleSuccessAlert(context, response['msg']);
    }
    isLoading.value = false;
  }

// create
  Future<void> fetchAllActiveDebtors() async {
    var response = await DebtorRepo().getAllActiveDebtors();
    if (response.containsKey('err') && response['err'] == "X") {
      // CustomAlerts.simpleErrorAlert(context, response['msg']);
    } else {
      Iterable debtorsList = response['results'];
      List<Debtor> debtor = List<Debtor>.from(debtorsList.map((d) => Debtor.fromJson(d)));
      this.debtors
        ..clear()
        ..addAll(debtor);
    }
    hasFetchingDebtors.value = false;
  }

  // read
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
