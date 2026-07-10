<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan CleanGo Laundry</title>

    <style>

        body{
            font-family: DejaVu Sans, sans-serif;
            font-size:12px;
        }

        h2{
            text-align:center;
            margin-bottom:20px;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        th,td{
            border:1px solid #000;
            padding:6px;
            text-align:left;
        }

        th{
            background:#e5e5e5;
        }

    </style>

</head>

<body>

<h2>Laporan CleanGo Laundry</h2>

<p>Total User : {{ $totalUser }}</p>
<p>Total Order : {{ $totalOrder }}</p>
<p>Order Selesai : {{ $orderSelesai }}</p>
<p>Total Pendapatan : Rp {{ number_format($totalPendapatan,0,',','.') }}</p>

<br>

<table>

    <thead>

    <tr>

        <th>No</th>
        <th>Kode Order</th>
        <th>Customer</th>
        <th>Tanggal</th>
        <th>Status</th>
        <th>Pickup</th>
        <th>Total</th>

    </tr>

    </thead>

    <tbody>

    @foreach($orders as $order)

    <tr>

        <td>{{ $loop->iteration }}</td>

        <td>{{ $order->kode_order }}</td>

        <td>{{ $order->user->name }}</td>

        <td>{{ $order->tanggal_order }}</td>

        <td>{{ $order->status }}</td>

        <td>{{ $order->pickup_type }}</td>

        <td>
            Rp {{ number_format($order->total_harga,0,',','.') }}
        </td>

    </tr>

    @endforeach

    </tbody>

</table>

</body>
</html>
