@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Hero Sections</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Hero Sections</a></div>
                <div class="breadcrumb-item">All Hero Sections</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">All Hero Sections</h2>
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
                                            <th>Banner</th>
                                            <th>Heading</th>
                                            <th>Subheading</th>
                                            <th>Achievement</th>
                                            <th>Path Video</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($heroSections as $heroSection)
                                            <tr>
                                                <td class="text-left">{{ ++$loop->index }}</td>
                                                <td>
                                                    @if ($heroSection->banner)
                                                        <img src="{{ asset('storage/' . $heroSection->banner) }}"
                                                            alt="Banner" width="50">
                                                    @else
                                                        No Banner
                                                    @endif
                                                </td>
                                                <td>{{ $heroSection->heading }}</td>
                                                <td>{{ $heroSection->subheading }}</td>
                                                <td>{{ $heroSection->achievement }}</td>
                                                <td>{{ $heroSection->path_video }}</td>
                                                <td>
                                                    <a href="{{ route('admin.hero-sections.edit', $heroSection->id) }}"
                                                        class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                                    <a href="{{ route('admin.hero-sections.destroy', $heroSection->id) }}"
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
            $('#table').DataTable({
                "pageLength": 5,
                "lengthMenu": [5, 10, 25, 50],
                "searching": true,
                "paging": true,
                "ordering": true,
                "info": true,
                "language": {
                    "emptyTable": "Tidak ada data yang tersedia"
                },
                "destroy": true,
            });
        });
    </script>
@endpush
