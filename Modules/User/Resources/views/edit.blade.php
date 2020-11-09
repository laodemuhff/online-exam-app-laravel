@extends('layouts.app')

@section('title', 'Admin Management')
@section('user-management', 'kt-menu__item--open')
@section('user-create', 'kt-menu__item--active')

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
                    Pada page ini anda dapat mengedit user yang terdiri dari Admin, Entry dan Instructor
                </div>
            </div>
        </div>
    </div>

    <div class="kt-portlet">
        <div class="kt-portlet__body">
            @include('layouts.notification')
            <form action="{{route('user.update', $user->id)}}" method="POST">
            @csrf
                <div class="row">
                    {{-- Input field --}}
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    Level <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Level User"></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <select class="form-control" name="level">
                                    <option value="">Pilih Level User</option>
                                    <option value="admin" 
                                        @if(old('level') !== null) 
                                            @if(old('level') == 'admin') selected @endif
                                        @else 
                                            @if($user->level == 'admin') selected @endif
                                        @endif>Admin</option>
                                    <option value="instructor" 
                                        @if(old('level') !== null) 
                                            @if(old('level') == 'instructor') selected @endif
                                        @else 
                                            @if($user->level == 'instructor') selected @endif
                                        @endif>Instructor</option>
                                    <option value="entry" 
                                        @if(old('level') !== null) 
                                            @if(old('level') == 'entry') selected @endif
                                        @else 
                                            @if($user->level == 'entry') selected @endif
                                        @endif>Entry</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    Name <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Nama User"></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <input class="form-control" type="text" name="name" placeholder="E.g: Yudi Purwono" value="{{ old('name') ?? $user->name }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    Email <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Masukan email user, email harus unik dan belum pernah dipakai di admin ataupun applikasi"></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <input class="form-control" type="email" name="email" placeholder="E.g: yudipurwono@hemofilia.com" autocomplete="off" value="{{ old('email') ?? $user->email }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    Phone <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Masukan No. Telpon user, phone harus unik dan belum pernah dipakai di admin ataupun applikasi"></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <input class="form-control" type="text" name="phone" placeholder="E.g: 0812xxxxxxxxx" autocomplete="off" value="{{ old('phone') ?? $user->phone }}">
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
                    {{-- <div class="col-md-6">
                        @foreach ($features as $feature => $data)
                        <strong>{{$feature}}</strong><br>
                        <div class="kt-checkbox-inline" style="margin-bottom: 20px">
                            @foreach ($data as $key => $value)
                                <label class="kt-checkbox">
                                    <input name="feature[]" type="checkbox" value="{{$value['id']}}"> {{$value['action']}}
                                    <span></span>
                                </label>
                            @endforeach
                        </div> <br>
                        @endforeach
                    </div> --}}
                </div>
                <div class="pull-right">
                    <button class="btn btn-primary btn-sm">
                        <i class="flaticon2-send-1"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
