@extends('layouts.app')
@section('title', 'Data Kamar')
@section('content')
    <div class="col-md-12 project-list">
        <div class="card">
            <div class="card-header pb-0">
                <h3>DataTable @yield('title')</h3>
                <a class="btn btn-outline-primary-2x float-right" href="{{ route('kamar.add') }}">
                    <i class="fa fa-plus"></i> Tambah</a>
            </div>
            <div class="card-body">
                <div class="table-responsive theme-scrollbar">
                    <table class="display" id="basic-1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor Kamar</th>
                                <th>Harga</th>
                                <th>Lantai</th>
                                <th>Status</th>
                                <th>Foto Kamar</th>
                                <th>Fasilitas</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $d)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $d->nomor }}</td>
                                    <td>{{ $d->harga }}</td>
                                    <td>{{ $d->lantai }}</td>
                                    <td>
                                        @if ($d->status == 'tersedia')
                                            <span class="badge rounded-pill badge-light-success">Tersedia</span>
                                        @elseif ($d->status == 'tidak tersedia')
                                            <span class="badge rounded-pill badge-light-secondary">Tidak Tersedia</span>
                                        @else
                                            <span class="badge rounded-pill badge-light-warning">Tidak terdefenisi</span>
                                        @endif
                                    </td>
                                    <td>
                                        <li class="show"><a href="#"><i class="icon-file"></i></a></li>
                                    </td>
                                    <td>{{ $d->fasilitas }}</td>
                                    <td>
                                        <ul class="action">
                                            <li class="edit"> <a href="#"><i class="icon-pencil-alt"></i></a></li>
                                            <li class="delete"><a href="#"><i class="icon-trash"></i></a></li>
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('modal-script')
    <script src="{{ asset('assets/js/modal-animated.js') }}"></script>
@endpush
@push('datatable-script')
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>
@endpush
