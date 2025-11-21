import '../Configs/ApiService.dart';

class Users {
  final int idUser;
  final String username, email, password, phoneNumber, role, status;

  // Kita butuh instance ApiService di sini
  static final ApiService _api = ApiService();

  Users({
    required this.idUser,
    required this.username,
    required this.email,
    required this.password,
    required this.phoneNumber,
    required this.role,
    required this.status,
  });

  // Konversi dari JSON (dari Laravel) ke Object Dart
  factory Users.fromJson(Map<String, dynamic> json) {
    return Users(
      idUser: int.parse(json['idUser'].toString()),
      username: json['username'] ?? '',
      email: json['email'] ?? '',
      password: json['password'] ?? '',
      phoneNumber: json['phoneNumber'] ?? '',
      role: json['role'] ?? 'masyarakat',
      status: json['status'] ?? 'active',
    );
  }

  // Konversi Object Dart ke JSON buat dikirim ke API
  Map<String, dynamic> toJson() {
    return {
      'idUser': idUser,
      'username': username,
      'email': email,
      'password': password,
      'phoneNumber': phoneNumber,
      'role': role,
      'status': status,
    };
  }

  // --- FUNGSI CRUD (Memanggil ApiService) ---

  // 1. SELECT (Ambil semua user) - Static karena belum ada objeknya
  static Future<List<Users>> selectAll() async {
    try {
      final data = await _api.get('users');
      List<dynamic> list = data['data'] ?? data;
      return list.map((json) => Users.fromJson(json)).toList();
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
      await _api.put('users/$idUser', toJson());
      return true;
    } catch (e) {
      print("Gagal update user: $e");
      return false;
    }
  }

  // 4. DELETE (Hapus user ini)
  Future<bool> delete() async {
    try {
      await _api.delete('users/$idUser');
      return true;
    } catch (e) {
      print("Gagal hapus user: $e");
      return false;
    }
  }

  Future<Map<String, dynamic>> login() async {
    try {
      final data = await _api.post('login', {
        'email': email,
        'password': password,
      });
      // Cek apakah login berhasil berdasarkan response dari API
      if (data['success'] == true) {
        return data;
      } else {
        print("Login gagal: ${data['message']}");
        return data;
      }
    } catch (e) {
      print("Gagal login: $e");
      return {'success': false, 'message': 'Error during login'};
    }
  }
}
