@extends('layouts.app')

@section('title', 'Dashboard')

@section('breadcrumb')
    <h3 class="kt-subheader__title">
        Dashboard
    </h3>
    <span class="kt-subheader__separator kt-hidden"></span>
        <div class="kt-subheader__breadcrumbs">
            <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
            <a href="#" class="kt-subheader__breadcrumbs-link">
                Dashboard
            </a>
        </div>
@endsection

@section('content')
    {{-- <div class="col-md-12"> --}}
       {{-- Begin:: Version List  --}}
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        <i class="flaticon-cogwheel"></i> Dashboard
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                @include('layouts.notification')
                <div class="tab-content">
                   {{-- Begin: Tab Android --}}
                    <div class="tab-pane active" id="android" role="tabpanel">
                    </div>
                </div>
            </div>
        </div>
@endsection

