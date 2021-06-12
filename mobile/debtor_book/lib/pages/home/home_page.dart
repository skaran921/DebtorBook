import 'dart:ui';
import 'package:debtor_book/configs/config.dart';
import 'package:debtor_book/controllers/debtor_controller.dart';
import 'package:debtor_book/pages/debtors/create_debtor.dart';
import 'package:debtor_book/pages/transactions/pay/payment.dart';
import 'package:debtor_book/pages/transactions/received/received.dart';
import 'package:debtor_book/utils/utils.dart';
import 'package:debtor_book/widgets/custom_open_container.dart';
import 'package:flutter/material.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';
import 'package:get/get.dart';
import 'package:velocity_x/velocity_x.dart';

var userDetails = decodeJwtToken();

class HomePage extends StatefulWidget {
  @override
  _HomePageState createState() => _HomePageState();
}

class _HomePageState extends State<HomePage> with TickerProviderStateMixin {
  final _debtorController = Get.find<DebtorController>(tag: "_debtorController");

  late final AnimationController _animationController = AnimationController(vsync: this, duration: Duration(milliseconds: 250));
  late final Animation _animation = Tween<double>(begin: 0.0, end: 1.0)
      .animate(CurvedAnimation(parent: _animationController, curve: Interval((1 / 2) * 1, 1.0, curve: Curves.easeInOut)));

  @override
  Widget build(BuildContext context) {
    _animationController.forward();
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
                              AnimatedBuilder(
                                  animation: _animation,
                                  builder: (context, widget) {
                                    return FadeTransition(
                                      opacity: _animationController,
                                      child: AnimatedContainer(
                                        duration: Duration(milliseconds: 250),
                                        transform: new Matrix4.translationValues(0.0, 30 * (1.0 - _animation.value), 0.0),
                                        child: Column(
                                            crossAxisAlignment: CrossAxisAlignment.start,
                                            children: [
                                              {"icon": FontAwesomeIcons.rupeeSign, "value": 34289, "color": Configs.greenColor},
                                              {
                                                "icon": FontAwesomeIcons.userCircle,
                                                "value": _debtorController.totalDebtors,
                                                "color": Configs.grayColor
                                              }
                                            ].map((item) {
                                              return Row(
                                                children: [
                                                  Icon(item['icon'] as IconData, color: item['color'] as Color, size: 24),
                                                  10.0.widthBox,
                                                  "${((item['value']! as num) * (_animation.value)).toInt()}"
                                                      .text
                                                      .color(item['color'] as Color)
                                                      .xl3
                                                      .make()
                                                ],
                                              );
                                            }).toList()),
                                      ),
                                    );
                                  }),
                              Expanded(
                                child: Container(),
                              ),
                              CustomOpenContainer(
                                targetPage: CreateDebtorPage(),
                                closeBuilder: (BuildContext context, VoidCallback openContainer) {
                                  return FloatingActionButton(
                                    heroTag: "addDebtorBtn",
                                    backgroundColor: Configs.primaryColor,
                                    onPressed: openContainer,
                                    child: Icons.person_add.toIcon(color: Colors.white),
                                  );
                                },
                              ),
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
                            CustomOpenContainer(
                              targetPage: ReceivedPage(),
                              closeBuilder: (BuildContext context, VoidCallback openContainer) {
                                return FloatingActionButton(
                                  heroTag: "rcvAmtFrmDbtBtn",
                                  onPressed: openContainer,
                                  backgroundColor: Configs.whiteGrayColor,
                                  child: FontAwesomeIcons.arrowRight.toIcon(),
                                );
                              },
                            ),
                            10.0.heightBox,
                            "Received".text.white.make()
                          ],
                        ),
                        40.0.widthBox,
                        Column(
                          children: [
                            CustomOpenContainer(
                              targetPage: PaymentPage(),
                              closeBuilder: (BuildContext context, VoidCallback openContainer) {
                                return FloatingActionButton(
                                  heroTag: "payAmtToDbtBtn",
                                  onPressed: openContainer,
                                  backgroundColor: Configs.whiteGrayColor,
                                  child: FontAwesomeIcons.plus.toIcon(),
                                );
                              },
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
