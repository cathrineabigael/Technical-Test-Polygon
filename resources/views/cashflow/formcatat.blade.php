@extends('layouts.cashflowmanager')
@section('title')
    Catat Transaksi Baru
@endsection
@section('plugincss')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/owlcarousel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/rating.css') }}">
@endsection
@section('breadcrumbs')
    {{-- <div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">
                <h3>Step Form Wizard</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Forms </li>
                    <li class="breadcrumb-item">Form Layout</li>
                    <li class="breadcrumb-item active">Form Wizard 2</li>
                </ol>
            </div>
            <div class="col-sm-6">
            </div>
        </div>
    </div>
</div> --}}
@endsection
@section('content')
    <div class="container-fluid list-products">
        <div class="row">
            <div class="col-sm-12">
                @if (session('sukses'))
                    <div class="alert alert-success dark alert-dismissible fade show" role="alert"><svg
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-thumbs-up">
                            <path
                                d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3">
                            </path>
                        </svg>
                        {{ session('sukses') }}
                        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"
                            data-bs-original-title="" title=""></button>
                    </div>
                @elseif(session('gagal'))
                    <div class="alert alert-danger dark alert-dismissible fade show" role="alert">
                        <i data-feather="x"></i>
                        <path
                            d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3">
                        </path>
                        </svg>
                        {{ session('gagal') }}
                        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"
                            data-bs-original-title="" title=""></button>
                    </div>
                @endif
            </div>
            <!-- Individual column searching (text inputs) Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Catat Transaksi Baru</h5>
                    </div>
                    <div class="card-body">

                        <form action="{{ route('transaction.add') }}" class='theme-form mega-form needs-validation'
                            method="post" novalidate="" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" for="min_stock">Tanggal & Waktu</label>
                                <div class="col">
                                    <input class="form-control digits" id="example-datetime-local-input"
                                        type="datetime-local" name='tanggal'>
                                </div>

                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" for="min_stock">Jenis transaksi</label>
                                <div class="col">
                                    <div class="form-group m-t-10 m-checkbox-inline mb-0 custom-radio-ml">
                                        <div class="radio radio-primary">
                                            <input id="radioinline1" type="radio" name="type" value="income" checked>
                                            <label class="mb-0" for="radioinline1">Pemasukan</label>
                                        </div>
                                        <div class="radio radio-primary">
                                            <input id="radioinline2" type="radio" name="type" value="expense">
                                            <label class="mb-0" for="radioinline2">Pengeluaran</label>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" for="category">Kategori<span
                                        style="color: red">*</span></label>
                                <div class="col-sm-9">
                                    <select class="js-example-basic-single col-sm-12" id="categorySelect" name="category"
                                        required='required'>
                                        <option value="" selected disabled>--Pilih Kategori--</option>
                                        @foreach ($category as $b)
                                            <option value="{{ $b->id }}">{{ $b->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Required</div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" for="sale_price">Nominal<span
                                        style="color: red">*</span></label>
                                <div class="col-sm-1">Rp</div>
                                <div class="col-sm-5">
                                    <input class="form-control" id="amount" type="number" name="amount" min="1"
                                        required="required">
                                    <div class="invalid-feedback">Required</div>
                                </div>
                                <div class="col-sm-1">,00</div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" for="note">Catatan</label>
                                <div class="col-sm-9">
                                    <textarea name="note" id="note" cols="20" rows="10" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-secondary" onclick="history.back()" type="button">Batal</button>
                                <button class="btn btn-primary" type="submit">Catat</button>
                            </div>
                        </form>


                    </div>

                </div>
            </div>
            <!-- Individual column searching (text inputs) Ends-->
        </div>
    </div>
    </div>

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content" id="modal_content">

            </div>
        </div>
    </div>
@endsection



@section('script')
    <script src="{{ asset('assets/js/form-validation-custom.js') }}"></script>
    <script src="{{ asset('assets/js/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/rating/jquery.barrating.js') }}"></script>
    <script src="{{ asset('assets/js/rating/rating-script.js') }}"></script>
    <script src="{{ asset('assets/js/owlcarousel/owl.carousel.js') }}"></script>
    <script src="{{ asset('assets/js/ecommerce.js') }}"></script>
    <script src="{{ asset('assets/js/product-list-custom.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>

    <script>
        window.addEventListener('load', () => {
            var now = new Date();
            now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
            now.setMilliseconds(null)
            now.setSeconds(null)

            document.getElementById('example-datetime-local-input').value = now.toISOString().slice(0, -1);
        });

        function form_tambah_brand() {
            $('#modal_content').html(`
                <div class="modal-header">
                    <div class="loader-box" style="height:auto;">
                        <div class="loader-7"></div>
                    </div>
                </div>
                <div class='modal-body'>
                    <div class="loader-box" style="height:auto;">
                        <div class="loader-7"></div>
                    </div>
            </div>`);
            $.ajax({
                type: 'POST',

                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                },
                success: function(data) {
                    $('#modal_content').html(data.msg)
                }
            });
        }

        $('.brandSelect').on('change', function(e) {
            if ($(this).val() == 'newbrand') {
                $('.modal').modal('show');
                form_tambah_brand();
                $(".brandSelect").prop('selectedIndex', -1);
            }
        });

        $('input:radio[name="type"]').on('change', function() {
            var tipe = $(this).val();
            // alert(tipe);
            $.ajax({
                type: 'POST',
                url: '{{ url('catat/category') }}',
                data: '_token= <?php echo csrf_token(); ?>&tipe=' + tipe,
                success: function(data) {
                    $("#categorySelect").html(data.msg);
                }
            });
        });
    </script>
@endsection
