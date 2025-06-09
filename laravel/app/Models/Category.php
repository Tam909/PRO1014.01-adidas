<?php

namespace App\Models;

use App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
        public $timestamps = false;
    protected $fillable = [
        'name', 'status_categories'
    ];
    public function products()
    {
        return $this->hasMany(Product::class, 'id_categories');
    }
}
