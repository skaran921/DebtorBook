import 'package:animations/animations.dart';
import 'package:debtor_book/configs/config.dart';
import 'package:debtor_book/pages/debtors/debtor_page.dart';
import 'package:debtor_book/pages/home/home_page.dart';
import 'package:debtor_book/pages/settings/setting_page.dart';
import 'package:flutter/material.dart';

class CustomScaffold extends StatelessWidget {
  final ValueNotifier<int> _selectedIndex = ValueNotifier<int>(0);
  final bool withBottomNavigationBar;
  final Widget? body;
  final List<Widget> pages = [HomePage(), DebtorPage(), SettingPage()];

  CustomScaffold({Key? key, this.withBottomNavigationBar = false, this.body}) : super(key: key);
  CustomScaffold.withBottomNavBar({this.withBottomNavigationBar = true, this.body});
  @override
  Widget build(BuildContext context) {
    return Scaffold(
        body: !withBottomNavigationBar
            ? this.body
            : ValueListenableBuilder(
                valueListenable: _selectedIndex,
                builder: (BuildContext context, int value, child) {
                  return PageTransitionSwitcher(
                    reverse: true,
                    transitionBuilder: (
                      Widget child,
                      Animation<double> animation,
                      Animation<double> secondaryAnimation,
                    ) {
                      return SharedAxisTransition(
                        animation: animation,
                        secondaryAnimation: secondaryAnimation,
                        transitionType: SharedAxisTransitionType.scaled,
                        child: child,
                      );
                    },
                    child: pages[value],
                  );
                }),
        bottomNavigationBar: ValueListenableBuilder(
          valueListenable: _selectedIndex,
          builder: (BuildContext context, int value, child) {
            return BottomNavigationBar(
              currentIndex: value,
              backgroundColor: Configs.whiteColor,
              type: BottomNavigationBarType.fixed,
              items: [
                BottomNavigationBarItem(icon: Icon(Icons.home), label: "Home"),
                BottomNavigationBarItem(icon: Icon(Icons.people_alt), label: "Debtors"),
                //TODO:1 BottomNavigationBarItem(icon: Icon(Icons.book_online), label: "Cashbook"),
                //TODO:2 BottomNavigationBarItem(icon: Icon(Icons.list_alt), label: "Report"),
                BottomNavigationBarItem(icon: Icon(Icons.settings), label: "Settings"),
              ],
              onTap: (index) {
                _selectedIndex.value = index;
              },
            );
          },
        ));
  }
}
