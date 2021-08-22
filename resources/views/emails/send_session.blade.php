@component('mail::message')
Exam Name : {{$exam_name}}<br>
Exam Code (Session Code): {{$exam_session_code}}<br>
@if (!empty($schedule))
    Scheduled At : {{$schedule}}<br>
@endif

<br>

Use this code to enter your exam session<br>
User Session Code : <b>{{$session_code}}</b>


Thanks for your attention<br>
@endcomponent
