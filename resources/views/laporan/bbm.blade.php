@extends('layouts.app')

@section('title', $title)

@section('css')
    <!-- Sweetalert2 -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <!-- DatePicker -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/datepicker/bootstrap-datepicker.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <style>
        @media print {
            .row {
                display: -ms-flexbox;
                display: flex;
                -ms-flex-wrap: wrap;
                flex-wrap: wrap;
                margin-right: -7.5px;
                margin-left: -7.5px;
            }

            .col-sm-3 {
                -ms-flex: 0 0 25%;
                flex: 0 0 25%;
                max-width: 25%;
            }

            .col-sm-6 {
                -ms-flex: 0 0 50%;
                flex: 0 0 50%;
                max-width: 50%;
            }
        }
    </style>
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            @if (session('info'))
                <div class="alert alert-danger">
                    <strong><i class="fas fa-exclamation-triangle"></i></strong>
                    {{ session('info') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{ $title }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">{{ $title }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-purple">
                        <div class="card-header d-flex flex-row align-items-center">
                            <h3 class="card-title">Laporan</h3>
                        </div>
                        <form method="POST">
                            @csrf
                            <input type="hidden" name="jenis" value="{{ $jenis }}">
                            <div class="card-body row">
                                <div class="col-12 col-md-2 my-auto">
                                    <label for="">Pilih Bulan</label>
                                </div>
                                <div class="col-12 col-md-3">
                                    <select class="form-control" name="bulan" id="bulan">
                                        <option value="" disabled selected>Pilih</option>
                                        @foreach ($bulan as $no => $item)
                                            <option value="{{ $no + 1 }}">{{ ucwords($item) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-md-2 my-auto">
                                    <label for="">Pilih Tahun</label>
                                </div>
                                <div class="col-12 col-md-3">
                                    <select class="form-control" name="tahun" id="tahun">
                                        <option value="" disabled selected>Pilih</option>
                                        @for ($i = date('Y'); $i < 2040; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer d-flex flex-row align-items-center">
                                <button type="submit" id="lihat" class="btn btn-dark">Preview</button>
                                <button type="button" id="cetak" class="btn btn-danger mx-1"><i class="fa fa-print"
                                        aria-hidden="true"></i> Cetak</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row" id="printable">
                {{-- Laporan Transaksi Simpanan --}}
                <div class="col-12 col-sm-12">
                    <div class="card card-dark">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-3">
                                    <img src="{{ asset('assets/dist/img/logo.png') }}" alt="AdminLTE Logo"
                                        class="brand-image" width="150">
                                    <br>
                                </div>
                                <div class="col-12 col-sm-6 my-auto">
                                    <h4 class="text-center">{{ $title }}<br>CV. CATUR</h4>
                                    <p class="text-center m-0" id="text_caption">
                                        Jl. Raya Tanah Putih No. 15, Darmasaba, Badung
                                    </p>
                                    <p class="text-center m-0" id="text_caption">
                                        Telp: (0361) 24603650, Email: udcatur@gmail.com
                                    </p>
                                    <p class="text-center mt-4" id="text_caption">Berdasarkan Bulan : <span id="d1"
                                            class="mr-2"></span> Tahun : <span id="d2"></span>
                                    </p>
                                </div>
                            </div>
                            <br>
                            <table class="table table-bordered table-striped" id="table1">
                                <thead>
                                    <tr>
                                        <th>Periode</th>
                                        <th>Tahun</th>
                                        <th>Bahan Baku</th>
                                        <th>Ukuran</th>
                                        <th>Satuan</th>
                                        <th>Jumlah Masuk</th>
                                        <th>Tanggal Masuk</th>
                                        <th>Supplier</th>
                                        <th>Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <!--/. container-fluid -->
    </section>

@endsection

@section('script')
    <!-- DataTables -->
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <!-- Jquery Validate -->
    <script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <!-- Sweetalert2 -->
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <!-- DatePicker -->
    <script src="{{ asset('assets/plugins/datepicker/bootstrap-datepicker.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('assets/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- SELECT2 -->
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/print/jQuery.print.js') }}"></script>
    <script>
        $(document).ready(function() {
            function formatMoney(num) {
                var p = num.toFixed(0).split(".");
                return "Rp " + p[0].split("").reverse().reduce(function(acc, num, i, orig) {
                    return num + (num != "-" && i && !(i % 3) ? "." : "") + acc;
                }, "");
            }

            function openInNewTab(url) {
                window.open(url, '_blank').focus();
            }

            function lastdigit(strs) {
                str = strs.toString();
                str = str.slice(0, -3);
                str = parseInt(str);
                return str;
            }

            $(function() {
                $("#cetak").on('click', function() {
                    $.print("#printable");
                });
            });

            $('#bulan, #tahun').select2({
                theme: 'bootstrap4',
            });

            $('[name*="pilihan"]').change(function(e) {
                e.preventDefault();
                var v = $(this).val();
                if (v == 'tanggal') {
                    $('#d_1').removeClass('d-none');
                    $('#d_2, #d_3').addClass('d-none');
                } else if (v == 'bulan') {
                    $('#d_2').removeClass('d-none');
                    $('#d_1, #d_3').addClass('d-none');
                } else if (v == 'tahun') {
                    $('#d_3').removeClass('d-none');
                    $('#d_1, #d_2').addClass('d-none');
                }
            });

            // remove invalid in change
            $('select').on('change', function(e) {
                e.preventDefault();
                var id = $(this).val();
                if (id != null) {
                    $(this).removeClass('is-invalid');
                }
            });

            var validator = $("form").validate({
                rules: {
                    bulan: {
                        required: true,
                    },
                    tahun: {
                        required: true,
                    },
                },
                errorElement: "div",
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.input-group, .form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
                submitHandler: function(form) {
                    var data = $(form).serialize();
                    var bulan = $('#bulan option:selected').text();
                    var tahun = $('#tahun option:selected').val();
                    $('#text_caption #d1').text(bulan);
                    $('#text_caption #d2').text(tahun);

                    $.ajax({
                        type: "POST",
                        url: "{{ route('post.laporan') }}",
                        data: data,
                        dataType: "json",
                        success: function(res) {
                            if (res.query) {
                                $('#table1').find('tbody').html('');
                                var html = '';
                                if (res.query.length >= 1) {
                                    var subtotal = 0;
                                    $.each(res.query, function(i, val) {
                                        var total = formatMoney(val.harga);
                                        subtotal += (val.harga);
                                        html += '<tr>';
                                        html += '<td>' + val.periode.bulan +
                                            '</td>';
                                        html += '<td>' + val.periode.tahun +
                                            '</td>';
                                        html += '<td>' + val.bahanbaku
                                            .nama_bahanbaku +
                                            '</td>';
                                        html += '<td>' + val.ukuran +
                                            '</td>';
                                        html += '<td>' + val.satuan +
                                            '</td>';
                                        html += '<td>' + val.jumlah +
                                            '</td>';
                                        html += '<td>' + val.tanggal +
                                            '</td>';
                                        html += '<td>' + val.supplier
                                            .nama_supplier +
                                            '</td>';
                                        html += '<td>' + total +
                                            '</td>';
                                        html += '</tr>';
                                    });
                                    html += '<tr>';
                                    html += '<td colspan="7"></td>';
                                    html += '<td><b>SubTotal</b></td>';
                                    html += '<td><b>' + formatMoney(subtotal) + '</b></td>';
                                    html += '</tr>';
                                } else {
                                    html += '<tr>';
                                    html +=
                                        '<td colspan="9" class="text-center">No Data</td>';
                                    html += '</tr>';
                                }

                                $('#table1').find('tbody').append(html);
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
