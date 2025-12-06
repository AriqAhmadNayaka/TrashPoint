import 'package:flutter/material.dart';

import '../../Configs/ManagerSession.dart';
import '../../Models/Users.dart';

class ProfilePage extends StatefulWidget {
  const ProfilePage({Key? key}) : super(key: key);

  @override
  _ProfilePageState createState() => _ProfilePageState();
}

class _ProfilePageState extends State<ProfilePage> {
  @override
  Widget build(BuildContext context) {
    Users userData = SessionManager.currentUser!;
    double width = MediaQuery.of(context).size.width;

    return LayoutBuilder(
      builder: (context, constraints) {
        return Scaffold(
          bottomNavigationBar: NavigationBar(
            onDestinationSelected: (int index) {
              if (index == 0) {
                Navigator.pushNamed(context, '/Masyarakat/HomePage');
              } else if (index == 1) {
                Navigator.pushNamed(context, '/Masyarakat/VoucherPage');
              } else if (index == 2) {
                Navigator.pushNamed(context, '/Masyarakat/ProfilePage');
              }
            },
            destinations: [
              NavigationDestination(icon: Icon(Icons.home), label: 'Home'),
              NavigationDestination(icon: Icon(Icons.shop), label: 'Voucher'),
              NavigationDestination(icon: Icon(Icons.person), label: 'Profile'),
            ],
            selectedIndex: 2,
          ),
          body: Column(
            children: [
              Container(
                width: constraints.maxWidth,
                decoration: BoxDecoration(
                  color: const Color.fromARGB(255, 255, 255, 255),
                ),
                child: Column(
                  children: [
                    SizedBox(height: width * 0.1),
                    CircleAvatar(
                      radius: width * 0.15,
                      backgroundImage: NetworkImage(
                        'https://cdn-icons-png.flaticon.com/512/3135/3135715.png',
                      ),
                    ),
                    SizedBox(height: width * 0.05),
                    Text(
                      userData.username,
                      style: TextStyle(
                        fontSize: width * 0.06,
                        fontWeight: FontWeight.bold,
                      ),
                    ),
                    SizedBox(height: width * 0.02),
                    Text(
                      userData.email,
                      style: TextStyle(
                        fontSize: width * 0.04,
                        color: Colors.grey[600],
                      ),
                    ),
                    SizedBox(height: width * 0.1),
                  ],
                ),
              ),
              Container(width: constraints.maxWidth, child: Text("asjk")),
            ],
          ),
        );
      },
    );
  }
}
