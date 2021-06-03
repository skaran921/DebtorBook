import 'package:debtor_book/controllers/debtor_controller.dart';
import 'package:debtor_book/pages/home/custom_scaffold.dart';
import 'package:flutter/material.dart';
import 'package:get/get.dart';

class DashboardPage extends StatefulWidget {
  @override
  _DashboardPageState createState() => _DashboardPageState();
}

class _DashboardPageState extends State<DashboardPage> {
  @override
  void initState() {
    super.initState();

    /// add debtor controller
    Get.put(DebtorController(), tag: "_debtorController");
  }

  @override
  Widget build(BuildContext context) {
    return CustomScaffold.withBottomNavBar();
  }
}
