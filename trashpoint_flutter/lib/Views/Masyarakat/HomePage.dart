import 'package:flutter/material.dart';
import '../../Models/Users.dart';
import '../../Configs/ManagerSession.dart';

class HomePage extends StatelessWidget {
  const HomePage({super.key});
  @override
  Widget build(BuildContext context) {
    Users userData = SessionManager.currentUser!;

    return Scaffold(body: Center(child: Text("Welcome ${userData.username}!")));
  }
}
