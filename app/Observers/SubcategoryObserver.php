<?php

namespace App\Observers;

use App\Models\Subcategory;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Storage;

class SubcategoryObserver
{

    /**
     * Handle the Subcategory "updating" event.
     *
     * @param  \App\Models\Subcategory  $subcategory
     * @return void
     */
    public function updating(Subcategory $subcategory)
    {
        if ($subcategory->getOriginal('icon')
            && $subcategory->icon
            && $subcategory->getOriginal('icon') != $subcategory->icon
        ) {
            Storage::disk('public')->delete($subcategory->getOriginal('icon'));
        }

    }

    /**
     * Handle the Subcategory "deleting" event.
     *
     * @param  \App\Models\Subcategory  $subcategory
     * @return void
     */
    public function deleting(Subcategory $subcategory)
    {
        if ($subcategory->getOriginal('icon')) Storage::disk('public')->delete($subcategory->getOriginal('icon'));
    }
}
