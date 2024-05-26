
<form action="{{ route('profile.update') }}" method="POST">
    @csrf
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control"
                        value="{{ $user->email }}" readonly>
                </div>

                <div class="form-group">
                    <label>Name</label>
                    <input type="text"
                        class="form-control @error('name')
                    is-invalid
                @enderror"
                        name="name" value="{{ $user->name }}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" class="form-control" name="phone"
                        value="{{ $user->phone }}">
                </div>


                <div class="form-group">
                    <label>Address</label>
                    <input type="text" class="form-control" name="address"
                        value="{{ $user->address }}">
                </div>
            </div>
            <div class="col-md-6">

                <div class="mb-3">Change Password</div>
                <div class="form-group">
                    <label>Old Password</label>
                    <div class="input-group">
                        <div class="input-group-prepend" onclick="showPassword('password')">
                            <div class="input-group-text">
                                <i class="fas fa-eye"></i>
                            </div>
                        </div>
                        <input type="password"
                            class="form-control @error('password') is-invalid @enderror"
                            name="password">
                    </div>
                    @error('password')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>New Password</label>
                    <div class="input-group">
                        <div class="input-group-prepend" onclick="showPassword('password2')">
                            <div class="input-group-text">
                                <i class="fas fa-eye"></i>
                            </div>
                        </div>
                        <input type="password"
                            class="form-control @error('password2') is-invalid @enderror"
                            name="password2">
                    </div>
                    @error('password2')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-right">
                <button class="btn btn-primary">
                   <i class="fa fa-save"></i> Submit
                </button>
            </div>
        </div>
    </div>
</form>
