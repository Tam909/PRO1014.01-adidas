<?php

namespace App\Models;

use App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
protected $table = 'cart_details';
    protected $primaryKey = 'id_detail';

    protected $fillable = [
        'id_cart',
        'id_pro',
         'quantity',
          'money',
           'total_money'
    ];

    public function product()
    {
          return $this->belongsTo(Product::class, 'id_pro', 'id'); 
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'id_cart', 'id_cart');
    }
}
