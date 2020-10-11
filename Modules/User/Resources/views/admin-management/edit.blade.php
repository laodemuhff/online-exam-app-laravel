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
        <span class="kt-subheader__breadcrumbs-separator"></span>
        <a class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">
            Edit Admin
        </a>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="alert alert-light alert-elevate fade show" role="alert">
                <div class="alert-icon"><i class="flaticon-information kt-font-info"></i></div>
                <div class="alert-text">
                    Pada page ini anda dapat membuat user untuk mengatur CMS berdasarkan hak akses yang diberikan
                </div>
            </div>
        </div>
    </div>

    <div class="kt-portlet">
        <div class="kt-portlet__body">
            @include('layouts.notification')
            <form action="{{route('admin.admin.management.update',[encSlug($user['id'])])}}" method="POST">
            @csrf
                <div class="row">
                    {{-- Input field --}}
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    Name <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Nama Admin"></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <input class="form-control" type="text" name="name" placeholder="E.g: Yudi Purwono" value="{{$user['name']}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    Email <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Masukan email admin, email harus unik dan belum pernah dipakai di admin ataupun applikasi"></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <input class="form-control" type="email" name="email" placeholder="E.g: yudipurwono@hemofilia.com" autocomplete="off" value="{{$user['email']}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    Password <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Masukan password"></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <input class="form-control" type="password" name="password" placeholder="******" autocomplete="off">
                                <span class="form-text text-muted">Let it blank if u won't change the password.</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    Confirm Password <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Masukan lagi password"></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <input class="form-control" type="password" name="password_confirmation" placeholder="******" autocomplete="false">
                                <span class="form-text text-muted">Let it blank if u won't change the password.</span>
                            </div>
                        </div>
                    </div>
                    {{-- Feature field --}}
                    <div class="col-md-6">
                        @foreach ($features as $feature => $data)
                        <strong>{{$feature}}</strong><br>
                        <div class="kt-checkbox-inline">
                            @foreach ($data as $item)
                                <label class="kt-checkbox">
                                    <input name="feature[]" type="checkbox" value="{{$item['id']}}"
                                        @foreach ($user['userAdminFeature'] as $key => $value)
                                            {{($item['id'] == $value['id_admin_feature']) ? "checked" : ""}}
                                        @endforeach
                                    > {{$item['action']}}
                                    <span></span>
                                </label>
                            @endforeach
                        </div> <br>
                        @endforeach
                    </div>
                </div>
                <div class="pull-right">
                    <button class="btn btn-warning btn-sm">
                        <i class="flaticon-edit"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
