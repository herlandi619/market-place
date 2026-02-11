<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function create(Order $order)
    {
        return view('payments.create', compact('order'));
    }

    public function store(Request $request, Order $order)
    {
        $request->validate([
            'payment_proof' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'payment_date' => 'required|date',
        ]);

        $filePath = $request->file('payment_proof')->store('payments', 'public');

        Payment::create([
            'order_id' => $order->id,
            'payment_proof' => $filePath,
            'payment_date' => $request->payment_date,
            'status' => 'pending',
        ]);

        return redirect()->route('orders.index')
            ->with('success', 'Bukti pembayaran berhasil dikirim, menunggu verifikasi admin.');
    }
}
