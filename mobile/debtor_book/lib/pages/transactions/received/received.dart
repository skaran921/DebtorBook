import 'package:debtor_book/pages/transactions/common.dart';
import 'package:flutter/material.dart';

class ReceivedPage extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: SafeArea(child: CommonTransactionForm.received()),
    );
  }
}
