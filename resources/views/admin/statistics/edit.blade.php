@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Company Statistic</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.statistics.index') }}">Company Statistics</a></div>
                <div class="breadcrumb-item">Edit</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Edit Company Statistic</h2>
            <p class="section-lead">
                On this page, you can edit the existing company statistic and update the required fields.
            </p>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Company Statistic</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.statistics.update', $statistic->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="name" class="form-control"
                                            value="{{ old('name', $statistic->name) }}">
                                        @error('name')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Goal</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="goal" class="form-control"
                                            value="{{ old('goal', $statistic->goal) }}">
                                        @error('goal')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Icon</label>
                                    <div class="col-sm-12 col-md-7">
                                        <div id="image-preview" class="image-preview"
                                            style="background-image: url('{{ asset('storage/' . $statistic->icon) }}'); background-size: cover; background-position: center center;">
                                            <label for="image-upload" id="image-label">Choose File</label>
                                            <input type="file" name="icon" id="image-upload" />
                                        </div>
                                        @error('icon')
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
            $('#image-preview').css({
                'background-image': 'url("{{ asset('storage/' . $statistic->icon) }}")',
                'background-size': 'cover',
                'background-position': 'center center'
            });
        });
    </script>
@endpush
