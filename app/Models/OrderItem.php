<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\Product;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
    ];

    /**
     * Un orderItem pertenece a un pedido (Order).
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Un orderItem está asociado a un producto.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
