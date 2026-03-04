<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $sellerId = Auth::id();

        // Total Produk milik seller
        $totalProducts = Product::where('user_id', $sellerId)->count();

        // Total Pesanan untuk produk seller
        $totalOrders = OrderItem::whereHas('product', function ($query) use ($sellerId) {
            $query->where('user_id', $sellerId);
        })->count();

        // Pesanan terbaru
        $latestOrders = OrderItem::with(['order', 'product'])
            ->whereHas('product', function ($query) use ($sellerId) {
                $query->where('user_id', $sellerId);
            })
            ->latest()
            ->take(5)
            ->get();

        // Grafik penjualan per bulan
        $salesChart = DB::table('order_items')
            ->selectRaw("strftime('%m', created_at) as month, SUM(price * qty) as total")
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('products')
                    ->whereColumn('order_items.product_id', 'products.id')
                    ->where('user_id', 5);
            })
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();

        return view('seller.dashboard', compact(
            'totalProducts',
            'totalOrders',
            'latestOrders',
            'salesChart'
        ));
    }
}
