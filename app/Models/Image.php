<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Image extends Model
{
    use HasFactory;

    /**
     * Camps que es poden assignar massivament.
     */
    protected $fillable = [
        'user_id',
        'image_path',
        'description',
    ];

    /**
     * Relació: Una imatge pertany a un usuari.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relació: Una imatge té molts comentaris.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Relació: Una imatge té molts likes.
     */
    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }
}