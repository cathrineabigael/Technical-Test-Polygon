@extends('layouts.cashflowmanager')
@section('title')
    pengeluaran
@endsection
@section('plugincss')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/owlcarousel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/rating.css') }}">
@endsection
@section('breadcrumbs')
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
                        <h5>Daftar pengeluaran</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="basic-4">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Kategori</th>
                                        <th>Nominal</th>
                                        <th>Catatan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($expense as $s)
                                        <tr id="tr_{{ $s->id }}">
                                            <td>{{ $s->created_at }}</td>
                                            <td>
                                                <p>{{ $s->category->name }}</p>
                                            </td>

                                            <td>
                                                <p>Rp {{ number_format($s->amount, 2, ',', '.') }}</p>
                                            </td>
                                            <td>
                                                <p>{{ $s->note }}</p>
                                            </td>
                                            <td>

                                                <button class="btn btn-primary btn-xs" type="button" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModalCenter"
                                                    onclick="getDataFirst({{ $s->id }})">Edit</button>
                                                <button class="btn btn-danger btn-xs" type="button"
                                                    data-original-title="btn btn-danger btn-xs" title=""
                                                    onclick="deleteexpense({{ $s->id }})">Delete</button>
                                                @if (Auth::user()->id == 2 and $s->verified_at == null and $s->verificator_id == null)
                                                    <button class="btn btn-primary btn-xs" type="button"
                                                        data-original-title="btn btn-danger btn-xs" title="" id='buttonverif{{ $s->id }}'
                                                        onclick="verif({{ $s->id }})">Verifikasi</button>
                                                @endif


                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Kategori</th>
                                        <th>Nominal</th>
                                        <th>Catatan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
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
    {{-- <div class="modal fade" id="modal_edit_category" tabindex="-1" role="dialog" aria-labelledby="modal_edit_category"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content" id="modal_content_edit_category">

            </div>
        </div>
    </div> --}}
@endsection

@section('modal')
@endsection

@section('script')
    <script>
        function verif(id) {
            swal({
                    title: "Yakin verifikasi pengeluaran?",
                    text: "Data yang sudah dihapus tidak dapat dikembalikan",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willVerif) => {
                    if (willVerif) {
                        $.post('{{ route('income.verif') }}', {
                                _token: "<?php echo csrf_token(); ?>",
                                id: id
                            },
                            function(data) {
                                if (data.status == "sukses") {
                                    $('#buttonverif' + id).remove();
                                    swal("pengeluaran berhasil diverifikasi", {
                                        icon: "success",
                                    });

                                } else {
                                    swal("pengeluaran gagal diverifikasi", {
                                        title: "pengeluaran gagal diverifikasi",
                                        icon: "error",
                                    });
                                }
                                // alert(data.msg);

                            });
                    }
                })
        }

        function deleteexpense(id) {
            swal({
                    title: "Yakin hapus pengeluaran?",
                    text: "Data yang sudah diverifikasi tidak dapat dikembalikan",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.post('{{ route('income.delete_data') }}', {
                                _token: "<?php echo csrf_token(); ?>",
                                id: id
                            },
                            function(data) {
                                if (data.status == "sukses") {
                                    $('#tr_' + id).remove();

                                    swal("pengeluaran berhasil dihapus", {
                                        icon: "success",
                                    });
                                    // location.reload();

                                } else {
                                    swal("pengeluaran gagal dihapus", {
                                        title: "pengeluaran gagal dihapus",
                                        text: "Pastikan data child sudah terhapus atau sudah tidak berhubungan terlebih dahulu.",
                                        icon: "error",
                                    });
                                }
                                // alert(data.msg);

                            });
                    }
                })
        }
    </script>
    <script src="{{ asset('assets/js/form-validation-custom.js') }}"></script>
    <script src="{{ asset('assets/js/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/rating/jquery.barrating.js') }}"></script>
    <script src="{{ asset('assets/js/rating/rating-script.js') }}"></script>
    <script src="{{ asset('assets/js/owlcarousel/owl.carousel.js') }}"></script>
    <script src="{{ asset('assets/js/ecommerce.js') }}"></script>
    <script src="{{ asset('assets/js/product-list-custom.js') }}"></script>
@endsection
