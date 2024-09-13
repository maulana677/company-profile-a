@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Create FAQ Question</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.faq-question.index') }}">FAQ Questions</a></div>
                <div class="breadcrumb-item">Create FAQ Question</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Create FAQ Question</h2>
            <p class="section-lead">
                On this page, you can create a new FAQ question.
            </p>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create FAQ Question</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.faq-question.store') }}" method="POST">
                                @csrf

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Question</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="question" class="form-control"
                                            value="{{ old('question') }}">
                                        @error('question')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Answer</label>
                                    <div class="col-sm-12 col-md-7">
                                        <textarea name="answer" class="form-control" style="height: 100px">{{ old('answer') }}</textarea>
                                        @error('answer')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <div class="col-sm-12 col-md-7 offset-md-3">
                                        <button type="submit" class="btn btn-primary">Create</button>
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
