import 'package:flutter/material.dart';
import '../../Models/Users.dart';
import '../../Configs/ManagerSession.dart';
import '../../Models/Trash.dart';

class HomePage extends StatelessWidget {
  const HomePage({super.key});
  @override
  Widget build(BuildContext context) {
    Users userData = SessionManager.currentUser!;

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
      ),
      body: FutureBuilder<List<Trash>>(
        future: Trash.selectAll(),
        builder: (context, snapshot) {
          if (snapshot.connectionState == ConnectionState.waiting) {
            return const Center(child: CircularProgressIndicator());
          } else if (snapshot.hasError) {
            return Center(child: Text('Error: ${snapshot.error}'));
          } else if (!snapshot.hasData || snapshot.data!.isEmpty) {
            return const Center(child: Text('No vouchers available'));
          } else {
            final trash = snapshot.data!;
            return Column(
              children: [
                const SizedBox(height: 20),
                Text(
                  'Your Points : ${userData.points}',
                  style: TextStyle(fontSize: 24, fontWeight: FontWeight.bold),
                ),
                const SizedBox(height: 20),
                Expanded(
                  child: GridView.builder(
                    padding: const EdgeInsets.all(10),
                    gridDelegate:
                        const SliverGridDelegateWithFixedCrossAxisCount(
                          crossAxisCount: 3,
                          crossAxisSpacing: 8,
                          mainAxisSpacing: 8,
                          childAspectRatio: 0.8,
                        ),
                    itemCount: trash.length,
                    itemBuilder: (context, index) {
                      final trashItem = trash[index];
                      return Card(
                        color: const Color.fromRGBO(77, 122, 115, 1),
                        shape: RoundedRectangleBorder(
                          borderRadius: BorderRadius.circular(12),
                        ),
                        child: InkWell(
                          onTap: () {
                            showDialog(
                              context: context,
                              builder: (BuildContext context) {
                                return AlertDialog(
                                  title: const Text("Konfirmasi Penukaran"),
                                  content: Text(
                                    "Apakah anda yakin ingin menukar ${trashItem.status} poin untuk ${trashItem.roadAddress}?",
                                  ),
                                  actions: [
                                    TextButton(
                                      child: const Text("Batal"),
                                      onPressed: () {
                                        Navigator.of(context).pop();
                                      },
                                    ),
                                  ],
                                );
                              },
                            );
                          },
                          child: Padding(
                            padding: const EdgeInsets.all(8.0),
                            child: Column(
                              mainAxisAlignment: MainAxisAlignment.center,
                              children: [
                                Text(
                                  trashItem.roadAddress,
                                  textAlign: TextAlign.center,
                                  style: const TextStyle(
                                    fontWeight: FontWeight.bold,
                                    color: Colors.white,
                                    fontSize: 14,
                                  ),
                                  maxLines: 2,
                                  overflow: TextOverflow.ellipsis,
                                ),
                                const SizedBox(height: 8),
                                Text(
                                  'Status: ${trashItem.status}',
                                  textAlign: TextAlign.center,
                                  style: const TextStyle(
                                    color: Colors.white70,
                                    fontSize: 12,
                                  ),
                                ),
                              ],
                            ),
                          ),
                        ),
                      );
                    },
                  ),
                ),
              ],
            );
          }
        },
      ),
    );
  }
}
