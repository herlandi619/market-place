<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
       $totalUsers = User::count();
    $totalSellers = User::where('role', 'seller')->count();
    $totalBuyers = User::where('role', 'buyer')->count();

    $totalOrders = Order::count();
    $totalRevenue = Order::where('status', 'paid')->sum('total_price');

    $monthlySales = Order::select(
            DB::raw("strftime('%m', created_at) as month"),
            DB::raw("SUM(total_price) as total")
        )
        ->where('status', 'paid')
        ->groupBy('month')
        ->get()
        ->mapWithKeys(function ($item) {
            $monthName = Carbon::create()
                ->month((int)$item->month)
                ->format('M');

            return [$monthName => $item->total];
        });

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalSellers',
            'totalBuyers',
            'totalOrders',
            'totalRevenue',
            'monthlySales'
        ));
    }
}
