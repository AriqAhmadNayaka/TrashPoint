<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Admin;
use App\Models\Petugas;
use App\Models\Masyarakat;
use App\Models\HistoryTakeOutTrash;
use App\Models\Trash;
use App\Models\Voucher;
use App\Models\HistoryVoucher;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        foreach ($users as $user) {
            if ($user->role == 'masyarakat') {
                $masyarakat = Masyarakat::where('idUser', $user->idUser)->first();
                $user = $user->setAttribute('points', $masyarakat ? $masyarakat->points : 0);
            }
        }
        return response()->json([
            'data' => $users
        ]);
    }

    public function show($id)
    {
        $user = User::find($id);
        if ($user) {
            if ($user->role == 'masyarakat') {
                $masyarakat = Masyarakat::where('idUser', $user->idUser)->first();
                $user = $user->setAttribute('points', $masyarakat->points);
            }
            return response()->json([
                'data' => $user
            ]);
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'password' => ['required'],
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phoneNumber' => $request->phoneNumber ?? '',
            'role' => $request->role ?? 'masyarakat',
            'status' => $request->status ?? 'active',
        ]);

        if ($request->role == 'admin') {
            Admin::create([
                'idUser' => $user->idUser
            ]);
        } elseif ($request->role == 'petugas') {
            Petugas::create([
                'idUser' => $user->idUser
            ]);
        } elseif ($request->role == 'masyarakat') {
            Masyarakat::create([
                'idUser' => $user->idUser,
            ]);
        }
        if ($request->expectsJson()) {
            $response = ['success' => true, 'message' => 'User created successfully', 'user' => $user];
            return response()->json($response, 201);
        }
        return redirect()->route('login.page')->with('success', 'User created successfully.');
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if ($user) {
            $user->update([
                'username' => $request->username ?? $user->username,
                'email' => $request->email ?? $user->email,
                'phoneNumber' => $request->phoneNumber ?? $user->phoneNumber,
                'password' => $request->password ? Hash::make($request->password) : $user->password,
            ]);
            return response()->json(["success" => true, $user]);
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return response()->json(["success" => true, 'message' => 'User deleted']);
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    }

    public function takeOutTrash(Request $request, $id)
    {
        $user = User::find($id);
        if ($user && $user->role == 'masyarakat') {
            $masyarakat = Masyarakat::where('idUser', $user->idUser)->first();
            if ($masyarakat) {
                $history = HistoryTakeOutTrash::create([
                    'idTrash' => $request->idTrash,
                    'idMasyarakat' => $masyarakat->idMasyarakat,
                ]);
                // Update points
                $masyarakat->points += 10;
                $masyarakat->save();
                $trash = Trash::find($request->idTrash);
                if ($trash) {
                    // 20% kemungkinan mengubah status tempat sampah
                    if (mt_rand(1, 100) <= 20) {
                        $trash->status = 'full';
                        $trash->save();
                    }
                }
                $data = [
                    "success" => true,
                    'message' => 'Trash taken out successfully',
                    "data" => [
                        'idMasyarakat' => $masyarakat->idMasyarakat,
                        'points' => $masyarakat->points,
                        'idUser' => $masyarakat->idUser,
                        'trashStatus' => $trash ? $trash->status : null,
                    ]
                ];
                return response()->json($data, 201);
            } else {
                return response()->json(['message' => 'Masyarakat not found'], 404);
            }
        } else {
            return response()->json(['message' => 'User not found or not a masyarakat'], 404);
        }
    }

    public function historyTakeOutTrashes($id)
    {
        $user = User::find($id);
        if ($user && $user->role == 'masyarakat') {
            $masyarakat = Masyarakat::where('idUser', $user->idUser)->first();
            if ($masyarakat) {
                $historyTakeOutTrashes = $masyarakat->historyTakeOutTrashes;
                $historyTakeOutTrashes->load('trash');
                return response()->json([
                    'data' => $historyTakeOutTrashes
                ]);
            } else {
                return response()->json(['message' => 'Masyarakat not found'], 404);
            }
        } else {
            return response()->json(['message' => 'User not found or not a masyarakat'], 404);
        }
    }

    public function redeem(Request $request, $id)
    {
        $user = User::find($id);
        $masyarakat = Masyarakat::where('idUser', $user->idUser)->first();
        $voucher = Voucher::find($request->idVoucher);

        if ($masyarakat && $voucher) {
            if ($masyarakat->points < $voucher->price) {
                return response()->json(['message' => 'Insufficient points'], 400);
            }
            $history = HistoryVoucher::create([
                'idMasyarakat' => $masyarakat->idMasyarakat,
                'idVoucher' => $voucher->idVoucher,
            ]);
            $masyarakat->points -= $voucher->price;
            $masyarakat->save();
            return response()->json(['success' => true, $history], 201);
        } else {
            return response()->json(['message' => 'User or Voucher not found'], 404);
        }
    }

    public function historyVouchers($id)
    {
        $user = User::find($id);
        if ($user && $user->role == 'masyarakat') {
            $masyarakat = Masyarakat::where('idUser', $user->idUser)->first();
            if ($masyarakat) {
                $historyVouchers = $masyarakat->historyVouchers;
                $historyVouchers->load('voucher');
                return response()->json([
                    'data' => $historyVouchers
                ]);
            } else {
                return response()->json(['message' => 'Masyarakat not found'], 404);
            }
        } else {
            return response()->json(['message' => 'User not found or not a masyarakat'], 404);
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {

            if ($request->expectsJson()) {
                if ($user->role == 'masyarakat') {
                    $masyarakat = Masyarakat::where('idUser', $user->idUser)->first();
                    $user = $user->setAttribute('points', $masyarakat ? $masyarakat->points : 0);
                } else if ($user->role == "petugas") {
                    $petugas = Petugas::where('idUser', $user->idUser)->first();
                    $user = $user->setAttribute('points', $petugas ? $petugas->idPetugas : 0);
                }

                $token = $user->createToken('auth_token')->plainTextToken;

                return response()->json([
                    'success' => true,
                    'message' => 'Login successful',
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                    'data' => $user
                ]);
            }

            Auth::attempt($request->only('email', 'password'));
            if (Auth::user()->role === 'admin') {
                return redirect()->route('Admin.Homepage.Page')->with('success', 'Login successful.');
            } else if (Auth::user()->role === 'petugas') {
                return redirect()->route('Petugas.Homepage.Page')->with('success', 'Login successful.');
            } else if (Auth::user()->role === 'masyarakat') {
                return redirect()->route('Masyarakat.Homepage.Page')->with('success', 'Login successful.');
            }

            return back()->with('error', 'Invalid credentials. Please try again.');
        }

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}
