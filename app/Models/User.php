<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Camps que es poden assignar massivament.
     */
    protected $fillable = [
        'name',
        'surname',
        'nick',
        'role',
        'image',
        'email',
        'password',
        'phone_number',
    ];

    /**
     * Camps ocults en la serialització (JSON).
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Càsting de tipus per als camps.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relació: Un usuari té moltes imatges.
     */
    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    /**
     * Relació: Un usuari té molts comentaris.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Relació: Un usuari té molts likes.
     */
    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }
}