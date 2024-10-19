@extends('layouts.app')
@section('title', 'Edit Data Kamar')
@section('content')
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <form class="form theme-form" action="{{ route('kamar.update', $kamarId->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label>Nomor Kamar</label>
                                <input class="form-control @error('nomorkamar') is-invalid @enderror" type="number"
                                    placeholder="Nomor Kamar" name="nomorKamar" value="{{ $kamarId->nomor }}">

                                @error('nomorKamar')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label>Harga Kamar</label>
                                <input class="form-control @error('hargaKamar') is-invalid @enderror" type="number"
                                    placeholder="Harga Kamar" name="hargaKamar" value="{{ $kamarId->harga }}">

                                @error('hargaKamar')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label>Berada di Lantai</label>
                                <select name="lantaiKamar" class="form-select @error('lantaiKamar') is-invalid @enderror">
                                    <option selected disabled>--Pilih--</option>
                                    <option value="Lantai 1" {{ $kamarId->lantai == 'Lantai 1' ? 'selected' : '' }}>Lantai
                                        1</option>
                                    <option value="Lantai 2" {{ $kamarId->lantai == 'Lantai 2' ? 'selected' : '' }}>Lantai
                                        2</option>
                                    <option value="Lantai 3" {{ $kamarId->lantai == 'Lantai 3' ? 'selected' : '' }}>Lantai
                                        3</option>
                                </select>

                                @error('lantaiKamar')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label>Status Kamar</label>
                                <select name="status" class="form-select @error('status') is-invalid @enderror">
                                    <option selected disabled>---Plih---</option>
                                    <option value="Belum Dihuni" {{ $kamarId->status == 'Belum Dihuni' ? 'selected' : '' }}>
                                        Belum
                                        Dihuni</option>
                                    <option value="Sudah Dihuni"
                                        {{ $kamarId->status == 'Sudah Dihuni' ? 'selected' : '' }}>
                                        Sudah
                                        Dihuni</option>
                                </select>

                                @error('status')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label>Fasilitas Kamar</label>
                                <textarea class="form-control @error('fasilitas') is-invalid @enderror" id="exampleFormControlTextarea4" rows="3"
                                    name="fasilitas">{{ $kamarId->fasilitas }}</textarea>

                                @error('fasilitas')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label>Foto Kamar</label>
                                <input type="file" class="form-control @error('fotoKamar[]') is-invalid @enderror"
                                    name="fotoKamar[]" multiple>

                                @error('fotoKamar[]')
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
                                <a class="btn btn-danger" href="{{ url('/kamar') }}">Batal</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
