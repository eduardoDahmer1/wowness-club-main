<?php

namespace App\Observers;

use App\Mail\PaidPurchase;
use App\Mail\PaidPurchaseProvider;
use App\Models\Purchase;
use Illuminate\Support\Facades\Mail;

class PurchaseObserver
{
    /**
     * Handle the purchase "created" event.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return void
     */
    public function updated(Purchase $purchase)
    {
        Mail::to($purchase->user)->when($purchase->status == 1)->send(new PaidPurchase($purchase));
        Mail::to($purchase->content->user)->when($purchase->status == 1)->send(new PaidPurchaseProvider($purchase));
    }
}
