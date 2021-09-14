@extends('layouts.app')

@section('title', 'Dashboard')

{{-- @section('breadcrumb')
    <h3 class="kt-subheader__title">
        Dashboard
    </h3>
@endsection --}}

@section('content')
<!--Begin::Row-->
<div class="row">
    <div class="col-xl-6">
        <!--begin:: Widgets/Application Sales-->
        <div class="kt-portlet kt-portlet--height-fluid">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        Online Exam Records
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <ul class="nav nav-pills nav-pills-sm nav-pills-label nav-pills-bold" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#kt_widget11_tab1_content" role="tab">
                                Last Month
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#kt_widget11_tab2_content" role="tab">
                                All Time
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="tab-content">
                    <div class="tab-pane active" id="kt_widget11_tab1_content">

                        <!--begin::Widget 11-->
                        <div class="kt-widget11">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <td style=" width: 20%;">Stats</td>
                                            <td style=" width: 10%;">Total</td>
                                            <td style=" width: 10%; text-align:center">Contribution</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <span class="kt-widget11__title">Session Enrolled</span>
                                            </td>
                                            <td>19</td>
                                            <td style="color: rgb(7, 7, 160); text-align: center">10%</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="kt-widget11__title">Session Evaluated</span>
                                            </td>
                                            <td>10</td>
                                            <td style="color: rgb(7, 7, 160); text-align: center">25%</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="kt-widget11__title">Exam Created</span>
                                            </td>
                                            <td>12</td>
                                            <td style="color: rgb(7, 7, 160); text-align: center">30%</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="kt-widget11__title">Questions Created</span>
                                            </td>
                                            <td>120</td>
                                            <td style="color: rgb(7, 7, 160); text-align: center">18%</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!--end::Widget 11-->
                    </div>
                    <div class="tab-pane" id="kt_widget11_tab2_content">

                        <!--begin::Widget 11-->
                        <div class="kt-widget11">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <td style=" width: 20%;">Stats</td>
                                            <td style=" width: 10%;">Total</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <span class="kt-widget11__title">Session Enrolled</span>
                                            </td>
                                            <td>59</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="kt-widget11__title">Session Evaluated</span>
                                            </td>
                                            <td>50</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="kt-widget11__title">Exam Created</span>
                                            </td>
                                            <td>22</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="kt-widget11__title">Questions Created</span>
                                            </td>
                                            <td>545</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!--end::Widget 11-->
                    </div>
                </div>
            </div>
        </div>
        <!--end:: Widgets/Application Sales-->
    </div>
    <div class="col-xl-6">
        <!--begin:: Widgets/Latest Updates-->
        <div class="kt-portlet kt-portlet--height-fluid ">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        Popular Subjects
                    </h3>
                </div>      
            </div>

            <!--full height portlet body-->
            <div class="kt-portlet__body kt-portlet__body--fluid kt-portlet__body--fit">
                <div class="kt-widget4 kt-widget4--sticky">
                    <div class="kt-widget4__items kt-portlet__space-x kt-margin-t-15">
                        <div class="kt-widget4__item">
                            <a href="#" class="kt-widget4__title">
                                Pemrograman Web Dasar
                            </a>
                            <span class="kt-widget4__number kt-font-brand">500</span>
                        </div>
                        <div class="kt-widget4__item">
                            <a href="#" class="kt-widget4__title">
                                Mobile Apps
                            </a>
                            <span class="kt-widget4__number kt-font-success">64</span>
                        </div>
                        <div class="kt-widget4__item">
                            <a href="#" class="kt-widget4__title">
                                Kalkulus
                            </a>
                            <span class="kt-widget4__number kt-font-danger">30</span>
                        </div>
                        <div class="kt-widget4__item">
                            <a href="#" class="kt-widget4__title">
                                Matematika Diskrit
                            </a>
                            <span class="kt-widget4__number kt-font-warning">19</span>
                        </div>
                    </div>
                    <div class="kt-widget4__chart kt-margin-t-15">
                        <canvas id="kt_chart_latest_updates" style="height: 150px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!--end:: Widgets/Latest Updates-->
    </div>
</div>
<!--End::Row-->
@endsection
