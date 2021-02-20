@extends('layouts.app')

@section('title', 'Exam Session Management')
@section('exam-session', 'kt-menu__item--open')
@section('exam-session-create', 'kt-menu__item--active')

@section('styles')
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <style>
        #id_exam{
            height: calc(3rem + 2px) !important;
        }

        .start-anytime-checkbox, .end-anytime-checkbox, .unbound-registration-checkbox{
            padding:0;
        }

        .other-policies-form{
            border: dashed 1px rgb(155, 152, 152);
            padding: 3%;
            position: relative;
        }

        .other-policies-checkbox{
            margin-bottom: 5%;
        }

        /* prepare wrapper element */
        .suffix-number {
            display: inline-block;
            position: relative;
        }

        /* position the unit to the right of the wrapper */
        .suffix-number::after {
            position: absolute;
            top: 10px;
            left: 3em;
            transition: all .05s ease-in-out;
        }

        /* move unit more to the left on hover or focus within
        for arrow buttons will appear to the right of number inputs */
        .suffix-number:hover::after,
        .suffix-number:focus-within::after {
            right: 1.5em;
        }

        /* handle Firefox (arrows always shown) */
        @supports (-moz-appearance:none) {
            .suffix-number::after {
                right: 1.5em;
            }
        }

        .ms{
            width: 50%;
        }

        /* set the unit abbreviation for each unit class */
        .ms::after {
            content: 'minutes';
            color: rgb(56, 56, 151);
            font-weight: bolder;
        }
    </style>
@endsection

