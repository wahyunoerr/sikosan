@extends('layouts.app')
@section('title', 'Data Transaksi')
@section('content')
    <div class="col-md-12 project-list">
        <div class="card">
            <div class="card-header pb-0">
                <h3>DataTable @yield('title')</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive theme-scrollbar">
                    <table class="display" id="basic-1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Harga Transaksi</th>
                                <th>Bukti Bayar</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaksi as $t)
                                @if (!isset($t->status) || $t->status !== 'Selesai')
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $t->nama_pelanggan }}</td>
                                        <td>Rp. {{ number_format($t->total_bayar) }}</td>
                                        <td>
                                            @if ($t->bukti_dp)
                                                <a href="#" data-bs-toggle="modal"
                                                    data-original-title="Lihat Bukti Booking"
                                                    data-bs-target="#viewBuktiModal-{{ $t->id }}">
                                                    <img src="{{ Storage::disk('public')->url($t->bukti_dp) }}"
                                                        class="img-fluid rounded shadow-lg" alt="img-bukti"
                                                        width="50"></img>
                                                </a>
                                            @else
                                                <span class="badge badge-light-warning">Belum Ada Bukti</span>
                                            @endif
                                        </td>
                                        <td>
                                            <ul class="action">
                                                <li class="edit">
                                                    <a href="{{ route('transakci.invoice', $t->id) }}"
                                                        title="Print Invoice">
                                                        <i class="fa fa-print"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </td>
                                        <div class="modal fade" id="viewBuktiModal-{{ $t->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="viewBuktiModal-{{ $t->id }}Label"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="viewBuktiModal-{{ $t->id }}Label">
                                                            Bukti Pembayaran Booking, {{ $t->nama_pelanggan }}</h5>
                                                        <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="img-fluid d-flex justify-content-center">
                                                            <img src="{{ Storage::disk('public')->url($t->bukti_dp) }}"
                                                                alt="modal-image-bukti" width="300" class="shadow">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-success px-3" type="button"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                @endif
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
