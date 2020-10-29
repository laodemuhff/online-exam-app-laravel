@extends('layouts.app')

@section('title', 'Create Transaction')
@section('transaction', 'kt-menu__item--open')

@section('breadcrumb')
    <h3 class="kt-subheader__title">
        Transaction Management
    </h3>
    <span class="kt-subheader__separator kt-hidden"></span>
    <div class="kt-subheader__breadcrumbs">
        <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
        <a href="{{route('transaction.create')}}" class="kt-subheader__breadcrumbs-link">
            Create Transaction
        </a>
    </div>
@endsection

@section('styles')
    <style>

    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="alert alert-light alert-elevate fade show" role="alert">
                <div class="alert-icon"><i class="flaticon-information kt-font-info"></i></div>
                <div class="alert-text">
                    Pada page ini anda dapat membuat transaksi baru
                </div>
            </div>
        </div>
    </div>
    @include('layouts.notification')

    <form action="{{route('transaction.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="m-portlet__head-caption" style="padding-top:15px">
                    <div class="m-portlet__head-title">
                        <h4 class="m-portlet__head-text">
                        Customer Info
                        </h4>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="row">
                    {{-- Input field --}}
                    <div class="col-md-8">
                        <div class="form-group row">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    Nama Customer <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Nama Customer"></i>
                                </div>
                            </label>
                            <div class="col-8">
                            <input type="text" name="nama_customer" id="nama_customer" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    No. Telepon Customer <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="No. Telp."></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <div class="input-group">
                                    <input class="form-control" type="text" name="no_hp_customer" id="no_hp_customer" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    Alamat Customer <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Alamat Customer"></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <textarea name="alamat_customer" id="alamat_customer" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="m-portlet__head-caption" style="padding-top:15px">
                    <div class="m-portlet__head-title">
                        <h4 class="m-portlet__head-text">
                        Transaction Info
                        </h4>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="row">
                    {{-- Input field --}}
                    <div class="col-md-8">
                        <div class="form-group row">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    Tipe Armada <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Tipe Armada"></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <select class="form-control" name="tipe_armada" id="tipe_armada" required>
                                    <option value="">Pilih Tipe Armada</option>
                                    @foreach ($tipe_armada as $item)
                                        <option value="{{ $item['id'] }}">{{ ucfirst($item['tipe']) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row" style="display: none">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    Armada <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Armada"></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <select class="form-control" name="id_armada" id="armada" required>
                                    {{-- generate armada --}}
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    Durasi Sewa <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Durasi Sewa (hari)"></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <a class="btn btn-secondary">Days</a>
                                    </div>
                                    <input class="form-control" type="number" min="1" name="durasi_sewa" id="durasi_sewa" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    Pickup Date <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Pickup Date"></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <input class="form-control" type="date" name="pickup_date" id="pickup_date" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    Status Lepas Kunci <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Status Lepas Kunci"></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <select name="status_lepas_kunci" id="status_lepas_kunci" class="form-control">
                                    <option value="">Pilih Status Lepas Kunci</option>
                                    @foreach ($status_lepas_kunci as $item)
                                        <option value="{{$item}}">{{$item}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    Status Pengambilan <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Status Pengambilan"></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <select name="status_pengambilan" id="status_pengambilan" class="form-control">
                                    <option value="">Pilih Status Pengambilan</option>
                                    @foreach ($status_pengambilan as $item)
                                        <option value="{{$item}}">{{$item}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    Grand Total <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Grand Total"></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <input type="text" min="0" class="form-control" name="grand_total" id="grand_total" value="Rp 0" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="pull-right">
                    <button class="btn btn-primary btn-sm">
                        <i class="flaticon2-send-1"></i> Create
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('scripts')
    <script>
        $('#grand_total').on('keyup',function(e){
            $("#grand_total").inputmask({ alias : "currency", prefix: 'Rp ',rightAlign: false, 'digits': '0',autoUnmask: true });
        });
    </script>
@endsection