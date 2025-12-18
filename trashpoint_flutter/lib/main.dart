import 'package:flutter/material.dart';

import 'Views/SplashScreen.dart';
import 'Views/RegisterPage.dart';
import 'Views/LoginPage.dart';

import '/Views/Masyarakat/HomePage.dart';
import '/Views/Masyarakat/VoucherPage.dart';
import '/Views/Masyarakat/ProfilePage.dart';

import '/Views/Petugas/HomePage.dart';

void main() {
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      theme: ThemeData(
        colorScheme: ColorScheme.fromSeed(
          seedColor: const Color.fromRGBO(77, 122, 115, 1),
        ),
        useMaterial3: true,
      ),
      initialRoute: '/',
      routes: {
        '/': (context) => const SplashScreen(),
        '/LoginPage': (context) => const LoginPage(),
        '/RegisterPage': (context) => const RegisterPage(),

        '/Masyarakat/HomePage': (context) => const HomePage(),
        '/Masyarakat/VoucherPage': (context) => const VoucherPage(),
        '/Masyarakat/ProfilePage': (context) => const ProfilePage(),

        '/Petugas/Pengangkutan': (context) => const Pengangkutan(),
      },
    );
  }
}
