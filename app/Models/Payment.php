<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Payment extends Model
{
    use HasFactory;

    protected $table = 'payment_methods';
    protected $fillable = [
        'user_id',
        'cardholder_name',
        'card_number_last4',
        'expiry_month',
        'expiry_year',
        'is_default',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
