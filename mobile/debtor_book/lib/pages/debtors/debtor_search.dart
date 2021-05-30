import 'package:debtor_book/configs/config.dart';
import 'package:debtor_book/controllers/debtor_controller.dart';
import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:velocity_x/velocity_x.dart';

class SearchDebtor extends SearchDelegate {
  final _debtorController = Get.find<DebtorController>(tag: "_debtorController");

  @override
  List<Widget> buildActions(BuildContext context) {
    return [
      IconButton(
          icon: Icon(Icons.close),
          onPressed: () {
            query = "";
          })
    ];
  }

  @override
  Widget buildLeading(BuildContext context) {
    return Icon(Icons.search);
  }

  @override
  Widget buildResults(BuildContext context) {
    return Container();
  }

  @override
  Widget buildSuggestions(BuildContext context) {
    return GetX<DebtorController>(
        init: _debtorController,
        builder: (controller) {
          var debtors = controller.searchDebtor(query);
          return ListView.builder(
              itemCount: debtors.length,
              itemBuilder: (BuildContext context, int index) {
                var debtor = debtors[index];
                var colorIndex = Colors.primaries.length / Colors.primaries.length + int.parse(debtor.debtorId);
                return ListTile(
                  key: ValueKey("_debtorsSearch_${debtor.debtorId}"),
                  leading: CircleAvatar(
                    backgroundColor: Colors.primaries[colorIndex.ceil()],
                    child: Container(child: "${debtor.fullName[0]}".text.xl2.white.make()),
                  ),
                  title: debtor.fullName.text.color(Configs.grayColor).make(),
                  subtitle: debtor.mobile.text.color(Configs.grayColor).make(),
                );
              });
        });
  }
}
