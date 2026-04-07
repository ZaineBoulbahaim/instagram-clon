<?php

/**
 * Arxiu de funcions d'ajuda reutilitzables a tot el projecte.
 * S'inclou automàticament gràcies a la configuració de composer.json
 */

/**
 * Retorna la URL de l'avatar d'un usuari.
 * Si no té avatar, retorna null.
 *
 * @param  \App\Models\User $user
 * @return string|null
 */
function getUserAvatar($user): ?string
{
    if ($user->image) {
        return asset('storage/' . $user->image);
    }
    return null;
}

/**
 * Retorna la inicial del nom d'un usuari per mostrar com a avatar per defecte.
 *
 * @param  \App\Models\User $user
 * @return string
 */
function getUserInitial($user): string
{
    return strtoupper(substr($user->nick ?? $user->name, 0, 1));
}

/**
 * Formata una data en format llegible en català.
 *
 * @param  \Carbon\Carbon $date
 * @return string
 */
function formatDate($date): string
{
    return $date->diffForHumans();
}