@component('mail::message')

<table class="table table-light" style="border: 1px black solid; padding:10px">
    <tbody>
        <tr>
            <td>Exam Name</td>
            <td> : </td>
            <td> {{$exam_name}}</td>
        </tr>
        <tr>
            <td>Exam Code</td>
            <td> : </td>
            <td> {{$exam_session_code}}</td>
        </tr>
        @if (!empty($schedule))
            <tr>
                <td>Schedule</td>
                <td> : </td>
                <td> {{isset($schedule) ? tgl_indo(date('Y-m-d', strtotime($schedule))).' - '.date('H.i', strtotime($schedule))  : 'Not Set'}}</td>
            </tr>
        @endif
    </tbody>
</table>
<br>

Use this code to enter your exam session<br>
User Session Code : <b style="color:red">{{$session_code}}</b>
<br>
<br>
Please Don't Share This Code To Anybody, Keep it Secret for Yourself.
<br><br>
<b>Thanks for your attention!<b>
<br>
@endcomponent
