import 'dart:convert';
import 'dart:nativewrappers/_internal/vm/lib/ffi_native_type_patch.dart';
import 'package:http/http.dart' as http;

class ApiService {
  String ip = '192.168.0.101:80';

  setIp(String newIp) {
    ip = newIp;
  }

  String getIp() {
    return ip;
  }

  // Fungsi GET
  Future<dynamic> get(String endpoint) async {
    final response = await http.get(Uri.parse('http://${ip}/api/$endpoint'));
    return _handleResponse(response);
  }

  // Fungsi POST
  Future<dynamic> post(String endpoint, Map<String, dynamic> data) async {
    final response = await http.post(
      Uri.parse('http://${ip}/api/$endpoint'),
      headers: {"Content-Type": "application/json"},
      body: jsonEncode(data),
    );
    return _handleResponse(response);
  }

  // Fungsi PUT (Update)
  Future<dynamic> put(String endpoint, Map<String, dynamic> data) async {
    final response = await http.put(
      Uri.parse('http://${ip}/api/$endpoint'),
      headers: {"Content-Type": "application/json"},
      body: jsonEncode(data),
    );
    return _handleResponse(response);
  }

  // Fungsi DELETE
  Future<dynamic> delete(String endpoint) async {
    final response = await http.delete(Uri.parse('http://${ip}/api/$endpoint'));
    return _handleResponse(response);
  }

  // Helper buat cek status code biar kamu gak capek ngecek terus
  dynamic _handleResponse(http.Response response) {
    if (response.statusCode >= 200 && response.statusCode < 300) {
      return jsonDecode(response.body);
    } else {
      throw Exception('Error :( Status: ${response.statusCode}');
    }
  }
}
