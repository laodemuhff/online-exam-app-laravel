@extends('layouts.app')

@section('title', 'Transaction Management')
@section('transaction', 'kt-menu__item--open')
@section('transaction_list', 'kt-menu__item--open')
@section('transaction_list_'.$status, 'kt-menu__item--active')

@section('breadcrumb')
    <h3 class="kt-subheader__title">
        Transaction Management
    </h3>
    <span class="kt-subheader__separator kt-hidden"></span>
    <div class="kt-subheader__breadcrumbs">
        <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
        <a href="{{route('transaction.list', $status)}}" class="kt-subheader__breadcrumbs-link">
            List Transaction {{ ucfirst($status) }}
        </a>
    </div>
@endsection
@section('styles')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .detal-trx{
            margin-bottom:0.8rem;   
        }
    </style>
@endsection
@section('content')
    {{-- Search Path --}}
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="m-portlet__head-caption" style="padding-top:15px">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        <a href="#" id="filter-btn-show"><i class="la la-angle-double-down" style="font-size: 1.2em"></i></a>
                        <a href="#" id="filter-btn-hide" style="display: none"><i class="la la-angle-double-up" style="font-size: 1.2em"></i></a>
                    </h3>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body" style="padding-bottom: 0; display: none" id="filter-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group ">
                        <label>Nama Customer</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="nama_customer" id="nama_customer" placeholder="E.g : Umam Maulana ">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group ">
                        <label>Alamat Customer</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="alamat_customer" id="alamat_customer" placeholder="E.g : Kec. Ngemplak ">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group ">
                        <label>Nomor Telpon Customer</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="no_hp_customer" id="no_hp_customer" placeholder="E.g : 087777xxxxxx ">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group ">
                        <label>Nomor Faktur</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="nomor_faktur" id="nomor_faktur" placeholder="E.g : FAK-ABCD-1 ">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group ">
                        <label>Tipe Armada</label>
                        <div class="input-group">
                            <select class="form-control" name="tipe_armada" id="tipe_armada">
                                <option value=""></option>
                                @foreach ($tipe_armada as $item)
                                    <option value="{{ $item['tipe'] }}">{{ ucfirst($item['tipe']) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group ">
                        <label>Durasi Sewa</label>
                        <div class="input-group">
                            <input type="number" min="0" class="form-control" name="durasi_sewa" id="durasi_sewa">
                            <div class="input-group-append">
                                <span class="input-group-text">days</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group ">
                        <label>Pickup Date</label>
                        <div class="input-group">
                            <input type="date" class="form-control" name="pickup_date" id="pickup_date" value="{{ date('Y-m-d') }}">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group ">
                        <label>Status Lepas Kunci</label>
                        <div class="input-group">
                            <select class="form-control" name="status_lepas_kunci" id="status_lepas_kunci">
                                <option value="">None</option>
                                @foreach ($status_lepas_kunci as $item)
                                    <option value="{{ $item }}">{{ ucfirst($item) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group ">
                        <label>Status Pengambilan</label>
                        <div class="input-group">
                            <select class="form-control" name="status_pengambilan" id="status_pengambilan">
                                <option value="">None</option>
                                @foreach ($status_pengambilan as $item)
                                    <option value="{{ $item }}">{{ ucfirst($item) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer col-md-12">
                <div class="pull-right">
                    <button id="reset" class="btn btn-secondary btn-sm">
                        <i class="flaticon2-refresh-button"></i> Reset
                    </button>
                    <button id="search" class="btn btn-info btn-sm">
                        <i class="flaticon-search"></i> Search
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Body Path --}}
    <div class="kt-portlet">
        <div class="kt-portlet__body">
            @include('layouts.notification')
            <input id="url" type="hidden" value="{{ url('/') }}">
            <table id="datatable" class="table table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Action</th>
                        <th>Status</th>
                        <th>No Faktur</th>
                        <th>Nama Customer</th>
                        <th>No HP Customer</th>
                        <th>Tipe Armada</th>
                        <th>Kode Armada</th>
                        {{-- <th>Pickup Date</th> --}}
                        {{-- <th>Pickup Time</th> --}}
                        <th>Durasi Sewa</th>
                        <th>Harga Sewa</th>
                        <th>Grand Total</th>
                        <th>Alamat Customer</th>
                        <th>Status Lepas Kunci</th>
                        <th>Status Pengambilan</th>
                        <th>Note</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
            {{-- <div class="kt-separator kt-separator--dashed"></div> --}}
        </div>
    </div>

    <!-- Modal Update -->
    @foreach ($transaction as $item)
        @csrf
        <div class="modal fade" id="detailTrx{{$item['id']}}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="padding:30px">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Transaksi {{$item['nomor_faktur']}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="padding:30px">
                        <div class="form-group row detal-trx">
                            <div class="col-md-4">
                                <label for="">Nomor Faktur</label>
                            </div>
                            <div class="col-md-8">
                                <p>{{ $item['nomor_faktur'] }}</p>
                            </div>
                        </div>
                        <div class="form-group row detal-trx">
                            <div class="col-md-4">
                                <label for="">Nama Customer</label>
                            </div>
                            <div class="col-md-8">
                                <p>{{ $item['nama_customer'] }}</p>
                            </div>
                        </div>
                        <div class="form-group row detal-trx">
                            <div class="col-md-4">
                                <label for="">Alamat Customer</label>
                            </div>
                            <div class="col-md-8">
                                <p>{{ $item['alamat_customer'] }}</p>
                            </div>
                        </div>
                        <div class="form-group row detal-trx">
                            <div class="col-md-4">
                                <label for="">No. HP Customer</label>
                            </div>
                            <div class="col-md-8">
                                <p>{{ $item['no_hp_customer'] }}</p>
                            </div>
                        </div>
                        <div class="form-group row detal-trx">
                            <div class="col-md-4">
                                <label for="">Kode Armada</label>
                            </div>
                            <div class="col-md-8">
                                <p>{{ $item['armada']['kode_armada'] }}</p>
                            </div>
                        </div>
                        <div class="form-group row detal-trx">
                            <div class="col-md-4">
                                <label for="">Tipe Armada</label>
                            </div>
                            <div class="col-md-8">
                                <p>{{ $item['armada']['tipe_armada']['tipe'] }}</p>
                            </div>
                        </div>
                        {{-- <div class="form-group row detal-trx">
                            <div class="col-md-4">
                                <label for=""></label>
                            </div>
                            <div class="col-md-8">
                                <img src="{{$item['photo']}}" alt="" width="150" height="150">
                            </div>
                        </div> --}}
                        <div class="form-group row detal-trx">
                            <div class="col-md-4">
                                <label for="">Durasi Sewa</label>
                            </div>
                            <div class="col-md-8">
                                <p>{{ $item['durasi_sewa'] }} days</p>
                            </div>
                        </div>
                        <div class="form-group row detal-trx">
                            <div class="col-md-4">
                                <label for="">Pickup Date</label>
                            </div>
                            <div class="col-md-8">
                                <p>{{ tgl_indo(explode(' ',$item['pickup_date'])[0]) }}</p>
                            </div>
                        </div>
                        <div class="form-group row detal-trx">
                            <div class="col-md-4">
                                <label for="">Pickup Time</label>
                            </div>
                            <div class="col-md-8">
                                <p>{{ explode(' ',$item['pickup_date'])[1] }}</p>
                            </div>
                        </div>
                        <div class="form-group row detal-trx">
                            <div class="col-md-4">
                                <label for="">Status Lepas Kunci</label>
                            </div>
                            <div class="col-md-8">
                                <p>{{ $item['status_lepas_kunci'] ?? 'None' }}</p>
                            </div>
                        </div>
                        <div class="form-group row detal-trx">
                            <div class="col-md-4">
                                <label for="">Status Pengambilan</label>
                            </div>
                            <div class="col-md-8">
                                <p>{{ $item['status_pengambilan'] ?? 'None' }}</p>
                            </div>
                        </div>
                        <div class="form-group row detal-trx">
                            <div class="col-md-4">
                                <label for="">Status Transaksi</label>
                            </div>
                            <div class="col-md-8">
                                @if ($item['status_transaksi'] == 'pending')
                                    <span class="badge badge-warning">
                                        {{ $item['status_transaksi'] }}
                                    </span>
                                @elseif($item['status_transaksi'] == 'on rent')
                                    <span class="badge badge-primary">
                                        {{ $item['status_transaksi'] }}
                                    </span>
                                @elseif($item['status_transaksi'] == 'success')
                                    <span class="badge badge-success">
                                        {{ $item['status_transaksi'] }}
                                    </span>
                                @else
                                    <span class="badge badge-danger">
                                        {{ $item['status_transaksi'] }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row detal-trx">
                            <div class="col-md-4">
                                <label for="">Harga Sewa</label>
                            </div>
                            <div class="col-md-8">
                                <p>{{ IDR($item['armada']['price']) }}</p>
                            </div>
                        </div>
                        <div class="form-group row detal-trx">
                            <div class="col-md-4">
                                <label for="">Grand Total</label>
                            </div>
                            <div class="col-md-8">
                                <p>{{ IDR($item['grand_total']) }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <form action="{{ route('transaction.confirm') }}" method="POST">
                            <button type="submit" class="btn btn-primary" value="{{$item['id']}}">Confirm Rent</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/helper.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
    <script>
        // $.fn.dataTable.ext.errMode = 'none';
        $(document).ready( function () {
            var url = $('#url').val();

            $('#datatable').DataTable({
                sScrollX: "100%",
                responsive: true,
                processing: true,
                serverSide: true,
                stateSave: true,
                "bFilter": false,
                "lengthChange": false,
                ajax: "{{ route('transaction.table', $status) }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'id', searchable: false, orderable: false},
                    {data: 'action', name: 'action', searchable: false, orderable: false, width: '130'},
                    {data: 'status_transaksi', name: 'status_transaksi', render: function (data, type, full, meta) {
                            if (data == 'pending')
                                return "<span class='badge badge-warning'>"+data+"</span>"
                            else if (data == 'on rent')
                                return "<span class='badge badge-primary'>"+data+"</span>"
                            else if (data == 'success')
                                return "<span class='badge badge-success'>"+data+"</span>"
                            else
                                return "<span class='badge badge-danger'>"+data+"</span>"
                        }
                    },
                    {data: 'nomor_faktur', name: 'nomor_faktur'},
                    {data: 'nama_customer', name: 'nama_customer'},
                    {data: 'no_hp_customer', name: 'no_hp_customer'},
                    {data: 'tipe_armada', name: 'tipe_armada'},
                    {data: 'kode_armada', name: 'kode_armada', responsivePriority: 10001},
                    // {data: 'pickup_date', name: 'pickup_date', render: function (data, type, full, meta) {
                    //         return data.split(' ')[0];
                    //     }, width: '130px'
                    // },
                    // {data: 'pickup_date', name: 'pickup_date', render: function (data, type, full, meta) {
                    //         return data.split(' ')[1];
                    //     }, width: '130px'
                    // },
                    {data: 'durasi_sewa', name: 'durasi_sewa', render: function (data, type, full, meta) {
                            return data+' days';
                        }
                    },
                    {data: 'harga_sewa', name: 'harga_sewa', render: function (data, type, full, meta) {
                            return 'Rp '+number_format(data, 0, ',', '.');
                        }
                    },
                    {data: 'grand_total', name: 'grand_total', render: function (data, type, full, meta) {
                            return 'Rp '+number_format(data, 0, ',', '.');
                        }
                    },
                    {data: 'alamat_customer', name: 'alamat_customer', responsivePriority: 10005},
                    {data: 'status_lepas_kunci', name: 'status_lepas_kunci', responsivePriority: 10003, render: function(data, type,  full, meta){
                            if(data == null)
                                return 'None'
                            else
                                return data
                        }
                    },
                    {data: 'status_pengambilan', name: 'status_pengambilan', responsivePriority: 10002, render: function(data, type,  full, meta){
                            if(data == null)
                                return 'None'
                            else
                                return data
                        }
                    },
                    {data: 'note', name: 'note', responsivePriority: 10004, render: function(data, type,  full, meta){
                            if(data == null)
                                return 'None'
                            else
                                return data
                        }
                    }
                ]
            });
        } );
    </script>
    <script>
        $('body').on('click', '.btn-delete', function (event) {
            event.preventDefault();

            var me = $(this),
                url = me.attr('href'),
                title = me.attr('title'),
                csrf_token = $('meta[name="csrf-token"]').attr('content');

            swal.fire({
                title: 'Are you sure want to delete ' + title + ' ?',
                text: 'You won\'t be able to revert this!',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    $('#loading').show();
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: {
                            '_method': 'DELETE',
                            '_token': csrf_token,
                        },
                        success: function (response) {
                            // $('#loading').hide();
                            console.log(response)
                            if (response) {
                                swal.fire({
                                    type: 'success',
                                    title: 'Success!',
                                    text: 'Data has been deleted!'
                                });
                                location.reload();
                            }else{
                                swal.fire({
                                    type: 'error',
                                    title: 'Oops...',
                                    text: response.messages
                                });
                            }
                        },
                        error: function (xhr) {
                            // $('#loading').hide();
                            swal.fire({
                                type: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!'
                            });
                        }
                    });
                }
            });
        });
    </script>
    <script>
        $(document).on('click', '#search', function() {
            var nama_customer = $('#nama_customer').val();
            var alamat_customer = $('#alamat_customer').val();
            var no_hp_customer = $('#no_hp_customer').val();
            var nomor_faktur = $('#nomor_faktur').val();
            var tipe_armada = $('#tipe_armada').val();
            var durasi_sewa = $('#durasi_sewa').val();
            var pickup_date = $('#pickup_date').val();
            var status_lepas_kunci = $('#status_lepas_kunci').val();
            var status_pengambilan = $('#status_pengambilan').val();

            search(nama_customer, alamat_customer, no_hp_customer, nomor_faktur, tipe_armada, durasi_sewa, pickup_date, status_lepas_kunci, status_pengambilan);
        });

        $(document).on('click', '#reset', function(){
            reset();
            search();
        });

        function search(nama_customer = '', alamat_customer = '', no_hp_customer = '',nomor_faktur = '', tipe_armada = '', durasi_sewa = '', pickup_date = '', status_lepas_kunci = '', status_pengambilan = '') {
            // $.fn.dataTable.ext.errMode = 'none';

            var table = $('#datatable').DataTable({
                sScrollX: "100%",
                responsive: true,
                processing: true,
                serverSide: true,
                destroy: true,
                "bFilter": false,
                "lengthChange": false,
                ajax: {
                    url: "{{ route('transaction.table', 'pending') }}",
                    type: 'get',
                    data: function(d) {
                        d.nama_customer = nama_customer;
                        d.alamat_customer = alamat_customer;
                        d.no_hp_customer = no_hp_customer;
                        d.nomor_faktur = nomor_faktur;
                        d.tipe_armada = tipe_armada;
                        d.durasi_sewa = durasi_sewa;
                        d.pickup_date = pickup_date;
                        d.status_lepas_kunci = status_lepas_kunci;
                        d.status_pengambilan = status_pengambilan;
                    }
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'id', searchable: false, orderable: false},
                    {data: 'action', name: 'action', searchable: false, orderable: false, width: '130'},
                    {data: 'status_transaksi', name: 'status_transaksi', render: function (data, type, full, meta) {
                            if (data == 'pending')
                                return "<span class='badge badge-warning'>"+data+"</span>"
                            else if (data == 'on rent')
                                return "<span class='badge badge-primary'>"+data+"</span>"
                            else if (data == 'success')
                                return "<span class='badge badge-success'>"+data+"</span>"
                            else
                                return "<span class='badge badge-danger'>"+data+"</span>"
                        }
                    },
                    {data: 'nomor_faktur', name: 'nomor_faktur'},
                    {data: 'nama_customer', name: 'nama_customer'},
                    {data: 'no_hp_customer', name: 'no_hp_customer'},
                    {data: 'tipe_armada', name: 'tipe_armada'},
                    {data: 'kode_armada', name: 'kode_armada', responsivePriority: 10001},
                    // {data: 'pickup_date', name: 'pickup_date', render: function (data, type, full, meta) {
                    //         return data.split(' ')[0];
                    //     }, width: '130px'
                    // },
                    // {data: 'pickup_date', name: 'pickup_date', render: function (data, type, full, meta) {
                    //         return data.split(' ')[1];
                    //     }, width: '130px'
                    // },
                    {data: 'durasi_sewa', name: 'durasi_sewa', render: function (data, type, full, meta) {
                            return data+' days';
                        }
                    },
                    {data: 'harga_sewa', name: 'harga_sewa', render: function (data, type, full, meta) {
                            return 'Rp '+number_format(data, 0, ',', '.');
                        }
                    },
                    {data: 'grand_total', name: 'grand_total', render: function (data, type, full, meta) {
                            return 'Rp '+number_format(data, 0, ',', '.');
                        }
                    },
                    {data: 'alamat_customer', name: 'alamat_customer', responsivePriority: 10005},
                    {data: 'status_lepas_kunci', name: 'status_lepas_kunci', responsivePriority: 10003, render: function(data, type,  full, meta){
                            if(data == null)
                                return 'None'
                            else
                                return data
                        }
                    },
                    {data: 'status_pengambilan', name: 'status_pengambilan', responsivePriority: 10002, render: function(data, type,  full, meta){
                            if(data == null)
                                return 'None'
                            else
                                return data
                        }
                    },
                    {data: 'note', name: 'note', responsivePriority: 10004, render: function(data, type,  full, meta){
                            if(data == null)
                                return 'None'
                            else
                                return data
                        }
                    }
                ]
            });
        }

        function reset() {
            $('#nama_customer').val('');
            $('#alamat_customer').val('');
            $('#no_hp_customer').val('');
            $('#nomor_faktur').val('');
            $('#tipe_armada').val('');
            $('#durasi_sewa').val('');
            $('#pickup_date').val('');
            $('#status_lepas_kunci').val('');
            $('#status_pengambilan').val('');
            $('#search').val('').trigger('change');
        }
    </script>
    <script>
        $('#filter-btn-show').on('click', function(e){
            $('#filter-body').slideDown(200);
            $(this).hide();
            $('#filter-btn-hide').show();
        })

        $('#filter-btn-hide').on('click', function(e){
            $('#filter-body').slideUp(200);
            $(this).hide();
            $('#filter-btn-show').show();
        })

    </script>
@endsection
