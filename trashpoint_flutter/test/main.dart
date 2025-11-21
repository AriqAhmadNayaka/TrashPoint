import 'dart:io';
import '../lib/Models/Users.dart';

void main() async {
  bool running = true;

  while (running) {
    print('\n=== APLIKASI NYA MAS ARIQ ===');
    print('1. Lihat Semua User');
    print('2. Tambah User');
    print('3. Update User');
    print('4. Hapus User');
    print('5. Login');
    print('6. Keluar');
    stdout.write('Pilih menu (1-6): ');
    String? input = stdin.readLineSync();

    switch (input) {
      case '1':
        print('\n--- Data User ---');
        List<Users> users = await Users.selectAll();
        if (users.isEmpty) {
          print("Datanya kosong atau error nih :(");
        } else {
          for (var u in users) {
            print('[${u.idUser}] ${u.username} - ${u.email} - ${u.role}');
          }
        }
        break;

      case '2':
        print('\n--- Tambah User Baru ---');
        stdout.write('Username: ');
        String username = stdin.readLineSync()!;
        stdout.write('Email: ');
        String email = stdin.readLineSync()!;
        stdout.write('Password: ');
        String password = stdin.readLineSync()!;
        stdout.write('No HP: ');
        String phone = stdin.readLineSync()!;

        // Buat objek user baru (ID 0 karena auto increment di DB)
        Users newUser = Users(
          idUser: 0,
          username: username,
          email: email,
          password: password,
          phoneNumber: phone,
          role: 'masyarakat',
          status: 'active',
        );

        // Panggil fungsi add() langsung dari modelnya
        if (await newUser.add()) {
          print('Yeay! Berhasil nambah data!');
        }
        break;

      case '3':
        print('\n--- Update User ---');
        stdout.write('Masukan ID User yang mau diedit: ');
        int id = int.parse(stdin.readLineSync()!);
        stdout.write('Username Baru: ');
        String newName = stdin.readLineSync()!;
        stdout.write('Email Baru: ');
        String newEmail = stdin.readLineSync()!;

        Users userToUpdate = Users(
          idUser: id,
          username: newName,
          email: newEmail,
          password: 'unchanged',
          phoneNumber: '000', // Isi dummy kalau ga diubah
          role: 'masyarakat',
          status: 'active',
        );

        if (await userToUpdate.update()) {
          print('Data berhasil diupdate!');
        }
        break;

      case '4':
        print('\n--- Hapus User ---');
        stdout.write('Masukan ID User yang mau dihapus: ');
        int idDel = int.parse(stdin.readLineSync()!);

        // Buat objek dummy cuma buat bawa ID
        Users userDelete = Users(
          idUser: idDel,
          username: '',
          email: '',
          password: '',
          phoneNumber: '',
          role: '',
          status: '',
        );

        if (await userDelete.delete()) {
          print('User berhasil dihapus!');
        }
        break;

      case '5':
        print('Login');
        stdout.write('Email: ');
        String email = stdin.readLineSync()!;
        stdout.write('Password: ');
        String password = stdin.readLineSync()!;

        Users userLogin = Users(
          idUser: 0,
          username: '',
          email: email,
          password: password,
          phoneNumber: '',
          role: '',
          status: '',
        );

      // bool success = await userLogin.login();
      // if (success) {
      //   print('Login berhasil! Selamat datang, ${userLogin.username}!');
      // } else {
      //   print('Login gagal! Cek email dan password kamu ya.');
      // }

      case '6':
        running = false;
        break;

      default:
        print('Salah pilih...');
    }
  }
}
