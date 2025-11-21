import 'package:flutter/material.dart';
import 'Views/SplashScreen.dart';

void main() {
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'TrashPoint',
      debugShowCheckedModeBanner: false,
      theme: ThemeData(
        colorScheme: ColorScheme.fromSeed(
          seedColor: const Color.fromARGB(255, 228, 255, 227),
        ),
        useMaterial3: true,
      ),
      home: const SplashScreen(),
    );
  }
}
