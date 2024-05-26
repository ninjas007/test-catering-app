@extends('customer.layouts.app')

@section('title', 'Home')
@section('description', '')

@section('content')
    <div class="container">
        <div class="row justify-content-center mb-2">
            <div class="col-12 px-4">
                @foreach ($menus as $menu)
                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="{{ $menu->image }}" class="rounded-start" alt="{{ $menu->name }}"
                                    style="width: 100%; height: 100%">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $menu->name }}</h5>
                                    <p class="card-text">{{ $menu->description }}</p>
                                    <p class="card-text"><strong>Price: </strong>{{ $menu->price }}
                                        @if (auth()->check() && auth()->user()->role == 'customer')
                                            <a href="javascript:void(0)" data-id="{{ $menu->id }}"
                                                onclick="order({{ $menu->id }})" class="btn btn-primary btn-sm ms-2">
                                                <i class="fa fa-plus"></i> Add
                                            </a>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="d-flex justify-content-center mt-3">
                    {{ $menus->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        function order(menuId) {
            $.ajax({
                url: "{{ route('customer.cart') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    menu_id: menuId
                },
                success: function(result) {
                    if (result.status == 'success') {
                        swal({
                            title: "Berhasil!",
                            text: `${result.msg}`,
                            icon: "success",
                            button: "Ok",
                        });

                        // set total cart to localStorage
                        localStorage.setItem('cart', JSON.stringify(result.total_cart));
                        getCart();
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
