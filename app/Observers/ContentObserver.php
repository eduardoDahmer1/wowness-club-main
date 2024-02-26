<?php

namespace App\Observers;

use App\Models\Content;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ContentObserver
{
    /**
     * Handle the content "created" event.
     *
     * @param  \App\Models\Content  $content
     * @return void
     */
    public function created(Content $content)
    {
        $title = $content->title;
        $slug = Str::slug($title . $content->id);

        if (strlen($slug) > 50) {
            $slug = substr($slug, 0, 50);
        }

        $content->slug = $slug;
        $content->save();
    }

    public function updating(Content $content)
    {
        if($content->getOriginal('thumbnail') && $content->getOriginal('thumbnail') != $content->thumbnail) Storage::disk('public')->delete($content->getOriginal('thumbnail'));
    }

    /**
     * Handle the User "forceDeleted" event.
     *
     * @param  \App\Models\Content  $content
     * @return void
     */
    public function forceDeleted(Content $content)
    {
        if($content->getOriginal('thumbnail')) Storage::disk('public')->delete($content->getOriginal('thumbnail'));
    }
}
