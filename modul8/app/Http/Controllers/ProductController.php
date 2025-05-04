<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'        => 'required|string|max:255|unique:products,name',
            'price'       => 'required|numeric',
            'description' => 'nullable|string',
            'stok'        => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => 'Nama produk telah tersedia.'
            ], 422);
        }

        $produk = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'stok' => $request->stok,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'produk telah ditambahkan',
            'data' => $produk
        ], 201);
    }

    public function index()
    {
        return response()->json(Product::all(), 200);
    }

    public function searchbyid(Request $request) {
        // Mengambil ID dari body request (json)
        $id = $request->input('id'); // Jika input ID ada dalam body request JSON dengan key 'id'
    
        // Cek apakah ID tidak ada
        if (!$id) {
            return response()->json([
                'status' => false,
                'message' => 'ID produk tidak ditemukan dalam body request'
            ], 400);
        }
    
        $produk = Product::find($id);
    
        if (!$produk) {
            return response()->json([
                'status' => false,
                'message' => 'Produk tidak ditemukan'
            ], 404);
        }
    
        return response()->json([
            'status' => true,
            'message' => 'Produk ditemukan',
            'data' => $produk
        ], 200);
    }    
}
