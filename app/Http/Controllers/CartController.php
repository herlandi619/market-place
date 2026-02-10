<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // tampilkan keranjang
    public function index()
    {
        $carts = auth()->user()
            ->carts()
            ->with('product')
            ->get();

        return view('cart.index', compact('carts'));
    }

    /**
     * Tambah produk ke keranjang
     * Add product to cart
     */
    public function add(Request $request, $productId)
    {
        $request->validate([
            'qty' => 'required|integer|min:1'
        ]);

        $cart = Cart::where('user_id', auth()->id())
            ->where('product_id', $productId)
            ->first();

        if ($cart) {
            // kalau produk sudah ada, tambah qty
            $cart->qty += $request->qty;
            $cart->save();
        } else {
            // kalau belum ada
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $productId,
                'qty' => $request->qty
            ]);
        }

        return redirect()->back()->with('success', 'Produk ditambahkan ke keranjang');
    }



    // hapus item
    public function destroy($id)
    {
        $cart = Cart::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $cart->delete();

        return redirect()->back()->with('success', 'Produk dihapus dari keranjang');
    }
}
