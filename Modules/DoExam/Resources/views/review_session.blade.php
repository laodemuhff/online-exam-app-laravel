@extends('layouts.app')

@section('title', 'Exam Session')

@section('breadcrumb')
    <h3 class="kt-subheader__title">
        Review Exam Session
    </h3>
    <span class="kt-subheader__separator kt-hidden"></span>
    <div class="kt-subheader__breadcrumbs">
        <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
        <a href="{{route('register-session')}}" class="kt-subheader__breadcrumbs-link">
            Summary
        </a>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h3>Your Exam Summary</h3>
            </div>
            <div class="card-body">
                <table class="table table-light">
                    <tbody>
                        <tr>
                            <td>Exam</td>
                            <td>:</td>
                            <td><h3>{{$exam}}</b></h3></td>
                        </tr>
                        <tr>
                            <td>Final Score</td>
                            <td>:</td>
                            <td><h3><b>{{$final_score}}</b></h3></td>
                        </tr>
                        <tr>
                            <td>Right Answer</td>
                            <td>:</td>
                            <td><h3><b><span style="color:rgb(31, 196, 86)">{{$right_answer}}</span></b></h3></td>
                        </tr>
                        <tr>
                            <td>Wrong Answer</td>
                            <td>:</td>
                            <td><h3><b><span style="color:rgb(223, 37, 37)">{{$wrong_answer}}</span></b></h3></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <a type="button" class="btn btn-primary" href="{{route('home')}}"><i class="la la-home"></i> Back to Home Registration</a>
            </div>
        </div>


    </div>
@endsection
