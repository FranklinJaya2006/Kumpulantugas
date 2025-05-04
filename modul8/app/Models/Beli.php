<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Beli extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
