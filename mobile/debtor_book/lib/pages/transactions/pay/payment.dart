import 'package:debtor_book/pages/transactions/common.dart';
import 'package:flutter/material.dart';

class PaymentPage extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: SafeArea(child: CommonTransactionForm.pay()),
    );
  }
}
