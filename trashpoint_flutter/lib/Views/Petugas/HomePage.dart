import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:flutter_map/flutter_map.dart';
import 'package:latlong2/latlong.dart';
import 'package:http/http.dart' as http;
import '../../Models/Users.dart';
import '../../Configs/ManagerSession.dart';
import '../../Models/Trash.dart';

class Pengangkutan extends StatefulWidget {
  const Pengangkutan({super.key});

  @override
  State<Pengangkutan> createState() => _PengangkutanState();
}

class _PengangkutanState extends State<Pengangkutan> {
  @override
  Widget build(BuildContext context) {
    Users userData = SessionManager.currentUser!;

    return Scaffold(
      appBar: AppBar(
        title: const Text("Daftar Tugas Pengangkutan"),
        backgroundColor: Colors.white,
        surfaceTintColor: Colors.white,
      ),
      bottomNavigationBar: NavigationBar(
        onDestinationSelected: (int index) {
          if (index == 0) {
            Navigator.pushNamed(context, '/Petugas/HomePage');
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
      body: FutureBuilder<List<dynamic>>(
        // Pastikan parameter ini adalah ID Petugas yang benar.
        // Di kode sebelumnya Anda menggunakan userData.points, saya biarkan demikian.
        future: Trash.selectSchedule(userData.points),
        builder: (context, snapshot) {
          if (snapshot.connectionState == ConnectionState.waiting) {
            return const Center(child: CircularProgressIndicator());
          } else if (snapshot.hasError) {
            return Center(child: Text('Error: ${snapshot.error}'));
          } else if (!snapshot.hasData || snapshot.data!.isEmpty) {
            return const Center(child: Text('Belum ada jadwal pengangkutan'));
          } else {
            final schedules = snapshot.data!;

            return ListView.builder(
              padding: const EdgeInsets.all(16),
              itemCount: schedules.length,
              itemBuilder: (context, index) {
                final schedule = schedules[index];
                return ScheduleCard(
                  schedule: schedule,
                  userData: userData,
                  onCompleted: () {
                    setState(() {});
                  },
                );
              },
            );
          }
        },
      ),
    );
  }
}

class ScheduleCard extends StatefulWidget {
  final dynamic schedule;
  final Users userData;
  final VoidCallback? onCompleted;

  const ScheduleCard({
    super.key,
    required this.schedule,
    required this.userData,
    this.onCompleted,
  });

  @override
  State<ScheduleCard> createState() => _ScheduleCardState();
}

class _ScheduleCardState extends State<ScheduleCard> {
  List<LatLng> routePoints = [];
  List<Trash> trashList = [];
  List<LatLng> waypoints = [];
  bool isRouteLoaded = false;

  @override
  void initState() {
    super.initState();
    _parseAndLoadRoute();
  }

  void _parseAndLoadRoute() {
    final details = widget.schedule['detail_trash_schedules'] as List;

    for (var detail in details) {
      var trashData = detail['trash'];
      Trash t = Trash(
        idTrash: int.parse(trashData['idTrash'].toString()),
        province: trashData['province'],
        city: trashData['city'],
        roadAddress: trashData['roadAddress'],
        latitude: double.parse(trashData['latitude'].toString()),
        longitude: double.parse(trashData['longitude'].toString()),
        status: trashData['status'],
      );
      trashList.add(t);
      waypoints.add(LatLng(t.latitude, t.longitude));
    }

    if (waypoints.isNotEmpty) {
      _fetchRoute(waypoints);
    }
  }

  Future<void> _fetchRoute(List<LatLng> points) async {
    if (points.length < 2) {
      if (mounted) setState(() => isRouteLoaded = true);
      return;
    }

    String coordinates = points
        .map((p) => "${p.longitude},${p.latitude}")
        .join(';');
    String url =
        'http://router.project-osrm.org/route/v1/driving/$coordinates?overview=full&geometries=geojson';

    try {
      final response = await http.get(Uri.parse(url));
      if (response.statusCode == 200) {
        var data = jsonDecode(response.body);
        var geometry = data['routes'][0]['geometry']['coordinates'] as List;
        List<LatLng> newRoute = geometry.map((coord) {
          return LatLng(coord[1].toDouble(), coord[0].toDouble());
        }).toList();

        if (mounted) {
          setState(() {
            routePoints = newRoute;
            isRouteLoaded = true;
          });
        }
      }
    } catch (e) {
      print("Gagal ambil rute: $e");
      if (mounted) {
        setState(() {
          routePoints = points; // Fallback garis lurus
          isRouteLoaded = true;
        });
      }
    }
  }

  @override
  Widget build(BuildContext context) {
    bool isAllCollected = trashList.isEmpty;

    return Card(
      margin: const EdgeInsets.only(bottom: 20),
      elevation: 4,
      color: isAllCollected ? Colors.green.shade50 : Colors.white,
      shape: RoundedRectangleBorder(
        borderRadius: BorderRadius.circular(15),
        side: isAllCollected
            ? const BorderSide(color: Colors.green, width: 2)
            : BorderSide.none,
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          // Header Card
          Padding(
            padding: const EdgeInsets.all(16.0),
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Row(
                  mainAxisAlignment: MainAxisAlignment.spaceBetween,
                  children: [
                    Text(
                      "Jadwal: ${widget.schedule['scheduleDateTime']}",
                      style: const TextStyle(
                        fontWeight: FontWeight.bold,
                        fontSize: 16,
                      ),
                    ),
                    if (isAllCollected)
                      const Chip(
                        label: Text(
                          "Selesai",
                          style: TextStyle(color: Colors.white),
                        ),
                        backgroundColor: Colors.green,
                        padding: EdgeInsets.zero,
                        visualDensity: VisualDensity.compact,
                      ),
                  ],
                ),
                const SizedBox(height: 4),
                Text("Total Titik Tersisa: ${trashList.length} Lokasi"),
              ],
            ),
          ),

          // Map Section or Completed Message
          isAllCollected
              ? Container(
                  height: 250,
                  width: double.infinity,
                  alignment: Alignment.center,
                  child: Column(
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: [
                      const Icon(
                        Icons.check_circle_outline,
                        size: 80,
                        color: Colors.green,
                      ),
                      const SizedBox(height: 10),
                      const Text(
                        "Semua tempat sampah sudah diangkut!",
                        style: TextStyle(
                          fontSize: 16,
                          fontWeight: FontWeight.bold,
                          color: Colors.green,
                        ),
                      ),
                    ],
                  ),
                )
              : SizedBox(
                  height: 250,
                  child: FlutterMap(
                    options: MapOptions(
                      initialCenter: waypoints.isNotEmpty
                          ? waypoints[0]
                          : const LatLng(-6.2, 106.8),
                      initialZoom: 13.0,
                      interactionOptions: const InteractionOptions(
                        flags: InteractiveFlag.all & ~InteractiveFlag.rotate,
                      ),
                    ),
                    children: [
                      TileLayer(
                        urlTemplate:
                            'https://tile.openstreetmap.org/{z}/{x}/{y}.png',
                        userAgentPackageName: 'com.trashpoint.app',
                      ),
                      PolylineLayer(
                        polylines: [
                          Polyline(
                            points: routePoints,
                            strokeWidth: 4.0,
                            color: Colors.blue,
                          ),
                        ],
                      ),
                      MarkerLayer(
                        markers: trashList.asMap().entries.map((entry) {
                          int idx = entry.key;
                          Trash item = entry.value;
                          return Marker(
                            point: LatLng(item.latitude, item.longitude),
                            width: 80,
                            height: 80,
                            child: GestureDetector(
                              onTap: () => _showTrashDetailPopup(context, item),
                              child: Column(
                                mainAxisAlignment: MainAxisAlignment.center,
                                children: [
                                  Container(
                                    padding: const EdgeInsets.all(6),
                                    decoration: const BoxDecoration(
                                      color: Colors.white,
                                      shape: BoxShape.circle,
                                      boxShadow: [
                                        BoxShadow(
                                          blurRadius: 2,
                                          color: Colors.black26,
                                        ),
                                      ],
                                    ),
                                    child: Text(
                                      "${idx + 1}",
                                      style: const TextStyle(
                                        fontWeight: FontWeight.bold,
                                        fontSize: 12,
                                      ),
                                    ),
                                  ),
                                  const Icon(
                                    Icons.location_on,
                                    color: Colors.red,
                                    size: 35,
                                  ),
                                ],
                              ),
                            ),
                          );
                        }).toList(),
                      ),
                    ],
                  ),
                ),

          // Action Button
          Padding(
            padding: const EdgeInsets.all(16.0),
            child: SizedBox(
              width: double.infinity,
              child: ElevatedButton(
                style: ElevatedButton.styleFrom(
                  backgroundColor: isAllCollected
                      ? Colors.green
                      : const Color.fromRGBO(77, 122, 115, 1),
                  padding: const EdgeInsets.symmetric(vertical: 12),
                  shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(8),
                  ),
                ),
                onPressed: () {
                  _completeSchedule();
                },
                child: const Text(
                  "Konfirmasi Selesai",
                  style: TextStyle(color: Colors.white, fontSize: 16),
                ),
              ),
            ),
          ),
        ],
      ),
    );
  }

  Future<void> _completeSchedule() async {
    // Logika untuk menyelesaikan jadwal
    Trash item = Trash(
      idTrash: 0,
      province: '',
      city: '',
      roadAddress: '',
      latitude: 0.0,
      longitude: 0.0,
      status: '',
    );
    await item.completeTrashSchedule(widget.schedule['idTrashSchedule']);
    print("Menyelesaikan jadwal ID: ${widget.schedule['idTrashSchedule']}");

    if (mounted) {
      ScaffoldMessenger.of(context).4(
        const SnackBar(content: Text("Jadwal berhasil diselesaikan!")),
      );
      widget.onCompleted?.call();
    }
  }

  void _showTrashDetailPopup(BuildContext context, Trash item) {
    showDialog(
      context: context,
      builder: (BuildContext context) {
        return AlertDialog(
          title: const Text("Konfirmasi Pengangkutan"),
          content: Column(
            mainAxisSize: MainAxisSize.min,
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              const Text(
                "Lokasi:",
                style: TextStyle(fontWeight: FontWeight.bold),
              ),
              Text(item.roadAddress),
              const SizedBox(height: 8),
              Text("Kota: ${item.city}"),
              const SizedBox(height: 16),
              const Text("Apakah sampah di titik ini sudah diangkut?"),
            ],
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
                await item.cleanTrash(item.idTrash);
                if (mounted) {
                  setState(() {
                    trashList.removeWhere((t) => t.idTrash == item.idTrash);
                  });
                }
                Navigator.of(context).pop();
                _executeTrashAction(item);
              },
              child: const Text(
                "Ya, Sudah",
                style: TextStyle(color: Colors.white),
              ),
            ),
          ],
        );
      },
    );
  }

  void _executeTrashAction(Trash item) {
    // Logika program Anda untuk update status sampah per titik
    print("Menjalankan aksi untuk Trash ID: ${item.idTrash}");
    ScaffoldMessenger.of(context).showSnackBar(
      SnackBar(
        content: Text("Status sampah di ${item.roadAddress} diperbarui!"),
      ),
    );
  }
}
