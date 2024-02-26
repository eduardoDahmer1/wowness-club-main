<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Http\Requests\StorePurchaseRequest;
use App\Models\Content;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class PurchaseController extends Controller
{
    public function index(Purchase $purchase, Request $request)
    {
        $userContentsIds = auth()->user()->contents->pluck('id');

        $purchases = Purchase::whereIn('content_id', $userContentsIds)
            ->orderByDesc('id')
            ->paginate();


        if (Gate::allows('viewAny', $purchase)) {
            $purchases = Purchase::filter($request->toArray())
                ->orderByDesc('id')
                ->paginate();
        }

        return view('admin.purchases.index')
            ->withPurchases($purchases);
    }

    public function indexSeeker()
    {
        return view('front.purchases.index')
            ->with('purchases', Purchase::where('user_id', auth()->user()->id)->get());
    }

    public function store(StorePurchaseRequest $request)
    {
        $data = $request->all();
        $data['status'] = false;
        $content = Content::find($data['content_id']);
        $data['amount_paid'] = $content->price;
        if (!Auth::check()) {
            Session::put('purchase', $data);
            return to_route('preregister');
        }
        $data['user_id'] = auth()->user()->id;

        if (!$content->user->status_stripe_integration) {
            return redirect()->back()->withErrors(['quantity' => __('The Practitioner must be verify account on stripe to sell')]);
        }

        $purchase = Purchase::create($data);
        $purchase->content()->associate($content);
        $purchase->save();

        return redirect()->route('purchases.checkout.index', $purchase);
    }


    public function paymentSuccessfull(Request $request)
    {
        $purchase = Purchase::where('payment_intent', $request->payment_intent)->first();

        if (auth()->user()->id !== $purchase->user_id) {
            abort(403);
        }

        $purchase->update(['status' => true]);
        return view('front.payment-successfull-purchase')->with(['name' => Str::before($purchase->user->name, ' ')]);
    }
}
