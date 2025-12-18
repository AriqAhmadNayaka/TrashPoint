import 'package:flutter/material.dart';
import 'package:flutter_map/flutter_map.dart';
import 'package:latlong2/latlong.dart';
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
        destinations: const [
          NavigationDestination(icon: Icon(Icons.home), label: 'Home'),
          NavigationDestination(icon: Icon(Icons.shop), label: 'Voucher'),
          NavigationDestination(icon: Icon(Icons.person), label: 'Profile'),
        ],
      ),
      // Kita pakai FutureBuilder di body biar loading datanya cuma sekali
      body: FutureBuilder<List<Trash>>(
        future: Trash.selectEmpty(),
        builder: (context, snapshot) {
          if (snapshot.connectionState == ConnectionState.waiting) {
            return const Center(child: CircularProgressIndicator());
          } else if (snapshot.hasError) {
            return Center(child: Text('Error: ${snapshot.error}'));
          } else if (!snapshot.hasData || snapshot.data!.isEmpty) {
            return const Center(child: Text('Belum ada data sampah tersedia'));
          } else {
            // Nah, ini data 'trash' yang udah siap kita pakai
            final trashList = snapshot.data!;

            return SingleChildScrollView(
              child: Column(
                children: [
                  const SizedBox(height: 20),
                  const SizedBox(height: 10),

                  // --- BAGIAN 1: PETA (CARD MINIMALIS) ---
                  Padding(
                    padding: const EdgeInsets.symmetric(horizontal: 16.0),
                    child: Card(
                      elevation: 4,
                      shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(15),
                      ),
                      child: ClipRRect(
                        borderRadius: BorderRadius.circular(15),
                        child: SizedBox(
                          height: 250, // Tinggi peta minimalis
                          width: double.infinity,
                          child: FlutterMap(
                            options: const MapOptions(
                              // Titik tengah default (bisa kamu atur ke lokasi user kalau mau)
                              initialCenter: LatLng(-6.234, 106.979),
                              initialZoom: 13.0,
                              interactionOptions: InteractionOptions(
                                flags:
                                    InteractiveFlag.all &
                                    ~InteractiveFlag.rotate,
                              ),
                            ),
                            children: [
                              TileLayer(
                                urlTemplate:
                                    'https://tile.openstreetmap.org/{z}/{x}/{y}.png',
                                userAgentPackageName: 'com.trashpoint.app',
                              ),
                              // Disini kita generate Marker dari data FutureBuilder
                              MarkerLayer(
                                markers: trashList.map((item) {
                                  // NOTE: Pastikan di Model Trash kamu ada field 'lat' dan 'lon' ya sayang!
                                  // Kalau namanya beda (misal latitude), ganti di sini ya.
                                  return Marker(
                                    point: LatLng(
                                      double.parse(item.latitude.toString()),
                                      double.parse(item.longitude.toString()),
                                    ),
                                    width: 40,
                                    height: 40,
                                    child: GestureDetector(
                                      onTap: () {
                                        // Pas marker diklik, munculin popup detail
                                        _showDetailPopup(
                                          context,
                                          item,
                                          userData,
                                        );
                                      },
                                      child: const Icon(
                                        Icons.location_on,
                                        color: Colors.red,
                                        size: 40,
                                      ),
                                    ),
                                  );
                                }).toList(),
                              ),
                            ],
                          ),
                        ),
                      ),
                    ),
                  ),
                  // Judul kecil pemanis
                ],
              ),
            );
          }
        },
      ),
    );
  }

  // --- FUNGSI POPUP (Biar bisa dipanggil di Map & Grid) ---
  void _showDetailPopup(BuildContext context, Trash item, Users userData) {
    showDialog(
      context: context,
      builder: (BuildContext context) {
        return AlertDialog(
          title: const Text("Konfirmasi Penukaran"),
          content: Text(
            "Apakah anda yakin ingin menukar poin di lokasi:\n\n${item.roadAddress}?",
          ),
          actions: [
            TextButton(
              child: const Text("Batal", style: TextStyle(color: Colors.grey)),
              onPressed: () => Navigator.of(context).pop(),
            ),
            ElevatedButton(
              style: ElevatedButton.styleFrom(
                backgroundColor: const Color.fromRGBO(77, 122, 115, 1),
              ),
              onPressed: () async {
                Navigator.of(context).pop();
                Map<String, dynamic> user = await userData.takeOutTrashes(
                  item.idTrash,
                  userData.idUser,
                );
                print(user);
                if (user['success'] == true) {
                  print("berhasil");
                  // Navigator.pushNamed(context, "/Masyarakat/HomePage");
                  SessionManager.updatePoints(user['data']['points']);

                  return showDialog(
                    context: context,
                    builder: (BuildContext context) {
                      return AlertDialog(
                        title: const Text("Sukses"),
                        content: const Text(
                          "Poin berhasil ditukar dan sampah diambil!",
                        ),
                        actions: [
                          TextButton(
                            child: const Text("OK"),
                            onPressed: () {
                              Navigator.of(context).pop();
                            },
                          ),
                        ],
                      );
                    },
                  );
                } else {
                  print("gagal");
                }
              },
              child: const Text(
                "Tukar Poin",
                style: TextStyle(color: Colors.white),
              ),
            ),
          ],
        );
      },
    );
  }
}
