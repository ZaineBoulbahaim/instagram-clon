<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Like extends Model
{
    use HasFactory;

    /**
     * Camps que es poden assignar massivament.
     */
    protected $fillable = [
        'user_id',
        'image_id',
    ];

    /**
     * Relació: Un like pertany a un usuari.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relació: Un like pertany a una imatge.
     */
    public function image(): BelongsTo
    {
        return $this->belongsTo(Image::class);
    }
}