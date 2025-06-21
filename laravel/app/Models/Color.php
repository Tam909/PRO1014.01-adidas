<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $table = 'color'; // Nếu bảng là 'color'

    public $timestamps = false;

    protected $fillable = [
        'name',
        'status',
    ];

    // Quan hệ với bảng variant
    public function variants()
    {
        return $this->hasMany(Varianti::class, 'id_color');
    }
}
