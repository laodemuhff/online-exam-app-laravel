@extends('layouts.app')

@section('title', 'Admin Management')
@section('admin-management', 'kt-menu__item--open')

@section('breadcrumb')
    <h3 class="kt-subheader__title">
        User Management
    </h3>
    <span class="kt-subheader__separator kt-hidden"></span>
    <div class="kt-subheader__breadcrumbs">
        <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
        <a href="{{route('user.create')}}" class="kt-subheader__breadcrumbs-link">
            Create User
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
            <form action="{{route('user.store')}}" method="POST">
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
                                <input class="form-control" type="text" name="name" placeholder="E.g: Yudi Purwono">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    Email <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Masukan email admin, email harus unik dan belum pernah dipakai di admin ataupun applikasi"></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <input class="form-control" type="email" name="email" placeholder="E.g: yudipurwono@hemofilia.com" autocomplete="off">
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
                                    <input name="feature[]" type="checkbox" value="{{$item['id']}}"> {{$item['action']}}
                                    <span></span>
                                </label>
                            @endforeach
                        </div> <br>
                        @endforeach
                    </div>
                </div>
                <div class="pull-right">
                    <button class="btn btn-primary btn-sm">
                        <i class="flaticon2-send-1"></i> Create
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
