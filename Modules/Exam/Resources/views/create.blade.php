@extends('layouts.app')

@section('title', 'Exam Management')
@section('exam', 'kt-menu__item--open')
@section('exam-create', 'kt-menu__item--active')

@section('styles')
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
    <link rel="stylesheet" href="https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/examples/assets/app.css">
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <style>
        .badge-info{
            margin-left: 4px !important;
           
        }

        /* autocomplete tagsinput*/
        .label-info {
            background-color: #5bc0de;
            display: inline-block;
            padding: 0.2em 0.6em 0.3em;
            font-size: 100%;
            font-weight: 700;
            line-height: 1;
            color: #fff;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0.25em;
        }

        .oecps-explanation-box{
            height: auto;
            width: 100%;
        }

        .oecps-explanation-header{
            border: dashed 1px rgb(155, 152, 152);
            padding: 3%;
            position: relative;
        }

        .oecps-explanation-body{
            border: dashed 1px rgb(155, 152, 152);
            border-top: none;
            padding: 5%;
            display: none;
        }

        .oecps-title{
            font-weight: bold;
        }

        .oecps-subtitle{
            font-weight: 100 !important;
            font-style: italic !important;
        }

        .oecps-explanation-item{
            width: 100%;
            overflow-wrap: break-word;
            margin-bottom: 3%;
            text-align: justify;
            font-size: 1em;
            line-height: 2em;
        }

        .oecps-enable-button{
            float: right;
            position: absolute;
            right: 4px;
            top: 7px;
        }

        .oecps-explanatory{
            cursor: pointer;
        }

    </style>
@endsection

