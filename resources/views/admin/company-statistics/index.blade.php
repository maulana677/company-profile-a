@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Company Statistics</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Posts</a></div>
                <div class="breadcrumb-item">Company Statistics</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Company Statistics</h2>
            <p class="section-lead">
                On this page you can see all the data.
            </p>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Company Statistics</h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.statistics.create') }}" class="btn btn-success">Create New <i
                                        class="fas fa-plus"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table">
                                    <thead>
                                        <tr>
                                            <th class="text-left">
                                                No
                                            </th>
                                            <th>Judul Artikel</th>
                                            <th>Tanggal Post</th>
                                            <th>Dibuat Oleh</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($artikel as $artikels)
                                            <tr>
                                                <td>{{ ++$loop->index }}</td>
                                                <td>{{ $artikels->title }}</td>
                                                <td>
                                                    {{ Carbon\Carbon::parse($artikels->created_at)->translatedFormat('d F Y') }}
                                                </td>
                                                <td>{{ $artikels->user->name }}</td>
                                                <td>
                                                    <a href="{{ route('admin.artikel.edit', $artikels->id) }}"
                                                        class="btn btn-primary"><i class="fas fa-edit"></i></a>

                                                    <form action="{{ route('admin.artikel.destroy', $artikels->id) }}"
                                                        method="POST" class="d-inline delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger delete-button"><i
                                                                class="fas fa-trash-alt"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
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
            $('#table').DataTable();

            $('.delete-button').on('click', function() {
                var form = $(this).closest('form');
                if (confirm('Anda yakin ingin menghapus data ini?')) {
                    form.submit();
                }
            });
        });
    </script>
@endpush
