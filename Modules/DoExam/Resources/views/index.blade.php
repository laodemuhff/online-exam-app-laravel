@extends('layouts.app')

@section('title', 'Do Exam')

@section('styles')
    <link rel="stylesheet" href="{{asset('package/TimeCircles.css')}}">
@endsection

@section('breadcrumb')
    <h3 class="kt-subheader__title">
        Exam Session History
    </h3>
    <span class="kt-subheader__separator kt-hidden"></span>
    <div class="kt-subheader__breadcrumbs">
        <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
        <a href="{{route('register-session')}}" class="kt-subheader__breadcrumbs-link">
            Exam Session History
        </a>
    </div>
@endsection

@section('content')
    @include('layouts.notification')

    <ul class="nav nav-pills nav-fill" role="tablist">
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#pending_exam">Pending Exam</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#running_exam">Running Exam</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#on_evaluation">On Evaluation</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#reviewed_exam">Reviewed Exam</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#invalid_exam">Invalid Exam</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" id="pending_exam" role="tabpanel">
            @include('doexam::layouts.table', ['history_status' => 'pending_exam'])
        </div>
        <div class="tab-pane active" id="running_exam" role="tabpanel">
            @include('doexam::layouts.table', ['history_status' => 'running_exam'])
        </div>
        <div class="tab-pane" id="on_evaluation" role="tabpanel">
            @include('doexam::layouts.table', ['history_status' => 'on_evaluation'])
        </div>
        <div class="tab-pane" id="reviewed_exam" role="tabpanel">
            @include('doexam::layouts.table', ['history_status' => 'reviewed_exam'])
        </div>
        <div class="tab-pane" id="invalid_exam" role="tabpanel">
            @include('doexam::layouts.table', ['history_status' => 'invalid_exam'])
        </div>
    </div>
    {{-- <div id="DateCountdown" data-date="2021-01-10 9:14:00" style="width: 100%;"></div> --}}
@endsection

@section('scripts')
    {{-- <script src="{{ asset('package/TimeCircles.js') }}"></script>

    <script>
        $(function(){
            $("#DateCountdown").TimeCircles({
                "animation": "smooth",
                "bg_width": 1.2,
                "fg_width": 0.1,
                "circle_bg_color": "#60686F",
                "time": {
                    "Days": {
                        "text": "Days",
                        "color": "#FFCC66",
                        "show": true
                    },
                    "Hours": {
                        "text": "Hours",
                        "color": "#99CCFF",
                        "show": true
                    },
                    "Minutes": {
                        "text": "Minutes",
                        "color": "#BBFFBB",
                        "show": true
                    },
                    "Seconds": {
                        "text": "Seconds",
                        "color": "#FF9999",
                        "show": true
                    }
                }
            });
        })
    </script> --}}
@endsection
