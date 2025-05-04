<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => 'Email telah tersedia.'
            ], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Pengguna telah ditambahkan',
            'data' => $user
        ], 201);
    }

    public function index()
    {
        return response()->json(User::all(), 200);
    }

    public function show(Request $request)
    {
        // Validasi input tanpa cek exists (akan dicek manual agar fleksibel)
        $request->validate([
            'id' => 'nullable|integer',
            'email' => 'nullable|email',
        ]);

        // Pastikan minimal salah satu parameter diisi
        if (!$request->filled('id') && !$request->filled('email')) {
            return response()->json([
                'status' => false,
                'message' => 'Harap isi ID atau Email.'
            ], 400);
        }

        // Query user berdasarkan ID dan/atau Email
        $user = User::query()
            ->when($request->id, fn($q) => $q->where('id', $request->id))
            ->when($request->email, fn($q) => $q->where('email', $request->email))
            ->first();

        // Jika tidak ditemukan
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User tidak ditemukan berdasarkan ID atau Email yang diberikan.'
            ], 404);
        }

        // Jika ditemukan
        return response()->json([
            'status' => true,
            'message' => 'User ditemukan',
            'data' => $user
        ], 200);
    }
}
