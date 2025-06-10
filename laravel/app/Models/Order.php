<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;
use App\Models\User;

class Order extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id_order';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'id_promotion',
        'name',
        'tel',
        'shipping_address',
        'status_order',
        'payment',
        'total_amount',
        'total_money',
        'create_at',
        'update_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function orderItems()
    {
<<<<<<< HEAD
        return $this->hasMany(OrderItem::class, 'id_order', 'id_order');
=======
        return $this->hasMany(OrderItem::class, 'order_id', 'id_order');
>>>>>>> 26d10af666f16deb84d1a7ba6e19a3932f1a5d58
    }
}
