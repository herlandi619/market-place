<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function index()
    {
        $payments = Payment::with('order.user')
                    ->latest()
                    ->paginate(10); // tampil 10 data per halaman

        return view('admin.payments.index', compact('payments'));
    }

     public function approve(Payment $payment)
    {
        $payment->update([
            'status' => 'approved'
        ]);

        $payment->order->update([
            'status' => 'paid'
        ]);

        return redirect()->back()->with('success', 'Pembayaran disetujui.');
    }

    public function reject(Payment $payment)
    {
        $payment->update([
            'status' => 'rejected'
        ]);

        $payment->order->update([
            'status' => 'pending'
        ]);

        return redirect()->back()->with('success', 'Pembayaran ditolak.');
    }
}
