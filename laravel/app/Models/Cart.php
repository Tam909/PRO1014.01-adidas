<?php

namespace App\Models;

use App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'cart';
    protected $primaryKey = 'id_cart';

    protected $fillable = [
        'id_user', 'status', 'total_money'
    ];

    public function CartDetail()
    {
        return $this->hasMany(CartDetail::class, 'id_cart', 'id_cart');
    }
}
