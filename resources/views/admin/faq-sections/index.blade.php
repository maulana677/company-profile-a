@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>FAQ Section</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">FAQ Section</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">FAQ Section</h2>
            <p class="section-lead">
                On this page you can update the FAQ section.
            </p>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Update FAQ Section</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.faq-section-setting.update', 1) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="title" value="{{ old('title', $faqSection->title) }}"
                                            class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Button Text</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="btn_text"
                                            value="{{ old('btn_text', $faqSection->btn_text) }}" class="form-control"
                                            required>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <div class="col-sm-12 col-md-7 offset-md-3">
                                        <button type="submit" class="btn btn-primary">Update</button>
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
