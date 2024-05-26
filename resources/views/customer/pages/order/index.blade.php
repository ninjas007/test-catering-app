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
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-12">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h5 class="card-title">Total: {{ $orderTotal }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @foreach ($orders as $order)
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-12 p-3">
                            <table style="width: 100%">
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
                                    <td>Sub Total</td>
                                    <td>: {{ $order->orderDetails->sum('subtotal') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-9">
                            <div class="card-body">
                                <ul>
                                    @foreach ($order->orderDetails as $detail)
                                        <li>
                                            {{ $detail->menu->name }} x {{ $detail->quantity }} ({{ $detail->subtotal }})
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
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
