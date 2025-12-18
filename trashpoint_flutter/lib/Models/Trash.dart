import '../Configs/ApiService.dart';

class Trash {
  final int idTrash;
  final double latitude, longitude;
  final String province, city, roadAddress, status;

  // Kita butuh instance ApiService di sini
  static final ApiService _api = ApiService();

  Trash({
    required this.idTrash,
    required this.latitude,
    required this.longitude,
    required this.province,
    required this.city,
    required this.roadAddress,
    required this.status,
  });

  // Konversi dari JSON (dari Laravel) ke Object Dart
  factory Trash.fromJson(Map<String, dynamic> json) {
    return Trash(
      idTrash: int.parse(json['idTrash'].toString()),
      latitude: double.parse(json['latitude'].toString()),
      longitude: double.parse(json['longitude'].toString()),
      province: json['province'] ?? '',
      city: json['city'] ?? '',
      roadAddress: json['roadAddress'] ?? '',
      status: json['status'] ?? 'active',
    );
  }

  // Konversi Object Dart ke JSON buat dikirim ke API
  Map<String, dynamic> toJson() {
    return {
      'idTrash': idTrash,
      'latitude': latitude,
      'longitude': longitude,
      'province': province,
      'city': city,
      'roadAddress': roadAddress,
      'status': status,
    };
  }

  // --- FUNGSI CRUD (Memanggil ApiService) ---

  Future<Map<String, dynamic>> cleanTrash(int idTrash) async {
    try {
      final data = await _api.post('trash-schedule/clean-trash/$idTrash', {});
      // Cek apakah login berhasil berdasarkan response dari API
      if (data['success'] == true) {
        return data;
      } else {
        print("Login gagal: ${data['message']}");
        return data;
      }
    } catch (e) {
      print("Gagal clean: $e");
      return {'success': false, 'message': 'Error during cleaning trash'};
    }
  }

  Future<Map<String, dynamic>> completeTrashSchedule(int id) async {
    try {
      final data = await _api.post(
        'trash-schedule/complete-trash-schedule/$id',
        {},
      );
      // Cek apakah login berhasil berdasarkan response dari API
      if (data['success'] == true) {
        return data;
      } else {
        print("Login gagal: ${data['message']}");
        return data;
      }
    } catch (e) {
      print("Gagal clean: $e");
      return {'success': false, 'message': 'Error during cleaning trash'};
    }
  }

  // 1. SELECT (Ambil semua user) - Static karena belum ada objeknya
  static Future<List<Trash>> selectAll() async {
    try {
      final data = await _api.get('trash');
      List<dynamic> list = data['data'] ?? data;
      return list.map((json) => Trash.fromJson(json)).toList();
    } catch (e) {
      print("Duh error pas ambil data: $e");
      return [];
    }
  }

  static Future<List<Trash>> selectEmpty() async {
    try {
      final data = await _api.get('trash/empty');
      List<dynamic> list = data['data'] ?? data;
      // print(list);
      return list.map((json) => Trash.fromJson(json)).toList();
    } catch (e) {
      print("Duh error pas ambil data: $e");
      return [];
    }
  }

  static Future<List<dynamic>> selectSchedule(int idPetugas) async {
    try {
      final data = await _api.get('trash-schedule/trash-schedules/$idPetugas');
      List<dynamic> list = data['data'] ?? data;
      // Kembalikan raw list (List of Schedules), jangan dipaksa jadi List<Trash> dulu
      // karena strukturnya beda (Trash ada di dalam detail_trash_schedules)
      return list;
    } catch (e) {
      print("Duh error pas ambil data: $e");
      return [];
    }
  }

  // 2. ADD (Simpan user baru)
  Future<bool> add() async {
    try {
      await _api.post('users', toJson());
      return true;
    } catch (e) {
      print("Gagal nambah user sayang: $e");
      return false;
    }
  }

  // 3. UPDATE (Update data user ini)
  Future<bool> update() async {
    try {
      await _api.put('users/$idTrash', toJson());
      return true;
    } catch (e) {
      print("Gagal update user: $e");
      return false;
    }
  }

  // 4. DELETE (Hapus user ini)
  Future<bool> delete() async {
    try {
      await _api.delete('users/$idTrash');
      return true;
    } catch (e) {
      print("Gagal hapus trash: $e");
      return false;
    }
  }
}
