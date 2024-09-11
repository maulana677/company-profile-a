@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Footer Info</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.footer-info.index') }}">Posts</a></div>
                <div class="breadcrumb-item">Create Footer Info</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create Footer Info</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.footer-info.update', 1) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Avatar</label>
                                    <div>
                                        <div id="image-preview" class="image-preview"
                                            style="background-image: url('{{ Storage::url($footerInfo->logo) }}')">
                                            <label for="image-upload" id="image-label">Choose File</label>
                                            <input type="file" name="avatar" id="image-upload" />
                                        </div>
                                        @error('avatar')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Description</label>
                                    <textarea name="description" class="form-control" id="" cols="30" rows="10">{{ $footerInfo->description }}</textarea>

                                </div>
                                <div class="form-group">
                                    <label for="">Copyright text</label>
                                    <input type="text" name="copyright" class="form-control"
                                        value="{{ $footerInfo->copyright }}">
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button>
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
                'background-image': 'url("{{ Storage::url($footerInfo->logo) }}")',
                'background-size': 'cover',
                'background-position': 'center center'
            });
        });
    </script>
@endpush
