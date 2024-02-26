<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Models\Order;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::filterReview(auth()->user())->get();
        $orders = Order::has('review')->get();
        return view('admin.reviews.index')->with([
            'reviews' => $reviews,
            'orders' =>  $orders,
        ]);
    }

    public function show(Review $review)
    {
        return view('front.reviews.show')->with('review', $review);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('front.reviews.create');
    }

    public function store(StoreReviewRequest $request, Order $order)
    {
        $data = $request->validated();
        $data['order_id'] = $order->id;
        $data['user_id'] = $order->package->service->user_id;

        if (isset($data['photo'])) {
            $data['photo'] =  $request->file('photo')->store('reviews', 'public');
        };

        $review = Review::create($data);
        $review->save();

        $order->reviewed = true;
        $order->save();
        return to_route('orders.indexSeeker');
    }

    public function destroy(Review $review)
    {
        if (isset($review->photo)) {
            Storage::disk('public')->delete($review->photo);
        }

        $review->delete();

        return to_route('reviews.index');
    }

    public function destroySeekerReview(Review $review)
    {
        $service = $review->order->package->service;
        if (isset($review->photo)) {
            Storage::disk('public')->delete($review->photo);
        }
        if ($review->status) {
            $review->user->overall = $review->user->overall - $review->practitioner;
            $review->user->save();
            $service->overall = $service->overall - $review->service;
            $service->save();
        }
        $review->order->reviewed = false;
        $review->order->save();
        $review->delete();

        return to_route('orders.indexSeeker');
    }

    public function changeStatus(Review $review)
    {
        $review->status = !$review->status;
        $review->save();
        $reviews = Review::where('user_id', $review->user_id)->where('status', true)->get();
        $service = $review->order->package->service;

        $reviewsService = Review::whereHas('order', function ($query) use ($service) {
            $query->whereHas('package', function ($query) use ($service) {
                $query->where('service_id', $service->id);
            });
        })->get();

        if ($reviews->count() && $reviewsService->count()) {
            $overallService = array_sum($reviewsService->pluck('service')->toArray('service')) / $reviews->count();
            $overallPractitioner = array_sum($reviews->pluck('practitioner')->toArray()) / $reviews->count();
        } else {
            $overallPractitioner = 0;
            $overallService = 0;
        }
        $practitioner = User::where('id', $review->user_id)->first();
        $practitioner->overall = $overallPractitioner;
        $practitioner->save();
        $service->overall = $overallService;
        $service->save();

        return to_route('reviews.index');
    }
} 
