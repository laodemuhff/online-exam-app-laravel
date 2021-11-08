@extends('layouts.app')

@section('title', 'User Management')
@section('user-management', 'kt-menu__item--open')
@section('user-list-'.$user->level, 'kt-menu__item--active')

@section('breadcrumb')
    <h3 class="kt-subheader__title">
        User Management
    </h3>
    <span class="kt-subheader__separator kt-hidden"></span>
    <div class="kt-subheader__breadcrumbs">
        <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
        <a href="{{route('user.info', $user->id)}}" class="kt-subheader__breadcrumbs-link">
            User Detail
        </a>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="alert alert-light alert-elevate fade show" role="alert">
                <div class="alert-icon"><i class="flaticon-information kt-font-info"></i></div>
                <div class="alert-text">
                    Pada page ini anda dapat melihat detail user
                </div>
            </div>
        </div>
    </div>
    <div class="kt-portlet">
        <div class="row">
            <div class="col-md-12">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-caption">
                        <div class="kt-portlet__head-title" style="padding-top: 30%">
                            <h5>User Info</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="row">
                {{-- Input field --}}
                <div class="col-md-8">
                    <div class="form-group row">
                        <label class="col-4 col-form-label">
                            <div class="pull-right" style="font-weight: bold">
                                Name
                            </div>
                        </label>
                        <div class="col-8" style="margin-top: 5px">
                            <div id="bloodhound">
                                {{$user->name}}
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-4 col-form-label">
                            <div class="pull-right" style="font-weight: bold">
                                Email
                            </div>
                        </label>
                        <div class="col-8" style="margin-top: 5px">
                            {{$user->email}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-4 col-form-label">
                            <div class="pull-right" style="font-weight: bold">
                                Phone
                            </div>
                        </label>
                        <div class="col-8" style="margin-top: 5px">
                            {{$user->phone}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-4 col-form-label">
                            <div class="pull-right" style="font-weight: bold">
                                Level
                            </div>
                        </label>
                        <div class="col-8" style="margin-top: 5px">
                            {{$user->level}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-4 col-form-label">
                            <div class="pull-right" style="font-weight: bold">
                                
                            </div>
                        </label>
                        <div class="col-8" style="margin-top: 5px">
                            <a class="btn btn-primary btn-sm text-white" href="{{route('user', $user->level)}}">
                                <i class="flaticon2-arrow-left"></i> Back
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
  
      