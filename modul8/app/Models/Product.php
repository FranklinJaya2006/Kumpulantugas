<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'description',
        'stok'
    ];

    protected $casts = [
        'price' => 'float',
        'stok'  => 'integer',
    ];

    public function bells()
    {
        return $this->hasMany(Bell::class);
    }
}
