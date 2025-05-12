<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Cetak Surat Barang Masuk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            color: #333;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 30px;
        }

        .logo {
            max-height: 60px;
        }

        h2 {
            margin: 0;
        }

        .info {
            margin-bottom: 20px;
        }

        .info p {
            margin: 4px 0;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 10px;
            font-size: 14px;
            text-align: left;
        }

        th {
            background-color: #f0f0f0;
        }

        tfoot td {
            font-weight: bold;
        }

        .text-right {
            text-align: right;
        }

        @media print {
            body {
                margin: 0;
            }

            .header {
                border: none;
            }
        }
    </style>
</head>

<body>
    <div class="header">
        <div>
            <h2>Surat Barang Masuk</h2>
        </div>
        <!-- <img src="logo.png" class="logo" alt="Logo"> -->
    </div>

    <div class="info">
        <p><strong>Tanggal:</strong> {{ $incoming->created_at->format('d-m-Y') }}</p>
        <p><strong>Asal Barang:</strong> {{ $incoming->origin_of_goods }}</p>
        <p><strong>Penerima:</strong> {{ $incoming->operator->name }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th class="text-right">Harga</th>
                <th class="text-right">Jumlah</th>
                <th class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            @php $grandTotal = 0; @endphp
            @foreach ($incoming->goodsDetail as $index => $detail)
                @php
                    $total = $detail->price * $detail->volume;
                    $grandTotal += $total;
                @endphp
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $detail->goods_name }}</td>
                    <td class="text-right">{{ number_format($detail->price, 0, ',', '.') }}</td>
                    <td class="text-right">{{ $detail->volume }}</td>
                    <td class="text-right">{{ number_format($total, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" class="text-right">Grand Total</td>
                <td class="text-right">{{ number_format($grandTotal, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

    <script>
        window.print();
    </script>
</body>

</html>
