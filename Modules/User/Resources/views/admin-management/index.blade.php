@extends('layouts.app')

@section('title', 'Admin Management')
@section('admin-management', 'kt-menu__item--open')

@section('breadcrumb')
    <h3 class="kt-subheader__title">
        Admin Management
    </h3>
    <span class="kt-subheader__separator kt-hidden"></span>
    <div class="kt-subheader__breadcrumbs">
        <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
        <a href="{{route('admin.admin.management.list')}}" class="kt-subheader__breadcrumbs-link">
            List Admin
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
                        <label>Name</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="flaticon2-user-outline-symbol"></i></span></div>
                            <input id="name" type="text" class="form-control" placeholder="E.g: Admin Yudi" aria-describedby="basic-addon1">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group ">
                        <label>Email</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">@</span></div>
                            <input id="email" type="text" class="form-control" placeholder="E.g: yudi@hemofilia.com" aria-describedby="basic-addon1">
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
            <table id="datatable" class="table table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Admin Name</th>
                        <th>Admin Email</th>
                        <th>Action</th>
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
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
    <script>
        // $.fn.dataTable.ext.errMode = 'none';
        $(document).ready( function () {
            $('#datatable').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            stateSave: true,
            "bFilter": false,
            "lengthChange": false,
            ajax: "{{ route('admin.admin.management.table') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'id', searchable: false, orderable: false},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
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
            var name    = $('#name').val();
            var email   = $('#email').val();
            search(name, email);
        });

        $(document).on('click', '#reset', function(){
            reset();
            search();
        });

        function search(name = '', email = '') {
            // $.fn.dataTable.ext.errMode = 'none';

            var table = $('#datatable').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                destroy: true,
                "bFilter": false,
                "lengthChange": false,
                ajax: {
                    url: "{{ route('admin.admin.management.table') }}",
                    type: 'get',
                    data: function(d) {
                        d.name = name;
                        d.email = email;
                    }
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'id', searchable: false, orderable: false},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'action', name: 'action', searchable: false, orderable: false}
                ]
            });
        }

        function reset() {
            $('#name').val('');
            $('#email').val('');
            $('#search').val('').trigger('change');
        }
    </script>
@endsection
