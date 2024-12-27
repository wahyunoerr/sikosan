@extends('layouts.app')
@section('title', 'Foto Kamar')
@section('content')
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header pb-0">
                <h4>Galeri @yield('title')</h4>
            </div>
            <div class="card-body">
                <div class="gallery my-gallery row" itemscope="" data-pswp-uid="1">
                    @foreach ($imageId as $img)
                        <figure class="col-xl-3 col-md-4 col-sm-6 box-col-33" itemprop="associatedMedia" itemscope="">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal"
                                data-img-url="{{ Storage::disk('public')->url('upload/image/' . $img->nameImage) }}">
                                <img class="img-thumbnail"
                                    src="{{ Storage::disk('public')->url('upload/image/' . $img->nameImage) }}"
                                    itemprop="thumbnail" alt="Image description">
                            </a>
                            <figcaption itemprop="caption description">{{ $img->nameImage }}</figcaption>
                        </figure>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body position-relative">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <img id="modalImage" src="" class="img-fluid" alt="Preview">
                    <button type="button" class="btn btn-primary position-absolute bg-white" id="prevImage"
                        style="top: 50%; left: -100px; transform: translateY(-50%);">&laquo;</button>
                    <button type="button" class="btn btn-primary position-absolute bg-white" id="nextImage"
                        style="top: 50%; right: -100px; transform: translateY(-50%);">&raquo;</button>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var imageModal = document.getElementById('imageModal');
        var modalImage = imageModal.querySelector('#modalImage');
        var images = @json($imageId);
        var currentIndex = 0;

        function updateModalImage(index) {
            modalImage.src = "{{ Storage::disk('public')->url('upload/image/') }}" + images[index].nameImage;
        }

        imageModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var imgUrl = button.getAttribute('data-img-url');
            currentIndex = images.findIndex(img =>
                "{{ Storage::disk('public')->url('upload/image/') }}" + img.nameImage === imgUrl);
            updateModalImage(currentIndex);
        });

        document.getElementById('prevImage').addEventListener('click', function() {
            currentIndex = (currentIndex > 0) ? currentIndex - 1 : images.length - 1;
            updateModalImage(currentIndex);
        });

        document.getElementById('nextImage').addEventListener('click', function() {
            currentIndex = (currentIndex < images.length - 1) ? currentIndex + 1 : 0;
            updateModalImage(currentIndex);
        });
    });
</script>
