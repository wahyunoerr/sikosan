@extends('layouts.app')
@section('title', 'Data Booking')
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
                                <th>Info Kamar Dibooking</th>
                                <th>Harga Kamar Dibooking</th>
                                <th>Status Pembayaran</th>
                                <th>Keterangan</th>
                                <th>Status Booking</th>
                                <th>Status Pelunasan</th>
                                <th>Tanggal Booking</th>
                                <th>Tanggal Masuk</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($booking as $b)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $b->nama_customer }}</td>
                                    <td class="d-flex flex-column">
                                        <span>Nomor : {{ $b->nomor_kamar }}</span>
                                        <span>Berada : {{ $b->lantai }}</span>
                                    </td>
                                    <td>Rp. {{ number_format($b->harga_kamar_booking) }}</td>
                                    <td>
                                        @if ($b->is_paid)
                                            <span class="badge badge-light-success">Lunas</span>
                                        @else
                                            <span class="badge badge-light-warning">Belum Lunas</span>
                                        @endif
                                    </td>
                                    <td>{{ $b->keterangan ?? '-' }}</td>
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
                                        @if ($b->is_paid)
                                            <span class="badge badge-light-success">Lunas</span>
                                        @else
                                            <span class="badge badge-light-warning">Belum Lunas</span>
                                        @endif
                                    </td>
                                    <td>{{ $b->tanggal_booking ? date('d-m-Y', strtotime($b->tanggal_booking)) : '-' }}</td>
                                    <td>
                                        @if ($b->tanggal_checkin)
                                            {{ date('d-m-Y', strtotime($b->tanggal_checkin)) }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if (!$b->is_paid)
                                            <form action="{{ route('booking.confirmPayment', $b->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="booking_id" value="{{ $b->id }}">
                                                <button type="submit" class="btn btn-success btn-sm">Verifikasi</button>
                                            </form>
                                        @else
                                            <span class="text-muted">Sudah Diverifikasi</span>
                                        @endif
                                    </td>
                                    <td>
                                        <ul class="action gap-2">
                                            <li class="delete">
                                                <form action="{{ route('booking.delete', $b->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('booking.delete', $b->id) }}"
                                                        class="btn btn-danger btn-sm" data-confirm-delete="true"
                                                        title="Hapus Data">
                                                        <i class="icon-trash"></i> Hapus
                                                    </a>
                                                </form>
                                            </li>
                                        </ul>
                                        <div class="dropup-basic dropdown-basic">
                                            <div class="dropstart dropdown me-3">
                                                <button class="dropbtn btn-pill btn-info" type="button">Status<span><i
                                                            class="icofont icofont-arrow-left"></i>
                                                    </span>
                                                </button>
                                                <div class="dropstart-content dropdown-content">
                                                    <a href="#" class="dropdown-item"
                                                        onclick="event.preventDefault(); document.getElementById('approve-form-{{ $b->id }}').submit();">Disetujui</a>
                                                    <form id="approve-form-{{ $b->id }}"
                                                        action="{{ route('booking.status', ['id' => $b->id, 'status' => 'Disetujui']) }}"
                                                        method="POST" style="display: none;">
                                                        @csrf
                                                    </form>
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#rejectModal-{{ $b->id }}">Ditolak</a>
                                                    @if ($b->status == 'Disetujui' || $b->status == 'Ditolak')
                                                        <a href="#" class="dropdown-item"
                                                            onclick="event.preventDefault(); document.getElementById('pending-form-{{ $b->id }}').submit();">Menunggu</a>
                                                        <form id="pending-form-{{ $b->id }}"
                                                            action="{{ route('booking.status', ['id' => $b->id, 'status' => 'Menunggu']) }}"
                                                            method="POST" style="display: none;">
                                                            @csrf
                                                        </form>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
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
                                                        <img src="{{ Storage::disk('public')->url('upload/bukti/' . $b->bukti_dp) }}"
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

                                    <div class="modal fade" id="rejectModal-{{ $b->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="rejectModalLabel-{{ $b->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <form
                                                action="{{ route('booking.status', ['id' => $b->id, 'status' => 'Ditolak']) }}"
                                                method="POST">
                                                @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="rejectModalLabel-{{ $b->id }}">
                                                            Alasan Penolakan</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="reason">Masukkan alasan penolakan:</label>
                                                            <textarea name="reason" id="reason" class="form-control" rows="3" required></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-danger">Tolak</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
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
