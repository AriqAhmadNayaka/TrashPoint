import 'package:flutter/material.dart';

import '../../Configs/ManagerSession.dart';
import '../../Models/Users.dart';

class ProfilePagePetugas extends StatefulWidget {
  const ProfilePagePetugas({Key? key}) : super(key: key);

  @override
  _ProfilePagePetugasState createState() => _ProfilePagePetugasState();
}

class _ProfilePagePetugasState extends State<ProfilePagePetugas> {
  // Warna tema aplikasi
  final Color primaryColor = const Color.fromRGBO(77, 122, 115, 1);

  @override
  Widget build(BuildContext context) {
    Users userData = SessionManager.currentUser!;
    double width = MediaQuery.of(context).size.width;

    return FutureBuilder<Map<String, dynamic>>(
      future: userData.getHistory(userData.idUser),
      builder: (context, snapshot) {
        if (snapshot.connectionState == ConnectionState.waiting) {
          return const Scaffold(
            body: Center(child: CircularProgressIndicator()),
          );
        } else if (snapshot.hasError) {
          return Scaffold(
            body: Center(child: Text('Error: ${snapshot.error}')),
          );
        } else {
          final history = snapshot.data ?? {};
          final List<dynamic> trashData = history['historyTakeOutTrash'] ?? [];
          final List<dynamic> voucherData = history['historyVouchers'] ?? [];

          return Scaffold(
            backgroundColor:
                Colors.grey[100], // Background sedikit abu agar kontras
            bottomNavigationBar: NavigationBar(
              onDestinationSelected: (int index) {
                if (index == 0) {
                  Navigator.pushNamed(context, '/Petugas/Pengangkutan');
                } else if (index == 1) {
                  Navigator.pushNamed(context, '/Petugas/ProfilePage');
                }
              },
              destinations: const [
                NavigationDestination(icon: Icon(Icons.home), label: 'Home'),
                NavigationDestination(
                  icon: Icon(Icons.person),
                  label: 'Profile',
                ),
              ],
              selectedIndex: 1,
            ),
            body: SingleChildScrollView(
              child: Column(
                children: [
                  // --- BAGIAN HEADER PROFILE ---
                  Container(
                    width: width,
                    padding: const EdgeInsets.only(bottom: 30),
                    decoration: BoxDecoration(
                      color: Colors.white,
                      borderRadius: const BorderRadius.only(
                        bottomLeft: Radius.circular(30),
                        bottomRight: Radius.circular(30),
                      ),
                      boxShadow: [
                        BoxShadow(
                          color: Colors.grey.withOpacity(0.2),
                          spreadRadius: 2,
                          blurRadius: 10,
                          offset: const Offset(0, 3),
                        ),
                      ],
                    ),
                    child: Column(
                      children: [
                        SizedBox(height: width * 0.15),
                        CircleAvatar(
                          radius: width * 0.15,
                          backgroundColor: primaryColor.withOpacity(0.1),
                          backgroundImage: const NetworkImage(
                            'https://cdn-icons-png.flaticon.com/512/3135/3135715.png',
                          ),
                        ),
                        SizedBox(height: width * 0.04),
                        Text(
                          userData.username,
                          style: TextStyle(
                            fontSize: width * 0.06,
                            fontWeight: FontWeight.bold,
                            color: Colors.black87,
                          ),
                        ),
                        const SizedBox(height: 5),
                        Text(
                          userData.email,
                          style: TextStyle(
                            fontSize: width * 0.04,
                            color: Colors.grey[600],
                          ),
                        ),
                        const SizedBox(height: 10),
                        Container(
                          padding: const EdgeInsets.symmetric(
                            horizontal: 12,
                            vertical: 6,
                          ),
                        ),
                      ],
                    ),
                  ),

                  const SizedBox(height: 30),

                  // --- BAGIAN TOMBOL MENU ---
                  Padding(
                    padding: const EdgeInsets.symmetric(horizontal: 20),
                    child: Column(
                      children: [
                        const SizedBox(height: 15),
                        _buildMenuButton(
                          context,
                          title: "Keluar",
                          icon: Icons.logout,
                          isLogout: true,
                          onTap: () {
                            Navigator.pushReplacementNamed(
                              context,
                              '/LoginPage',
                            );
                          },
                        ),
                      ],
                    ),
                  ),
                ],
              ),
            ),
          );
        }
      },
    );
  }

  // Widget untuk membuat tombol menu
  Widget _buildMenuButton(
    BuildContext context, {
    required String title,
    required IconData icon,
    int? count,
    required VoidCallback onTap,
    bool isLogout = false,
  }) {
    return Card(
      elevation: 2,
      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(15)),
      child: InkWell(
        onTap: onTap,
        borderRadius: BorderRadius.circular(15),
        child: Padding(
          padding: const EdgeInsets.all(20.0),
          child: Row(
            children: [
              Container(
                padding: const EdgeInsets.all(10),
                decoration: BoxDecoration(
                  color: isLogout
                      ? Colors.red.withOpacity(0.1)
                      : primaryColor.withOpacity(0.1),
                  shape: BoxShape.circle,
                ),
                child: Icon(icon, color: isLogout ? Colors.red : primaryColor),
              ),
              const SizedBox(width: 15),
              Expanded(
                child: Text(
                  title,
                  style: const TextStyle(
                    fontSize: 16,
                    fontWeight: FontWeight.w600,
                  ),
                ),
              ),
              if (count != null)
                Container(
                  padding: const EdgeInsets.symmetric(
                    horizontal: 8,
                    vertical: 4,
                  ),
                  decoration: BoxDecoration(
                    color: Colors.grey[200],
                    borderRadius: BorderRadius.circular(10),
                  ),
                  child: Text(
                    count.toString(),
                    style: TextStyle(
                      fontSize: 12,
                      fontWeight: FontWeight.bold,
                      color: Colors.grey[600],
                    ),
                  ),
                ),
              if (count == null)
                const Icon(
                  Icons.arrow_forward_ios,
                  size: 16,
                  color: Colors.grey,
                ),
            ],
          ),
        ),
      ),
    );
  }

  // Popup untuk Riwayat Sampah

  Widget _buildEmptyState(String message) {
    return Center(
      child: Column(
        mainAxisAlignment: MainAxisAlignment.center,
        children: [
          Icon(Icons.history, size: 60, color: Colors.grey[300]),
          const SizedBox(height: 10),
          Text(message, style: TextStyle(color: Colors.grey[600])),
        ],
      ),
    );
  }
}
