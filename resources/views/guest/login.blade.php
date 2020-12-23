<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- begin::Global Theme Styles(used by all pages) --}}
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #17a2b8;
            height: 80vh;
        }

        #login .container #login-row #login-column #login-box {
            margin-top: 50px;
            max-width: 600px;
            height: 45%;
            border: 1px solid #9C9C9C;
            background-color: #EAEAEA;
        
        }

        #login .container #login-row #login-column #login-box #login-form {
            padding: 20px;
        }

        #login .container #login-row #login-column #login-box #login-form #register-link {
            margin-top: -85px;
        }

        .image{
            text-align: center;
        }

        .image img{
            width: 40%;
            margin: auto;
            margin-bottom: 10px;
            margin-top: 15px;
            padding: 5px;
            border: none;
        }
    </style>
</head>
<body>
    <div id="login">
        <h3 class="text-center text-white pt-5">Login form</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="{{route('admin.login.post')}}" method="post">
                            @csrf
                            <div class="image">
                                <img alt="Online Exam" src="{{env('APP_URL').'assets/img/logo.png'}}" width="130">
                            </div>
                            @include('layouts.notification')
                            <div class="form-group">
                                <label for="email" class="text-info">Email:</label><br>
                                <input type="email" name="email" id="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Password:</label><br>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="remember-me" class="text-info"><span>Remember me</span> <span><input id="remember-me" name="remember-me" type="checkbox"></span></label><br>
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="Login">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>



