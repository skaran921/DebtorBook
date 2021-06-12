import 'package:animations/animations.dart';
import 'package:flutter/material.dart';

///
/// A card into a details page
/// A list item into a details page
/// A FAB into a details page
/// A search bar into expanded search
///

class CustomOpenContainer extends StatelessWidget {
  const CustomOpenContainer({Key? key, required this.closeBuilder, required this.targetPage}) : super(key: key);

  final Widget Function(BuildContext context, void Function() openContainer) closeBuilder;
  final Widget targetPage;

  @override
  Widget build(BuildContext context) {
    return OpenContainer(
        openElevation: 0.0,
        closedShape: const RoundedRectangleBorder(
          borderRadius: BorderRadius.all(
            Radius.circular(50),
          ),
        ),
        transitionDuration: const Duration(milliseconds: 200),
        transitionType: ContainerTransitionType.fadeThrough,
        closedElevation: 0.0,
        closedBuilder: closeBuilder,
        openBuilder: (BuildContext context, VoidCallback _) {
          return targetPage;
        });
  }
}
