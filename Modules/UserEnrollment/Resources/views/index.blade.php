@extends('layouts.app')

@section('title', 'User Enrollment')
@section('exam-session', 'kt-menu__item--open')
@section('exam-session-list', 'kt-menu__item--active')

@section('styles')
    <style>
        #datatable_wrapper > .row > .col-md-6:first-child{
            padding-top: 5px;
        }

        #datatable_wrapper > .row > .col-md-6:first-child::after {
            content: "Instructor List";
            font-size: 16px;
            font-weight: bold;
        }

        #datatable2_wrapper > .row > .col-md-6:first-child{
            padding-top: 5px;
        }

        #datatable2_wrapper > .row > .col-md-6:first-child::after {
            content: "Entry List";
            font-size: 16px;
            font-weight: bold;
        }
    </style>
@endsection

@section('breadcrumb')
    <h3 class="kt-subheader__title">
        User Enrollment
    </h3>
    <span class="kt-subheader__separator kt-hidden"></span>
    <div class="kt-subheader__breadcrumbs">
        <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
        <a href="{{route('user-enrollment',$this_session['id'] ?? null)}}" class="kt-subheader__breadcrumbs-link">
            Exam Session User Enrollment
        </a>
    </div>
@endsection

@section('content')
<meta name="url-save-user-enrollment" content="{{ route('user-enrollment-save') }}">
<meta name="url-user-enrollment" content="{{ route('user-enrollment', $this_session['id'] ?? null) }}">
<div class="kt-portlet">
    <div class="kt-portlet__body">
        @include('layouts.notification')
        <div class="container">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="exam-title">Exam Title</span>
                </div>
                <input class="form-control mr-3" type="text" id="exam-title" value="{{$this_session['exam']['exam_title'] ?? null}}" readonly>

                <div class="input-group-prepend">
                    <span class="input-group-text" id="exam-session_code">Session Code</span>
                </div>
                <input class="form-control" type="text" id="exam-session-code" value="{{$this_session['exam_session_code'] ?? null}}" readonly>
            </div>
        </div>

        <div class="container mt-3">
            <table id="datatable" class="table table-light">
                <thead>
                    <tr>
                        <th>#</th>
                        @if (!$this_session['enrollment_status'] && Auth::user()->level != 'instructor')
                            <th>Action</th>
                        @endif
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $count_instructor = 0;
                    @endphp
                    @if (!empty($user_enroll_instructor))
                        @foreach ($user_enroll_instructor as $key => $item)
                            <tr>
                                <td>{{++$key}}</td>
                                @if (!$this_session['enrollment_status'] && Auth::user()->level != 'instructor')
                                    <td>
                                        <a href="{{route('user-enrollment-delete', $item['id'])}}" title="{{$item['user']['email']}}" type="button" class="btn btn-danger btn-delete btn-sm">
                                            <i class="la la-trash"></i>
                                        </a>
                                    </td>
                                @endif
                                <td>{{$item['user']['name']}}</td>
                                <td>{{$item['user']['email']}}</td>
                                <td>{{$item['user']['phone']}}</td>
                            </tr>
                            @php
                                $count_instructor++;
                            @endphp
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" style="text-align: center">No Instructor Found</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            @if (!$this_session['enrollment_status'] && Auth::user()->level != 'instructor')
                <div class="btn-group-horizontal mt-2" role="group" aria-label="Horizontal button group">
                    <button data-target="#searchInstructor" data-toggle="modal" class="btn btn-primary"><i class="la la-search"></i> Search and Add Instructor</button>
                    {{-- <a href="{{'#'}}" type="button" class="btn btn-secondary"><i class="la la-download"></i> Download Sample File</a>
                    <a href="{{'#'}}" type="button" class="btn btn-secondary"><i class="la la-upload"></i> Upload List Instructor</a> --}}
                </div>
            @endif
        </div>

        <div class="container mt-5">
            <table id="datatable2" class="table table-light">
                <thead>
                    <tr>
                        <th>#</th>
                        @if (!$this_session['enrollment_status'])
                            <th>Action</th>
                        @endif
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $count_entry = 0;
                    @endphp
                    @if (!empty($user_enroll_entry))
                        @foreach ($user_enroll_entry as $key => $item)
                            <tr>
                                <td>{{++$key}}</td>
                                @if (!$this_session['enrollment_status'])
                                    <td>
                                        <a href="{{route('user-enrollment-delete', $item['id'])}}" title="{{$item['user']['email']}}" type="button" class="btn btn-danger btn-delete btn-sm">
                                            <i class="la la-trash"></i>
                                        </a>
                                    </td>
                                @endif
                                <td>{{$item['user']['name']}}</td>
                                <td>{{$item['user']['email']}}</td>
                                <td>{{$item['user']['phone']}}</td>
                            </tr>
                            @php
                                $count_entry++;
                            @endphp
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" style="text-align: center">No Entry Found</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            @if (!$this_session['enrollment_status'])
                <div class="btn-group-horizontal mt-2" role="group" aria-label="Horizontal button group">
                    <button data-target="#searchEntry" data-toggle="modal" class="btn btn-primary"><i class="la la-search"></i> Search and Add Entry</button>
                    {{-- <a href="{{'#'}}" type="button" class="btn btn-secondary"><i class="la la-download"></i> Download Sample File</a>
                    <a href="{{'#'}}" type="button" class="btn btn-secondary"><i class="la la-upload"></i> Upload List Entry</a> --}}
                </div>
            @endif
        </div>
    </div>
