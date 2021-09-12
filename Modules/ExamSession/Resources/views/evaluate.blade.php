@extends('layouts.app')

@section('title', 'Exam Session Management')
@section('exam-session', 'kt-menu__item--open')
@section('exam-session-list-'.$status, 'kt-menu__item--active')

@section('styles')
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
@endsection

@section('breadcrumb')
    <h3 class="kt-subheader__title">
        Exam Session Management
    </h3>
    <span class="kt-subheader__separator kt-hidden"></span>
    <div class="kt-subheader__breadcrumbs">
        <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
        <a href="{{route('exam-session', $status)}}" class="kt-subheader__breadcrumbs-link">
            Back to List Exam Session
        </a>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="alert alert-light alert-elevate fade show" role="alert">
                <div class="alert-icon"><i class="flaticon-information kt-font-info"></i></div>
                <div class="alert-text">
                    Pada page ini anda dapat melakukan evaluasi Exam Session
                </div>
            </div>
        </div>
    </div>

    @include('layouts.notification')
    <div class="kt-portlet">
        <div class="kt-portlet__body">
            <tr style="border: solid 1px black">
                <td style="font-weight: bolder">Exam</td>
                <td>:</td>
                <td>{{$exam_title}} ({{$exam_session_code}})</td>
            </tr>
            <table id="datatable" class="table table-bordered table-hover table-checkable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Action</th>
                        <th>Level</th>
                        <th>User ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Final Score</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($enrolls as $key => $item)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>
                                @if ($item['user']['level'] == 'entry')
                                    <a href="{{route('exam-session.evaluate-answer', $item['user_session_code'])}}?exam_session_id={{$id}}" type="button" class="btn btn-info btn-sm" title="Evaluate {{$item['user']['name']}}"><i class="la la-check-square" style="color: white"></i></a>
                                @endif
                            </td>
                            <td>{{$item['user']['level']}}</td>
                            <td>{{$item['user_session_code']}}</td>
                            <td>{{$item['user']['name']}}</td>
                            <td>{{$item['user']['email']}}</td>
                            <td>{{$item['final_score'] ?? 0}}</td>
                            <td>
                                @if($item['final_score_status'] == 'Ready to evaluate')
                                    <span class="badge badge-pill badge-primary" style="font-size: 1em">Ready to Evaluate</span>
                                @elseif($item['final_score_status'] == 'Verified')
                                    <span class="badge badge-pill badge-success" style="font-size: 1em">Verified</span>
                                @else   
                                    <span class="badge badge-pill badge-danger" style="font-size: 1em">Invalid</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="kt-portlet" style="background:none; box-shadow:none">
        <div class="kt-form kt-form--fit kt-form--label-align-right">
            <div class="kt-portlet__foot kt-portlet__foot--fit" id="create-portlet" style="border-top: 0">
                <div class="kt-form__actions ">
                    <div class="pull-right">
                        <a class="btn btn-success btn-sm white-text" type="button" data-toggle="tooltip" title="">
                            <i class="la la-check"></i><span style="font-size: 1.1em; font-weight:bold" id="add-question-text">Commit Evaluation Result</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.2.6/jquery.inputmask.bundle.min.js"></script> --}}
@endsection
