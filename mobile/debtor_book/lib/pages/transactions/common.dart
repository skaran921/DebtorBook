import 'package:debtor_book/models/Debtor.dart';
import 'package:debtor_book/utils/utils.dart';
import 'package:flutter/material.dart';
import 'package:debtor_book/pages/debtors/debtor_search.dart';
import 'package:debtor_book/widgets/custom_header.dart';
import 'package:debtor_book/widgets/custom_page_header.dart';
import 'package:debtor_book/widgets/custom_text_btn.dart';
import 'package:debtor_book/widgets/custom_text_field.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';
import 'package:velocity_x/velocity_x.dart';

enum FormTypes { pay, received }

class CommonTransactionForm extends StatelessWidget {
  CommonTransactionForm({Key? key, required this.formTypes}) : super(key: key);
  CommonTransactionForm.pay({Key? key, this.formTypes = FormTypes.pay}) : super(key: key);
  CommonTransactionForm.received({Key? key, this.formTypes = FormTypes.received}) : super(key: key);

  final FormTypes formTypes;
  final _formKey = GlobalKey<FormState>();
  final _dateController = TextEditingController();
  final _debtorController = TextEditingController();
  final _debtorIdController = TextEditingController();
  final _amountController = TextEditingController();
  final _remarksController = TextEditingController();

  void _validateForm(BuildContext context) {
    if (_formKey.currentState!.validate()) {
      ///save data
    }
  }

  @override
  Widget build(BuildContext context) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        CustomAppHeader(
          title: "Home",
        ),
        20.0.heightBox,
        CustomPageHeader(icon: FontAwesomeIcons.moneyBill, label: formTypes == FormTypes.pay ? "Payment" : "Received"),
        20.0.heightBox,
        Expanded(
            child: Form(
          key: _formKey,
          child: ListView(
            physics: BouncingScrollPhysics(),
            children: [
              CustomTextField(
                controller: _debtorController,
                prefixIcon: FontAwesomeIcons.userAlt,
                hintText: "Select Debtor",
                readOnly: true,
                validator: (v) {
                  if (v!.isEmpty) return "Please Select Debtor A/C";
                  return null;
                },
                onTap: () async {
                  Debtor debtor = await showSearch(context: context, delegate: SearchDebtor());
                  _debtorController.text = debtor.fullName;
                  _debtorIdController.text = debtor.debtorId;
                },
              ),
              10.0.heightBox,
              CustomTextField(
                  kbdType: TextInputType.number,
                  controller: _amountController,
                  prefixIcon: FontAwesomeIcons.rupeeSign,
                  validator: (v) {
                    if (v!.isEmpty) return "Please Enter Amount";
                    return null;
                  },
                  hintText: "Amount"),
              10.0.heightBox,
              CustomTextField(controller: _remarksController, prefixIcon: FontAwesomeIcons.stickyNote, hintText: "Remarks"),
              20.0.heightBox,
              CustomTextButton(
                text: "Save",
                onPressed: () {
                  _validateForm(context);
                },
              )
            ],
          ),
        ))
      ],
    ).p(16);
  }
}
