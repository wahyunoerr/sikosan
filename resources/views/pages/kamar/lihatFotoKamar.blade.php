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
                        <figure class="col-xl-3 col-md-4 col-sm-6 box-col-33" itemprop="associatedMedia" itemscope=""><a
                                href="{{ Storage::disk('public')->url('upload/image/' . $img->nameImage) }}"
                                itemprop="contentUrl" data-size="1600x950"><img class="img-thumbnail"
                                    src="{{ Storage::disk('public')->url('upload/image/' . $img->nameImage) }}"
                                    itemprop="thumbnail" alt="Image description"></a>
                            <figcaption itemprop="caption description">{{ $img->nameImage }}</figcaption>
                        </figure>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
