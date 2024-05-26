@extends('customer.layouts.app')

@section('title', 'Home')
@section('description', '')

@section('content')
    <div class="container" @if ($menus->count() <= 3) style="height: 80vh" @endif>
        <div class="row justify-content-center mb-5">
            <div class="col-12 px-4">
                <form action="{{ url()->current() }}" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" name="search" class="form-control" placeholder="Search menu or cathering"
                            value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </form>
            </div>
            <div class="col-12 px-4">
                @forelse ($menus as $menu)
                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <div class="border p-2 text-center">
                                    {{ $menu->merchant->name }}
                                </div>
                                <div>
                                    <img src="{{ $menu->image }}" class="rounded-start" alt="{{ $menu->name }}"
                                        style="width: 100%; height: 100px; object-fit: cover">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $menu->name }}</h5>
                                    <p class="card-text">{{ $menu->description }}</p>
                                    <p class="card-text"><strong>Price: </strong>{{ $menu->price }}
                                        @if (auth()->check() && auth()->user()->role == 'customer')
                                            <a href="javascript:void(0)" data-id="{{ $menu->id }}"
                                                onclick="addCart({{ $menu->id }})" class="btn btn-primary btn-sm ms-2">
                                                <i class="fa fa-plus"></i> Add
                                            </a>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        {{ $menus->links() }}
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
        function addCart(menuId) {
            $.ajax({
                url: "{{ route('saveCart') }}",
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
