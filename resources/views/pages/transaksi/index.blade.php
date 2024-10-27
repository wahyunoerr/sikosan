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
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($transaksi as $t)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $b->nama_customer }}</td>
                                    <td class="d-flex flex-column">
                                        <span>Nomor : {{ $b->nomor_kamar }}</span>
                                        <span>Berada : {{ $b->lantai }}</span>
                                    </td>
                                    <td>Rp. {{ number_format($b->harga_kamar_booking) }}</td>
                                    <td>
                                        @if ($b->bukti_bayar)
                                            <a href="#" data-bs-toggle="modal" data-original-title="Lihat Bukti Booking"
                                                data-bs-target="#viewBuktiModal-{{ $b->id }}">
                                                <img src="{{ Storage::disk('public')->url('upload/bukti/' . $b->bukti_bayar) }}"
                                                    class="img-fluid rounded shadow-lg" alt="img-bukti"
                                                    width="50"></img>
                                            </a>
                                        @else
                                            <span class="badge badge-light-warning">Belum Ada Bukti</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($b->status == 'Menunggu')
                                            <span
                                                class="badge px-3 py-2 rounded-pill badge-light-info">{{ $b->status }}...</span>
                                        @elseif ($b->status == 'Ditolak')
                                            <span
                                                class="badge px-3 py-2 rounded-pill badge-light-danger">{{ $b->status }}</span>
                                        @else
                                            <span
                                                class="badge px-3 py-2 rounded-pill badge-light-success">{{ $b->status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <ul class="action gap-2">
                                            <li class="edit"><a href="{{ route('kamar.edit', $b->id) }}"><i
                                                        class="icon-pencil-alt"></i></a></li>
                                            <li class="delete"><a href="{{ route('kamar.delete', $b->id) }}"
                                                    data-confirm-delete="true"><i class="icon-trash"></i></a></li>
                                            <li class="edit"><a href="{{ route('kamar.delete', $b->id) }}"
                                                    title="Setujui Status Booking"
                                                    onclick="event.prefentDefault(); document.getElementById('setujuiStatus-{{ $b->id }}').submit();"><i
                                                        class="icon-check"></i></a></li>

                                            <form action="#" method="POST" enctype="multipart/form-data"
                                                id="setujuiStatus-{{ $b->id }}">@csrf</form>
                                        </ul>
                                    </td>

                                    <div class="modal fade" id="viewBuktiModal-{{ $b->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="viewBuktiModal-{{ $b->id }}Label"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="viewBuktiModal-{{ $b->id }}Label">
                                                        Bukti Pembayaran Booking, {{ $b->nama_customer }}</h5>
                                                    <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="img-fluid d-flex justify-content-center">
                                                        <img src="{{ Storage::disk('public')->url('upload/bukti/' . $b->bukti_bayar) }}"
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
                            @endforeach --}}
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
