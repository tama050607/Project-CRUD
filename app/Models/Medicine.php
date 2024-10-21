<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;
    // Mempersiapkan data
    // fillabel
    protected $fillable = [
        'name',
        'type',
        'price',
        'stock'
    ];
}
