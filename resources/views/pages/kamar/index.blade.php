@extends('layouts.app')
@section('title', 'Data Kamar')
@section('content')
    <div class="col-md-12 project-list">
        <div class="card">
            <div class="row">
                <div class="col-md-6 p-0 d-flex">

                </div>
                <div class="col-md-6 p-0">
                    <div class="form-group mb-0 me-0"></div><a class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#myModal"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-plus-square">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="12" y1="8" x2="12" y2="16"></line>
                            <line x1="8" y1="12" x2="16" y2="12"></line>
                        </svg>Create New Project</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive theme-scrollbar">
                    <table class="display" id="basic-1">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Office</th>
                                <th>Age</th>
                                <th>Status</th>
                                <th>Salary</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Tiger Nixon</td>
                                <td>System Architect</td>
                                <td>Edinburgh</td>
                                <td>61</td>
                                <td><span class="badge rounded-pill badge-light-success">Software Engineer</span>
                                    <span class="badge rounded-pill badge-light-secondary">Software Engineer</span>
                                </td>
                                <td>$320,800</td>
                                <td>
                                    <ul class="action">
                                        <li class="edit"> <a href="#"><i class="icon-pencil-alt"></i></a></li>
                                        <li class="delete"><a href="#"><i class="icon-trash"></i></a></li>
                                    </ul>
                                </td>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('pages.kamar.modalCreate')
@endsection
@push('modal-script')
    <script src="{{ asset('assets/js/modal-animated.js') }}"></script>
@endpush
@push('datatable-script')
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>
@endpush
