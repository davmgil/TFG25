<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;
use App\Models\User;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total',
    ];

    /**
     * Un pedido pertenece a un usuario (opcional).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Un pedido tiene muchos orderItems.
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
