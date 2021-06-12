import 'package:debtor_book/configs/config.dart';
import 'package:debtor_book/controllers/debtor_controller.dart';
import 'package:debtor_book/pages/debtors/debtor_search.dart';
import 'package:debtor_book/widgets/custom_page_header.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';
import 'package:get/get.dart';
import 'package:velocity_x/velocity_x.dart';

class DebtorPage extends StatefulWidget {
  @override
  _DebtorPageState createState() => _DebtorPageState();
}

class _DebtorPageState extends State<DebtorPage> with TickerProviderStateMixin {
  final _debtorController = Get.find<DebtorController>(tag: "_debtorController");

  Widget build(BuildContext context) {
    return Scaffold(
      body: SafeArea(
        child: Column(
          children: [
            CustomPageHeader(icon: Icons.people_alt, label: "Debtors"),
            10.0.heightBox,
            Container(
              padding: EdgeInsets.symmetric(vertical: 12, horizontal: 20),
              decoration: BoxDecoration(color: Configs.whiteGrayColor, borderRadius: BorderRadius.circular(8.0)),
              height: 40.0,
              child: Row(
                children: [
                  Icon(
                    Icons.search,
                    color: Configs.grayColor,
                  ),
                  4.0.widthBox,
                  "Search".text.color(Configs.grayColor).lg.make()
                ],
              ),
            ).onTap(() {
              showSearch(context: context, delegate: SearchDebtor());
            }),
            10.0.heightBox,
            Expanded(
              child: GetX<DebtorController>(
                  init: _debtorController,
                  builder: (value) {
                    return value.hasFetchingDebtors.value
                        ? Center(child: CircularProgressIndicator())
                        : RefreshIndicator(
                            color: Colors.white,
                            onRefresh: () async {
                              return await value.fetchAllActiveDebtors();
                            },
                            child: ListView.builder(
                                itemCount: value.debtors.length,
                                itemBuilder: (BuildContext context, int index) {
                                  var debtor = value.debtors[index];
                                  return Container(
                                      child: Container(
                                    margin: EdgeInsets.all(8.0),
                                    padding: EdgeInsets.all(16.0),
                                    decoration: BoxDecoration(
                                        color: Colors.white,
                                        borderRadius: BorderRadius.only(
                                            topLeft: Radius.circular(5.0),
                                            topRight: Radius.circular(50.0),
                                            bottomLeft: Radius.circular(5.0),
                                            bottomRight: Radius.circular(5.0))),
                                    child: Column(
                                      children: [
                                        Row(
                                          children: [
                                            Icon(FontAwesomeIcons.userCheck, color: Configs.grayColor),
                                            10.0.widthBox,
                                            debtor.fullName.text.xl.color(Configs.grayColor).make()
                                          ],
                                        ),
                                        10.0.heightBox,
                                        Row(
                                          children: [
                                            Icon(FontAwesomeIcons.mobileAlt, color: Configs.grayColor),
                                            10.0.widthBox,
                                            debtor.mobile.text.xl.color(Configs.grayColor).make()
                                          ],
                                        ),
                                        Row(
                                          children: [
                                            Icon(FontAwesomeIcons.envelope, color: Configs.grayColor),
                                            10.0.widthBox,
                                            debtor.email.text.xl.color(Configs.grayColor).make()
                                          ],
                                        ),
                                        debtor.address.isEmpty
                                            ? Container()
                                            : Row(
                                                children: [
                                                  Icon(FontAwesomeIcons.addressCard, color: Configs.grayColor),
                                                  10.0.widthBox,
                                                  debtor.address.text.xl.color(Configs.grayColor).make()
                                                ],
                                              )
                                      ],
                                    ),
                                  ).wFull(context));
                                }));
                  }),
            ),
          ],
        ).p(16),
      ),
    );
  }
}
