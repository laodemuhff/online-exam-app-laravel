@extends('layouts.app')

@section('title', 'User Management')
@section('user-management', 'kt-menu__item--open')
@section('user-list-'.$level, 'kt-menu__item--active')

@section('breadcrumb')
    <h3 class="kt-subheader__title">
        User {{ucfirst($level)}} Management
    </h3>
    <span class="kt-subheader__separator kt-hidden"></span>
    <div class="kt-subheader__breadcrumbs">
        <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
        <a href="{{route('user', ['level' => $level])}}" class="kt-subheader__breadcrumbs-link">
            List User {{ucfirst($level)}}
        </a>
    </div>
@endsection
@section('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
@endsection
@section('content')
<div class="kt-portlet">
    <div class="kt-portlet__body">
        @include('layouts.notification')
        <table id="datatable" class="display compact nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Level</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $key => $user)
                    <tr>
                        <td>{{ $user['name'] }}</td>
                        <td>{{ $user['email'] }}</td>
                        <td>{{ $user['phone'] }}</td>
                        <td>{{ $user['level'] }}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-info btn-sm"><i class="la la-eye"></i></button>
                                <button type="button" class="btn btn-warning btn-sm"><i class="la la-edit"></i></button>
                                <button type="button" class="btn btn-danger btn-sm"><i class="la la-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready( function () {
            $('#datatable').DataTable({
                responsive: true
            });
        });
    </script>
@endsection
