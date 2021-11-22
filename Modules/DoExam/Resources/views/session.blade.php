@php
    use Illuminate\Support\Facades\Cache;
@endphp

@extends('layouts.app')

@section('title', 'Exam Session')

@section('breadcrumb')
    <h3 class="kt-subheader__title">
        Exam Session
    </h3>
    <span class="kt-subheader__separator kt-hidden"></span>
    <div class="kt-subheader__breadcrumbs">
        <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
        <a href="{{route('register-session')}}" class="kt-subheader__breadcrumbs-link">
            Exam Session
        </a>
    </div>
@endsection

@section('styles')
    <style>
        .card{
            margin:10px !important;
            background-color: white;
        }

        .btn-secondary{
            background-color:white !important;
            color: black;
        }

        .btn-secondary:hover{
            color: black !important;
        }

        .changeToGreen{
            background-color:rgb(45, 232, 45) !important;
            color: white !important;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="row">
                <div class="card col-md-11">
                    <div class="card-body">
                        <h5 class="card-title">Exam Info</h5>
                        <p class="card-text">
                            <table class="table table-light">
                                <tbody>
                                    <tr>
                                        <td>Session</td>
                                        <td>:</td>
                                        <td>{{$setting['exam_session_code']}}</td>
                                    </tr>
                                    <tr>
                                        <td>Subject</td>
                                        <td>:</td>
                                        <td>{{$setting['subject']}}</td>
                                    </tr>
                                    <tr>
                                        <td>Schedule</td>
                                        <td>:</td>
                                        <td>
                                            @if (!empty($setting['started_on_going_at']))
                                                {{ $setting['started_on_going_at'] }}
                                            @else
                                                {{$setting['exam_datetime']}}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Duration</td>
                                        <td>:</td>
                                        <td>{{$setting['exam_duration'] ?? '-'}} Menit</td>
                                    </tr>
                                    <tr>
                                        <td>Question</td>
                                        <td>:</td>
                                        <td>{{$setting['total_question']}} Soal</td>
                                    </tr>
                                </tbody>
                            </table>
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card col-md-11">
                    <div class="card-body">
                        <h5 class="card-title">User Info</h5>
                        <p class="card-text">
                            <table class="table table-light">
                                <tbody>
                                    <tr>
                                        <td>Name</td>
                                        <td>:</td>
                                        <td>{{Auth::user()->name}}</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>:</td>
                                        <td>{{Auth::user()->email}}</td>
                                    </tr>
                                    <tr>
                                    </tr>
                                    <tr>
                                        <td>Level</td>
                                        <td>:</td>
                                        <td>{{Auth::user()->level}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <form action="{{route('submit-exam')}}" method="post">
                @csrf
                <input type="hidden" name="exam_session_code" value="{{$setting['exam_session_code']}}">
                <input type="hidden" name="user_session_code" value="{{$user_session_code}}">
                <div class="row">
                    @php
                        if(Cache::has('questions')){
                            $questions = Cache::get('questions'.$user_session_code);
                        }
                    @endphp
                    @foreach ($questions as $key => $item)
                        <div class="card col-md-12 box-soal" @if(isset($current_active_nav)) @if($current_active_nav != $key) style="display: none" @endif @else @if($key != 0) style="display:none" @endif @endif data-index="{{$key}}">
                            <div class="card-body">
                                @if ($setting['disallow_navigation'])
                                    <div class="alert alert-warning" role="alert">
                                        <strong>Navigasi Dinonaktifkan! Harap mengecek ulang jawaban anda sebelum lanjut ke soal berikutnya</strong>
                                    </div>
                                @endif
                                <h5 class="card-title">Soal {{++$key}}</h5>
                                <p class="card-text">
                                    <?php echo $item['question']['question_description'];?>
                                </p>
                                @if ($item['question']['type'] == 'multiple_choice')
                                <table class="table table-light">
                                    <tbody>
                                        @foreach ($item['question']['options'] as $key_option => $option)
                                        <tr>
                                            <td style="width: 10%">
                                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                    <label class="btn btn-secondary @if($item['question']['answer'] == $option['id']) changeToGreen @endif question{{$item['question']['id']}}_option" onclick="handleOption(this)" data-index={{$key_option}} data-question-index="{{$key}}" data-option-id="{{$option['id']}}" data-answer-status="{{$option['answer_status']}}" data-question-type="{{$item['question']['type']}}" data-question-id="{{$item['question']['id']}}">
                                                        <input type="radio" name="question{{$item['question']['id']}}_option[]">{{$option['option_label']}}
                                                    </label>
                                                </div>
                                            </td>
                                            <td style="color: black">{{$option['option_description']}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @else
                                    <div class="form-group">
                                        <label for="my-textarea">Answer : </label>
                                        <textarea id="my-textarea" name="question{{$item['question']['id']}}_essay" class="form-control" name="" rows="8" onchange="handleEssay(this)" data-question-type="{{$item['question']['type']}}" data-question-id="{{$item['question']['id']}}" data-question-index="{{$key}}">{{$item['question']['answer']}}</textarea>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="card col-md-12">
                        <div class="card-body">
                            {{-- <h5 class="card-title">Navigation</h5> --}}
                            @if ($setting['disallow_navigation'])
                                <div class="row">
                                    <div class="col-md-12" style="text-align: center">
                                        <div class="btn-group" id="nav-arrow" role="group" aria-label="Button group">
                                            {{-- <a href="#" class="btn btn-outline-primary" style="width: 100%"><i class="la la-arrow-left"></i></a> --}}
                                            {{-- <a href="#" class="btn btn-outline-primary" style="width: 100%" onclick="confirmNext(this)"><i class="la la-arrow-right"></i></a> --}}
                                            <a href="#" class="btn btn-outline-primary" style="width: 100%" onclick="setNext(this)"><i class="la la-arrow-right"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-md-12" style="border: 1px dotted black; margin-top:10px">
                                        @foreach ($questions as $key => $item)
                                            <div style="float:left; margin:3px; min-width: 45px">
                                                <a href="#" class="btn @if(!empty($item['question']['answer'])) btn-primary @else btn-outline-primary @endif  nav-link @if(isset($current_active_nav)) @if($current_active_nav == $key) active @endif @else @if($key == 0) active @endif @endif" style="width: 100%" data-index="{{$key}}">{{++$key}}</a>
                                                @if ($item['question']['type'] === 'essay')
                                                    <div style="text-align: center">essay</div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <div class="row">
                                    <div class="col-md-12" style="text-align: center">
                                        <div class="btn-group" role="group" aria-label="Button group">
                                            <a href="#" class="btn btn-outline-primary" style="width: 100%" onclick="setPrev(this)"><i class="la la-arrow-left"></i></a>
                                            <a href="#" class="btn btn-outline-primary" style="width: 100%" onclick="setNext(this)"><i class="la la-arrow-right"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-md-12" style="border: 1px dotted black; margin-top:10px">
                                        @foreach ($questions as $key => $item)
                                            <div style="float:left; margin:3px; min-width: 45px">
                                                <a href="#" class="btn @if(!empty($item['question']['answer'])) btn-primary @else btn-outline-primary @endif  nav-link @if(isset($current_active_nav)) @if($current_active_nav == $key) active @endif @else @if($key == 0) active @endif @endif" style="width: 100%" onclick="navigate(this)" data-index="{{$key}}">{{++$key}}</a>
                                                @if ($item['question']['type'] === 'essay')
                                                    <div style="text-align: center">essay</div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                 <div style="float:right; margin:3px; min-width: 45px">
                    <button type="button" data-toggle="modal" data-target="#submitExam" class="btn btn-outline-danger" style="width: 100%" onclick="cekExamSessionStatus()">Submit Exam</button>
                </div>

                <div id="submitExam" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="my-modal-title">Apakah Anda Yakin ini Submit Ujian Ini?</h5>
                                <button class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Exam Info
                            </div>
                            <div class="modal-footer">
                                <div class="btn-group" role="group" aria-label="Button group">
                                    <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // save answer
        let url = $('meta[name="url"]').attr('content')
        let token = $('meta[name="csrf-token"]').attr('content')
        let user_session_code = "<?php echo $user_session_code ?>"
        let exam_sess_code = "<?php echo $setting['exam_session_code'] ?>"
        let is_navigation_disallowed = "{!! $setting['disallow_navigation'] !!}";

        function handleEssay(e){
            const essay_answer = $(e).val()

            let question_index = $(e).data('question-index')
            let question_type = $(e).data('question-type')
            let id_question = $(e).data('question-id')
            let is_delete = 0;

            if(essay_answer){
                $('.nav-link').eq(question_index - 1).removeClass('btn-outline-primary').addClass('btn-primary')
                is_delete = 0;
            }else{
                $('.nav-link').eq(question_index - 1).removeClass('btn-primary').addClass('btn-outline-primary')
                is_delete = 1;
            }

            $.ajax({
                'type' : 'POST',
                'dataType' : 'json',
                'url' : url+'/answer/save',
                'data' : {
                    'id_question' : id_question,
                    'user_session_code' : user_session_code,
                    'question_type' : question_type,
                    'essay_answer' : essay_answer,
                    'exam_session_code' : exam_sess_code,
                    'is_delete' : is_delete,
                    '_token' : token
                }
            }).done(function(result){
                if(result['status'] == 'fail'){
                    alert('Session already Terminated')
                    window.location = url+"/doexam/session";
                }
            }).fail(function(result){
                console.log(result)
            });
        }

        function handleOption(e){
            let question_index = $(e).data('question-index')
            let option_index = $(e).data('index');
            let is_delete = 0;

            // $(e).css('background-color', 'red !important');
            let option_elements_name = $(e).children().attr('name');
            let option_elements = $("."+option_elements_name.slice(0,-2));

            $.each(option_elements, function(index, option){
                if(option_index != index)
                    console.log(option_elements.eq(index).removeClass('changeToGreen'))
            })
            //console.log(option_elements)

            let classname = $(e).attr('class')
            if(classname.indexOf('changeToGreen') > -1){
                $(e).removeClass('changeToGreen')
                $('.nav-link').eq(question_index - 1).removeClass('btn-primary').addClass('btn-outline-primary')
                is_delete = 1;
            }else{
                $(e).addClass('changeToGreen');
                $('.nav-link').eq(question_index - 1).removeClass('btn-outline-primary').addClass('btn-primary')
                is_delete = 0;
            }

            let option_id = $(e).data('option-id')
            let answer_status = $(e).data('answer-status')
            let question_type = $(e).data('question-type')
            let id_question = $(e).data('question-id')

            $.ajax({
                'type' : 'POST',
                'dataType' : 'json',
                'url' : url+'/answer/save',
                'data' : {
                    'id_question' : id_question,
                    'user_session_code' : user_session_code,
                    'question_type' : question_type,
                    'option_id' : option_id,
                    'answer_status' : answer_status,
                    'is_delete' : is_delete,
                    'exam_session_code' : exam_sess_code,
                    '_token' : token
                }
            }).done(function(result){
                console.log(result)
                if(result['status'] == 'fail'){
                    alert('Session already Terminated')
                    window.location = url+"/doexam/session";
                }
            }).fail(function(result){
                // console.log(result)
            });
        }

        function navigate(e, next_index = undefined){
            let navlinks = $('.nav-link')

            // search current nav link index
            let current_nav_index = 0;
            $.each(navlinks, function(index, value){
                if(navlinks.eq(index).attr('class').indexOf('active') > -1)
                    current_nav_index = index
            });

            let clicked_navigation_index = next_index;

            if(next_index == undefined){
                clicked_navigation_index = $(e).data('index')
            }

            let linkTo = $('.box-soal').eq(clicked_navigation_index);
            let hideCurrentNav = $('.box-soal').eq(current_nav_index);

            hideCurrentNav.fadeOut(200)
            $('.nav-link').eq(current_nav_index).removeClass('active')

            linkTo.fadeIn(200)
            if(next_index != undefined){
                $('.nav-link').eq(next_index).addClass('active')
            }else{
                $(e).addClass('active')
            }

            $.ajax({
                'type' : 'POST',
                'dataType' : 'json',
                'url' : url+'/answer/save-nav-position',
                'data' : {
                    'user_session_code' : user_session_code,
                    'current_active_nav' : clicked_navigation_index,
                    'exam_session_code' : exam_sess_code,
                    '_token' : token
                }
            }).done(function(result){
                console.log(result)
                if(result['status'] == 'fail'){
                    alert('Session already Terminated')
                    window.location = url+"/doexam/session";
                }
            }).fail(function(result){

            });

        }

        function confirmNext(e){
            let navlinks = $('.nav-link')

            // search current nav link index
            let current_nav_index = 0;
            $.each(navlinks, function(index, value){
                if(navlinks.eq(index).attr('class').indexOf('active') > -1)
                    current_nav_index = index
            });


            if(confirm('Yakin dengan Jawaban Anda ? Anda tidak dapat kembali ke soal sebelumnya.')){
                navigate(e,++current_nav_index)

                if(current_nav_index == navlinks.length - 1){
                    $('#nav-arrow').hide()
                    $('#submit-all').show()
                }
            }
        }

        function setNext(e){
            let navlinks = $('.nav-link')

            // search current nav link index
            let current_nav_index = 0;
            $.each(navlinks, function(index, value){
                if(navlinks.eq(index).attr('class').indexOf('active') > -1)
                    current_nav_index = index
            });

            if(current_nav_index == navlinks.length - 1){
                if(is_navigation_disallowed){
                    $('#nav-arrow').hide()
                    $('#submit-all').show()
                }else{
                    console.log('tets')
                    navigate(e,0)
                }
            }else{
                navigate(e,++current_nav_index)
            }

        }

        function setPrev(e){
            let navlinks = $('.nav-link')

            // search current nav link index
            let current_nav_index = 0;
            $.each(navlinks, function(index, value){
                if(navlinks.eq(index).attr('class').indexOf('active') > -1)
                    current_nav_index = index
            });

            console.log(current_nav_index)

            navigate(e,--current_nav_index)
        }

        function cekExamSessionStatus(e){
            $.ajax({
                'type' : 'POST',
                'dataType' : 'json',
                'url' : url+'/doexam/submit/check',
                'data' : {
                    'exam_session_code' : exam_sess_code,
                    '_token' : token
                }
            }).done(function(result){
                console.log(result)
                if(result['status'] == 'fail'){
                    alert('Session already Terminated')
                    window.location = url+"/doexam/session";
                }
            }).fail(function(result){

            });
        }

        $(document).keypress(
            function(event){
                if (event.which == '13') {
                    event.preventDefault();
                }
            }
        );
            
    </script>
@endsection
