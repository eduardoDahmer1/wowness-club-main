<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePost extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'cover_photo' => ['image', 'required', 'max:3072'],
            'video' => ['nullable', 'url', 'max:255'],
            'banner' => ['image', 'max:3072'],
            'body' => ['nullable', 'max:20000'],
            'flipsnack_embed' => ['string', 'nullable', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'status' => ['boolean'],
            'slug' => ['string', 'nullable', 'max:255', 'unique:posts,slug'],
            'released_at' => ['nullable', 'date'],
        ];
    }

    public function messages()
    {
        return [
            'slug.unique' => 'The slug must be unique, it already belongs to another post!',
        ];
    }
}
