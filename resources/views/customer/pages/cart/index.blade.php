@extends('customer.layouts.app')

@section('title', 'Home')
@section('description', '')

@section('content')
    <div class="container">
        <div class="row justify-content-center mb-4">
            <div class="col-12 px-4">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-12">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h5 class="card-title">Total: {{ $cartTotal }}</h5>
                                    <form action="{{ route('cart.checkout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary btn-sm">Checkout</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @foreach ($carts as $cart)
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{ $cart->menu->image }}" class="rounded-start" alt="{{ $cart->menu->name }}"
                                style="width: 100%; height: 100%">
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
                @endforeach

                <div class="d-flex justify-content-center mt-3">
                    {{ $carts->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        function removeCart(cartId)
        {
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
