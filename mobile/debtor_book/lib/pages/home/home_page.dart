import 'dart:ui';

import 'package:debtor_book/configs/config.dart';
import 'package:debtor_book/utils/utils.dart';
import 'package:flutter/material.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';
import 'package:velocity_x/velocity_x.dart';

var userDetails = decodeJwtToken();

class HomePage extends StatelessWidget {
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
                                    Row(
                                      children: [
                                        FontAwesomeIcons.rupeeSign.toIcon(color: Configs.greenColor, size: 24),
                                        10.0.widthBox,
                                        "89.40".text.color(Configs.greenColor).xl3.make()
                                      ],
                                    ),
                                    Row(
                                      children: [
                                        FontAwesomeIcons.userCircle.toIcon(color: Configs.grayColor, size: 24),
                                        10.0.widthBox,
                                        "3".text.color(Configs.grayColor).xl3.make()
                                      ],
                                    ),
                                  ],
                                ),
                                Expanded(
                                  child: Container(),
                                ),
                                FloatingActionButton(
                                  heroTag: "addDebtorBtn",
                                  backgroundColor: Configs.primaryColor,
                                  onPressed: () {},
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
                                onPressed: () {},
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
                                onPressed: () {},
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
        bottomNavigationBar: BottomNavigationBar(
          backgroundColor: Configs.whiteColor,
          type: BottomNavigationBarType.fixed,
          items: [
            BottomNavigationBarItem(icon: Icon(Icons.home), label: "Home"),
            BottomNavigationBarItem(icon: Icon(Icons.book_online), label: "Cashbook"),
            BottomNavigationBarItem(icon: Icon(Icons.list_alt), label: "Report"),
            BottomNavigationBarItem(icon: Icon(Icons.settings), label: "Settings"),
          ],
        ));
  }
}
