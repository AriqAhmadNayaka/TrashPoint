import '../Configs/ApiService.dart';

class Voucher {
  final int idVoucher, price;
  final String voucherName, status;

  // Kita butuh instance ApiService di sini
  static final ApiService _api = ApiService();

  Voucher({
    required this.idVoucher,
    required this.voucherName,
    required this.price,
    required this.status,
  });

  // Konversi dari JSON (dari Laravel) ke Object Dart
  factory Voucher.fromJson(Map<String, dynamic> json) {
    return Voucher(
      idVoucher: int.parse(json['idVoucher'].toString()),
      voucherName: json['voucherName'] ?? '',
      price: int.parse(json['price'].toString()),
      status: json['status'] ?? 'active',
    );
  }

  // Konversi Object Dart ke JSON buat dikirim ke API
  Map<String, dynamic> toJson() {
    return {
      'idVoucher': idVoucher,
      'voucherName': voucherName,
      'price': price,
      'status': status,
    };
  }

  // --- FUNGSI CRUD (Memanggil ApiService) ---
  static Future<List<Voucher>> selectAll() async {
    try {
      final data = await _api.get('vouchers');
      List<dynamic> list = data['data'] ?? data;
      print(list);
      return list.map((json) => Voucher.fromJson(json)).toList();
    } catch (e) {
      print("Duh error pas ambil data: $e");
      return [];
    }
  }

  Future<bool> add() async {
    try {
      await _api.post('vouchers', toJson());
      return true;
    } catch (e) {
      print("Gagal nambah user sayang: $e");
      return false;
    }
  }

  Future<bool> update() async {
    try {
      await _api.put('vouchers/$idVoucher', toJson());
      return true;
    } catch (e) {
      print("Gagal update voucher: $e");
      return false;
    }
  }

  Future<bool> delete() async {
    try {
      await _api.delete('vouchers/$idVoucher');
      return true;
    } catch (e) {
      print("Gagal hapus user: $e");
      return false;
    }
  }
}
