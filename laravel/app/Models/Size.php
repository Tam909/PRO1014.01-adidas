<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $table = 'size'; // Nếu bảng là 'size'

    public $timestamps = false;

    protected $fillable = [
        'name',
        'status',
    ];

    // Quan hệ với bảng variant
    public function variants()
    {
        return $this->hasMany(Varianti::class, 'id_size');
    }
}
