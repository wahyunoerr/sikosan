@extends('layouts.app')
@section('title', 'Tambah Data Kamar')
@section('content')
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <form class="form theme-form" action="{{ route('kamar.save') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label>Nomor Kamar</label>
                                <input class="form-control" type="number" placeholder="Nomor Kamar" name="nomorKamar">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label>Harga Kamar</label>
                                <input class="form-control" type="number" placeholder="Harga Kamar" name="hargaKamar">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label>Berada di Lantai</label>
                                <select name="lantaiKamar" class="form-select">
                                    <option value="">--Pilih--</option>
                                    <option value="Lantai 1">Lantai 1</option>
                                    <option value="Lantai 2">Lantai 2</option>
                                    <option value="Lantai 3">Lantai 3</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label>Status Kamar</label>
                                <select name="status" class="form-select">
                                    <option value="Belum Dihuni" selected>Belum Dihuni</option>
                                    <option value="Sudah Dihuni">Sudah Dihuni</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label>Fasilitas Kamar</label>
                                <textarea class="form-control" id="exampleFormControlTextarea4" rows="3" name="fasilitas"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label>Foto Kamar</label>
                                <input type="file" class="form-control" name="fotoKamar[]" multiple>
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
