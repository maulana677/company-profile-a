@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Company Statistics</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Statistics</a></div>
                <div class="breadcrumb-item">Company Statistics</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Company Statistics</h2>
            <p class="section-lead">
                On this page, you can see all the company statistics data.
            </p>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Statistics</h4>
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
                                            <th class="text-left">No</th>
                                            <th>Name</th>
                                            <th>Goal</th>
                                            <th>Icon</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($statistics as $statistic)
                                            <tr>
                                                <td>{{ ++$loop->index }}</td>
                                                <td>{{ $statistic->name }}</td>
                                                <td>{{ $statistic->goal }}</td>
                                                <td><img src="{{ asset('icons/' . $statistic->icon) }}" alt="Icon"
                                                        width="50"></td>
                                                <td>
                                                    <a href="{{ route('admin.statistics.edit', $statistic->id) }}"
                                                        class="btn btn-primary"><i class="fas fa-edit"></i></a>

                                                    <form action="{{ route('admin.statistics.destroy', $statistic->id) }}"
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
            // Inisialisasi DataTables
            $('#table').DataTable({
                "pageLength": 5, // Jumlah baris per halaman
                "lengthMenu": [5, 10, 25, 50], // Opsi jumlah baris per halaman
                "searching": true, // Aktifkan pencarian
                "paging": true, // Aktifkan pagination
                "ordering": true, // Aktifkan pengurutan kolom
                "info": true, // Tampilkan informasi tentang tabel
                "language": {
                    "emptyTable": "Tidak ada data yang tersedia" // Ubah pesan ketika tabel kosong
                },
                "destroy": true,
            });
        });
    </script>
@endpush
