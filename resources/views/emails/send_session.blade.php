@component('mail::message')

<table class="table table-light">
    <tbody>
        <tr>
            <td>Exam Name</td>
            <td>:</td>
            <td>{{$exam_name}}</td>
        </tr>
        <tr>
            <td>Exam Session Code</td>
            <td>:</td>
            <td>{{$exam_session_code}}</td>
        </tr>
        @if (!empty($schedule))
            <tr>
                <td>Scheduled At</td>
                <td>:</td>
                <td>{{$schedule}}</td>
            </tr>
        @endif
    </tbody>
</table>
<br>

Use this code to enter your exam session<br>
User Session Code : <b>{{$session_code}}</b>


Thanks for your attention<br>
@endcomponent
