import 'package:flutter/material.dart';
import 'package:trashpoint_flutter/Configs/ApiService.dart';
import 'RegisterPage.dart';
import '../Models/Users.dart';
import '/Views/Masyarakat/HomePage.dart';
import '../Configs/ManagerSession.dart';
import '../Configs/ApiService.dart';

class LoginPage extends StatefulWidget {
  const LoginPage({super.key});

  @override
  State<LoginPage> createState() => _LoginPageState();
}

class _LoginPageState extends State<LoginPage> {
  final _emailController = TextEditingController();
  final _passwordController = TextEditingController();
  final _ipController = TextEditingController();
  String ipaddress = ApiService().getIp();

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        leading: IconButton(
          icon: const Icon(Icons.settings),
          onPressed: () => showDialog(
            context: context,
            builder: (BuildContext context) {
              return AlertDialog(
                title: const Text("Pengaturan"),
                content: Column(
                  mainAxisSize: MainAxisSize.min,
                  children: [
                    TextField(
                      controller: _ipController,
                      decoration: const InputDecoration(
                        labelText: "IP Address",
                        border: OutlineInputBorder(),
                        prefixIcon: Icon(Icons.cloud),
                      ),
                    ),
                  ],
                ),
                actions: [
                  TextButton(
                    child: const Text("Tutup"),
                    onPressed: () {
                      Navigator.of(context).pop();
                    },
                  ),
                ],
              );
            },
          ),
        ),
      ),
      body: Padding(
        padding: const EdgeInsets.all(24.0),
        child: Center(
          child: SingleChildScrollView(
            child: Column(
              mainAxisAlignment: MainAxisAlignment.center,
              crossAxisAlignment: CrossAxisAlignment.stretch,
              children: [
                const Text(
                  "LOGIN",
                  textAlign: TextAlign.center,
                  style: TextStyle(fontSize: 32, fontWeight: FontWeight.bold),
                ),
                const SizedBox(height: 20),
                Image.asset('Images/Login-rafiki.png', width: 800, height: 290),
                const SizedBox(height: 40),
                TextField(
                  controller: _emailController,
                  decoration: const InputDecoration(
                    labelText: "Email",
                    border: OutlineInputBorder(),
                    prefixIcon: Icon(Icons.email),
                  ),
                ),
                const SizedBox(height: 16),
                TextField(
                  controller: _passwordController,
                  obscureText: true,
                  decoration: const InputDecoration(
                    labelText: "Password",
                    border: OutlineInputBorder(),
                    prefixIcon: Icon(Icons.lock),
                  ),
                ),
                const SizedBox(height: 15),
                ElevatedButton(
                  onPressed: () async {
                    // TODO: Panggil fungsi login dari Users model di sini
                    Users userLogin = Users(
                      idUser: 0,
                      username: '',
                      email: _emailController.text,
                      password: _passwordController.text,
                      phoneNumber: '',
                      role: '',
                      status: '',
                    );

                    Map<String, dynamic> user = await userLogin.login();
                    if (user['success'] == true) {
                      SessionManager.saveUser(user['data']);
                      Navigator.push(
                        context,
                        MaterialPageRoute(
                          builder: (context) => const HomePage(),
                        ),
                      );
                    } else {
                      print('Login gagal! Cek email dan password kamu ya.');
                      SnackBar snackBar = SnackBar(
                        content: const Text(
                          'Login gagal! Cek email dan password kamu ya.',
                        ),
                        backgroundColor: Colors.red.shade400,
                      );
                      ScaffoldMessenger.of(context).showSnackBar(snackBar);
                    }
                    print("Login ditekan: ${_emailController.text}");
                  },
                  style: ElevatedButton.styleFrom(
                    backgroundColor: Colors.green,
                    foregroundColor: Colors.white,
                    shape: RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(
                        8,
                      ), // Adjust the radius for desired roundness
                    ),
                    padding: const EdgeInsets.symmetric(vertical: 20),
                  ),
                  child: const Text("LOGIN"),
                ),
                const SizedBox(height: 16),
                Row(
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: [
                    const Text("Belum punya akun?"),
                    TextButton(
                      onPressed: () {
                        Navigator.push(
                          context,
                          MaterialPageRoute(
                            builder: (context) => const RegisterPage(),
                          ),
                        );
                      },
                      child: const Text("Daftar Sekarang"),
                    ),
                  ],
                ),
              ],
            ),
          ),
        ),
      ),
    );
  }
}
