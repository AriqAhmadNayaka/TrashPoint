import 'package:flutter/material.dart';
import '../../Models/Voucher.dart';
import '../../Models/Users.dart';
import '../../Configs/ManagerSession.dart';

class VoucherPage extends StatefulWidget {
  const VoucherPage({super.key});

  @override
  State<VoucherPage> createState() => _VoucherPageState();
}

class _VoucherPageState extends State<VoucherPage> {
  @override
  Widget build(BuildContext context) {
    Users userData = SessionManager.currentUser!;
    var userPoints = userData.points;
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
        selectedIndex: 1,
      ),
      body: FutureBuilder<List<Voucher>>(
        future: Voucher.selectAll(),
        builder: (context, snapshot) {
          if (snapshot.connectionState == ConnectionState.waiting) {
            return const Center(child: CircularProgressIndicator());
          } else if (snapshot.hasError) {
            return Center(child: Text('Error: ${snapshot.error}'));
          } else if (!snapshot.hasData || snapshot.data!.isEmpty) {
            return const Center(child: Text('No vouchers available'));
          } else {
            final vouchers = snapshot.data!;
            return Column(
              children: [
                const SizedBox(height: 20),
                Text(
                  'Your Points : $userPoints',
                  style: TextStyle(fontSize: 24, fontWeight: FontWeight.bold),
                ),
                const SizedBox(height: 20),
                Expanded(
                  child: ListView.builder(
                    itemCount: vouchers.length,
                    itemBuilder: (context, index) {
                      final voucher = vouchers[index];
                      return Card(
                        color: Color.fromRGBO(77, 122, 115, 1),
                        margin: const EdgeInsets.symmetric(
                          horizontal: 16,
                          vertical: 8,
                        ),
                        shape: RoundedRectangleBorder(
                          borderRadius: BorderRadius.circular(12),
                        ),
                        child: ListTile(
                          contentPadding: const EdgeInsets.all(16),
                          title: Text(
                            voucher.voucherName,
                            style: const TextStyle(
                              fontWeight: FontWeight.bold,
                              color: Colors.white,
                            ),
                          ),
                          subtitle: Text(
                            'Price: ${voucher.price}',
                            style: const TextStyle(color: Colors.white70),
                          ),
                          onTap: () {
                            showDialog(
                              context: context,
                              builder: (BuildContext context) {
                                return AlertDialog(
                                  title: const Text("Konfirmasi Penukaran"),
                                  content: Text(
                                    "Apakah anda yakin ingin menukar ${voucher.price} poin untuk ${voucher.voucherName}?",
                                  ),
                                  actions: [
                                    TextButton(
                                      child: const Text("Batal"),
                                      onPressed: () {
                                        Navigator.of(context).pop();
                                      },
                                    ),
                                    TextButton(
                                      child: const Text("Tukar"),
                                      onPressed: () {
                                        if (userData.points >= voucher.price) {
                                          userData.redeemVoucher(
                                            voucher.idVoucher,
                                            userData.idUser,
                                          );
                                          SessionManager.updatePoints(
                                            userData.points - voucher.price,
                                          );
                                          setState(() {
                                            userPoints -= voucher.price;
                                          });
                                          ScaffoldMessenger.of(
                                            context,
                                          ).showSnackBar(
                                            SnackBar(
                                              content: Text(
                                                'Berhasil menukar ${voucher.voucherName}!',
                                              ),
                                            ),
                                          );
                                        } else {
                                          ScaffoldMessenger.of(
                                            context,
                                          ).showSnackBar(
                                            const SnackBar(
                                              content: Text(
                                                'Poin tidak cukup untuk menukar voucher ini.',
                                              ),
                                            ),
                                          );
                                        }
                                        Navigator.of(context).pop();
                                      },
                                    ),
                                  ],
                                );
                              },
                            );
                          },
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
