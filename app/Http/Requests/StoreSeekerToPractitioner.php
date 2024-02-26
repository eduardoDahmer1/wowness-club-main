<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Enum;

class StoreSeekerToPractitioner extends FormRequest
{
    public function rules()
    {
        return [
            'instagram' => ['nullable', 'url', 'max:255'],
            'youtube' => ['nullable', 'url', 'max:255'],
            'facebook' => ['nullable', 'url', 'max:255'],
            'linkedin' => ['nullable', 'url', 'max:255'],
            'twitter' => ['nullable', 'url', 'max:255'],
            'tiktok' => ['nullable', 'url', 'max:255'],
            'quote' => ['nullable', 'string', 'max:255'],
            'headline' => ['nullable', 'string', 'max:255'],
            'photo' => ['required', 'file', 'image', 'max:3072'],
            'street' => ['nullable', 'string', 'max:255'],
            'number' => ['nullable', 'string', 'max:255'],
            'complement' => ['nullable', 'string', 'max:255'],
            'city' => ['required','nullable', 'string', 'max:255'],
            'zipcode' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string', 'max:650'],
            'certificates' => ['nullable'],
            'certificates.*' => ['file'],
            'terms' => 'required'
        ];
    }
}
