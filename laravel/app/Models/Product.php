<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'id_categories',
        'name',
        'price',
        'img',
        'description',
        'status'
    ];
    public function category() {
        return $this->belongsTo(Category::class, 'id_categories');
        
    }
   
}
