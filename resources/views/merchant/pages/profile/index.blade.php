@extends('merchant.layouts.app')

@section('title', 'General Dashboard')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Profile / Merchant</h1>
            </div>
        </section>
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="bg-light">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link font-weight-bold active" data-toggle="tab" href="#tabs-1" role="tab">
                                        Profile Owner
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link font-weight-bold disabled-tab" data-toggle="tab" href="#tabs-2" role="tab">
                                        Merchant
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body pt-2 pb-2">

                            <div class="tab-content">
                                <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                    @include('merchant.pages.profile.profile-form')
                                </div>
                                <div class="tab-pane" id="tabs-2" role="tabpanel">
                                    @include('merchant.pages.merchant.merchant-form')
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
