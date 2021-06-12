import 'package:get/get.dart';

class ThemeController extends GetxController {
  var darkMode = false.obs;

  void switchThemeMode() {
    this.darkMode.value = !this.darkMode.value;
  }
}
