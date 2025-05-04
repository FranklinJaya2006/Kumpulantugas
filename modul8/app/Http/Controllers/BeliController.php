<?php

namespace App\Http\Controllers;

use App\Models\Beli;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class BeliController extends Controller
{
    public function store(Request $request)
    {
        // Validasi format dasar (tanpa 'exists' supaya controller tetap dijalankan)
        $request->validate([
            'user_id'    => 'required|integer',
            'product_id' => 'required|integer',
            'quantity'   => 'required|integer|min:1',
        ]);

        // Cari user
        $user = User::find($request->user_id);
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Pengguna tidak ditemukan.'
            ], 404);
        }

        // Cari produk
        $product = Product::find($request->product_id);
        if (!$product) {
            return response()->json([
                'status' => false,
                'message' => 'Produk tidak ditemukan.'
            ], 404);
        }

        // Cek stok cukup atau tidak
        if ($product->stok < $request->quantity) {
            return response()->json([
                'status' => false,
                'message' => 'Stok kurang.'
            ], 422);
        }

        // Kurangi stok
        $product->stok -= $request->quantity;
        $product->save();

        // Simpan pembelian
        $beli = Beli::create([
            'user_id'    => $user->id,
            'product_id' => $product->id,
            'quantity'   => $request->quantity,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Pembelian berhasil',
            'data' => $beli
        ], 201);
    }


    public function index()
    {
        return response()->json(Beli::all(), 200);
    }
}