@section('breadcrumb')
    <h3 class="kt-subheader__title">
        Exam Management
    </h3>
    <span class="kt-subheader__separator kt-hidden"></span>
    <div class="kt-subheader__breadcrumbs">
        <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
        <a href="{{route('exam.create')}}" class="kt-subheader__breadcrumbs-link">
            Create Exam
        </a>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="alert alert-light alert-elevate fade show" role="alert">
                <div class="alert-icon"><i class="flaticon-information kt-font-info"></i></div>
                <div class="alert-text">
                    Pada page ini anda dapat membuat Exam beserta Base Question dari Exam
                </div>
            </div>
        </div>
    </div>

    @include('layouts.notification')
    <form action="{{route('exam.store')}}" method="POST">
        @csrf
        <div class="kt-portlet">
            <div class="row">
                <div class="col-md-12">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-caption">
                            <div class="kt-portlet__head-title" style="padding-top: 30%">
                                <h5>Exam Info</h5>
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
                                <div class="pull-right">
                                    Exam Subjects <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Exam Subjects"></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <div id="bloodhound">
                                    <input name="exam_subjects" class="typeahead tags" type="text" class="form-control" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    Exam Title <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Exam Title"></i>
                                </div>
                            </label>
                            <div class="col-8">
                            <input type="text" class="form-control" placeholder="Exam Title" name="exam_title" value="{{old('exam_title')}}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    Maximum Score <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Exam Status"></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <input type="number" min="0" class="form-control" placeholder="Max Score" name="max_score" value="{{old('max_score') ?? '100' }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    Default Point <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Exam Status"></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <div class="input-grup row" style="margin-left: 1px">
                                    <div class="input-group-prepend" style="padding-right: 0">
                                        <span class="input-group-text btn btn-danger"><i class="la la-times"></i></span>
                                    </div>
                                    <input type="number" max="0" class="form-control col-md-3" name="default_wrong_point" value="{{old('default_wrong_point') ?? '0'}}" required>
                                    
                                    <div class="input-group-prepend" style="padding-right: 0; margin-left:15px">
                                        <span class="input-group-text btn btn-success"><i class="la la-check"></i></span>
                                    </div>
                                    <input type="number" min="0" class="form-control col-md-3" name="default_correct_point" value="{{old('default_correct_point') ?? '1'}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    OECPs <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Exam Status"></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <div class="oecps-explanation-box">
                                    <div class="oecps-explanation-header">
                                        <div class="oecps-enable-button">
                                            <div class="input-group">
                                                <input type="checkbox" checked data-toggle="toggle" name="oecp_1" style="width: 50px" data-on="Enable" data-off="Disable">
                                            </div>
                                        </div>
                                        <div class="oecps-title">
                                            OECP 1 - <span class="oecps-subtitle">Pengaturan Jadwal Ujian</span> &nbsp;<a class="oecps-explanatory" title="Show Explanatory" onclick="detailExplanatory(this)"><i class="la la-angle-double-down"></i></a>
                                        </div>
                                    </div>
                                    <div class="oecps-explanation-body">
                                        <div class="oecps-explanation-item">Jika Status <span class="badge badge-success" style="font-size:0.9em">Enabled</span>&nbsp;, maka pengaturan jadwal ujian pada tanggal dan waktu yang spesifik akan diaktifkan saat pembuatan sesi</div>
                                        <div class="oecps-explanation-item">Jika Status <span class="badge badge-danger" style="font-size:0.9em">Disabled</span>&nbsp;, maka tidak ada penjadwalan ujian dan petugas bebas mengaktifkan sesi kapan saja</div>
                                    </div>
                                </div>
                                <br>
                                <div class="oecps-explanation-box">
                                    <div class="oecps-explanation-header">
                                        <div class="oecps-enable-button">
                                            <div class="input-group">
                                                <input type="checkbox" checked data-toggle="toggle" name="oecp_2" style="width: 50px" data-on="Enable" data-off="Disable">
                                            </div>
                                        </div>
                                         <div class="oecps-title">
                                            OECP 2 - <span class="oecps-subtitle">Timer Batas Masuk ke Sesi</span> &nbsp;<a class="oecps-explanatory" title="Show Explanatory" onclick="detailExplanatory(this)"><i class="la la-angle-double-down"></i></a>
                                        </div>
                                    </div>
                                    <div class="oecps-explanation-body">
                                        <div class="oecps-explanation-item">Jika Status <span class="badge badge-success" style="font-size:0.9em">Enabled</span>&nbsp;, maka pengaturan <i>timer</i> batas registrasi sesi ujian akan dimunculkan pada saat membuat sesi dan sifatnya adalah <i>required</i></div>
                                        <div class="oecps-explanation-item">Jika Status <span class="badge badge-danger" style="font-size:0.9em">Disabled</span>&nbsp;, maka tidak ada pengaturan untuk <i>timer</i> registrasi sesi ujian saat pembuatan sesi, sehingga peserta dapat masuk ke sesi kapan saja selama sesi masih berlangsung.</div>
                                    </div>
                                </div>
                                <br>
                                <div class="oecps-explanation-box">
                                    <div class="oecps-explanation-header">
                                        <div class="oecps-enable-button">
                                            <div class="input-group">
                                                <input type="checkbox" checked data-toggle="toggle" name="oecp_3" style="width: 50px" data-on="Enable" data-off="Disable">
                                            </div>
                                        </div>
                                         <div class="oecps-title">
                                            OECP 3 - <span class="oecps-subtitle">Pengacakan Soal dan Jawaban</span> &nbsp;<a class="oecps-explanatory" title="Show Explanatory" onclick="detailExplanatory(this)"><i class="la la-angle-double-down"></i></a>
                                        </div>
                                    </div>
                                    <div class="oecps-explanation-body">
                                        <div class="oecps-explanation-item">Jika Status <span class="badge badge-success" style="font-size:0.9em">Enabled</span>&nbsp;, maka secara otomatis urutan soal dan jawaban akan diacak saat sesi berlangsung</div>
                                        <div class="oecps-explanation-item">Jika Status <span class="badge badge-danger" style="font-size:0.9em">Disabled</span>&nbsp;, maka tidak ada pengacakan soal dan jawaban, urutan akan disesuaikan dengan urutan yang dibuat oleh petugas ujian</div>
                                    </div>
                                </div>
                                <br>
                                <div class="oecps-explanation-box">
                                    <div class="oecps-explanation-header">
                                        <div class="oecps-enable-button">
                                            <div class="input-group">
                                                <input type="checkbox" checked data-toggle="toggle" name="oecp_4" style="width: 50px" data-on="Enable" data-off="Disable">
                                            </div>
                                        </div>
                                         <div class="oecps-title">
                                            OECP 4 - <span class="oecps-subtitle">Pembatasan Navigasi Soal</span> &nbsp;<a class="oecps-explanatory" title="Show Explanatory" onclick="detailExplanatory(this)"><i class="la la-angle-double-down"></i></a>
                                        </div>
                                    </div>
                                    <div class="oecps-explanation-body">
                                        <div class="oecps-explanation-item">Jika Status <span class="badge badge-success" style="font-size:0.9em">Enabled</span>&nbsp;, maka peserta yang mengikuti sesi ujian tidak dapat melakukan navigasi soal, sehingga soal dimunculkan satu per satu secara berurutan.</div>
                                        <div class="oecps-explanation-item">Jika Status <span class="badge badge-danger" style="font-size:0.9em">Disabled</span>&nbsp;, maka peserta yang mengikuti sesi ujian dapat melakukan navigasi soal secara bebas</div>
                                    </div>
                                </div>
                                <br>
                                <div class="oecps-explanation-box">
                                    <div class="oecps-explanation-header">
                                        <div class="oecps-enable-button">
                                            <div class="input-group">
                                                <input type="checkbox" checked data-toggle="toggle" name="oecp_5" style="width: 50px" data-on="Enable" data-off="Disable">
                                            </div>
                                        </div>
                                         <div class="oecps-title">
                                            OECP 5 - <span class="oecps-subtitle">Pengaturan Interval Ujian</span> &nbsp;<a class="oecps-explanatory" title="Show Explanatory" onclick="detailExplanatory(this)"><i class="la la-angle-double-down"></i></a>
                                        </div>
                                    </div>
                                    <div class="oecps-explanation-body">
                                        <div class="oecps-explanation-item">Jika Status <span class="badge badge-success" style="font-size:0.9em">Enabled</span>&nbsp;, maka akan dimunculkan pengaturan interval ujian pada saat pembuatan sesi, sehingga ujian akan otomatis berakhir ketika interval habis</div>
                                        <div class="oecps-explanation-item">Jika Status <span class="badge badge-danger" style="font-size:0.9em">Disabled</span>&nbsp;, maka tidak ada pengaturan interval ujian saat pembuatan sesi, sehingga lama ujian adalah sampai petugas memberhentikan secara manual di sistem</div>
                                    </div>
                                </div>
                                <br>
                                <div class="oecps-explanation-box">
                                    <div class="oecps-explanation-header">
                                        <div class="oecps-enable-button">
                                            <div class="input-group">
                                                <input type="checkbox" checked data-toggle="toggle" name="oecp_6" style="width: 50px" data-on="Enable" data-off="Disable">
                                            </div>
                                        </div>
                                         <div class="oecps-title">
                                            OECP 6 - <span class="oecps-subtitle">Pembatasan Akses Sesi Ujian</span> &nbsp;<a class="oecps-explanatory" title="Show Explanatory" onclick="detailExplanatory(this)"><i class="la la-angle-double-down"></i></a>
                                        </div>
                                    </div>
                                    <div class="oecps-explanation-body">
                                        <div class="oecps-explanation-item">Jika Status <span class="badge badge-success" style="font-size:0.9em">Enabled</span>&nbsp;, maka sesi ujian hanya dapat diakses sekali dalam satu waktu, jika ada gangguan koneksi internet atau sistem logout maka sesi akan berakhir</div>
                                        <div class="oecps-explanation-item">Jika Status <span class="badge badge-danger" style="font-size:0.9em">Disabled</span>&nbsp;, maka sesi ujian tetap dapat diakses atau dilanjutkan meskipun terjadi gangguan koneksi internet ataupun logout</div>
                                    </div>
                                </div>
                                <br>
                                <div class="oecps-explanation-box">
                                    <div class="oecps-explanation-header">
                                        <div class="oecps-enable-button">
                                            <div class="input-group">
                                                <input type="checkbox" checked data-toggle="toggle" name="oecp_8" style="width: 50px" data-on="Enable" data-off="Disable">
                                            </div>
                                        </div>
                                         <div class="oecps-title">
                                            OECP 8 - <span class="oecps-subtitle">Pengecekan Kemiripan Soal Ujian</span> &nbsp;<a class="oecps-explanatory" title="Show Explanatory" onclick="detailExplanatory(this)"><i class="la la-angle-double-down"></i></a>
                                        </div>
                                    </div>
                                    <div class="oecps-explanation-body">
                                        <div class="oecps-explanation-item">Jika Status <span class="badge badge-success" style="font-size:0.9em">Enabled</span>&nbsp;, maka pengecekan akurasi kemiripan ujian dengan ujian terdahulu (yang telah selesai) akan aktif saat pembuatan sesi ujian. Oleh karena itu, sesi yang memiliki kesamaan dengan sesi terdahulu tidak dapat dimulai dan harus dimodifikasi terlebih dahulu oleh petugas ujian.</div>
                                        <div class="oecps-explanation-item">Jika Status <span class="badge badge-danger" style="font-size:0.9em">Disabled</span>&nbsp;, maka tidak ada pengecekan akurasi kemiripan antar sesi ujian, sehingga akan ada kemungkinan sesi ujian sama persis dengan ujian terdahulu</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    Exam Status <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Exam Status"></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <input type="checkbox" checked data-toggle="toggle" data-size="sm" name="exam_status" style="width: 50px" data-on="Activate" data-off="Deactivate">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    
        <div class="kt-portlet" id="questions-form" style="display: none">
            <div class="row">
                <div class="col-md-12">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-caption">
                            <div class="kt-portlet__head-title" style="padding-top: 13%">
                                <h5>Questions & Answers</h5>
                            </div>
                        </div>
                        {{-- <div class="kt-portlet__head-caption">
                            <div class="kt-portlet__head-title" style="padding-top: 4%">
                                <div class="btn-group-horizontal" role="group" aria-label="Horizontal button group">
                                    <a type="button" class="btn btn-info" data-toggle='modal' data-target='#search-questions-modal' style="color: white"><i class="la la-search"></i> Search Questions</a>
                                    <a type="button" class="btn btn-info" style="color: white"><i class="la la-copy"></i> Copy Existing Exam</a>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div id="kt_repeater_2">
                <div class="kt-portlet__body" data-repeater-list = "group-questions" style="padding-top:0 !important; padding-bottom:0 !important">
                    @include('layouts.notification')
                    <div data-repeater-item="" class="row repeater-item" style="margin-top:5%; border-bottom:dashed 1px rgb(138, 132, 132)">
                        <div class="col-md-10">
                            {{-- <div class="form-group row">
                                <div class="col-md-3">
                                    <label for="" class="col-form-label pull-right">
                                        Subject <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Exam Subjects"></i>
                                    </label>
                                </div>
                                <div class="col-md-9">
                                    <div id="bloodhound">
                                        <input name="question_subjects" class="typeahead tags" type="text" class="form-control" autocomplete="off">
                                    </div>
                                </div>
                            </div> --}}
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label for="" class="col-form-label pull-right">
                                        Question Type <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Exam Subjects"></i>
                                    </label>
                                </div>
                                <div class="col-md-9">
                                    <select name="type" class="form-control question_type" onchange="setOptionGroup(this)" required disabled>
                                        <option value="">Pilih Question Type</option>
                                        <option value="essay">Essay</option>
                                        <option value="multiple_choice">Multiple Choice</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label for="" class="col-form-label pull-right">
                                        Question Description <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Exam Subjects"></i>
                                    </label>
                                </div>
                                <div class="col-md-9">
                                    <textarea class="summernote" name="question_description" required></textarea>
                                </div>
                            </div>
                            <div class="form-group row options" style="display: none">
                                <div class="col-md-3">
                                    <label for="" class="col-form-label pull-right">
                                        Options <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Exam Subjects"></i>
                                    </label>
                                </div>
                                <div class="col-md-9">
                                    <!-- innner repeater -->
                                    <div class="inner-repeater">
                                        <div data-repeater-list="group-options">
                                            <div data-repeater-item style="margin-bottom:1%" class="inner-repeater-item">
                                                <div class="input-group row">
                                                    <div class="input-group-prepend col-md-2" style="padding-right:0 !important">
                                                        <a type="button" class="btn btn-light" style="width: 100%; border:solid 1px rgb(197, 194, 194)">Label</a>
                                                    </div>
                                                    <input type="text" name="option_label" class="form-control-sm col-md-2 option_label" value="A" style="border:solid 1px rgb(197, 194, 194); max-width:12% !important; text-align:center" readonly/>
                                                    <div class="input-group-prepend col-md-2" style="padding-right:0 !important;padding-left:0 !important">
                                                        <a type="button" class="btn btn-light" style="width: 100%; border:solid 1px rgb(197, 194, 194)">Value</a>
                                                    </div>
                                                    <input type="text" name="option_description" class="form-control-sm col-md-4 input-sm option_description" value="Jawaban Option" style="border:solid 1px rgb(197, 194, 194)" required disabled/>
                                                    <input type="checkbox" name="answer_status" class="form-control-sm col-md-1 answer_status" onclick="reinitAnswerStatus(this)" checked/>
                                                    <input data-repeater-delete type="button" class="btn btn-danger col-md-1 btn-delete-inner-repeater-item" value="X" onclick="reArrangeOptionLabel(this)"/>
                                                </div>
                                            </div>
                                        </div>
                                        <input data-repeater-create type="button" value="+ Add Option" class="btn btn-light btn-add-inner-repeater-item" style="border:solid 1px rgb(197, 194, 194)" onclick="setNextLabel(this)"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row points" style="display: none">
                                <label class="col-md-3">
                                    <div class="col-form-label pull-right">
                                        Point <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Exam Status"></i>
                                    </div>
                                </label>
                                <div class="col-md-9">
                                    <div class="input-grup row" style="margin-left: 1px">
                                        <div class="input-group-prepend wrong-point" style="padding-right: 0; display:none">
                                            <span class="input-group-text btn btn-danger"><i class="la la-times"></i></span>
                                        </div>
                                        <input type="number" max="0" class="form-control col-md-2 input-sm wrong-point" name="wrong_point" style="display:none" disabled required>
                                        
                                        <div class="input-group-prepend correct-point" style="padding-right: 0; margin-left:15px; display:none">
                                            <span class="input-group-text btn btn-success"><i class="la la-check"></i></span>
                                        </div>
                                        <input type="number" min="0" class="form-control col-md-2 input-sm correct-point" name="correct_point" style="display:none" disabled required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3"></div>
                                <div class="col-md-9">
                                    <div class="form-check">
                                        <input type="checkbox" name="use_default_correct_point" class="form-check-input default-correct-checkbox" onchange="handleDefaultCorrectPoint(this)" checked>
                                        <label class="form-check-label default-correct-label" for="exampleCheck1">Use Default Correct Point</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3"></div>
                                <div class="col-md-9">
                                    <div class="form-check">
                                        <input type="checkbox" name="use_default_wrong_point" class="form-check-input default-wrong-checkbox" onchange="handleDefaultWrongPoint(this)" checked>
                                        <label class="form-check-label default-wrong-label" for="exampleCheck1">Use Default Wrong Point</label>
                                    </div>
                                </div>
                            </div>
                        </div>  
                        <div class="col-md-2">
                            <input data-repeater-delete="" type="button" value="X Delete Question" class="btn btn-danger"/>  
                        </div>
                    </div>
                </div>
                <input data-repeater-create="" type="button" value="+ Add Question" class="btn btn-light btn-add-repeater-item" style="width: 100%"/>
            </div>
        </div>

        <div class="kt-portlet" style="background:none; box-shadow:none">
            <div class="kt-form kt-form--fit kt-form--label-align-right">
                <div class="kt-portlet__foot kt-portlet__foot--fit" id="create-portlet" style="border-top: 0">
                    <div class="kt-form__actions ">
                        <div class="pull-right">
                            <a class="btn btn-success btn-sm white-text" id="add-questions-button">
                                <i class="la la-edit" style="font-weight: bold"></i> <span style="font-size: 1.1em; font-weight:bold" id="add-question-text">Create Questions & Answers</span> 
                            </a>
                            <button type="submit" class="btn btn-primary btn-sm">
                                <span style="font-size: 1.1em; font-weight:bold">Submit Create</span> 
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div id="search-questions-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="my-modal-title">Filter Existing Questions</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="get" action="" class="form">
                        @csrf
                        <div class="form-group">
                            <label for="filter_subjects">Subjects</label>
                            <div id="bloodhound">
                                <input id="filter_subjects" class="form-control typeahead tags" type="text" name="subjects" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="filter_type">Text</label>
                            <select id="filter_type" class="custom-select" name="type">
                                <option value="multiple_choice">Multiple Choice</option>
                                <option value="essay">Essay</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="question_keyword">Question Keyword</label>
                            <input id="question_keyword" class="form-control input-sm" type="text" name="keyword"  autocomplete="off">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <div class="btn-group float-right" role="group" aria-label="a">
                        <a href="" type="button" class="btn btn-info"><i class="la la-search"></i> Search</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
    <script src="https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="{{url('assets/demo/demo11/custom/crud/forms/widgets/form-repeater.js')}}" type="text/javascript"></script> 
    
    <script>
        $(document).ready(function() {
            
            var data = '<?php echo $subjects ?>'

            //get data pass to json
            var task = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.obj.whitespace("name"),
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                local: jQuery.parseJSON(data) //your can use json type
            });

            task.initialize();

            var elt = $(".tags");

            elt.tagsinput({
                itemValue: "id",
                itemText: "name",
                typeaheadjs: {
                    name: "task",
                    displayKey: "name",
                    source: task.ttAdapter()
                }
            });

            $('.summernote').summernote({
                tabsize: 2,
                height: 80,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold','italic']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
                        
            //handle click on add repeater item (questions)
            $("#kt_repeater_2").on('click','.btn-add-repeater-item', function(){
                $('#kt_repeater_2').find('.summernote').summernote({
                    tabsize: 2,
                    height: 80,
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold','italic']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['table', ['table']],
                        ['insert', ['link']],
                        ['view', ['fullscreen', 'codeview', 'help']]
                    ]
                });

            
                // $('.kt_repeater_2').find(".tags").tagsinput({
                //     itemValue: "id",
                //     itemText: "name",
                //     typeaheadjs: {
                //         name: "task",
                //         displayKey: "name",
                //         source: task.ttAdapter()
                //     }
                // });

                $('#kt_repeater_2').find(".default-correct-checkbox:last").prop('checked', true)
                $('#kt_repeater_2').find(".default-wrong-checkbox:last").prop('checked', true)
                $('#kt_repeater_2').find(".question_type:last").prop('disabled', false)
                $('#kt_repeater_2').find(".inner-repeater:last").find(".option_label").eq(0).val('A')
                $('#kt_repeater_2').find(".inner-repeater:last").find(".option_description").eq(0).val('Jawaban Option')
                $('#kt_repeater_2').find(".inner-repeater:last").find(".answer_status").eq(0).prop('checked', true)

                // handle bug delete confirmation on inner repeater triggering twice
                handleErrorDeleteOption();
            });

            // handle click on inner repeater item (options)

            // handle bug delete confirmation on inner repeater triggering twice
            handleErrorDeleteOption();
        });
    </script>

    <script>
        $('#add-questions-button').click(function(e){
            if($('#questions-form').is(':visible')){
                $('#questions-form').slideUp(150);
                $('#questions-form').eq(0).find('.question_type').prop('disabled', true)
                $('#questions-form').eq(0).find('.question_description').prop('disabled', true)
                $('#add-questions-button').removeClass('btn btn-warning').addClass('btn btn-success')
                $('#add-question-text').html('Add Questions & Answers');
                $(document).find('.option_description').prop('disabled', true)

            }else{
                $('#questions-form').slideDown(150);
                $('#questions-form').eq(0).find('.question_type').prop('disabled', false)
                $('#questions-form').eq(0).find('.question_description').prop('disabled', false)
                $('#add-questions-button').removeClass('btn btn-success').addClass('btn btn-warning')
                $('#add-question-text').html('Create Exam Only');
                $(document).find('.option_description').prop('disabled', false)
            }
        })
    </script>

    <script>
        function getIndexItemRepeater(selected_element){
            //get character between square brancket []
            var name = selected_element.name
            var outer = name.match(/group-questions\[(.*?)\]/);
            var inner = name.match(/\[group-options\]\[(.*?)\]/);
            var index = null;

            if(outer) {
                index = outer[1];
            }

            if(inner) {
                index = inner[1];
            }

            return index;
        }

        function setOptionGroup(selectedOption){
            var index = getIndexItemRepeater(selectedOption)
            var value = selectedOption.value
            
            if(value == 'multiple_choice'){
                $('.options').eq(index).slideDown(150);
                $('.options').eq(index).find('.option_description').prop('disabled', false)
            }else{
                $('.options').eq(index).slideUp(150);
                $('.options').eq(index).find('.option_description').prop('disabled', true)
            }
        }

        function setNextLabel(selectedAddButton){
            var index_repeater = $('.repeater-item').index($(selectedAddButton).closest('.repeater-item').get(0));
            var option_length = $('.repeater-item').eq(index_repeater).find('.inner-repeater-item').length
            var index = $('.btn-add-inner-repeater-item').index(selectedAddButton)
            var label_names = ['A', 'B', 'C', 'D', 'E', 'F', 'G'];
            
            $('.inner-repeater').eq(index).on('click', '.btn-add-inner-repeater-item', function(e){
                var last_label = $('.inner-repeater').eq(index).find('.option_label').eq(-2).val();
                var last_index = label_names.indexOf(last_label)

                if(last_index+1 < label_names.length){
                    var next_label = label_names[last_index+1];
                    $('.inner-repeater').eq(index).find('.option_label:last').val(next_label)

                    if(last_index+1 == label_names.length - 1){
                        $('.btn-add-inner-repeater-item').eq(index).prop('disabled', true)
                    }else{
                        $('.btn-add-inner-repeater-item').eq(index).prop('disabled', false)
                    }
                }
                
                $('.repeater-item').eq(index_repeater).find('.option_description').prop('disabled', false)

                if(option_length == 0){
                    let answer_status_length = $('.repeater-item').eq(index_repeater).find('.answer_status').length;
                    let is_checked_exist = false;
                    for(let i = 0; i < answer_status_length; i++){
                        if($('.repeater-item').eq(index_repeater).find('.answer_status').eq(i).prop('checked') == true) 
                            is_checked_exist = true;  
                    }

                    if(!is_checked_exist)
                        $('.repeater-item').eq(index_repeater).find('.answer_status').eq(0).prop('checked', true);
                }

            });
        }

        // re-arrange option label after deletion
        function reArrangeOptionLabel(clickedDeleteButton){
            var index_repeater = $('.repeater-item').index($(clickedDeleteButton).closest('.repeater-item').get(0));
            var inner_repeater_item = $('.repeater-item').eq(index_repeater).find('.inner-repeater-item')
            var option_length = inner_repeater_item.length;
            var index_deleted_option = inner_repeater_item.find('.btn-delete-inner-repeater-item').index(clickedDeleteButton)
            var label_names = ['A', 'B', 'C', 'D', 'E', 'F', 'G'];

            var count = 0;
            var check_answer_status = true;
            
            
            for (let index = 0; index < option_length; index++) {
                if(index != index_deleted_option){
                    $('.repeater-item').eq(index_repeater).find('.option_label').eq(index).val(label_names[count++]);
                    $('.repeater-item').eq(index_repeater).find('.btn-delete-inner-repeater-item').eq(index).prop('disabled', true);
                    
                    if(check_answer_status && $('.repeater-item').eq(index_repeater).find('.answer_status').eq(index_deleted_option).prop('checked') == true){
                        $('.repeater-item').eq(index_repeater).find('.answer_status').eq(index).prop('checked', true);
                        check_answer_status = false;
                    }
                }

            }

            setTimeout(function(){ $('.repeater-item').eq(index_repeater).find('.btn-delete-inner-repeater-item').prop('disabled', false) }, 500);
            $('.btn-add-inner-repeater-item').eq(index_repeater).prop('disabled', false)
        } 

        // handle bug delete confirmation on inner repeater triggering twice
        function handleErrorDeleteOption(){
            $('.inner-repeater').on('click', '[data-repeater-delete]', function(event) {
                event.stopPropagation(); // added this
                var self = $(this).closest('[data-repeater-item]').get(0);
            });
        }

        function reinitAnswerStatus(checkedAnswerStatus){
            var index_repeater = $('.repeater-item').index($(checkedAnswerStatus).closest('.repeater-item').get(0));
            var inner_repeater_item = $('.repeater-item').eq(index_repeater).find('.inner-repeater-item')
            var option_length = inner_repeater_item.length;
            var index_checked_answer_status = inner_repeater_item.find('.answer_status').index(checkedAnswerStatus)

            var count = 0;
            for (let index = 0; index < option_length; index++) {
                if(index != index_checked_answer_status){
                    $('.repeater-item').eq(index_repeater).find('.answer_status').eq(index).prop('checked', false);
                }
            }
           
            if($(checkedAnswerStatus).prop('checked') == false){
                $('.repeater-item').eq(index_repeater).find('.answer_status').eq(index_checked_answer_status).prop('checked', true);
            }
            
        }

    </script>

    <script>
        function handleDefaultCorrectPoint(checked_element){
            let index_repeater = $('.repeater-item').index($(checked_element).closest('.repeater-item').get(0));

            if($(checked_element).prop('checked') == false){
                $('.repeater-item').eq(index_repeater).find('.points').show();
                $('.repeater-item').eq(index_repeater).find('.correct-point').show();
                $('.repeater-item').eq(index_repeater).find('.correct-point').prop('disabled', false);

                if($('.repeater-item').eq(index_repeater).find('.wrong-point').css('display') == 'none'){
                    $('.repeater-item').eq(index_repeater).find('.input-group-prepend.correct-point').css('margin-left', 0);
                }else{
                    $('.repeater-item').eq(index_repeater).find('.input-group-prepend.correct-point').css('margin-left', '15px');
                }

                $('.repeater-item').eq(index_repeater).find('.default-correct-label').css('text-decoration','line-through');
            }
            else{
                if($('.repeater-item').eq(index_repeater).find('.wrong-point').css('display') == 'none')
                    $('.repeater-item').eq(index_repeater).find('.points').hide();

                $('.repeater-item').eq(index_repeater).find('.input-group-prepend.correct-point').css('margin-left', '15px');
                $('.repeater-item').eq(index_repeater).find('.correct-point').hide();
                $('.repeater-item').eq(index_repeater).find('.correct-point').prop('disabled', true);
                $('.repeater-item').eq(index_repeater).find('.default-correct-label').css('text-decoration','none');
            }
        }

        function handleDefaultWrongPoint(checked_element){
            let index_repeater = $('.repeater-item').index($(checked_element).closest('.repeater-item').get(0));

            if($(checked_element).prop('checked') == false){
                $('.repeater-item').eq(index_repeater).find('.input-group-prepend.correct-point').css('margin-left', '15px');
                $('.repeater-item').eq(index_repeater).find('.points').show();
                $('.repeater-item').eq(index_repeater).find('.wrong-point').show();
                $('.repeater-item').eq(index_repeater).find('.wrong-point').prop('disabled', false);
                $('.repeater-item').eq(index_repeater).find('.default-wrong-label').css('text-decoration','line-through');
            }
            else{
                $('.repeater-item').eq(index_repeater).find('.input-group-prepend.correct-point').css('margin-left', 0);

                if($('.repeater-item').eq(index_repeater).find('.correct-point').css('display') == 'none')
                    $('.repeater-item').eq(index_repeater).find('.points').hide();

                $('.repeater-item').eq(index_repeater).find('.wrong-point').hide();
                $('.repeater-item').eq(index_repeater).find('.wrong-point').prop('disabled', true);
                $('.repeater-item').eq(index_repeater).find('.default-wrong-label').css('text-decoration','none');
            }
        }

    </script>

    <script>
        function detailExplanatory(clickedExplanatory){
            let index = $('.oecps-explanatory').index(clickedExplanatory);

            let angle_classname = $('.oecps-explanatory i').eq(index).attr('class')

            if(angle_classname == "la la-angle-double-down"){
                $('.oecps-explanation-body').eq(index).slideDown(150);
                $('.oecps-explanatory i').eq(index).attr('class', 'la la-angle-double-up')
                $('.oecps-explanatory').eq(index).attr('title', 'Hide Explanatory')
            }else{
                $('.oecps-explanation-body').eq(index).slideUp(150);
                $('.oecps-explanatory i').eq(index).attr('class', 'la la-angle-double-down')
                $('.oecps-explanatory').eq(index).attr('title', 'Show Explanatory')
            }

        }

    </script>
@endsection