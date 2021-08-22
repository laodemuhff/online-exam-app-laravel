<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>Exam Title</th>
            <th>Session Code</th>
            <th>Scheduled At</th>
            <th>Exam Duration</th>
            <th>Register Duration</th>
            <th>Questions Type</th>
            {{-- <th>Total Questions</th> --}}
            <th>Session Status</th>
            <th>Review Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @php
            if($history_status == 'pending_exam'){
                $condition_status = 'Pending';
                $condition_final_score_status = null;

            }elseif($history_status == 'running_exam'){
                $condition_status = 'On Going';
                $condition_final_score_status = 'any';

            }elseif($history_status == 'on_evaluation'){
                $condition_status = 'Terminated';
                $condition_final_score_status = 'Ready to evaluate';

            }elseif($history_status == 'reviewed_exam'){
                $condition_status = 'Terminated';
                $condition_final_score_status = 'Verified';

            }elseif($history_status == 'invalid_exam'){
                $condition_status = 'Terminated';
                $condition_final_score_status = null;
            }

            $count_item = 0;
        @endphp
        @foreach ($exam_session as $key => $item)
            @if ($item['examSession']['exam_session_status'] == $condition_status && ($item['final_score_status'] == $condition_final_score_status || $condition_final_score_status == 'any'))
                <tr>
                    <td>{{++$key}}</td>
                    <td>{{$item['examSession']['exam']['exam_title']}}</td>
                    <td>{{$item['examSession']['exam_session_code']}}</td>
                    <td>
                        @if (!empty($item['examSession']['started_on_going_at']))
                            {{$item['examSession']['started_on_going_at'] ?? '-'}}
                        @else
                            {{$item['examSession']['exam_datetime'] ?? '-'}}
                        @endif
                    </td>
                    <td>{{isset($item['examSession']['exam_duration']) ? $item['examSession']['exam_duration'].' minutes' : '-'}}</td>
                    <td>{{isset($item['examSession']['register_duration']) ? $item['examSession']['register_duration'].' minutes' : '-'}}</td>
                    <td>{{$item['examSession']['question_type']}}</td>
                    {{-- <td>{{$item['examSession']['total_question']}}</td> --}}
                    <td>
                        @if ($item['examSession']['exam_session_status'] == 'Terminated')
                            <span class="badge badge-pill badge-danger" style="font-size: 1.1em">{{$item['examSession']['exam_session_status']}}</span>
                        @elseif($item['examSession']['exam_session_status'] == 'On Going')
                            <span class="badge badge-pill badge-success" style="font-size: 1.1em">{{$item['examSession']['exam_session_status']}}</span>
                        @else
                            <span class="badge badge-pill badge-warning" style="font-size: 1.1em">{{$item['examSession']['exam_session_status']}}</span>
                        @endif

                    </td>
                    <td>
                        @if ($item['final_score_status'] == null && $item['examSession']['exam_session_status'] == 'Terminated')
                            <span class="badge badge-pill badge-danger" style="font-size: 1.1em">Invalid</span>
                        @elseif ($item['final_score_status'] == null && $item['examSession']['exam_session_status'] != 'Terminated')
                            <span class="badge badge-pill badge-warning" style="font-size: 1.1em">Pending</span>
                        @elseif($item['final_score_status'] == 'Ready to evaluate')
                            <span class="badge badge-pill badge-success" style="font-size: 1.1em">Waiting Evaluation</span>
                        @else
                            <span class="badge badge-pill badge-primary" style="font-size: 1.1em"><a href="#">Final Result</a></span>
                        @endif

                    </td>
                    <td>
                        @if ($item['examSession']['exam_session_status'] == 'On Going' && !$item['is_submitted'] && $item['examSession']['registration_status'] != 'expired')
                            <a data-toggle='modal' data-target='#register-session-{{$item['examSession']['id']}}' type="button" class="btn btn-primary" style="color: white"><span class="flaticon-user-ok"></span> Register</a>
                        @else
                            <a @if($item['examSession']['registration_status'] == 'expired' || $item['examSession']['exam_session_status'] == 'Terminated') title="Register Session is Ended" @else title="Register Session is not Yet Started" @endif data-toggle="tooltip" type="button" class="btn btn-light" style="color: white; background-color: #EBEDF2; border-color: #EBEDF2;" disabled><span class="flaticon-user-ok"></span> Register</a>
                        @endif
                    </td>
                </tr>

                <div id="register-session-{{$item['examSession']['id']}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="my-modal-title">Masukkan User Session Code</h5>
                                <button class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{route('register-session')}}" method="post">
                                @csrf
                                <div class="modal-body">
                                    <input type="hidden" name="id_exam_session" value="{{$item['examSession']['id']}}">
                                    <input type="hidden" name="id_user" value="{{auth()->user()->id}}">
                                    <div class="form-group">
                                        <label for="user_session_code">User Session Code</label>
                                        <input id="user_session_code" class="form-control" type="text" name="user_session_code" autocomplete="off">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="btn-group" role="group" aria-label="Button group">
                                        <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @php
                    $count_item++;
                @endphp
            @endif
        @endforeach

        @if ($count_item == 0)
            <tr>
                <td colspan="10" style="text-align: center"><h3 style="font-size: 1.4rem">No Exam</h3></td>
            </tr>
        @endif
    </tbody>
</table>
