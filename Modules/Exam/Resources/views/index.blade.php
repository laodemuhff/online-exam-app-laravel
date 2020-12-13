@extends('layouts.app')

@section('title', 'Exam Management')
@section('exam', 'kt-menu__item--open')
@section('exam-list', 'kt-menu__item--active')

{{-- @section('styles')
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">

@endsection --}}

@section('breadcrumb')
    <h3 class="kt-subheader__title">
        Exam
    </h3>
    <span class="kt-subheader__separator kt-hidden"></span>
    <div class="kt-subheader__breadcrumbs">
        <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
        <a href="{{route('exam.list')}}" class="kt-subheader__breadcrumbs-link">
            List Exam
        </a>
    </div>
@endsection

@section('content')
<div class="kt-portlet">
    <div class="kt-portlet__body">
        @include('layouts.notification')
        <div class="col-md-2 mb-4" style="padding-left:0px">
            <a href="{{route('exam.create')}}" type="button" class="btn btn-primary btn-sm"><i class="la la-plus"></i> Add New Exam</a>
        </div>
        <table id="datatable" class="table table-bordered table-hover table-checkable">
            <thead>
                <tr>
                    <th></th>
                    {{-- <th>Subjects</th> --}}
                    <th>Action</th>
                    <th>Exam Title</th>
                    <th>Total Questions</th>
                    <th>Max Score</th>
                    <th>Default Wrong Point</th>
                    <th>Default Correct Point</th>
                    <th>Exam Status</th>
                    <th>OECP 1</th>
                    <th>OECP 2</th>
                    <th>OECP 3</th>
                    <th>OECP 4</th>
                    <th>OECP 5</th>
                    <th>OECP 6</th>
                    <th>OECP 8</th>
                    <th>New Session</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($exams as $key => $exam)
                    <tr>
                        <td>{{ ++$key }}</td>
                        {{-- <td>
                            @foreach ($exam['exam_subject'] as $item)
                                <span class="badge-info label-info">{{ $item['subject']['name'] }}</span>
                            @endforeach
                        </td> --}}
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="#" title="Detail Info {{$exam['exam_title']}}" type="button" class="btn btn-info btn-sm" data-toggle='modal' data-target='#detailModal{{$exam['id']}}'><i class="la la-eye"></i></a>
                                <a href="{{route('exam.edit',$exam['id'])}}" title="Edit {{$exam['exam_title']}}" type="button" class="btn btn-warning btn-sm"><i class="la la-edit"></i></a>
                                <a href="{{route('exam.delete', $exam['id'])}}" title="Delete {{$exam['exam_title']}}" type="button" class="btn btn-danger btn-delete btn-sm"><i class="la la-trash"></i></a>
                            </div>
                        </td>
                        <td>{{ $exam['exam_title'] }}</td>
                        <td class="center">{{ sizeof($exam['exam_base_questions']) }}</td>
                        <td class="center">{{ $exam['max_score'] }}</td>
                        <td class="center">{{ $exam['default_wrong_point'] }}</td>
                        <td class="center">+{{ $exam['default_correct_point']  }}</td>
                        <td class="center">@if($exam['exam_status'] == 'Active') <span class='badge badge-success badge-font'>{{$exam['exam_status']}}</span> @else <span class='badge badge-danger badge-font'>{{$exam['exam_status']}}</span>@endif</td>
                        <td class="center">@if($exam['oecp_1']) <span class='badge badge-primary badge-font'>Enabled</span> @else <span class='badge badge-secondary badge-font'>Disabled</span> @endif</td>
                        <td class="center">@if($exam['oecp_2']) <span class='badge badge-primary badge-font'>Enabled</span> @else <span class='badge badge-secondary badge-font'>Disabled</span> @endif</td>
                        <td class="center">@if($exam['oecp_3']) <span class='badge badge-primary badge-font'>Enabled</span> @else <span class='badge badge-secondary badge-font'>Disabled</span> @endif</td>
                        <td class="center">@if($exam['oecp_4']) <span class='badge badge-primary badge-font'>Enabled</span> @else <span class='badge badge-secondary badge-font'>Disabled</span> @endif</td>
                        <td class="center">@if($exam['oecp_5']) <span class='badge badge-primary badge-font'>Enabled</span> @else <span class='badge badge-secondary badge-font'>Disabled</span> @endif</td>
                        <td class="center">@if($exam['oecp_6']) <span class='badge badge-primary badge-font'>Enabled</span> @else <span class='badge badge-secondary badge-font'>Disabled</span> @endif</td>
                        <td class="center">@if($exam['oecp_8']) <span class='badge badge-primary badge-font'>Enabled</span> @else <span class='badge badge-secondary badge-font'>Disabled</span> @endif</td>
                        <td class="center">
                            <a href="{{route('exam.create-session', $exam['id'])}}" title="Add Session {{$exam['exam_title']}}" type="button" class="btn btn-success btn-sm"><i class="la la-plus"></i><i class="kt-menu__link-icon la la-laptop"></i></a>
                        </td>
                    </tr>

                    <!-- Button trigger modal -->
                    <!-- Modal -->
                    <div class="modal fade" id="detailModal{{$exam['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Detail Exam</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <label for="">Subject</label>
                                    </div>
                                    <div class="col-md-1">
                                        :
                                    </div>
                                    <div class="col-md-9">
                                        @if (!empty($exam['exam_subject']))
                                            @foreach ($exam['exam_subject'] as $item)
                                                <span class="label-info badge-info">{{$item['subject']['name']}}</span>
                                            @endforeach
                                        @else
                                            <i>Empty</i>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
