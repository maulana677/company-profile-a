@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Hero Sections</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Hero</a></div>
                <div class="breadcrumb-item">Hero Sections</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Hero Sections</h2>
            <p class="section-lead">
                On this page, you can see all the hero section data.
            </p>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Hero Sections</h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.hero-sections.create') }}" class="btn btn-success">Create New <i
                                        class="fas fa-plus"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table">
                                    <thead>
                                        <tr>
                                            <th class="text-left">No</th>
                                            <th>Heading</th>
                                            <th>Banner</th>
                                            <th>Subheading</th>
                                            <th>Achievement</th>
                                            <th>Video</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($heroSection as $heroSections)
                                            <tr>
                                                <td class="text-left">{{ ++$loop->index }}</td>
                                                <td>{{ $heroSections->achievement }}</td>
                                                <td>{{ $heroSections->subheading }}</td>
                                                <td>{{ $heroSections->heading }}</td>
                                                <td>
                                                    @if ($heroSections->path_video)
                                                        <a href="{{ asset('storage/' . $heroSections->path_video) }}"
                                                            target="_blank">View Video</a>
                                                    @else
                                                        No Video
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($heroSections->banner)
                                                        <img src="{{ asset('storage/' . $heroSections->banner) }}"
                                                            alt="Banner" width="50">
                                                    @else
                                                        No Banner
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.hero-sections.edit', $heroSections->id) }}"
                                                        class="btn btn-primary"><i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="{{ route('admin.hero-sections.destroy', $heroSections->id) }}"
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
