<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Regles de validació per actualitzar el perfil.
     */
    public function rules(): array
    {
        return [
            'name'         => ['required', 'string', 'max:255'],
            'surname'      => ['nullable', 'string', 'max:255'],
            'nick'         => ['nullable', 'string', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'email'        => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'phone_number' => ['nullable', 'string', 'min:9', 'max:15'],
            'image'        => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif', 'max:2048'], // Màxim 2MB
        ];
    }
}