<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Cho phép fill các trường sau
    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
    ];
}
