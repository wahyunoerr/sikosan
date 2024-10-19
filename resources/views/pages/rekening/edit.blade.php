@extends('layouts.app')
@section('title', 'Edit Rekening')
@section('content')
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <form class="form theme-form" action="{{ route('rekening.update', $rekeningId->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label>Nama Rekening</label>
                                <input class="form-control @error('namaRekening') is-invalid @enderror" type="text"
                                    placeholder="Nama Rekening" name="namaRekening" value="{{ $rekeningId->namaRekening }}">

                                @error('namaRekening')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label>Nomor Rekening</label>
                                <input class="form-control @error('nomorRekening') is-invalid @enderror" type="number"
                                    placeholder="Nomor Rekening" name="nomorRekening"
                                    value="{{ $rekeningId->nomorRekening }}">

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
                                <button class="btn btn-success me-3" type="submit">Ubah</button>
                                <a class="btn btn-danger" href="{{ url('/rekening') }}">Batal</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
