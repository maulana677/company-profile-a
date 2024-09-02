@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Principle</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.principles.index') }}">Principles</a></div>
                <div class="breadcrumb-item">Edit</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Edit Principle</h2>
            <p class="section-lead">
                On this page, you can edit the existing principle and update the required fields.
            </p>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Principle</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.principles.update', $principle->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="name" class="form-control"
                                            value="{{ old('name', $principle->name) }}">
                                        @error('name')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Thumbnail</label>
                                    <div class="col-sm-12 col-md-7">
                                        <div id="image-preview-thumbnail" class="image-preview"
                                            style="background-image: url('{{ asset('storage/' . $principle->thumbnail) }}'); background-size: cover; background-position: center center;">
                                            <label for="image-upload-thumbnail" id="image-label-thumbnail">Choose
                                                File</label>
                                            <input type="file" name="thumbnail" id="image-upload-thumbnail" />
                                        </div>
                                        @error('thumbnail')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Icon</label>
                                    <div class="col-sm-12 col-md-7">
                                        <div id="image-preview-icon" class="image-preview"
                                            style="background-image: url('{{ asset('storage/' . $principle->icon) }}'); background-size: cover; background-position: center center;">
                                            <label for="image-upload-icon" id="image-label-icon">Choose File</label>
                                            <input type="file" name="icon" id="image-upload-icon" />
                                        </div>
                                        @error('icon')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Subtitle</label>
                                    <div class="col-sm-12 col-md-7">
                                        <textarea name="subtitle" class="form-control" rows="3">{{ old('subtitle', $principle->subtitle) }}</textarea>
                                        @error('subtitle')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
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
            $('#image-preview-thumbnail').css({
                'background-image': 'url("{{ asset('storage/' . $principle->thumbnail) }}")',
                'background-size': 'cover',
                'background-position': 'center center'
            });

            $('#image-preview-icon').css({
                'background-image': 'url("{{ asset('storage/' . $principle->icon) }}")',
                'background-size': 'cover',
                'background-position': 'center center'
            });
        });
    </script>
@endpush
