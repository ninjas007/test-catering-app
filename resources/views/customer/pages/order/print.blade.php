<!-- resources/views/print_invoice.blade.php -->

<!DOCTYPE html>
<html>

<head>
    <title>Print Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .invoice-container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 8px;
        }
    </style>
</head>

<body>
    <div class="invoice-container">
        <table>
            <tr>
                <td width="20%">Date</td>
                <td>: {{ $order->created_at }}</td>
            </tr>
            <tr>
                <td>Order at</td>
                <td>: {{ $order->created_at->format('d-m-Y H:i') }}</td>
            </tr>
            <tr>
                <td>Invoice No</td>
                <td>: {{ $order->invoice_no }}</td>
            </tr>
            <tr>
                <td>Total</td>
                <td>: {{ $order->orderDetails->sum('subtotal') }}</td>
            </tr>
        </table>
        <hr>
        <div>
            @foreach ($order->orderDetails as $detail)
                <p> - {{ $detail->menu->name }} x {{ $detail->quantity }} ({{ $detail->subtotal }})</p>
            @endforeach
        </div>
    </div>
    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>

</html>
