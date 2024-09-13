@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>FAQ Questions</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">FAQ Questions</a></div>
                <div class="breadcrumb-item">All FAQ Questions</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">All FAQ Questions</h2>
            <p class="section-lead">
                On this page, you can see all the FAQ question data.
            </p>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All FAQ Questions</h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.faq-question.create') }}" class="btn btn-success">Create New <i
                                        class="fas fa-plus"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table">
                                    <thead>
                                        <tr>
                                            <th class="text-left">No</th>
                                            <th>Question</th>
                                            <th>Answer</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($faqQuestion as $faqQuestions)
                                            <tr>
                                                <td class="text-left">{{ ++$loop->index }}</td>
                                                <td>{{ $faqQuestions->question }}</td>
                                                <td>{{ $faqQuestions->answer }}</td>
                                                <td>
                                                    <a href="{{ route('admin.faq-question.edit', $faqQuestions->id) }}"
                                                        class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                                    <a href="{{ route('admin.faq-question.destroy', $faqQuestions->id) }}"
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
