<?php

namespace App\Http\Controllers;

use App\Enums\Type;
use App\Http\Requests\StoreOrder;
use App\Models\Calendar;
use App\Models\Occurrence;
use App\Models\Order;
use App\Models\Package;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Order $order, Request $request)
    {
        if (Gate::allows('viewAny', $order)) {
            return view('admin.orders.index')
            ->with('orders', Order::filter($request->toArray())->orderByDesc('id')->paginate());
        }

        return view('admin.orders.index')
            ->with('orders', Order::whereHas('package', function (Builder $query) {
                $query->whereHas('service', function (Builder $query) {
                    $query->where('services.user_id', auth()->user()->id);
                });
            })->get());
    }


    public function indexSeeker()
    {
        return view('front.orders.index')
            ->with('orders', Order::where('user_id', auth()->user()->id)->get());
    }

    public function store(Request $request)
    {
        $data = $request->all();

        //nao apagar o codigo comentado abaixo, sera utilizado para os pacotes em grupo
        
        // $customCalendar = Calendar::find($data['date_id']);
        // Occurrence::create([
        //     'occurrence_id' => '2',
        //     'title' => $customCalendar->service->name,
        //     'calendar_id' =>  $customCalendar->id,
        //     'start' => $customCalendar->start,
        //     'end' => $customCalendar->end,
        // ]);

        $package = Package::find($data['package_id']);
        $data['status'] = false;

        if ($package->service->type->value === 2) {
            $data['quantity'] = $data['quantity'] - 1;
        }

        if (!Auth::check()) {
            Session::put('order', $data);
            Session::put('package', $package);
            return to_route('preregister');
        }
        $data['user_id'] = auth()->user()->id;

        if (!$package->service->user->status_stripe_integration) {
            return redirect()->back()->withErrors(['quantity' => __('The Practitioner must be verify account on stripe to sell')]);
        }

        // if ($package->quantity < $data['quantity']) {
        //     return redirect()->back()->withErrors(['quantity' => __('The quantity must be lower than the number of services available')]);
        // }

        $timezoneService = $package->service->timezone->timezone;

        if ($package->service->end->shiftTimezone($timezoneService) < now($timezoneService)) {
            return redirect()->route('services.show', $package->service)->withErrors(['date' => __('This service has already expired.')]);
        }

        $order = Order::create($data);
        if($package->service->type->value !== 2) {
            $package->quantity -= $order->quantity;
        }
        $package->save();

        return redirect()->route('checkout.index', $order);
    }


    public function paymentSuccessfull(Request $request)
    {
        $order = Order::where('payment_intent', $request->payment_intent)->first();

        if (auth()->user()->id !== $order->user_id) {
            abort(403);
        }

        $order->update(['status' => true]);
        return view('front.payment-successfull')->with(['name' => Str::before($order->user->name, ' '), 'after_purchase' => $order->package->service->next_steps]);
    }
}