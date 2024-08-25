@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Testimonials</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Testimonials</a></div>
                <div class="breadcrumb-item">All Testimonials</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">All Testimonials</h2>
            <p class="section-lead">
                On this page, you can see all the testimonials data.
            </p>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Testimonials</h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.testimonials.create') }}" class="btn btn-success">Create New <i
                                        class="fas fa-plus"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table">
                                    <thead>
                                        <tr>
                                            <th class="text-left">No</th>
                                            <th>Client</th>
                                            <th>Thumbnail</th>
                                            <th>Message</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($testimonials as $testimonial)
                                            <tr>
                                                <td class="text-left">{{ ++$loop->index }}</td>
                                                <td>{{ $testimonial->projectClient->name }}</td>
                                                <td>
                                                    @if ($testimonial->thumbnail)
                                                        <img src="{{ asset('storage/' . $testimonial->thumbnail) }}"
                                                            alt="Thumbnail" width="50">
                                                    @else
                                                        No Thumbnail
                                                    @endif
                                                </td>
                                                <td>{{ $testimonial->message }}</td>
                                                <td>
                                                    <a href="{{ route('admin.testimonials.edit', $testimonial->id) }}"
                                                        class="btn btn-primary"><i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="{{ route('admin.testimonials.destroy', $testimonial->id) }}"
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
