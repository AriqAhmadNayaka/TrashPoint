import '../Models/Users.dart';

class SessionManager {
  // Ini variabel statis, ibaratnya 'kantong' yang nempel terus di aplikasi
  static Users? currentUser;

  // Fungsi buat nyimpen data pas berhasil login
  static void saveUser(Map user) {
    currentUser = Users(
      idUser: user['idUser'],
      username: user['username'],
      email: user['email'],
      password: user['password'],
      phoneNumber: user['phoneNumber'],
      role: user['role'],
      status: user['status'],
    );
  }

  // Fungsi buat cek apakah ada yang login
  static bool get isLoggedIn => currentUser != null;

  // Fungsi buat logout (hapus data dari kantong)
  static void logout() {
    currentUser = null;
  }
}
