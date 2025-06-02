<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; // importar el modelo User

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'user_id',
    ];

    /**
     * Usar slug en lugar de id para el route model binding.
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Relación: un post pertenece a un usuario (autor).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
