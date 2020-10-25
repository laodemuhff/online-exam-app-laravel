@extends('layouts.app')

@section('title', 'Armada Management')
@section('armada', 'kt-menu__item--open')

@section('breadcrumb')
    <h3 class="kt-subheader__title">
        Armada Management
    </h3>
    <span class="kt-subheader__separator kt-hidden"></span>
    <div class="kt-subheader__breadcrumbs">
        <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
        <a href="{{route('armada.list')}}" class="kt-subheader__breadcrumbs-link">
            List Armada
        </a>
    </div>
@endsection
@section('styles')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    {{-- Search Path --}}
    <div class="kt-portlet">
        <div class="kt-portlet__body" style="padding-bottom: 0">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group ">
                        <label>Tipe Armada</label>
                        <div class="input-group">
                            <select class="form-control" name="id_tipe_armada" id="id_tipe_armada">
                                <option value=""></option>
                                @foreach ($tipe_armada as $item)
                                    <option value="{{ $item['id'] }}">{{ ucfirst($item['tipe']) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group ">
                        <label>Status Armada</label>
                        <div class="input-group">
                            <select class="form-control" name="status_armada" id="status_armada">
                                <option value=""></option>
                                @foreach ($status_armada as $item)
                                    <option value="{{ $item }}">{{ ucfirst($item) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group ">
                        <label>Status Driver</label>
                        <div class="input-group">
                            <select class="form-control" name="status_driver" id="status_driver">
                                <option value=""></option>
                                @foreach ($status_driver as $item)
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
                        <th>Foto</th>
                        <th>Kode Armada</th>
                        <th>Tipe Armada</th>
                        <th>Status Armada</th>
                        <th>Status Driver</th>
                        <th>Harga Sewa</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
            {{-- <div class="kt-separator kt-separator--dashed"></div> --}}
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/helper.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
    <script>
        // $.fn.dataTable.ext.errMode = 'none';
        $(document).ready( function () {
            var url = $('#url').val();

            $('#datatable').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            stateSave: true,
            "bFilter": false,
            "lengthChange": false,
            ajax: "{{ route('armada.table') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'id', searchable: false, orderable: false},
                {data: 'photo', name: 'photo',  
                    render: function (data, type, full, meta) {
                        return "<img src=\"" + data + "\" height=\"50\"/>";
                    },
                },
                {data: 'kode_armada', name: 'kode_armada'},
                {data: 'tipe_armada', name: 'tipe_armada'},
                {data: 'status_armada', name: 'status_armada'},
                {data: 'status_driver', name: 'status_driver'},
                {data: 'price', name: 'price', 
                    render: function (data, type, full, meta) {
                        return 'Rp '+number_format(data, 0, ',', '.');
                    },
                },
                {data: 'action', name: 'action', searchable: false, orderable: false}
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
            var id_tipe_armada    = $('#id_tipe_armada').val();
            var status_armada   = $('#status_armada').val();
            var status_driver   = $('#status_driver').val();
            
            console.log(id_tipe_armada+ ' ' + status_armada + ' ' +status_driver)

            search(id_tipe_armada, status_armada, status_driver);
        });

        $(document).on('click', '#reset', function(){
            reset();
            search();
        });

        function search(id_tipe_armada = '', status_armada = '', status_driver = '') {
            // $.fn.dataTable.ext.errMode = 'none';

            var table = $('#datatable').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                destroy: true,
                "bFilter": false,
                "lengthChange": false,
                ajax: {
                    url: "{{ route('armada.table') }}",
                    type: 'get',
                    data: function(d) {
                        d.id_tipe_armada = id_tipe_armada;
                        d.status_armada = status_armada;
                        d.status_driver = status_driver;
                    }
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'id', searchable: false, orderable: false},
                    {data: 'photo', name: 'photo',  
                        render: function (data, type, full, meta) {
                            return "<img src=\"" + data + "\" height=\"50\"/>";
                        },
                    },
                    {data: 'kode_armada', name: 'kode_armada'},
                    {data: 'tipe_armada', name: 'tipe_armada'},
                    {data: 'status_armada', name: 'status_armada'},
                    {data: 'status_driver', name: 'status_driver'},
                    {data: 'price', name: 'price', 
                        render: function (data, type, full, meta) {
                            return 'Rp '+number_format(data, 0, ',', '.');
                        },
                    },
                    {data: 'action', name: 'action', searchable: false, orderable: false}
                ]
            });
        }

        function reset() {
            $('#id_tipe_armada').val('');
            $('#status_armada').val('');
            $('#status_driver').val('');
            $('#search').val('').trigger('change');
        }
    </script>
@endsection
