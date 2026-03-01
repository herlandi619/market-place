<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Penjualan</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        th, td { border: 1px solid #000; padding: 6px; }
        th { background: #eee; }
    </style>
</head>
<body>

<h2>Laporan Penjualan Global</h2>

<p>
    Periode:
    {{ $startDate ?? '-' }} s/d {{ $endDate ?? '-' }}
</p>

<h3>Total Penjualan: Rp {{ number_format($totalSales, 0, ',', '.') }}</h3>

<h4>Penjualan Per Seller</h4>
<table>
    <thead>
        <tr>
            <th>Seller</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach($salesPerSeller as $seller => $total)
            <tr>
                <td>{{ $seller }}</td>
                <td>Rp {{ number_format($total, 0, ',', '.') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<h4>Detail Transaksi</h4>
<table>
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Buyer</th>
            <th>Seller</th>
            <th>Produk</th>
            <th>Qty</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
            @foreach($order->orderItems as $item)
                <tr>
                    <td>{{ $order->created_at->format('d-m-Y') }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>{{ $item->product->user->name }}</td>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->qty }}</td>
                    <td>
                        Rp {{ number_format($item->price * $item->qty, 0, ',', '.') }}
                    </td>
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>

</body>
</html>