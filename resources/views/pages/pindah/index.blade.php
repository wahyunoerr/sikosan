@extends('layouts.app')
@section('title', 'Data Checkout/Pindah')
@section('content')
    <div class="col-md-12 project-list">
        <div class="card">
            <div class="card-header pb-0">
                <h3>DataTable @yield('title')</h3>
                <a class="btn btn-outline-primary-2x float-right" href="{{ route('pindah.create') }}">
                    <i class="fa fa-plus"></i> Checkout/Pindah</a>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <div class="table-responsive theme-scrollbar">
                    <table class="display" id="basic-1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Booking ID</th>
                                <th>Kamar Lama</th>
                                <th>Tanggal Pindah</th>
                                <th>Alasan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pindah as $d)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $d->booking_id }}</td>
                                    <td>{{ $d->nomor_lama }}</td>
                                    <td>{{ $d->tanggal_pindah }}</td>
                                    <td>{{ $d->alasan }}</td>
                                    <td>
                                        <ul class="action">
                                            <li class="delete">
                                                <form action="{{ route('pindah.delete', $d->id) }}" method="POST"
                                                    onsubmit="return confirm('Yakin hapus data?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('pindah.delete', $d->id) }}"
                                                        class="btn btn-danger btn-sm" data-confirm-delete="true">Hapus</a>
                                                </form>
                                            </li>
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
