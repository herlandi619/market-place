<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
     public function index()
    {
        $sellerId = Auth::id();

    $orders = OrderItem::with(['order.user','product'])
        ->whereHas('order') // penting
        ->whereHas('product', function($query) use ($sellerId) {
            $query->where('user_id', $sellerId);
        })
        ->latest()
        ->paginate(10);

    return view('seller.orders.index', compact('orders'));
    }

    // PROSES
    public function process($id)
    {
        // Ambil order item beserta relasinya
        $item = OrderItem::with(['order','product'])->findOrFail($id);

        $product = $item->product;
        $order   = $item->order;

        // Validasi jika order tidak ditemukan
        if (!$order) {
            return back()->with('error', 'Order tidak ditemukan');
        }

        // Validasi jika status bukan paid
        if ($order->status != 'paid') {
            return back()->with('error', 'Pesanan belum dibayar');
        }

        // Validasi stok agar tidak minus
        if ($product->stock < $item->qty) {
            return back()->with('error', 'Stok produk tidak mencukupi');
        }

        // Kurangi stok produk
        $product->stock = $product->stock - $item->qty;
        $product->save();

        // Update status order
        $order->status = 'shipped';
        $order->save();

        return back()->with('success', 'Pesanan berhasil diproses');
    }
}
