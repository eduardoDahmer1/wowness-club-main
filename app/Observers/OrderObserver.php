<?php

namespace App\Observers;

use App\Mail\PaidOrder;
use App\Mail\PaidOrderProvider;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class OrderObserver
{
    /**
     * Handle the order "created" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function updated(Order $order)
    {
        Mail::to($order->user)->when($order->status == 1)->send(new PaidOrder($order));
        Mail::to($order->package->service->user)->when($order->status == 1)->send(new PaidOrderProvider($order));
    }
}
