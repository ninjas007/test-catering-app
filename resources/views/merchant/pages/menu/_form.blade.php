<form action="{{ isset($menu) ? route('menu.update', $menu->id) : route('menu.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($menu))
        @method('PUT')
    @endif
    <input type="hidden" name="merchant_id" value="{{ auth()->user()->merchant->id }}">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', isset($menu) ? $menu->name : '') }}">
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" class="form-control @error('description') is-invalid @enderror" style="height: 80px">{{ old('description', isset($menu) ? $menu->description : '') }}</textarea>
        @error('description')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="price">Price</label>
        <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', isset($menu) ? $menu->price : '') }}">
        @error('price')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="image">Image</label>
        @if(isset($menu) && $menu->image)
            <div>
                <img src="{{ asset($menu->image) }}" width="100" alt="Menu Image">
            </div>
        @endif
        <input type="file" name="menu_image" class="form-control @error('image') is-invalid @enderror">
        @error('image')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary float-right">
       <i class="fa fa-save"></i> Submit
    </button>
</form>
