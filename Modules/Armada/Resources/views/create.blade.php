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
        <a href="{{route('armada.create')}}" class="kt-subheader__breadcrumbs-link">
            Create Armada
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
                    Pada page ini anda dapat menambahkan data armada
                </div>
            </div>
        </div>
    </div>

    <div class="kt-portlet">
        <div class="kt-portlet__body">
            @include('layouts.notification')
            <form action="{{route('armada.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="row">
                    {{-- Input field --}}
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    Tipe Armada <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Tipe Armada"></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <select class="form-control" name="id_tipe_armada" required>
                                    <option value="">Pilih Tipe Armada</option>
                                    @foreach ($tipe_armada as $item)
                                        <option value="{{ $item['id'] }}">{{ ucfirst($item['tipe']) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    Kode Armada <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Masukkan Kode Armada, atau Anda dapat mengacak kode secara random"></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <div class="input-group">
                                    <input class="form-control" type="text" name="kode_armada" placeholder="E.g: AVANZA4000cc" autocomplete="off" required>
                                    <div class="input-group-append">
                                        <a class="btn btn-secondary" id="btn-acak">#Acak Kode</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    Status Armada <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Status Armada"></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <select class="form-control" name="status_armada" required>
                                    <option value="">Pilih Status Armada</option>
                                    @foreach ($status_armada as $item)
                                        <option value="{{ $item }}">{{ ucfirst($item) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    Status Driver <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Status Driver"></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <select class="form-control" name="status_driver" required>
                                    <option value="">Pilih Status Driver</option>
                                    @foreach ($status_driver as $item)
                                        <option value="{{ $item }}">{{ ucfirst($item) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    Harga Sewa <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Masukkan Harga Sewa Armada"></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <input class="form-control" type="text" name="price" id="price" placeholder="Masukkan Harga Sewa" autocomplete="off" min="0" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    Gambar <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Masukkan Foto/Gambar Armada"></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <input class="form-control" type="file" name="photo" id="photo" accept="image/x-png,image/gif,image/jpeg" autocomplete="off" required>
                            </div>
                        </div>
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

@section('scripts')
    <script>
        $('#price').on('keyup',function(e){
            $("#price").inputmask({ alias : "currency", prefix: 'Rp ',rightAlign: false, 'digits': '0',autoUnmask: true });
        });
    </script>
@endsection