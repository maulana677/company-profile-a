@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Hero Section</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.hero-sections.index') }}">Hero Sections</a></div>
                <div class="breadcrumb-item">Edit</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Edit Hero Section</h2>
            <p class="section-lead">
                On this page, you can edit the selected hero section and update its fields.
            </p>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Hero Section</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.hero-sections.update', $heroSections->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Heading</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="heading" class="form-control"
                                            value="{{ old('heading', $heroSections->heading) }}">
                                        @error('heading')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Banner</label>
                                    <div class="col-sm-12 col-md-7">
                                        <div id="image-preview" class="image-preview"
                                            style="background-image: url('{{ Storage::url($heroSections->banner) }}'); background-size: cover; background-position: center center;">
                                            <label for="image-upload" id="image-label">Choose File</label>
                                            <input type="file" name="banner" id="image-upload" />
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
                                            value="{{ old('subheading', $heroSections->subheading) }}">
                                        @error('subheading')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Achievement</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="achievement" class="form-control"
                                            value="{{ old('achievement', $heroSections->achievement) }}">
                                        @error('achievement')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Path Video</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="path_video" class="form-control"
                                            value="{{ old('path_video', $heroSections->path_video) }}">
                                        @error('path_video')
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
            // Menampilkan preview gambar jika ada
            $('#image-preview').css({
                'background-image': 'url("{{ Storage::url($heroSections->banner) }}")',
                'background-size': 'cover',
                'background-position': 'center center',
                'background-repeat': 'no-repeat'
            });
        });
    </script>
@endpush
