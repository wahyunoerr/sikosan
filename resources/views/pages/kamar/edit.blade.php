@extends('layouts.app')
@section('title', 'Edit Data Kamar')
@section('content')
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <form class="form theme-form" action="{{ route('kamar.update', $kamarId->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
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
                        <div class="col-12">
                            <div class="mb-3">
                                <label>Alamat Kamar</label>
                                <textarea class="form-control @error('alamat') is-invalid @enderror" placeholder="Alamat Kamar" name="alamat">{{ $kamarId->alamat }}</textarea>
                                @error('alamat')
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
                                    <option value="Belum Dihuni"
                                        {{ $kamarId->status == 'Belum Dihuni' ? 'selected' : '' }}>
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
                                <label>Foto Saat Ini:</label>
                                <div class="row">
                                    @foreach ($fotoKamar as $foto)
                                        <div class="col-md-3">
                                            <img src="{{ asset('storage/upload/image/' . $foto->nameImage) }}"
                                                alt="Foto Kamar" class="img-fluid img-thumbnail"
                                                style="width: 100%; height: 200px; object-fit: cover;">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label>Foto Baru</label>
                                <div id="drop-area" class="border border-primary p-3 text-center"
                                    onclick="document.getElementById('fileElem').click()">
                                    <p>Drag & Drop your images here or click to select files</p>
                                    <input type="file" id="fileElem"
                                        class="form-control @error('fotoKamar.*') is-invalid @enderror" name="fotoKamar[]"
                                        multiple onchange="previewImages(event)" style="display: none;">
                                </div>
                                @error('fotoKamar.*')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div id="imagePreview" class="d-flex flex-wrap"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="text-end">
                                <button class="btn btn-success me-3" type="submit">Ubah</button>
                                <a class="btn btn-danger" href="{{ url('/kamar') }}">Batal</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const dropArea = document.getElementById('drop-area');
        const fileInput = document.getElementById('fileElem');

        dropArea.addEventListener('dragover', (event) => {
            event.preventDefault();
            dropArea.classList.add('bg-light');
        });

        dropArea.addEventListener('dragleave', () => {
            dropArea.classList.remove('bg-light');
        });

        dropArea.addEventListener('drop', (event) => {
            event.preventDefault();
            dropArea.classList.remove('bg-light');
            const files = event.dataTransfer.files;
            fileInput.files = files;
            previewImages({
                target: {
                    files
                }
            });
        });

        dropArea.addEventListener('click', () => {
            fileInput.click();
        });

        function previewImages(event) {
            const files = event.target.files;
            const previewContainer = document.getElementById('imagePreview');
            previewContainer.innerHTML = '';

            Array.from(files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('img-thumbnail', 'm-2');
                    img.style.width = '150px';
                    img.style.height = '150px';
                    previewContainer.appendChild(img);
                }
                reader.readAsDataURL(file);
            });
        }
    </script>

@endsection
