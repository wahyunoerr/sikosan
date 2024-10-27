@extends('layouts.landing.app', ['title' => 'Booking List'])

@section('content')
    <div class="container-fluid fruite py-5">
        <div class="container py-5">
            <h1 class="mb-4">List Ruangan Kost</h1>
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="row g-4 my-3 align-items-center">
                        <div class="col-xl-6">
                            <form action="{{ route('landing.index') }}" method="GET">
                                <div class="input-group w-50 d-flex">
                                    <input type="search" name="search" class="form-control p-3" placeholder="keywords"
                                        aria-describedby="search-icon-1" />
                                    <span id="search-icon-1" class="input-group-text p-3"><i
                                            class="fa fa-search"></i></span>
                                </div>
                            </form>

                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('landing.index') }}" class="btn btn-danger btn-lg px-4 rounded">
                                <i class="fa fa-times me-2"></i> Reset Search
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
