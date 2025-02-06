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
                                <th>Alamat</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $d)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $d->nomor }}</td>
                                    <td>Rp. {{ number_format($d->harga, 2, ',', '.') }}</td>
                                    <td>{{ $d->lantai }}</td>
                                    <td>
                                        @if ($d->status == 'Sudah Dihuni')
                                            <span class="badge rounded-pill badge-light-success">Sudah Dihuni</span>
                                        @elseif ($d->status == 'Belum Dihuni')
                                            <span class="badge rounded-pill badge-light-secondary">Belum Dihuni</span>
                                        @else
                                            <span class="badge rounded-pill badge-light-warning">Tidak terdefenisi</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('kamar.image', $d->id) }}"
                                            class="btn btn-pill btn-primary btn-air-primary">Lihat <i
                                                class="icofont icofont-file-image"></i></a>
                                    </td>
                                    <td>{{ $d->fasilitas }}</td>
                                    <td>{{ $d->alamat }}</td>
                                    <td>
                                        <ul class="action">
                                            <li class="edit"> <a href="{{ route('kamar.edit', $d->id) }}"><i
                                                        class="icon-pencil-alt"></i></a></li>
                                            <li class="delete"><a href="{{ route('kamar.delete', $d->id) }}"
                                                    data-confirm-delete="true"><i class="icon-trash"></i></a></li>
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
@push('datatable-script')
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>
@endpush
