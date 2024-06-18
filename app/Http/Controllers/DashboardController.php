<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Haal het totale aantal producten op
        $totalProducts = Product::count();
        // Haal het totale aantal bestellingen op
        $totalOrders = Order::count();
        // Bereken de totale omzet
        $totalRevenue = Order::sum('total_price');
        // Haal het totale aantal gebruikers op
        $totalUsers = User::count();

        // Haal de meest recente bestellingen op
        $orders = Order::latest()->take(10)->get();

        // Bereid gegevens voor de grafieken voor
        $labels = [];
        $amounts = [];
        $cumulativeAmounts = [];
        $cumulativeTotal = 0;

        // Haal de bestellingen op, gegroepeerd per 30 minuten interval, voor de laatste 24 uur
        $ordersByInterval = Order::where('ordered_at', '>=', Carbon::now()->subHours(24))
            ->select(DB::raw('DATE_FORMAT(ordered_at, "%Y-%m-%d %H:00:00") as interval_start'), DB::raw('FLOOR(MINUTE(ordered_at) / 30) as half_hour'), DB::raw('SUM(total_price) as total'))
            ->groupBy('interval_start', 'half_hour')
            ->orderBy('interval_start')
            ->orderBy('half_hour')
            ->get();

        // Verwerk de opgehaalde bestellingen om de labels en bedragen voor de grafieken te vullen
        foreach ($ordersByInterval as $order) {
            $labels[] = Carbon::parse($order->interval_start)->addMinutes($order->half_hour * 30)->format('Y-m-d H:i');
            $amounts[] = $order->total;
            $cumulativeTotal += $order->total;
            $cumulativeAmounts[] = $cumulativeTotal;
        }

        // Geef de data door aan de view
        return view('dashboard', compact(
            'totalProducts',
            'totalOrders',
            'totalRevenue',
            'totalUsers',
            'orders',
            'labels',
            'amounts',
            'cumulativeAmounts'
        ));
    }
}
