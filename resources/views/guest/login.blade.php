<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hemofilia | Login</title>
    <link rel="stylesheet" href="{{ asset('custom_style/login.style.css') }}">
</head>
<body>
    <header >
        <div class="main-header">

            <img alt="Hemofilia Kita" src="{{env('APP_URL').'assets/img/logo.png'}}" width="130">
            @include('layouts.notification')
            <form action="{{ route('admin.login.post')}}" method="post">
                @csrf
                <p><input type="email" name="email" placeholder="marrymorstan@hemofilia.com"></p>
                <p><input type="password" name="password" placeholder="*****"></p>
                <p><button type="submit">Login</button></p>
            </form>
        </div>
    </header>
</body>
</html>
