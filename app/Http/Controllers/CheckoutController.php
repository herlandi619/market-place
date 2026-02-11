<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $carts = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang masih kosong.');
        }

        return view('checkout.index', compact('carts'));
    }

    public function process()
    {
        $user = Auth::user();

        $carts = Cart::with('product')
            ->where('user_id', $user->id)
            ->get();

        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang kosong.');
        }

        DB::beginTransaction();

        try {

            // Hitung total
            $total = 0;
            foreach ($carts as $cart) {
                $total += $cart->product->price * $cart->qty;
            }

            // 1️⃣ Buat Order
            $order = Order::create([
                'user_id' => $user->id,
                'total_price' => $total,
                'status' => 'pending',
            ]);

            // 2️⃣ Buat Order Items
            foreach ($carts as $cart) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cart->product_id,
                    'price' => $cart->product->price,
                    'qty' => $cart->qty,
                ]);
            }

            // 3️⃣ Hapus Cart
            Cart::where('user_id', $user->id)->delete();

            DB::commit();

            return redirect()->route('payment.create', $order->id)
    ->with('success', 'Pesanan berhasil dibuat! Silakan lakukan pembayaran.');


        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route('cart.index')
                ->with('error', 'Terjadi kesalahan.');
        }
    }
}
