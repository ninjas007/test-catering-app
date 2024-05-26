@extends('merchant.layouts.app')

@section('title', 'Menu')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Add Menu</h1>
            </div>
        </section>
        <section class="section">
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            @include('merchant.pages.menu._form')
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
@endpush
