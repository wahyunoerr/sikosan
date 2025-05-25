@extends('layouts.app')
@section('title', 'Riwayat Kamar')
@section('content')
    <div class="col-md-12 project-list">
        <div class="card">
            <div class="card-header pb-0">
                <h3>Riwayat Kamar</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive theme-scrollbar">
                    <table class="display" id="basic-1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Customer</th>
                                <th>Dari Kamar</th>
                                <th>Ke Kamar</th>
                                <th>Tanggal Pindah</th>
                                <th>Alasan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($riwayat as $r)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $r->nama_customer }}</td>
                                    <td>{{ $r->nomor_kamar_lama }}</td>
                                    <td>{{ $r->nomor_kamar_baru ?? '-' }}</td>
                                    <td>{{ $r->tanggal_pindah ? date('d-m-Y', strtotime($r->tanggal_pindah)) : '-' }}</td>
                                    <td>{{ $r->alasan ?? '-' }}</td>
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
