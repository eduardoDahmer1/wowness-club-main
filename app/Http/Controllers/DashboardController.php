<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Models\Order;
use App\Models\Purchase;
use App\Models\Review;
use App\Models\Service;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
class DashboardController extends Controller
{
   
    public function index(): View
    {
        $userRequest = auth()->user();

        $salesMonth = 0;
        $salesLastMonth = 0;
        $commissionsMonth = 0;
        $commissionsLastMonth = 0;
        $practitionerMonthSales = 0;
        $practitionerLastMonthSales = 0;
        $ticketsMonth = 0;
        $ticketsLastMonth = 0;

        $startOfMonth = Carbon::now()->startOfMonth();
        $lastMonth = $startOfMonth->copy()->subMonth();

        $usersMonth = User::where('created_at', '>', $startOfMonth)->where('role', Role::ServiceProvider)->count();
        $usersLastMonth = User::whereBetween('created_at', [$lastMonth, $startOfMonth])->where('role', Role::ServiceProvider)->count();
    
        $usersDiffPercentage = $this->calcDiffPercentage($usersLastMonth, $usersMonth);
        $ordersOfMonth = Order::with('package')->where('status', true)->where('created_at', '>', $startOfMonth)->get();
        $ordersLastMonth = Order::with('package')->where('status', true)->whereBetween('created_at', [$lastMonth, $startOfMonth])->get();
        $purchasesOfMonth = Purchase::where('status', true)->where('created_at', '>', $startOfMonth)->get();
        $purchasesLastMonth = Purchase::where('status', true)->whereBetween('created_at', [$lastMonth, $startOfMonth])->get();


        if ($userRequest->role == Role::Admin) {
            $salesMonth = $ordersOfMonth->sum(function ($order) {
                return floatval($order->package->price * $order->quantity);
            }) + $purchasesOfMonth->sum('amount_paid');
        
            $commissionsMonth = $salesMonth * 0.15;
        
            $salesLastMonth = $ordersLastMonth->sum(function ($order) {
                return floatval($order->package->price * $order->quantity);
            }) + $purchasesLastMonth->sum('amount_paid');
        
            $commissionsLastMonth = $salesLastMonth * 0.15;
        }

        $serviceUserFilter = function ($order) use ($userRequest) {
            return $order->package && $order->package->service && $order->package->service->user_id == $userRequest->id;
        };
        
        if ($userRequest->role == Role::ServiceProvider) {
            $ticketsMonth = $ordersOfMonth->filter($serviceUserFilter)->sum('quantity');
            $ticketsLastMonth = $ordersLastMonth->filter($serviceUserFilter)->sum('quantity');

            $practitionerMonthSales = $ordersOfMonth->filter($serviceUserFilter)->sum(function ($order) {
                return floatval($order->package->price * $order->quantity);
            });

            $practitionerLastMonthSales = $ordersLastMonth->filter($serviceUserFilter)->sum(function ($order) {
                return floatval($order->package->price * $order->quantity);
            });
            
            $purchasesServiceFilter = function ($purchase) use ($userRequest) {
                return $purchase->content && $purchase->content->user_id == $userRequest->id;
            };
        
            $practitionerPurchasesMonth = $purchasesOfMonth->filter($purchasesServiceFilter)->sum('amount_paid');
            $practitionerPurchasesLastMonth = $purchasesLastMonth->filter($purchasesServiceFilter)->sum('amount_paid');
        
            $practitionerMonthSales += $practitionerPurchasesMonth;
            $practitionerLastMonthSales += $practitionerPurchasesLastMonth;
        }
        
        $salesDiffPercentage = $this->calcDiffPercentage($salesLastMonth, $salesMonth);
        $practitionerSalesDiffPercentage = $this->calcDiffPercentage($practitionerLastMonthSales, $practitionerMonthSales);
        $commissionsDiffPercentage = $this->calcDiffPercentage($commissionsLastMonth, $commissionsMonth);
        $ticketsDiffPercentage = $this->calcDiffPercentage($ticketsLastMonth, $ticketsMonth);
        $pendingApprovals = User::where('role', Role::ServiceProvider)->where('status', false)->latest()->take(6)->get();
        $qtdReviews = Review::where('user_id', $userRequest->id)->where('status', true)->count();
        return view('admin.dashboard', compact(
            'usersMonth', 'usersDiffPercentage',
            'salesMonth', 'salesDiffPercentage',
            'commissionsMonth', 'commissionsDiffPercentage',
            'pendingApprovals',
            'practitionerMonthSales',
            'practitionerSalesDiffPercentage',
            'ticketsMonth',
            'ticketsDiffPercentage',
            'userRequest',
            'qtdReviews',
        ));
    }

    private function calcDiffPercentage($old, $new)
    {
        if ($new == 0) {
            return - ($old * 100);
        }

        if ($old <= 1) {
            return ($new * 100);
        }

        return round((1 - $old / $new) * 100);
    }

    public function buildChartData()
    {
        $categoriesCount = [];
        $values = [];

        if (auth()->user()->role == Role::Admin) {
            $orders = Order::with(['package.service.categories'])->where('status', true)->get();
        }
        if (auth()->user()->role == Role::ServiceProvider) {
            $orders = Order::with(['package.service.categories'])->where('status', true)->whereHas('package.service', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })->get();
        }        
     
        foreach ($orders as $order) {
            if ($order->package && $order->package->service) {
                $service = $order->package->service;
                foreach ($service->categories as $category) {
                    if (!isset($categoriesCount[$category->id])) {
                        $categoriesCount[$category->id] = 0;
                    }
                    $categoriesCount[$category->id] += $order->quantity;
                }
            }
        }
        
        $services = Service::with('categories')->get();
        $labels = $services->pluck('categories')->flatten()->unique('id')->pluck('name')->take(7)->toArray();
        $categoryNameToId = $services->pluck('categories')->flatten()->unique('id')->pluck('id', 'name')->toArray();
        
        foreach ($labels as $label) {
            $categoryId = $categoryNameToId[$label];
            if (isset($categoriesCount[$categoryId])) {
                $values[] = $categoriesCount[$categoryId];
            } else {
                $values[] = 0;
            }
        }
        $data = [
            'values' => array_slice($values, 0, 7),
            'labels' => array_slice($labels, 0, 7)
        ];
        return response()->json($data);
    }
}
