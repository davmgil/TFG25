<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Campos asignables
    protected $fillable = [
        'title',
        'slug',
        'content',
    ];

    /**
     * Para usar route model binding por slug:
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
