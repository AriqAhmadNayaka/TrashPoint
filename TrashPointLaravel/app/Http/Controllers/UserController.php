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
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
            'phoneNumber' => $request->phoneNumber ?? '',
            'role' => $request->role ?? '',
            'status' => $request->status ?? '',
        ]);
        if ($request->role == 'admin') {
            Admin::create([
                'idUser' => $user->idUser,
                // Add other admin-specific fields here
            ]);
        } elseif ($request->role == 'petugas') {
            Petugas::create([
                'idUser' => $user->idUser,
                // Add other petugas-specific fields here
            ]);
        } elseif ($request->role == 'masyarakat') {
            Masyarakat::create([
                'idUser' => $user->idUser,

            ]);
        }
        return response()->json($user, 201);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if ($user) {
            $user->update($request->all());
            return response()->json($user);
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return response()->json(['message' => 'User deleted']);
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
                    'idMasyarakat' => $masyarakat->idMasyarakat,
                    'points' => $masyarakat->points,
                    'idUser' => $masyarakat->idUser,
                    'trashStatus' => $trash ? $trash->status : null,
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
                return response()->json($historyTakeOutTrashes);
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
            return response()->json($history, 201);
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
                return response()->json($historyVouchers);
            } else {
                return response()->json(['message' => 'Masyarakat not found'], 404);
            }
        } else {
            return response()->json(['message' => 'User not found or not a masyarakat'], 404);
        }
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user && $user->password === $request->password) {
            return response()->json([
                'success' => true,
                'message' => 'Login successful',
                'data' => $user
            ]);
        } else {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    }
}
