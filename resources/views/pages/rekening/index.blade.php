@extends('layouts.app')
@section('title', 'Data Rekening')
@section('content')
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <form class="form theme-form" action="{{ route('rekening.save') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label>Nama Rekening</label>
                                    <input class="form-control @error('namaRekening') is-invalid @enderror" type="text"
                                        placeholder="Nama Rekening" name="namaRekening" value="{{ old('namaRekening') }}">

                                    @error('namaRekening')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label>Nomor Rekening</label>
                                    <input class="form-control @error('nomorRekening') is-invalid @enderror" type="number"
                                        placeholder="Nomor Rekening" name="nomorRekening"
                                        value="{{ old('nomorRekening') }}">

                                    @error('nomorRekening')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="text-end">
                                    <button class="btn btn-success me-3" type="submit">Tambah</button>
                                    <a class="btn btn-danger" href="{{ url('/rekening') }}">Batal</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6 project-list">
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
                                    <th>Nama Rekening</th>
                                    <th>Nomor Rekening</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $d)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $d->namaRekening }}</td>
                                        <td>{{ $d->nomorRekening }}</td>
                                        <td>
                                            <ul class="action">
                                                <li class="edit"> <a href="{{ route('rekening.edit', $d->id) }}"><i
                                                            class="icon-pencil-alt"></i></a></li>
                                                <li class="delete"><a href="{{ route('rekening.delete', $d->id) }}"
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
    </div>
@endsection
@push('datatable-script')
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>
@endpush
