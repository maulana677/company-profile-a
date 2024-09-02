@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Teams</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Teams</a></div>
                <div class="breadcrumb-item">Team Members</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Team Members</h2>
            <p class="section-lead">
                Below is a list of team members in your organization.
            </p>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Team List</h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.teams.create') }}" class="btn btn-success">Add New Team Member <i
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
                                            <th>Occupation</th>
                                            <th>Avatar</th>
                                            <th>Location</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($teams as $team)
                                            <tr>
                                                <td class="text-left">{{ ++$loop->index }}</td>
                                                <td>{{ $team->name }}</td>
                                                <td>{{ $team->occupation }}</td>
                                                <td><img src="{{ asset('storage/' . $team->avatar) }}"
                                                        alt="{{ $team->name }}" width="50"></td>
                                                <td>{{ $team->location }}</td>
                                                <td>
                                                    <a href="{{ route('admin.teams.edit', $team->id) }}"
                                                        class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                                    <a href="{{ route('admin.teams.destroy', $team->id) }}"
                                                        class="btn btn-danger delete-item"><i
                                                            class="fas fa-trash-alt"></i></a>
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
