import 'package:flutter/material.dart';
import '../Models/Users.dart';
import '../Configs/ManagerSession.dart';

class LoginPage extends StatefulWidget {
  const LoginPage({super.key});

  @override
  State<LoginPage> createState() => _LoginPageState();
}

class _LoginPageState extends State<LoginPage> {
  final _emailController = TextEditingController();
  final _passwordController = TextEditingController();

  @override
  Widget build(BuildContext context) {
    double width = MediaQuery.of(context).size.width;

    return Scaffold(
      body: SingleChildScrollView(
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          crossAxisAlignment: CrossAxisAlignment.stretch,
          children: [
            Image.asset('Images/3.png', width: width, fit: BoxFit.contain),
            Padding(
              padding: const EdgeInsets.symmetric(horizontal: 24.0),
              child: Column(
                children: [
                  const SizedBox(height: 100),
                  TextField(
                    controller: _emailController,
                    decoration: const InputDecoration(
                      labelText: "Email",
                      border: OutlineInputBorder(),
                      prefixIcon: Icon(Icons.email),
                    ),
                  ),
                  const SizedBox(height: 50),
                  TextField(
                    controller: _passwordController,
                    obscureText: true,
                    decoration: const InputDecoration(
                      labelText: "Password",
                      border: OutlineInputBorder(),
                      prefixIcon: Icon(Icons.lock),
                    ),
                  ),
                  const SizedBox(height: 100),
                  ElevatedButton(
                    onPressed: () async {
                      Users userLogin = Users(
                        idUser: 0,
                        username: '',
                        email: _emailController.text,
                        password: _passwordController.text,
                        phoneNumber: '',
                        role: '',
                        status: '',
                        points: 0,
                      );
                      Map<String, dynamic> user = await userLogin.login();
                      if (user['success'] == true) {
                        SessionManager.saveUser(user['data']);
                        Navigator.pushNamed(context, '/Masyarakat/HomePage');
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
                      backgroundColor: Color.fromRGBO(77, 122, 115, 1),
                      foregroundColor: Colors.white,
                      fixedSize: Size(width, 50),
                      shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(8),
                      ),
                      padding: const EdgeInsets.symmetric(vertical: 13),
                    ),
                    child: const Text("Login"),
                  ),
                  const SizedBox(height: 16),
                  Row(
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: [
                      const Text("Belum punya akun?"),
                      TextButton(
                        onPressed: () {
                          Navigator.pushNamed(context, '/RegisterPage');
                        },
                        style: TextButton.styleFrom(
                          foregroundColor: Color.fromRGBO(77, 122, 115, 1),
                        ),
                        child: const Text("Daftar Sekarang"),
                      ),
                    ],
                  ),
                ],
              ),
            ),
          ],
        ),
      ),
    );
  }
}
