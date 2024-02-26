<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostObserver
{
    /**
     * Handle the Post "created" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function created(Post $post)
    {
        if (!$post->slug) {
            $post->slug = Str::slug($post->name . ' ' . Str::substr($post->id, 0, 15));
            $post->save();
        }
    }

    public function updating(Post $post)
    {
        if (!$post->slug) {
            $post->slug = Str::slug($post->name . ' ' . Str::substr($post->id, 0, 15));
            $post->update();
        }
        if ($post->getOriginal('cover_photo') && $post->getOriginal('cover_photo') != $post->cover_photo) Storage::disk('public')->delete($post->getOriginal('cover_photo'));
        if ($post->getOriginal('banner') && $post->getOriginal('banner') != $post->banner) Storage::disk('public')->delete($post->getOriginal('banner'));
    }
}
