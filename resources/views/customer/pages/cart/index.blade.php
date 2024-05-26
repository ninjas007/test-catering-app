@extends('customer.layouts.app')

@section('title', 'Cart')
@section('description', '')

@section('content')
    <div class="container" @if ($carts->count() <= 1) style="height: 80vh" @endif>
        <div class="row justify-content-center mb-4">
            <div class="col-12 px-4">
                @if ($carts->count() > 0)
                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-12">
                                <div class="card-body">
                                    <form action="{{ route('cart.checkout') }}" method="POST">
                                        <div class="d-flex justify-content-between">
                                            @csrf
                                            <div class="form-group">
                                                <label for="delivery_date">Delivery Date</label>
                                                <input type="date" class="form-control" name="delivery_date"
                                                    value="{{ now()->format('Y-m-d') }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="delivery_time">Delivery Time</label>
                                                <input type="time" class="form-control" name="delivery_time"
                                                    value="{{ now()->format('H:i') }}">
                                                @error('delivery_time')
                                                    <div class="text-danger mt-1">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <button type="submit" class="btn btn-primary mt-3">Order
                                                {{ $cartTotal }}</button>
                                        </div>
                                    </form>
                                </div>
                                @error('delivery_date')
                                    <div class="text-danger mt-1 p-4 pt-0">
                                        {{ $message }}
                                    </div>
                                @enderror
                                @error('delivery_time')
                                    <div class="text-danger mt-1 p-4 pt-0">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                @endif
                @forelse ($carts as $cart)
                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="{{ $cart->menu->image }}" class="rounded-start" alt="{{ $cart->menu->name }}"
                                    style="width: 100%; height: 110px; object-fit: cover">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $cart->menu->name }}</h5>
                                    <p class="card-text">{{ $cart->menu->description }}</p>
                                    <p class="card-text">
                                        <strong>Qty: </strong>{{ $cart->qty }} <br>
                                        <strong>Price: </strong>{{ $cart->menu->price }} <br>
                                        <br>
                                        <a href="javascript:void(0)" data-id="{{ $cart->id }}"
                                            onclick="removeCart({{ $cart->id }})" class="btn btn-danger btn-sm ms-2">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        <a href="javascript:void(0)" data-id="{{ $cart->id }}"
                                            onclick="addQty({{ $cart->id }})" class="btn btn-primary btn-sm ms-2">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        {{ $carts->links() }}
                    </div>
                @empty
                    <div class="text-center d-flex justify-content-center align-items-center" style="margin-top: 20px">
                        <img src="{{ asset('img/empty-cart.png') }}" width="300" alt="">
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        function removeCart(cartId) {
            $.ajax({
                url: "{{ route('removeCart') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    cart_id: cartId
                },
                success: function(result) {
                    if (result.status == 'success') {
                        swal({
                                title: "Berhasil!",
                                text: `${result.msg}`,
                                icon: "success",
                                button: "Ok",
                            })
                            .then(() => {
                                location.reload();
                            });
                    }
                },
                error: function(xhr, status, error) {
                    swal({
                        title: "Error!",
                        text: `Something wrong, please try again`,
                        icon: "error",
                        button: "Ok",
                    });
                }
            })
        }

        function addQty(cartId) {
            $.ajax({
                url: "{{ route('addQtyCart') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    cart_id: cartId
                },
                success: function(result) {
                    if (result.status == 'success') {
                        swal({
                                title: "Berhasil!",
                                text: `${result.msg}`,
                                icon: "success",
                                button: "Ok",
                            })
                            .then(() => {
                                location.reload();
                            });
                    }
                },
                error: function(xhr, status, error) {
                    swal({
                        title: "Error!",
                        text: `Something wrong, please try again`,
                        icon: "error",
                        button: "Ok",
                    });
                }
            })
        }
    </script>
@endsection
