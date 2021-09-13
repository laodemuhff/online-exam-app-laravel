<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    {{-- end::Global Theme Styles --}}
</head>
<body>
    <h4 style="font-family: Arial, Helvetica, sans-serif">Sesi Ujian</h4>
    <table class="table table-bordered">
        <tr>
            <td>Exam Session Code</td>
            <td>{{$exam_session['exam_session_code']}}</td>
        </tr>
        <tr>
            <td>Exam Title</td>
            <td>{{$exam_session['exam']['exam_title'] ?? 'Judul Exam'}}</td>
        </tr>
    </table>

    <h4 style="font-family: Arial, Helvetica, sans-serif">Rekap Hasil Evaluasi Peserta Ujian</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <td>No.</td>
                <td>Email</td>
                <td>Name</td>
                <td>Final Score</td>
                <td>Status</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($all_user as $key => $usr)
                @if ($usr['user']['level'] === 'entry')
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{$usr['user']['email']}}</td>
                        <td>{{$usr['user']['name']}}</td>
                        <td>{{$usr['final_score']}}</td>
                        <td>
                            @if (!is_null($usr['final_score_status']))
                                Verified
                            @else
                                <span style="color: rgb(224, 9, 9)">Invalid</span>
                            @endif
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</body>
</html>