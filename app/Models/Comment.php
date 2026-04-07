<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    /**
     * Camps que es poden assignar massivament.
     */
    protected $fillable = [
        'user_id',
        'image_id',
        'content',
    ];

    /**
     * Relació: Un comentari pertany a un usuari.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relació: Un comentari pertany a una imatge.
     */
    public function image(): BelongsTo
    {
        return $this->belongsTo(Image::class);
    }
}