@section('breadcrumb')
    <h3 class="kt-subheader__title">
        Exam Session Management
    </h3>
    <span class="kt-subheader__separator kt-hidden"></span>
    <div class="kt-subheader__breadcrumbs">
        <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
        <a href="{{route('exam-session.create')}}" class="kt-subheader__breadcrumbs-link">
            Create Exam Session
        </a>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="alert alert-light alert-elevate fade show" role="alert">
                <div class="alert-icon"><i class="flaticon-information kt-font-info"></i></div>
                <div class="alert-text">
                    Pada page ini anda dapat membuat Exam Session
                </div>
            </div>
        </div>
    </div>

    @include('layouts.notification')
    <form action="{{route('exam-session.store')}}" method="POST">
        @csrf
        <div class="kt-portlet">
            <div class="row">
                <div class="col-md-12">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-caption">
                            <div class="kt-portlet__head-title" style="padding-top: 15%">
                                <h5>New Exam Session</h5>
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
                                    Select Exam <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Exam"></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <select name="id_exam" id="id_exam" class="form-control" data-url="{{ url('exam/info') }}" required>
                                    <option value="">Pilih Exam</option>
                                    @foreach ($exams as $exam)
                                        <option value="{{$exam->id}}" @if(isset($id_exam) && $id_exam == $exam->id) selected @endif>{{$exam->exam_title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row" id="exam_datetime_wrapper">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    Session Schedule <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Exam Schedule"></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <input type="datetime-local" class="form-control" name="exam_datetime" value="{{date('Y-m-d H:i', strtotime('2020-08-12'))}}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4"></div>
                            <div class="col-md-8">
                                <div class="form-check">
                                    <input type="checkbox" name="start_anytime" class="form-check-input" checked>
                                    <label class="form-check-label start-anytime-checkbox" for="exampleCheck1">Allow Automated Scheduling</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row" id="exam_duration_wrapper">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    Session Duration <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Exam Schedule"></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <div class="suffix-number ms">
                                    <input type="number" class="form-control" id="exam_duration" name="exam_duration" min="15" max="180" value="120" required>
                                </div>
                                {{-- <input type="text" class="form-control" style="width: 72%; display:inline-block" value="Scheduled At : -" readonly> --}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4"></div>
                            <div class="col-md-8">
                                <div class="form-check">
                                    <input type="checkbox" name="end_anytime" class="form-check-input" checked>
                                    <label class="form-check-label end-anytime-checkbox" for="exampleCheck1">Allow Automated Time Limiting</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row" id="register_duration_wrapper">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    Register Duration <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Exam Schedule"></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <div class="suffix-number ms">
                                    <input type="number" class="form-control" id="register_duration" name="register_duration" min="1" max="15" value="15" required>
                                </div>
                                {{-- <input type="text" class="form-control" style="width: 72%; display:inline-block" value="Scheduled At : -" readonly> --}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4"></div>
                            <div class="col-md-8">
                                <div class="form-check">
                                    <input type="checkbox" name="unbound_registration" class="form-check-input" checked>
                                    <label class="form-check-label unbound-registration-checkbox" for="exampleCheck1">Allow Automated Register Time Limiting</label>
                                </div>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    Other Policies <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Exam Schedule"></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <div class="other-policies-form">
                                    <div class="form-check other-policies-checkbox">
                                        <input type="checkbox" name="allow_scrambled_questions" class="form-check-input" checked>
                                        <label class="form-check-label unbound-registration-checkbox" for="exampleCheck1">Allow Scrambled Questions</label>
                                    </div>
                                    <div class="form-check other-policies-checkbox">
                                        <input type="checkbox" name="allow_scrambled_options" class="form-check-input" checked>
                                        <label class="form-check-label unbound-registration-checkbox" for="exampleCheck1">Allow Scrambled Options</label>
                                    </div>
                                    <div class="form-check other-policies-checkbox">
                                        <input type="checkbox" name="disallow_navigation" class="form-check-input" checked>
                                        <label class="form-check-label unbound-registration-checkbox" for="exampleCheck1">Disallow Navigation</label>
                                    </div>
                                    <div class="form-check other-policies-checkbox">
                                        <input type="checkbox" name="disallow_multiple_login" class="form-check-input" checked>
                                        <label class="form-check-label unbound-registration-checkbox" for="exampleCheck1">Disallow Multiple Login</label>
                                    </div>
                                     <div class="form-check other-policies-checkbox">
                                        <input type="checkbox" name="check_on_exam_similarity" class="form-check-input" checked>
                                        <label class="form-check-label unbound-registration-checkbox" for="exampleCheck1">Check On Exam Similarity</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="kt-portlet" style="background:none; box-shadow:none">
            <div class="kt-form kt-form--fit kt-form--label-align-right">
                <div class="kt-portlet__foot kt-portlet__foot--fit" id="create-portlet" style="border-top: 0">
                    <div class="kt-form__actions ">
                        <div class="pull-right">
                            <a class="btn btn-secondary btn-sm white-text" id="add-questions-button" href="{{route('exam-session', 'Pending')}}">
                                <i class="la la-ban"></i><span style="font-size: 1.1em; font-weight:bold" id="add-question-text">Cancel</span>
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
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.2.6/jquery.inputmask.bundle.min.js"></script> --}}

    <script>

        $(function(){
            $('#id_exam').trigger('change');
        })

        function checkAllowScrambledQuestion(){
            $('input[name="allow_scrambled_questions"]').prop('checked', true)
        }

        function uncheckAllowScrambledQuestion(){
            $('input[name="allow_scrambled_questions"]').prop('checked', false)
        }

        function checkAllowScrambledOptions(){
            $('input[name="allow_scrambled_options"]').prop('checked', true)
        }

        function uncheckAllowScrambledOptions(){
            $('input[name="allow_scrambled_options"]').prop('checked', false)
        }

        function checkDisallowNavigation(){
            $('input[name="disallow_navigation"]').prop('checked', true)
        }

        function uncheckDisallowNavigation(){
            $('input[name="disallow_navigation"]').prop('checked', false)
        }

        function checkDisallowMultipleLogin(){
            $('input[name="disallow_multiple_login"]').prop('checked', true)
        }

        function uncheckDisallowMultipleLogin(){
            $('input[name="disallow_multiple_login"]').prop('checked', false)
        }

        function checkCheckOnExamSimilarity(){
            $('input[name="check_on_exam_similarity"]').prop('checked', true)
        }

        function uncheckCheckOnExamSimilarity(){
            $('input[name="check_on_exam_similarity"]').prop('checked', false)
        }

        function hideExamSchedule(){
            $('input[name="exam_datetime"').prop('disabled', true)
            $('#exam_datetime_wrapper').slideUp(250);
            $('input[name="start_anytime"]').prop('checked', false)
        }

        function showExamSchedule(){
            $('input[name="start_anytime"]').prop('checked', true)
            $('input[name="exam_datetime"').prop('disabled', false)
            $('#exam_datetime_wrapper').slideDown(250);
        }

        $('input[name="start_anytime"]').on('change', function(e){
            if($(this).prop('checked') == true){
                showExamSchedule();
            }else{
                hideExamSchedule()
            }
        })

        function hideExamDuration(){
            $('input[name="exam_duration"').prop('disabled', true)
            $('#exam_duration_wrapper').slideUp(250);
            $('input[name="end_anytime"]').prop('checked', false)
        }

        function showExamDuration(){
            $('input[name="end_anytime"]').prop('checked', true)
            $('input[name="exam_duration"').prop('disabled', false)
            $('#exam_duration_wrapper').slideDown(250);
        }


        $('input[name="end_anytime"]').on('change', function(e){
            if($(this).prop('checked') == true){
                showExamDuration()
            }else{
                hideExamDuration()
            }
        })

        function hideRegisterDuration(){
            $('input[name="register_duration"').prop('disabled', true)
            $('#register_duration_wrapper').slideUp(250);
            $('input[name="unbound_registration"]').prop('checked', false)
        }

        function showRegisterDuration(){
            $('input[name="unbound_registration"]').prop('checked', true)
            $('input[name="register_duration"').prop('disabled', false)
            $('#register_duration_wrapper').slideDown(250);
        }


        $('input[name="unbound_registration"]').on('change', function(e){
            if($(this).prop('checked') == true){
                showRegisterDuration();
            }else{
                hideRegisterDuration();
            }
        })


        $('#register_duration').on('change', function(e){
            if($(this).val() > 15){
                $(this).val(15);
            }

            if($(this).val() < 1){
                $(this).val(1);
            }
        })

        $('#register_duration').on('keyup keydown', function(e){
            if($(this).val().length > 3){
                $(this).val(15);
            }

            if($(this).val().length < 1){
                $(this).val(1);
            }
        })

        $('#exam_duration').on('change', function(e){
            if($(this).val() > 180){
                $(this).val(180);
            }

            if($(this).val() < 15){
                $(this).val(15);
            }
        })

        $('#exam_duration').on('keyup keydown', function(e){
            if($(this).val().length > 3){
                $(this).val(180);
            }

            if($(this).val().length < 1){
                $(this).val(15);
            }
        })

        $('#id_exam').on('change', function(){
            let id_exam = $(this).val()
            let url = $(this).data('url')+'/'+id_exam;

            if(id_exam == ''){
                // default condition
                showExamSchedule();
                showRegisterDuration();
                showExamDuration();
                checkAllowScrambledQuestion();
                checkAllowScrambledOptions();
                checkDisallowNavigation();
                checkDisallowMultipleLogin();
                checkCheckOnExamSimilarity();
            }else{
                $.ajax({
                    'type'  : 'get',
                    'url'   : url,
                    'dataType' : 'json'
                }).done(function(data){
                    if(data.oecp_1 == 1){
                        showExamSchedule();
                    }else{
                        hideExamSchedule();
                    }

                    if(data.oecp_2 == 1){
                        showRegisterDuration();
                    }else{
                        hideRegisterDuration();
                    }

                    if(data.oecp_3 == 1){
                        checkAllowScrambledQuestion();
                        checkAllowScrambledOptions();
                    }else{
                        uncheckAllowScrambledQuestion();
                        uncheckAllowScrambledOptions();
                    }

                    if(data.oecp_4 == 1){
                        checkDisallowNavigation();
                    }else{
                        uncheckDisallowNavigation();
                    }

                    if(data.oecp_5 == 1){
                        showExamDuration();
                    }else{
                        hideExamDuration();
                    }

                    if(data.oecp_6 == 1){
                        checkDisallowMultipleLogin();
                    }else{
                        uncheckDisallowMultipleLogin();
                    }

                    if(data.oecp_8 == 1){
                        checkCheckOnExamSimilarity();
                    }else{
                        uncheckCheckOnExamSimilarity();
                    }

                }).fail(function(data){

                })
            }
        })



    </script>
@endsection
