import 'dart:async';
import 'package:flutter/material.dart';

class SplashScreen extends StatefulWidget {
  const SplashScreen({super.key});

  @override
  State<SplashScreen> createState() => _SplashScreenState();
}

class _SplashScreenState extends State<SplashScreen> {
  @override
  void initState() {
    super.initState();
    Timer(const Duration(seconds: 3), () {
      Navigator.pushNamed(context, '/LoginPage');
    });
  }

  @override
  Widget build(BuildContext context) {
    // Get the screen size
    double width = MediaQuery.of(context).size.width;
    double height = MediaQuery.of(context).size.height;

    return Scaffold(
      backgroundColor: const Color.fromARGB(255, 228, 255, 227),
      body: Center(
        child: Image.asset(
          'Assets/Images/1.png',
          width: width,
          height: height,
          fit: BoxFit.cover,
        ),
      ),
    );
  }
}
