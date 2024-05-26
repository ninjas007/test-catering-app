@extends('auth.layouts.index')

@section('title', 'Register')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="card card-primary">
        <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input id="name" type="text"
                        class="form-control @error('name')
                        is-invalid
                    @enderror"
                        name="name" autofocus required value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email"
                        class="form-control @error('email')
                        is-invalid
                    @enderror"
                        name="email" required value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required>
                        <div class="input-group-prepend" onclick="showPassword('password')">
                            <div class="input-group-text">
                                <i class="fas fa-eye"></i>
                            </div>
                        </div>
                    </div>
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password2">Password Confirmation</label>
                    <div class="input-group">
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                            name="password_confirmation" required>
                        <div class="input-group-prepend" onclick="showPassword('password_confirmation')">
                            <div class="input-group-text">
                                <i class="fas fa-eye"></i>
                            </div>
                        </div>
                    </div>
                    @error('password_confirmation')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="role">Register As</label>
                    <div class="d-flex justify-content-start">
                        <div class="form-check mr-5">
                            <input class="form-check-input" type="radio" name="role" id="merchant" value="merchant" required onclick="merchantForm('block')">
                            <label class="form-check-label" for="merchant">
                                Merchant
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="role" id="customer" value="customer" required onclick="merchantForm('none')">
                            <label class="form-check-label" for="customer">
                                Customer
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group" id="merchantForm" style="display: none">
                    <label for="merchantName">Merchant Name</label>
                    <input type="text" class="form-control  @error('merchant_name') is-invalid @enderror" name="merchant_name" id="merchantName" value="{{ old('merchant_name') }}">
                </div>

                @error('merchant_name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="text-muted mt-5 text-center">
        Have account? <a href="{{ route('login') }}">Login</a>
    </div>
@endsection

@push('scripts')
<script>
    function merchantForm(display) {
        document.getElementById('merchantForm').style.display = display;

        if (display == 'none') {
            document.getElementById('merchantName').value = '';
        }
    }
</script>
@endpush
