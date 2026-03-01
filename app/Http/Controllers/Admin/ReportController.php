<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // dd($request->all());
        $startDate = $request->start_date;
        $endDate   = $request->end_date;

        $query = Order::with(['user', 'orderItems.product.user']);

        if ($startDate) {
            $query->whereDate('created_at', '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate('created_at', '<=', $endDate);
        }

        $orders = $query->get();

        // Hitung total global
        $totalSales = $orders->sum('total_price');

        // Rekap per seller
        $salesPerSeller = [];

        foreach ($orders as $order) {
            foreach ($order->orderItems as $item) {
                $sellerName = $item->product->user->name;
                $subtotal   = $item->price * $item->qty;

                if (!isset($salesPerSeller[$sellerName])) {
                    $salesPerSeller[$sellerName] = 0;
                }

                $salesPerSeller[$sellerName] += $subtotal;
            }
        }

        return view('admin.reports.index', compact(
            'orders',
            'totalSales',
            'salesPerSeller',
            'startDate',
            'endDate'
        ));
    }

    public function exportPdf(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $orders = Order::with(['user', 'orderItems.product.user'])
            ->when($startDate, function ($query) use ($startDate) {
                $query->whereDate('created_at', '>=', $startDate);
            })
            ->when($endDate, function ($query) use ($endDate) {
                $query->whereDate('created_at', '<=', $endDate);
            })
            ->get();

        $salesPerSeller = [];

        foreach ($orders as $order) {
            foreach ($order->orderItems as $item) {
                $sellerName = $item->product->user->name;
                $subtotal = $item->price * $item->qty;

                if (!isset($salesPerSeller[$sellerName])) {
                    $salesPerSeller[$sellerName] = 0;
                }

                $salesPerSeller[$sellerName] += $subtotal;
            }
        }

        $totalSales = array_sum($salesPerSeller);

        // 🔥 Cara paling stabil
        $pdf = Pdf::loadView('report.pdf', compact(
            'orders',
            'salesPerSeller',
            'totalSales',
            'startDate',
            'endDate'
        ));

        return $pdf->download('laporan-penjualan.pdf');
    }
}
