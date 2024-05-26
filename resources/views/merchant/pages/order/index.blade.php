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
                            <div class="row">
                                <div class="col-12">
                                    <form action="{{ url()->current() }}" method="GET">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Search Order" name="search" value="{{ request()->get('search') }}">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="submit">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="table-responsive">

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No Invoice</th>
                                            <th width="15%">Customer</th>
                                            <th>Order</th>
                                            <th width="15%">Total</th>
                                            <th width="15%" class="text-center">Status Order</th>
                                            <th width="15%" class="text-center">#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($orders as $order)
                                            <tr>
                                                <td>{{ $order->invoice_no }}</td>
                                                <td>
                                                    {{ $order->customer->name }}
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($order->orderDetails as $detail)
                                                            <li>
                                                                {{ $detail->menu->name }} x {{ $detail->quantity }} ({{ $detail->subtotal }})
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>{{ $order->total }}</td>
                                                <td class="text-center">{!! $order->status_order !!}</td>
                                                <td class="text-center">
                                                    <a href="{{ url('print-invoice?order_id=' . $order->id . '') }}" target="_blank"
                                                        class="btn btn-sm btn-info">
                                                        <i class="fa fa-print"></i>
                                                    </a>
                                                    @if ($order->status == 'pending')
                                                        <a href="{{ url('merchant/order/complete', $order->id) }}" class="btn btn-info btn-sm" title="Set Complete">
                                                            <i class="fa fa-check"></i>
                                                        </a>
                                                    @endif
                                                    <form action="{{ route('order.destroy', $order->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">
                                                    No data
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="float-right">
                                    {{ $orders->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
@endpush
