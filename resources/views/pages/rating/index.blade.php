@extends('layouts.app')
@section('title', 'Data Rating')
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
                                <th>Nomor Kamar</th>
                                <th>Nama User</th>
                                <th>Rating</th>
                                <th>Review</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $d)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $d->nomor_kamar }}</td>
                                    <td>{{ $d->user_name }}</td>
                                    <td>
                                        @for ($i = 0; $i < $d->rating; $i++)
                                            <span class="fa fa-star"></span>
                                        @endfor
                                    </td>
                                    <td>{{ $d->review }}</td>
                                    <td>
                                        @if ($d->status == 'active')
                                            <span class="badge rounded-pill badge-light-success">Active</span>
                                        @else
                                            <span class="badge rounded-pill badge-light-secondary">Deactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('rating.delete', $d->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                data-confirm-delete="true">Delete</button>
                                        </form>
                                        <a href="{{ route('rating.toggleStatus', $d->id) }}" class="btn btn-sm btn-primary"
                                            onclick="event.preventDefault(); toggleStatus('{{ route('rating.toggleStatus', $d->id) }}');">
                                            Toggle Status
                                        </a>
                                    </td>
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
@push('styles')
    <style>
        .checked {
            color: orange;
        }
    </style>
@endpush
@push('scripts')
    <script>
        function toggleStatus(url) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to change the status!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, change it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            })
        }
    </script>
@endpush
