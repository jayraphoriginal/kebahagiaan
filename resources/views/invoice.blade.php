<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <style>

       @media print {
        .hidden-print,
        .hidden-print * {
        display: none !important;
        }
}
        .container {
            width: 300px;
            padding-right: 30px;
        }
        .header {
            margin: 0;
            text-align: center;
        }
        h2, p {
            margin: 0;
        }
        .flex-container-1 {
            display: flex;
            margin-top: 10px;
        }

        .flex-container-1 > div {
            text-align : left;
        }
        .flex-container-1 .right {
            text-align : right;
            width: 200px;
        }
        .flex-container-1 .left {
            width: 100px;
        }
        .flex-container {
            width: 300px;
            display: flex;
        }

        .flex-container > div {
            -ms-flex: 1;  /* IE 10 */
            flex: 1;
        }
        ul {
            display: contents;
        }
        ul li {
            display: block;
        }
        hr {
            border-style: dashed;
        }
        a {
            text-decoration: none;
            text-align: center;
            padding: 10px;
            background: #00e676;
            border-radius: 5px;
            color: white;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header" style="margin-bottom: 30px;">
            <img src="{{ asset('/img/logogray.png') }}" width="100px"/>
            <h4>Jl Amphibi, sekip ujung no 2205</h4>
        </div>
        <hr>
        <div class="flex-container-1">
            <div class="left">
                <ul>
                    <li>Kasir</li>
                    <li>Tanggal</li>
                </ul>
            </div>
            <div class="right">
                <ul>
                    <li> {{ $order[0]->name }} </li>
                    <li> {{ date('Y-m-d : H:i:s', strtotime($order[0]->created_at)) }} </li>
                </ul>
            </div>
        </div>
        <hr>
        <div class="flex-container" style="margin-bottom: 10px; text-align:right;">
            <div style="text-align: left;">Nama Product</div>
            <div>Harga</div>
            <div>Total</div>
        </div>
        @foreach ($order as $item)
            <div class="flex-container" style="text-align: right;">
                <div style="text-align: left;">{{ $item->jumlah }}x {{ $item->nama_menu }}</div>
                <div>Rp {{ number_format($item->harga) }} </div>
                <div>Rp {{ number_format($item->harga * $item->jumlah) }} </div>
            </div>
        @endforeach
        <hr>
        <div class="flex-container" style="text-align: right; margin-top: 10px;">
            <div></div>
            <div>
                <ul>
                    <li>Tipe</li>
                    <li>Total</li>
                    <li>Disc</li>
                    <li>Grand Total</li>
                    <li>Pembayaran</li>
                    <li>Kembalian</li>
                </ul>
            </div>
            <div style="text-align: right;">
                <ul>
                    <li>{{ $order[0]->nama_pembayaran }} </li>
                    <li>Rp {{ number_format($order[0]->total) }} </li>
                    <li>{{ number_format($order[0]->disc).' %' }} </li>
                    <li>Rp {{ number_format($order[0]->grandtotal) }} </li>
                    <li>Rp {{ number_format($order[0]->jumlah_bayar) }}</li>
                    <li>Rp {{ number_format($order[0]->kembalian) }}</li>
                </ul>
            </div>
        </div>
        <hr>
        <div class="header" style="margin-top: 50px;">
            <h3>Terimakasih</h3>
            <p>Silahkan berkunjung kembali</p>
        </div>
    </div>
</body>
</html>
