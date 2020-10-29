
@extends('layouts.app')

@section('title', 'Setting Maintenance Mode')

@section('breadcrumb')
    <h3 class="kt-subheader__title">
        Setting Maintenance Mode
    </h3>
    <span class="kt-subheader__separator kt-hidden"></span>
    <div class="kt-subheader__breadcrumbs">
        <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
        <a href="{{route('armada.create')}}" class="kt-subheader__breadcrumbs-link">
            Update Maintenance Mode
        </a>
    </div>
@endsection

@section('styles')
    <style>

        #btn-acak:hover{
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="alert alert-light alert-elevate fade show" role="alert">
                <div class="alert-icon"><i class="flaticon-information kt-font-info"></i></div>
                <div class="alert-text">
                    Pada page ini anda dapat mengupdate setting maintenance mode
                </div>
            </div>
        </div>
    </div>

    <div class="kt-portlet">
        <div class="kt-portlet__body">
            @include('layouts.notification')
            <form action="{{route('setting.maintenance.mode.update')}}" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="row">
                    {{-- Input field --}}
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    Start Date <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Start Date"></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <input class="form-control" type="date" name="maintenance_start_date" id="maintenance_start_date" value="{{ isset($maintenance_start_date) ? date('Y-m-d', strtotime($maintenance_start_date)) : date('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    End Date<span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="End Date"></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <input class="form-control" type="date" name="maintenance_end_date" id="maintenance_end_date" value="{{ isset($maintenance_end_date) ? date('Y-m-d', strtotime($maintenance_end_date)) : date('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    Background <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Background"></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <input class="form-control" type="file" name="maintenance_background" id="maintenance_background" accept="image/x-png,image/gif,image/jpeg" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4"></div>
                            <div class="col-md-8">
                                <img src="{{ $maintenance_background ?? '' }}" alt="" width="150" style="border: #ccc solid 1px">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    Image <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Image"></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <input class="form-control" type="file" name="maintenance_image" id="maintenance_image" accept="image/x-png,image/gif,image/jpeg" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4"></div>
                            <div class="col-md-8">
                                <img src="{{ $maintenance_image ?? '' }}" alt="" width="150" style="border: #ccc solid 1px">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    Title<span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Title"></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <input class="form-control" type="text" name="maintenance_title" id="maintenance_title" placeholder="Masukkan Maintenance Title" autocomplete="off" min="0" value="{{ $maintenance_title ?? ''}}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    Content <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Masukkan Foto/Gambar Armada"></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <textarea class="form-control" name="maintenance_content" id="maintenance_content" cols="30" rows="10">{{$maintenance_content ?? ''}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    Status <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Aktifkan/Matikan Maintenance Mode"></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <!-- Rounded switch -->
                                <div class="col-md-4">
                                    <label class="switch">
                                        <input type="checkbox" name="maintenance_status" @if(isset($maintenance_status) && $maintenance_status == 1) checked @endif>
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
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

@section('scripts')
    <script>
        $('#price').on('keyup',function(e){
            $("#price").inputmask({ alias : "currency", prefix: 'Rp ',rightAlign: false, 'digits': '0',autoUnmask: true });
        });
    </script>
@endsection