@extends('merchant.layouts.app')

@section('title', 'Menu')

@push('style')
    <!-- CSS Libraries -->
    <style>
        table tr td {
            padding: 5px
        }
    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Menu</h1>
            </div>
        </section>
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table style="width: 100%">
                                <tbody>
                                    <tr>
                                        <td width="10%">Order ID</td>
                                        <td width="1%">:</td>
                                        <td>{{ $order->id }}</td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td>:</td>
                                        <td>{!! $order->status_order !!}</td>
                                    </tr>
                                    <tr>
                                        <td>Total</td>
                                        <td>:</td>
                                        <td>{{ $order->total }}</td>
                                    </tr>
                                    <tr>
                                        <td>Customer</td>
                                        <td>:</td>
                                        <td>{{ $order->customer->name }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <hr>
                            <table class="table table-bordered">
                                @foreach ($order->orderDetails as $detail)
                                    <tr>
                                        <td>
                                            <img src="{{ asset($detail->menu->image) }}" style="width: 70px; height: 70px; object-fit: cover" alt="">
                                            {{ $detail->menu->name }} x {{ $detail->quantity }}
                                        </td>
                                        <td>
                                            {{ $detail->subtotal }}
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
@endpush
