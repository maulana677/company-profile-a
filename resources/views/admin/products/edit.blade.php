@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Product</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Products</a></div>
                <div class="breadcrumb-item">Edit Product</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Edit Product</h2>
            <p class="section-lead">
                On this page, you can edit an existing product.
            </p>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Product</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.products.update', $product->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="name" class="form-control"
                                            value="{{ old('name', $product->name) }}">
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tagline</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="tagline" class="form-control"
                                            value="{{ old('tagline', $product->tagline) }}">
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">About</label>
                                    <div class="col-sm-12 col-md-7">
                                        <textarea name="about" class="form-control">{{ old('about', $product->about) }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Thumbnail</label>
                                    <div class="col-sm-12 col-md-7">
                                        <div id="image-preview" class="image-preview">
                                            <label for="image-upload" id="image-label">Choose File</label>
                                            <input type="file" name="thumbnail" id="image-upload">
                                        </div>
                                        @if ($product->thumbnail)
                                            <div class="mt-3">
                                                <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="Thumbnail"
                                                    width="100">
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#image-preview').css({
                'background-image': 'url("")',
                'background-size': 'cover',
                'background-position': 'center center'
            });

            $('#image-upload').change(function() {
                let reader = new FileReader();
                reader.onload = function(e) {
                    $('#image-preview').css('background-image', 'url(' + e.target.result + ')');
                };
                reader.readAsDataURL(this.files[0]);
            });
        });
    </script>
@endpush
