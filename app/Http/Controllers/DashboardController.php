<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Services\StripeService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $stripeService;

    public function __construct(StripeService $stripeService)
    {
        $this->stripeService = $stripeService;
    }

    public function index()
    {
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('total_price');
        $totalUsers = user::count();

        $recentCharges = $this->stripeService->getRecentCharges(10);
        $chargeData = $recentCharges->data;
        $labels = array_map(fn($charge) => date('Y-m-d', $charge->created), $chargeData);
        $amounts = array_map(fn($charge) => $charge->amount / 100, $chargeData);

        $cumulativeAmounts = [];
        $total = 0;
        foreach ($amounts as $amount) {
            $total += $amount;
            $cumulativeAmounts[] = $total;
        }

        $orders = Order::with('details')->orderBy('ordered_at', 'desc')->take(10)->get();

        return view('dashboard', compact('totalProducts', 'totalOrders', 'totalRevenue', 'labels', 'amounts', 'cumulativeAmounts', 'orders', 'totalUsers'));
    }
}
