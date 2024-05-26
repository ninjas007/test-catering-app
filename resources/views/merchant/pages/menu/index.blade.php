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
                        <div class="card-header">
                            <a href="{{ url('merchant/menu/create') }}" class="btn btn-primary">
                                <i class="fa fa-plus"></i> Add Menu
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th colspan="2" class="text-center">Menu</th>
                                            <th>Description</th>
                                            <th>Price</th>
                                            <th width="12%" class="text-center">#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($menus as $menu)
                                            <tr>
                                                <td width="10%">
                                                    <img src="{{ asset($menu->image) }}" style="width: 80px; height: 70px; object-fit: cover">
                                                </td>
                                                <td>
                                                    {{ $menu->name }}
                                                </td>
                                                <td>{{ $menu->description }}</td>
                                                <td>{{ $menu->price }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('menu.edit', $menu->id) }}" class="btn btn-primary btn-sm"
                                                        title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('menu.destroy', $menu->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this item?');">
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
                                                <td colspan="5" class="text-center">
                                                    No data
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
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
