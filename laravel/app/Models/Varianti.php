<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class Varianti extends Model
{
    protected $table = 'varianti';

    protected $primaryKey = 'id_var';
    public $timestamps = false;
    protected $fillable = [
        'id_pro',
        'id_color',
        'id_size',
        'price',
        'quantity',
        'img',
    ];
      public function product()
    {
        return $this->belongsTo(Product::class, 'id_pro');
    }
    public function color()
    {
        return $this->belongsTo(Color::class, 'id_color');
    }
    public function size()
    {
        return $this->belongsTo(Size::class, 'id_size');
    }
   
}
