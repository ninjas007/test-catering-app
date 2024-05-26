@extends('customer.layouts.app')

@section('title', 'Home')
@section('description', '')

@section('css')
<style>
    table tr td {
        padding: 5px
    }
</style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center mb-4">
            <div class="col-12 px-4">
                @foreach ($orders as $order)
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-12 p-3">
                            <table style="width: 100%">
                                <tr>
                                    <td width="20%">Date</td>
                                    <td>: {{ $order->created_at }}</td>
                                    <td align="right">
                                        <a href="{{ url('print-invoice?order_id='.$order->id.'') }}" target="_blank" class="btn btn-sm btn-info">
                                            <i class="fa fa-print"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Order at</td>
                                    <td colspan="2">: {{ $order->created_at->format('d-m-Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td>Invoice No</td>
                                    <td colspan="2">: {{ $order->invoice_no }}</td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td colspan="2">: {{ $order->orderDetails->sum('subtotal') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-12 p-3 pt-0">
                            @foreach ($order->orderDetails as $detail)
                                <p> - {{ $detail->menu->name }} x {{ $detail->quantity }} ({{ $detail->subtotal }})</p>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach

                <div class="d-flex justify-content-center mt-3">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
