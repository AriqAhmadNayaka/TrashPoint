<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Voucher;
use App\Models\User;
use App\Models\Masyarakat;
use App\Models\HistoryVoucher;

class VoucherController extends Controller
{
    public function index()
    {
        $vouchers = Voucher::all();
        return response()->json($vouchers);
    }

    public function show($id)
    {
        $voucher = Voucher::find($id);
        if ($voucher) {
            return response()->json($voucher);
        } else {
            return response()->json(['message' => 'Voucher not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $voucher = Voucher::create($request->all());
        return response()->json($voucher, 201);
    }

    public function update(Request $request, $id)
    {
        $voucher = Voucher::find($id);
        if ($voucher) {
            $voucher->update($request->all());
            return response()->json($voucher);
        } else {
            return response()->json(['message' => 'Voucher not found'], 404);
        }
    }

    public function destroy($id)
    {
        $voucher = Voucher::find($id);
        if ($voucher) {
            $voucher->delete();
            return response()->json(['message' => 'Voucher deleted']);
        } else {
            return response()->json(['message' => 'Voucher not found'], 404);
        }
    }
}
