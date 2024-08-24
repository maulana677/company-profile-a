@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>
        <div class="row">
            <div class="col-12 mb-4">
                <div class="hero bg-primary text-white">
                    <div class="hero-inner">
                        <h2>Selamat Datang, Ujang!</h2>
                        <p class="lead">Anda hampir sampai, buat Product langsung disini</p>
                        <div class="mt-4">
                            <a href="{{ route('admin.products.create') }}"
                                class="btn btn-outline-white btn-lg btn-icon icon-left"><i class="fas fa-file-alt"></i>
                                Buat Product</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Product</h4>
                        </div>
                        <div class="card-body">
                            {{ number_format($countProduct) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
