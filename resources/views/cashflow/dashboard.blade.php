@extends('layouts.cashflowmanager')
@section('title')
    Cashflow Manager
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
    <div class="container-fluid general-widget">
        <div class="row">
            <div class="col-sm-12 col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center pb-0 bg-primary">
                        <h5>Saldo</h5>
                    </div>
                    <div class="card-body bg-primary">
                        {{-- <p class="mb-0">100.000</p> --}}
                        <h1>Rp {{ number_format($balance, 2, ',', '.') }}</h1>
                    </div>
                    <div class="card-footer bg-primary">
                        <h6 class="mb-0">Jangan lupa untuk selalu melakukan verifikasi transaksi</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-xl-6 col-lg-6">
                <div class="card employee-status" style="min-height:350px;">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h5>Pemasukan Tahun {{ date('Y') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <label class="col-sm-3 col-form-label" for="min_stock">Kategori</label>
                            <div class="col-sm-6">
                                <select class="form-select digits" id="dropdownincomepercategory">
                                    @foreach ($incomecategory as $i)
                                        <option value="{{ $i->id }}">{{ $i->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div><br>
                        <div class="user-status table-responsive">

                            <table class="table table-bordernone">
                                <thead>
                                    <tr>
                                        <th scope="col">Bulan</th>
                                        <th scope="col">Total</th>

                                    </tr>
                                </thead>
                                <tbody id='tbodyincomepercategory'>
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach ($incomepercategory as $ic)
                                        <tr>
                                            <td>{{ $incomepercategory[$i]->bulan }}</td>
                                            <td>Rp {{ number_format($incomepercategory[$i]->total, 2, ',', '.') }}</td>
                                        </tr>
                                        @php
                                            $i++;
                                        @endphp
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-6 col-lg-6">
                <div class="card employee-status" style="min-height:350px;">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h5>Pengeluaran Tahun {{ date('Y') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <label class="col-sm-3 col-form-label" for="min_stock">Kategori</label>
                            <div class="col-sm-6">
                                <select class="form-select digits" id="dropdownexpensepercategory">
                                    @foreach ($expensecategory as $i)
                                        <option value="{{ $i->id }}">{{ $i->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div><br>
                        <div class="user-status table-responsive">

                            <table class="table table-bordernone">
                                <thead>
                                    <tr>
                                        <th scope="col">Bulan</th>
                                        <th scope="col">Total</th>

                                    </tr>
                                </thead>
                                <tbody id='tbodyexpensepercategory'>
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach ($expensepercategory as $ic)
                                        <tr>
                                            <td>{{ $expensepercategory[$i]->bulan }}</td>
                                            <td>Rp {{ number_format($expensepercategory[$i]->total, 2, ',', '.') }}</td>
                                        </tr>
                                        @php
                                            $i++;
                                        @endphp
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-xl-6 col-lg-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Pemasukan Belum Terverifikasi</h5>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="show-case" id="basic-3-asc">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Kategori</th>
                                        <th>Nominal</th>
                                        <th>Catatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach ($incomeunverified as $iu)
                                        <tr id="tr_{{ $incomeunverified[$i]->id }}">
                                            <td>
                                                <p>{{ $incomeunverified[$i]->created_at }}</p>
                                            </td>

                                            <td>
                                                <p>{{ $incomeunverified[$i]->category_id }}</p>
                                            </td>

                                            <td>
                                                <p>Rp {{ number_format($incomeunverified[$i]->amount, 2, ',', '.') }}</p>
                                            </td>
                                            <td>
                                                <p>{{ $incomeunverified[$i]->note }}</p>
                                            </td>
                                        </tr>
                                        @php
                                            $i++;
                                        @endphp
                                    @endforeach

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Kategori</th>
                                        <th>Nominal</th>
                                        <th>Catatan</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-6 col-lg-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Pengeluaran Belum Terverifikasi</h5>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="show-case" id="basic-3-asc">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Kategori</th>
                                        <th>Nominal</th>
                                        <th>Catatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach ($expenseunverified as $eu)
                                        <tr id="tr_{{ $expenseunverified[$i]->id }}">
                                            <td>
                                                <p>{{ $expenseunverified[$i]->created_at }}</p>
                                            </td>

                                            <td>
                                                <p>{{ $expenseunverified[$i]->category_id }}</p>
                                            </td>

                                            <td>
                                                <p>Rp {{ number_format($expenseunverified[$i]->amount, 2, ',', '.') }}</p>
                                            </td>
                                            <td>
                                                <p>{{ $expenseunverified[$i]->note }}</p>
                                            </td>
                                        </tr>
                                        @php
                                            $i++;
                                        @endphp
                                    @endforeach

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Kategori</th>
                                        <th>Nominal</th>
                                        <th>Catatan</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('modal')
@endsection

@section('script')
    <script>
        $('#dropdownincomepercategory').on('change', function() {
            var category = $(this).val();
            $.ajax({
                type: 'POST',
                url: '{{ url('dashboard/incomepercategory') }}',
                data: '_token= <?php echo csrf_token(); ?>&category=' + category,
                success: function(data) {
                    $("#tbodyincomepercategory").html(data.msg);
                }
            });
        });
       
        $('#dropdownexpensepercategory').on('change', function() {
            var category = $(this).val();
            $.ajax({
                type: 'POST',
                url: '{{ url('dashboard/expensepercategory') }}',
                data: '_token= <?php echo csrf_token(); ?>&category=' + category,
                success: function(data) {
                    $("#tbodyexpensepercategory").html(data.msg);
                }
            });
        });
    </script>
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
@endsection
