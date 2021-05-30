import 'dart:ui';

import 'package:debtor_book/configs/config.dart';
import 'package:debtor_book/configs/constants/route_constants.dart';
import 'package:debtor_book/controllers/debtor_controller.dart';
import 'package:debtor_book/utils/utils.dart';
import 'package:flutter/material.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';
import 'package:get/get.dart';
import 'package:velocity_x/velocity_x.dart';

var userDetails = decodeJwtToken();

class HomePage extends StatelessWidget {
  final _debtorController = Get.find<DebtorController>(tag: "_debtorController");

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          ClipPath(
            child: VxArc(
              height: 30,
              child: Container(
                decoration: BoxDecoration(
                    gradient: LinearGradient(begin: Alignment.topLeft, end: Alignment.bottomRight, colors: [
                  Configs.primaryColor,
                  Color(0xFF5762DA),
                ])),
                width: double.infinity,
                height: context.screenHeight / 2,
                child: Column(
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: [
                    Row(
                      mainAxisAlignment: MainAxisAlignment.spaceBetween,
                      children: [
                        "Home".text.white.xl3.make(),
                        CircleAvatar(
                          backgroundColor: Configs.whiteGrayColor,
                          child: FontAwesomeIcons.bell.toIcon(),
                        )
                      ],
                    ).pSymmetric(h: 20.0),
                    Container(
                      padding: EdgeInsets.all(20.0),
                      height: 150,
                      width: double.infinity,
                      margin: EdgeInsets.all(12.0),
                      decoration: BoxDecoration(color: Colors.white, borderRadius: BorderRadius.circular(16.0)),
                      child: Column(
                        mainAxisAlignment: MainAxisAlignment.center,
                        children: [
                          Row(
                            children: [
                              Column(
                                  crossAxisAlignment: CrossAxisAlignment.start,
                                  children: [
                                    {"icon": FontAwesomeIcons.rupeeSign, "value": "89.40", "color": Configs.greenColor},
                                    {
                                      "icon": FontAwesomeIcons.userCircle,
                                      "value": "${_debtorController.totalDebtors}",
                                      "color": Configs.grayColor
                                    }
                                  ].map((item) {
                                    return Row(
                                      children: [
                                        Icon(item['icon'] as IconData, color: item['color'] as Color, size: 24),
                                        10.0.widthBox,
                                        "${item['value']}".text.color(item['color'] as Color).xl3.make()
                                      ],
                                    );
                                  }).toList()),
                              Expanded(
                                child: Container(),
                              ),
                              FloatingActionButton(
                                heroTag: "addDebtorBtn",
                                backgroundColor: Configs.primaryColor,
                                onPressed: () {
                                  Navigator.pushNamed(context, RouteConstant.createDebtorPage);
                                },
                                child: Icons.person_add.toIcon(color: Colors.white),
                              )
                            ],
                          ),
                        ],
                      ),
                    ),
                    Row(
                      mainAxisAlignment: MainAxisAlignment.center,
                      children: [
                        Column(
                          children: [
                            FloatingActionButton(
                              heroTag: "rcvAmtFrmDbtBtn",
                              onPressed: () {
                                Navigator.pushNamed(context, RouteConstant.receivedPage);
                              },
                              backgroundColor: Configs.whiteGrayColor,
                              child: FontAwesomeIcons.arrowRight.toIcon(),
                            ),
                            10.0.heightBox,
                            "Received".text.white.make()
                          ],
                        ),
                        40.0.widthBox,
                        Column(
                          children: [
                            FloatingActionButton(
                              heroTag: "payAmtToDbtBtn",
                              onPressed: () {
                                Navigator.pushNamed(context, RouteConstant.paymentPage);
                              },
                              backgroundColor: Configs.whiteGrayColor,
                              child: FontAwesomeIcons.plus.toIcon(),
                            ),
                            10.0.heightBox,
                            "Pay".text.white.make()
                          ],
                        )
                      ],
                    )
                  ],
                ),
              ),
            ),
          ),
          Row(
            mainAxisAlignment: MainAxisAlignment.spaceBetween,
            children: [
              "Today".text.black.xl2.bold.make(),
              Row(
                children: [
                  Icons.search.toIcon(color: Configs.grayColor, size: 24.0),
                  4.0.widthBox,
                  "Search".text.color(Configs.grayColor).make()
                ],
              )
            ],
          ).p20(),
          Expanded(
              child: Container(
            decoration: BoxDecoration(
                color: Colors.white,
                borderRadius: BorderRadius.only(
                  topLeft: Radius.circular(12.0),
                  bottomRight: Radius.circular(12.0),
                )),
            child: ListView.builder(
                physics: BouncingScrollPhysics(),
                itemCount: 10,
                itemBuilder: (BuildContext context, int index) {
                  return ListTile(
                    leading: CircleAvatar(
                      backgroundColor: Configs.whiteGrayColor,
                      child: "S".text.color(Configs.greenColor).xl.make(),
                    ),
                    title: "Sidnee Gye".text.make(),
                    subtitle: "Cash transfer".text.make(),
                    trailing: "${Configs.rupeeSign} 25000".text.bold.make(),
                  );
                }),
          ))
        ],
      ),
    );
  }
}
