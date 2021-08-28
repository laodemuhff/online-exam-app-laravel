@extends('layouts.app')

@section('title', 'Exam Session Management')
@section('exam-session', 'kt-menu__item--open')
@section('exam-session-list-'.$status, 'kt-menu__item--active')

{{-- @section('styles')
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">

@endsection --}}

@section('breadcrumb')
    <h3 class="kt-subheader__title">
        {{ucfirst($status)}} Exam Session
    </h3>
    <span class="kt-subheader__separator kt-hidden"></span>
    <div class="kt-subheader__breadcrumbs">
        <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
        <a href="{{route('exam-session', $status)}}" class="kt-subheader__breadcrumbs-link">
            List Exam Session
        </a>
    </div>
@endsection

@section('content')
<div class="kt-portlet">
    <div class="kt-portlet__body">
        @include('layouts.notification')
        @if ($status == 'pending')
            <div class="col-md-2 mb-4" style="padding-left:0px">
                <a href="{{route('exam-session.create')}}" type="button" class="btn btn-primary btn-sm"><i class="la la-plus"></i> Add New Exam Session</a>
            </div>
        @endif
        <table id="datatable" class="table table-bordered table-hover table-checkable">
            <thead>
                <tr>
                    <th>#</th>
                    {{-- <th>Subjects</th> --}}
                    <th>Action</th>
                    <th>Exam</th>
                    <th>Session Code</th>
                    <th>Scheduled At</th>
                    <th>Session Duration</th>
                    <th>Register Duration</th>
                    <th>Allow Scrambled Question</th>
                    <th>Allow Scrambled Options</th>
                    <th>Disallow Multiple Login</th>
                    <th>Disallow Navigation</th>
                    <th>Similarity Value</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($exam_sessions as $key => $session)
                    @if (isset($session['exam']['exam_title']))
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    @if ($session['exam_session_status'] != 'On Going')
                                        @if ($session['exam_session_status'] == 'Pending')
                                            @php
                                                // $is_instructor_exist = false;
                                                // $is_entry_exist = false;

                                                $instructor_numbers = 0;
                                                $entry_numbers = 0;

                                                foreach ($session['examSessionUserEnrolls'] as $key => $user_enrolls) {
                                                    if($user_enrolls['user_type'] == 'instructor'){
                                                        // $is_instructor_exist = true;
                                                        $instructor_numbers++;
                                                    }

                                                    if($user_enrolls['user_type'] == 'entry'){
                                                        // $is_entry_exist = true;
                                                        $entry_numbers++;
                                                    }
                                                }
                                            @endphp
                                            @if($session['enrollment_status'])
                                                <a title="Start Exam Session {{$session['exam_session_code']}}" type="button" class="btn btn-success btn-sm" data-toggle='modal' data-target="#startSessionModal{{$session['id']}}"><i class="la la-play" style="color: white"></i></a>
                                            @else
                                                <a type="button" class="btn btn-light btn-sm" data-toggle='kt-tooltip' title data-placement="left" data-original-title="Can not Start Exam Session, User Enrollment is Not Yet Submitted"> <i class="la la-play" style="color: white"></i></a>
                                            @endif
                                            <a href="{{route('exam-session.edit',$session['id'])}}" title="Edit {{$session['exam_session_code']}}" type="button" class="btn btn-warning btn-sm"><i class="la la-edit"></i></a>
                                            <a href="{{route('user-enrollment',$session['id'])}}" title="User Enrollment - {{$session['exam_session_code']}}" type="button" class="btn btn-info btn-sm"><i class="la la-users" style="color: white"></i></a>
                                        @endif

                                        @if ($session['exam_session_status'] == 'Terminated')
                                            <a href="#" title="Evaluate Session - {{$session['exam_session_code']}}" type="button" class="btn btn-info btn-sm"><i class="la la-check-square" style="color: white"></i></a>
                                        @endif

                                        <a href="{{route('exam-session.delete', $session['id'])}}" title="Delete {{$session['exam_session_code']}}" type="button" class="btn btn-danger btn-delete btn-sm"><i class="la la-trash"></i></a>
                                    @else
                                        {{-- <a href="#" title="Monitor Session - {{$session['exam_session_code']}}" type="button" class="btn btn-success btn-sm"><i class="la la-tv" style="color: white"></i></a> --}}
                                        <a href="{{route('user-enrollment',$session['id'])}}" title="User Enrollment - {{$session['exam_session_code']}}" type="button" class="btn btn-info btn-sm"><i class="la la-users" style="color: white"></i></a>
                                        <a title="End Exam Session {{$session['exam_session_code']}}" type="button" class="btn btn-danger btn-sm" data-toggle='modal' data-target="#endSessionModal{{$session['id']}}"><i class="la la-stop" style="color: white"></i></a>
                                    @endif

                                </div>
                            </td>
                            <td>{{ $session['exam']['exam_title'] }}</td>
                            <td>{{ $session['exam_session_code'] }}</td>
                            <td>{{ isset($session['exam_datetime']) ? tgl_indo(date('Y-m-d', strtotime($session['exam_datetime']))).' - '.date('H.i', strtotime($session['exam_datetime']))  : 'Not Set' }}</td>
                            <td>{{ $session['exam_duration'] ?? 'Not Set'}}</td>
                            <td>{{ $session['register_duration'] ?? 'Not Set' }}</td>
                            <td class="center">
                                @if($session['allow_scrambled_questions'])
                                    <span class="badge badge-success badge-font">True</span>
                                @else
                                    <span class="badge badge-danger badge-font">False</span>
                                @endif
                            </td>
                            <td class="center">
                                @if($session['allow_scrambled_options'])
                                    <span class="badge badge-success badge-font">True</span>
                                @else
                                    <span class="badge badge-danger badge-font">False</span>
                                @endif
                            </td>
                            <td class="center">
                                @if($session['disallow_multiple_login'])
                                    <span class="badge badge-success badge-font">True</span>
                                @else
                                    <span class="badge badge-danger badge-font">False</span>
                                @endif
                            </td>
                            <td class="center">
                                @if( $session['disallow_navigation'])
                                    <span class="badge badge-success badge-font">True</span>
                                @else
                                    <span class="badge badge-danger badge-font">False</span>
                                @endif
                            </td>
                            <td>{{ $session['exam_similarity_value'] }}</td>
                            <td class="center">
                                @if( $session['exam_session_status'] == 'Pending')
                                    <span class="badge badge-warning badge-font">{{$session['exam_session_status']}}</span>
                                @elseif($session['exam_session_status'] == 'On Going')
                                    <span class="badge badge-info badge-font">{{$session['exam_session_status']}}</span>
                                @else
                                    <span class="badge badge-danger badge-font">{{$session['exam_session_status']}}</span>
                                @endif
                            </td>
                        </tr>
                    @endif

                    <!-- Button trigger modal -->
                    <!-- Modal -->
                    @if ($session['exam_session_status'] == 'Pending')
                        <div class="modal fade" id="startSessionModal{{$session['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Start Exam Session</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <h5>Are You Sure Want to Start This Exam Session?</h5>
                                    <ul style="margin-top: 10px">
                                        <li>Total Participant : {{$instructor_numbers + $entry_numbers}}</li>
                                        <li>Instructors : {{$instructor_numbers}}</li>
                                        <li>Entries : {{$entry_numbers}}</li>
                                    </ul>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <a href="{{route('exam-session.start', $session['id'])}}" type="submit" class="btn btn-primary">Yes!</a>
                                </div>
                            </div>
                            </div>
                        </div>
                    @endif

                      <!-- Modal -->
                      <div class="modal fade" id="endSessionModal{{$session['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">End Exam Session</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <h5>Are You Sure Want to End This Exam Session?</h5>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <a href="{{route('exam-session.end', $session['id'])}}" type="submit" class="btn btn-danger">Yes!</a>
                            </div>
                        </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