</div>

<div class="kt-portlet" style="background:none; box-shadow:none">
    <div class="kt-form kt-form--fit kt-form--label-align-right">
        <div class="kt-portlet__foot kt-portlet__foot--fit" id="create-portlet" style="border-top: 0">
            <div class="kt-form__actions ">
                <div class="pull-right">
                    @if ($count_instructor > 0 && $count_entry > 0 && !$this_session['enrollment_status'])
                        <a class="btn btn-success btn-sm white-text" id="add-questions-button" data-target="#modal-submit-enrollment" data-toggle="modal">
                            <i class="la la-check"></i><span style="font-size: 1.1em; font-weight:bold" id="add-question-text">Submit Enrollment</span>
                        </a>
                    @else
                        <a class="btn btn-secondary btn-sm white-text" id="add-questions-button" type="button" data-toggle="tooltip" title="User Enrollment Still Empty or it's already submitted">
                            <i class="la la-check"></i><span style="font-size: 1.1em; font-weight:bold" id="add-question-text">Submit Enrollment</span>
                        </a>
                    @endif
                    <a class="btn btn-secondary btn-sm white-text" id="add-questions-button" href="{{route('exam-session', $this_session['exam_session_status'])}}">
                        <i class="la la-ban"></i><span style="font-size: 1.1em; font-weight:bold" id="add-question-text">Cancel</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="searchInstructor" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="my-modal-title">Search and Add Instructor</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="search-box">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="my-addon"><i class="la la-search"></i></span>
                        </div>
                        <input class="form-control" type="text" name="instructor_keyword" placeholder="Name/Email/Phone">
                    </div>
                </div>
                <div class="list-instructor">

                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<div id="searchEntry" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="my-modal-title">Search and Add Entry</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="search-box">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="my-addon"><i class="la la-search"></i></span>
                        </div>
                        <input class="form-control" type="text" name="entry_keyword" placeholder="Name/Email/Phone">
                    </div>
                </div>
                <div class="list-entry">

                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-submit-enrollment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Submit Enrollment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <h5>Are You Sure Want to Submit This Enrollment? You Can't Edit Enrollment After this.</h5>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <a href="{{route('exam-session.submit-enrollment', $this_session['id'])}}" type="submit" class="btn btn-danger">Yes!</a>
        </div>
    </div>
    </div>
            </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/helper.js') }}"></script>
    <script>

        function saveUserEnrollment(elem){
            let id_user = $(elem).data('id_user')
            let user_type = $(elem).data('user_type')
            let id_exam_session = "{!! $this_session['id'] !!}"
            let this_url = $('meta[name="url-user-enrollment"]').attr('content')
            let url = $('meta[name="url-save-user-enrollment"]').attr('content')
            let crsf_token = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                'dataType' : 'json',
                'type' : 'post',
                'url' : url,
                'data' : {
                    '_token' : crsf_token,
                    'id_user' : id_user,
                    'id_exam_session' : id_exam_session,
                    'user_type' : user_type
                }
            }).done(function(result){
                window.location = this_url
            }).fail(function(result){
                console.log('fail:',result)
            })
        }


        $('input[name="instructor_keyword"]').keyup(function(){
            let value = $(this).val();
            let instructors = {!! $instructors !!}
            let ids_enrolls = {!! $ids_user_enroll_instructor !!}

            console.log(ids_enrolls)
            $('.list-instructor').html('');
            if(value != ''){
                $.each(instructors, function(index, item){
                    if(item.name.indexOf(value) != -1 || item.email.indexOf(value) != -1 || item.phone.indexOf(value) != -1){
                        if(in_array(item.id, ids_enrolls)){
                            $('.list-instructor').append("<div class='card mt-3'> <div class='card-body row'> <div class='col-md-8'> <p class='card-text' style='font-weight: bold'>"+item.name+"</p><p class='card-text'>"+item.email+"</p> <p class='card-text'>"+item.phone+"</p> </div> <div class='col-md-4'> <div class='pull-right'> <button class='btn btn-light'><i class='la la-check-square'></i>Added</button> </div> </div> </div> </div>");
                        }else{
                            $('.list-instructor').append("<div class='card mt-3'> <div class='card-body row'> <div class='col-md-8'> <p class='card-text' style='font-weight: bold'>"+item.name+"</p><p class='card-text'>"+item.email+"</p> <p class='card-text'>"+item.phone+"</p> </div> <div class='col-md-4'> <div class='pull-right'> <button class='btn btn-info' onclick='saveUserEnrollment(this)' data-id_user='"+item.id+"' data-user_type='"+item.level+"'><i class='la la-plus'></i>Add Instructor</button> </div> </div> </div> </div>");
                        }

                    }
                })
            }
        });

        $('input[name="entry_keyword"]').keyup(function(){
            let value = $(this).val();
            let entries = {!! $entries !!}
            let ids_enrolls = {!! $ids_user_enroll_entry !!}

            $('.list-entry').html('');
            if(value != ''){
                $.each(entries, function(index, item){
                    if(item.name.toLowerCase().indexOf(value.toLowerCase()) != -1 || item.email.toLowerCase().indexOf(value.toLowerCase()) != -1 || item.phone.toLowerCase().indexOf(value.toLowerCase()) != -1){
                        if(in_array(item.id, ids_enrolls)){
                            $('.list-entry').append("<div class='card mt-3'> <div class='card-body row'> <div class='col-md-8'> <p class='card-text' style='font-weight: bold'>"+item.name+"</p><p class='card-text'>"+item.email+"</p> <p class='card-text'>"+item.phone+"</p> </div> <div class='col-md-4'> <div class='pull-right'> <button class='btn btn-light'><i class='la la-check-square'></i>Added</button> </div> </div> </div> </div>");
                        }else{
                            $('.list-entry').append("<div class='card mt-3'> <div class='card-body row'> <div class='col-md-8'> <p class='card-text' style='font-weight: bold'>"+item.name+"</p><p class='card-text'>"+item.email+"</p> <p class='card-text'>"+item.phone+"</p> </div> <div class='col-md-4'> <div class='pull-right'> <button class='btn btn-info' onclick='saveUserEnrollment(this)'  data-id_user='"+item.id+"' data-user_type='"+item.level+"'><i class='la la-plus'></i>Add Entry</button> </div> </div> </div> </div>");
                        }
                    }
                })
            }
        });
    </script>
@endsection
