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
        'varianti_id',
         'quantity',
          'money',
           'total_money'
    ];

    public function product()
    {
          return $this->belongsTo(Product::class, 'id_pro', 'id'); 
    }
    /**
     * Get the cart that owns the CartDetail.
     */
    public function varianti() {
    return $this->belongsTo(Varianti::class, 'varianti_id','id_var');
}

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'id_cart', 'id_cart');
    }
}
