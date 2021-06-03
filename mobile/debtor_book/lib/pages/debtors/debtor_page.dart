import 'package:debtor_book/configs/config.dart';
import 'package:debtor_book/controllers/debtor_controller.dart';
import 'package:debtor_book/pages/debtors/debtor_search.dart';
import 'package:debtor_book/widgets/custom_page_header.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';
import 'package:get/get.dart';
import 'package:velocity_x/velocity_x.dart';

class DebtorPage extends StatelessWidget {
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
                                return value.fetchAllActiveDebtors();
                              },
                              child: ListView.builder(
                                  itemCount: value.debtors.length,
                                  itemBuilder: (BuildContext context, int index) {
                                    var debtor = value.debtors[index];
                                    return ExpansionTile(
                                      leading: Icon(
                                        FontAwesomeIcons.userCircle,
                                      ),
                                      title: debtor.fullName.text.color(Configs.grayColor).make(),
                                      children: [
                                        ListTile(
                                          leading: Icon(FontAwesomeIcons.mobileAlt),
                                          title: debtor.mobile.text.color(Configs.grayColor).make(),
                                        ),
                                        ListTile(
                                          leading: Icon(FontAwesomeIcons.envelope),
                                          title: debtor.email.text.color(Configs.grayColor).make(),
                                        ),
                                        ListTile(
                                          leading: Icon(FontAwesomeIcons.solidAddressBook),
                                          title: debtor.address.text.color(Configs.grayColor).make(),
                                        )
                                      ],
                                    );
                                  }),
                            );
                    })),
          ],
        ).p(16),
      ),
    );
  }
}
