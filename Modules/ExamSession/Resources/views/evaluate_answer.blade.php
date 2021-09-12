@extends('layouts.app')

@section('title', 'Exam Session Management')
@section('exam-session', 'kt-menu__item--open')
@section('exam-session-list-', 'kt-menu__item--active')

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
        <a href="{{route('exam-session.evaluate', $user_enrollment['id_exam_session'])}}" class="kt-subheader__breadcrumbs-link">
            Back to Evaluate Exam Session
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
    <div class="row">
        <div class="col-md-9">
            <div class="kt-portlet">
                <div class="kt-portlet__body">
                    @if (!is_null($user_enrollment['final_score_status']))
                        @if ($need_to_evaluate > 0)
                            <div class="alert alert-warning fade show" role="alert">
                                <strong>Important!</strong> &nbsp;&nbsp;{{ $need_to_evaluate }} answer need to evaluate.
                            </div>
                        @else
                            <div class="alert alert-success fade show" role="alert">
                                <strong>Complete</strong> &nbsp;&nbsp; all answer has been evaluated
                            </div>
                        @endif
                    @endif
                    @foreach ($exam_session_base_question as $key => $item)
                        <div class="form-group" style="border: 1px solid rgb(218, 212, 212);">
                            <div for="" style="border-bottom: solid 1px rgb(218, 212, 212); width:100%">
                                <h3 style="padding:10px; padding-bottom:0">
                                    <span class="badge badge-pill badge-primary">Soal {{++$key}}</span>
                                </h3>
                                <label for="" style="padding:10px; padding-bottom:0">
                                    @php
                                        echo $item['question']['question_description']
                                    @endphp
                                </label>
                            </div>
                            @if ($item['question']['type'] == 'multiple_choice')
                                <div style="width: 100%">
                                    <ul style="list-style-type:none; padding:10px; padding-bottom:0">
                                        @foreach ($item['question']['options'] as $option)
                                            <li style="margin-bottom:5px @if($option['answer_status']) ;color:green; font-weight:bold @endif">
                                                {{$option['option_label']}}
                                                {{$option['option_description']}}
                                                @if (!empty($option['is_user_answer']))
                                                    @if ($option['answer_status'])
                                                        <span style="color: black">
                                                            (User Answer is Correct)
                                                        </span>
                                                    @else
                                                        <span style="color: red; font-weight:bold;">
                                                            (User Answer is Incorrect)
                                                        </span>
                                                    @endif
                                                @elseif(empty($item['answer']))
                                                    @if ($option['answer_status'])
                                                        <span style="color: red; font-weight:bold;">
                                                            (Unanswered by User)
                                                        </span>
                                                    @endif
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @else
                                <div style="width: 100%">
                                    <p style="padding:10px">
                                        @if (!empty($item['answer']['essay_answer']))
                                            @php
                                                echo $item['answer']['essay_answer']
                                            @endphp
                                        @else
                                           @if (is_null($user_enrollment['final_score_status']))
                                                <span style="color: red; font-weight:bold;">
                                                    (Unanswered by User)
                                                </span>
                                           @else
                                                -
                                           @endif
                                        @endif
                                    </p>
                                </div>
                                @if (!is_null($user_enrollment['final_score_status']))
                                    <div style="width: 100%; border-top: solid 1px rgb(218, 212, 212); padding: 10px; padding-left:0">
                                        <div class="input-group flex-nowrap col-md-6">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="addon-wrapping">Given Point</span>
                                            </div>
                                            <input type="number" class="form-control" id="given_point_{{$item['question']['id']}}" name="given_point_{{$item['question']['id']}}" placeholder="Given Point" aria-label="Given Point" aria-describedby="addon-wrapping" value="{{$item['answer']['given_point'] ?? null}}">
                                            &nbsp;
                                            <button class="btn btn-light" style="border: 1px solid #e2e5ec" onclick="updateFinalScore(this)" data-id-exam-session-question="{{$item['question']['id']}}">Save</button>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="kt-portlet">
                <div class="kt-portlet__body">
                    <div class="kt-form__actions " style="text-align:center">
                        <p for="">Final Score :</p>
                        <h1>
                            {{$user_enrollment['final_score'] ?? 0}}
                        </h1>
                    </div>
                    {{-- @if (!is_null($user_enrollment['final_score_status']))
                        <div class="kt-form__actions " style="margin-top: 10px">
                            <div class="pull-left">
                                <a class="btn btn-success btn-sm white-text" type="button" data-toggle="tooltip" title="">
                                    <span style="font-size: 1.1em; font-weight:bold" id="add-question-text">Mark as Verified</span>
                                </a>
                            </div>
                        </div>
                    @endif --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.2.6/jquery.inputmask.bundle.min.js"></script> --}}

    <script>
        const url = $('meta[name="url"]').attr('content')
        const token = $('meta[name="csrf-token"]').attr('content')
        const user_session_code = "<?php echo $user_enrollment['user_session_code'] ?>"

        function updateFinalScore(e){
            const id_exam_session_question = $(e).data('id-exam-session-question');
            const given_point = $('#given_point_'+id_exam_session_question).val();
            console.log('given_point : '+ given_point)
            console.log('id_exam_session_question : '+ id_exam_session_question)
            console.log('user_session_code : '+ user_session_code)
            $.ajax({
                'type' : 'POST',
                'dataType' : 'json',
                'url' : url+'/exam-session/update-final-score',
                'data' : {
                    'id_exam_session_question' : id_exam_session_question,
                    'user_session_code' : user_session_code,
                    'given_point' : given_point,
                    '_token' : token
                }
            }).done(function(result){
                console.log(result)
                if(result['status']){
                    window.location.href = window.location.href
                }
            }).fail(function(result){
                console.log(result)
            });
        }
    </script>
@endsection