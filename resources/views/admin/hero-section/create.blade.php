@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Create Hero Section</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.hero-sections.index') }}">Hero Sections</a></div>
                <div class="breadcrumb-item">Create</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Create Hero Section</h2>
            <p class="section-lead">
                On this page, you can create a new hero section and fill in all the required fields.
            </p>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create Hero Section</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.hero-sections.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Heading</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="heading" class="form-control"
                                            value="{{ old('heading') }}">
                                        @error('heading')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Banner</label>
                                    <div class="col-sm-12 col-md-7">
                                        <div id="banner-preview" class="image-preview">
                                            <label for="banner-upload" id="banner-label">Choose File</label>
                                            <input type="file" name="banner" id="banner-upload" />
                                        </div>
                                        @error('banner')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Subheading</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="subheading" class="form-control"
                                            value="{{ old('subheading') }}">
                                        @error('subheading')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Achievement</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="achievement" class="form-control"
                                            value="{{ old('achievement') }}">
                                        @error('achievement')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Path Video</label>
                                    <div class="col-sm-12 col-md-7">
                                        <div id="video-preview" class="image-preview">
                                            <label for="video-upload" id="video-label">Choose File</label>
                                            <input type="file" name="path_video" id="video-upload" />
                                        </div>
                                        @error('path_video')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button class="btn btn-primary">Create</button>
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
            $('#video-preview').css({
                'background-image': 'url("")',
                'background-size': 'cover',
                'background-position': 'center center'
            });

            $('#banner-preview').css({
                'background-image': 'url("")',
                'background-size': 'cover',
                'background-position': 'center center'
            });
        });
    </script>
@endpush
