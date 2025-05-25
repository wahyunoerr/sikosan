@extends('layouts.app')
@section('title', 'Checkout/Pindah Kamar')
@section('content')
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header pb-0">
                <h3>Form Checkout/Pindah</h3>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('pindah.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="booking_id" class="form-label">Booking</label>
                        <select name="booking_id" id="booking_id" class="form-control" required>
                            <option value="">-- Pilih Booking --</option>
                            @php
                                $usedCustomerIds = [];
                            @endphp
                            @foreach ($booking as $b)
                                @if ($b->status === 'Disetujui' && !in_array($b->customer_id, $usedCustomerIds))
                                    <option value="{{ $b->id }}">Customer: {{ $b->customer_name }} | Kamar:
                                        {{ $b->kamar_id }}</option>
                                    @php $usedCustomerIds[] = $b->customer_id; @endphp
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="kamar_lama_id" class="form-label">Kamar Lama</label>
                        <input type="text" name="kamar_lama_nomor" id="kamar_lama_nomor" class="form-control"
                            value="" readonly>
                        <input type="hidden" name="kamar_lama_id" id="kamar_lama_id" value="">
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_pindah" class="form-label">Tanggal Pindah</label>
                        <input type="date" name="tanggal_pindah" id="tanggal_pindah" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="alasan" class="form-label">Alasan</label>
                        <textarea name="alasan" id="alasan" class="form-control" rows="2"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenis Pindah</label>
                        <input type="text" class="form-control" value="Keluar Kos" readonly disabled>
                        <input type="hidden" name="jenis_pindah" value="keluar">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('pindah.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('booking_id').addEventListener('change', function() {
            var selectedId = this.value;
            var kamarNomor = '';
            var kamarId = '';
            @foreach ($booking as $b)
                if ('{{ $b->id }}' == selectedId) {
                    kamarNomor = @json($kamar->firstWhere('id', $b->kamar_id)->nomor ?? '');
                    kamarId = {{ $b->kamar_id }};
                }
            @endforeach
            document.getElementById('kamar_lama_nomor').value = kamarNomor;
            document.getElementById('kamar_lama_id').value = kamarId;
        });
        if (document.getElementById('booking_id').value) {
            document.getElementById('booking_id').dispatchEvent(new Event('change'));
        }
    </script>
@endsection
