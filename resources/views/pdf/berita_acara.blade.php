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
    <table>
        <tr>
           <td style="text-align: center"><h1>Berita Acara</h1></td>
        </tr>
    </table>

    <h4 style="font-family: Arial, Helvetica, sans-serif">Jadwal Ujian</h4>
    <table class="table table-bordered">
        <tr>
            <td>Exam Session Code</td>
            <td>{{$exam_session['exam_session_code']}}</td>
        </tr>
        <tr>
            <td>Exam Date Time</td>
            <td>{{isset($exam_session['exam_datetime']) ? tgl_indo(date('Y-m-d', strtotime($exam_session['exam_datetime']))).' - '.date('H.i', strtotime($exam_session['exam_datetime']))  : 'Not Set'}}</td>
        </tr>
    </table>

    <h4 style="font-family: Arial, Helvetica, sans-serif">Daftar Peserta Ujian</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <td>No.</td>
                <td>Email</td>
                <td>Name</td>
                <td>Phone</td>
                <td>Level</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($all_user as $key => $usr)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{$usr['user']['email']}}</td>
                    <td>{{$usr['user']['name']}}</td>
                    <td>{{$usr['user']['phone']}}</td>
                    <td>{{$usr['user']['level']}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>