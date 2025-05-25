@extends('layouts.app')
@section('title', 'Invoice')
@section('content')
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="invoice">
                    <div>
                        <div class="row invo-header mb-3">
                            <div class="col-sm-6">
                                <div class="d-flex">
                                    <div class="flex-shrink-0"><img class="d-flex-object rounded-circle img-60"
                                            src="{{ asset('assets/images/favicon/favicon.png') }}" alt=""></div>
                                    <div class="flex-grow-1 m-l-20">
                                        <h4 class="d-flex-heading f-w-600">SiKosan</h4>
                                        <p class="mb-0">si-kosan@gmail.com<br><span class="digits">Pekanbaru, Riau</span>
                                        </p>
                                    </div>
                                </div>
                                <!-- End Info-->
                            </div>
                            <div class="col-sm-6">
                                <div class="text-md-end text-xs-center">
                                    <h3>Invoice</h3>
                                    <p class="mb-0">Issued: {{ now()->format('M') }}<span class="digits">
                                            {{ now()->format('d') }},
                                            {{ now()->format('Y') }}</span><br>Payment Due:
                                        {{ date('M', strtotime($invoice->created_at ?? '')) }} <span
                                            class="digits">{{ date('d', strtotime($invoice->created_at ?? '')) }},
                                            {{ date('Y', strtotime($invoice->created_at ?? '')) }}</span></p>
                                </div>
                                <!-- End Title-->
                            </div>
                        </div>
                    </div>
                    <!-- End InvoiceTop-->
                    <div class="row invo-profile">
                        <div class="col-xl-4">
                            <div class="invo-profile-left">
                                <div class="d-flex">
                                    <div class="flex-shrink-0"><img class="d-flex-object rounded-circle img-60"
                                            src="{{ asset('assets/images/user/1.jpg') }}" alt=""></div>
                                    <div class="flex-grow-1">
                                        <h4 class="d-flex-heading f-w-600">{{ $invoice->nama_pelanggan }}</h4>
                                        <p class="mb-0">{{ $invoice->email }} <span class="digits">&mdash;
                                                {{ $invoice->no_hp ?? '' }}</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Invoice Mid-->
                    <div>
                        <div class="table-responsive theme-scrollbar invoice-table" id="table">
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <td class="item">
                                            <h6 class="py-2 mb-0">Kamar Yang Dibooking</h6>
                                        </td>
                                        {{-- <td class="Hours">
                                            <h6 class="py-2 mb-0"></h6>
                                        </td> --}}
                                        <td class="Rate">
                                            <h6 class="py-2 mb-0">Status Transaksi</h6>
                                        </td>
                                        <td class="subtotal">
                                            <h6 class="py-2 mb-0">Total Bayar</h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>{{ $invoice->nomor }} &mdash; {{ $invoice->lantai }}</label>
                                            <p class="m-0">{{ $invoice->fasilitas }}</p>
                                        </td>
                                        <td>
                                            <p class="itemtext digits mb-0">{{ $invoice->status_booking }}</p>
                                        </td>
                                        <td>
                                            <p class="itemtext digits mb-0">Rp. {{ number_format($invoice->total_bayar) }}
                                            </p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- End Table-->
                        <div class="row mt-3">
                            <div class="col-md-8">
                                <div>
                                    <p class="legal mb-0"><strong>Thank you for your business!</strong>Payment
                                        is expected within 31 days; please process this invoice within that
                                        time. There will be a 5% interest charge per month on late invoices.</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <form class="text-center invo-pal mt-2">
                                    <input type="image"
                                        src="{{ Storage::disk('public')->url('upload/bukti/' . $invoice->bukti_dp) }} "
                                        name="submit" alt="bukti-bayar" width="100" height="150">
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- End InvoiceBot-->
                </div>
                <div class="col-sm-12 text-center mt-3">
                    <button class="btn btn btn-primary me-2" type="button" onclick="printInvoice()">Print</button>
                    <button class="btn btn-secondary" type="button"
                        onclick="window.location.href='{{ url('/transaksi') }}'">Cancel</button>
                </div>
                <!-- End Invoice-->
                <!-- End Invoice Holder-->
            </div>
        </div>
    </div>
@endsection
@push('datatable-script')
    <script>
        function printInvoice() {
            const cardContent = document.querySelector('.invoice').innerHTML;
            const printWindow = window.open();
            printWindow.document.write('<html><head><title>Invoice</title>');
            printWindow.document.write(
                '<link rel="stylesheet" type="text/css" href="/assets/css/vendors/font-awesome.css">' +
                '<link rel="stylesheet" type="text/css" href="/assets/css/vendors/icofont.css">' +
                '<link rel="stylesheet" type="text/css" href="/assets/css/vendors/themify.css">' +
                '<link rel="stylesheet" type="text/css" href="/assets/css/vendors/flag-icon.css">' +
                '<link rel="stylesheet" type="text/css" href="/assets/css/vendors/feather-icon.css">' +
                '<link rel="stylesheet" type="text/css" href="/assets/css/vendors/scrollbar.css">' +
                '<link rel="stylesheet" type="text/css" href="/assets/css/vendors/animate.css">' +
                '<link rel="stylesheet" type="text/css" href="/assets/css/vendors/chartist.css">' +
                '<link rel="stylesheet" type="text/css" href="/assets/css/vendors/prism.css">' +
                '<link rel="stylesheet" type="text/css" href="/assets/css/vendors/vector-map.css">' +
                '<link rel="stylesheet" type="text/css" href="/assets/css/vendors/datatables.css">' +
                '<link rel="stylesheet" type="text/css" href="/assets/css/vendors/bootstrap.css">' +
                '<link rel="stylesheet" type="text/css" href="/assets/css/style.css">' +
                '<link id="color" rel="stylesheet" href="/assets/css/color-1.css" media="screen">' +
                '<link rel="stylesheet" type="text/css" href="/assets/css/vendors/dropzone.css">' +
                '<link rel="stylesheet" type="text/css" href="/assets/css/responsive.css">'
            );
            printWindow.document.write('</head><body>');
            printWindow.document.write(cardContent);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        }
    </script>



    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>
    <script src="{{ asset('assets/js/print.js') }}"></script>
@endpush
