<!DOCTYPE html>
<html lang="en">

	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>Online Exam | @yield('title')</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="url" content="{{ url('') }}">

		{{-- begin::Fonts --}}
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Asap+Condensed:500">
		{{-- end::Fonts --}}


		{{-- begin::Global Theme Styles(used by all pages) --}}
        <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
		{{-- end::Global Theme Styles --}}

        <link href="{{ url('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />

        <style>
            .kt-header{
                background-color: rgb(235, 252, 251) !important;
            }

            .badge-info{
                margin-left: 4px !important;
            }

            .badge-font{
                font-size: 0.85em;
            }

            .center{
                text-align: center;
            }

            .white-text{
                color: white !important;
            }

            /* autocomplete tagsinput*/
            .label-info {
                background-color: #5bc0de;
                display: inline-block;
                padding: 0.2em 0.6em 0.3em;
                font-size: 100%;
                font-weight: 700;
                line-height: 1;
                color: #fff;
                text-align: center;
                white-space: nowrap;
                vertical-align: baseline;
                border-radius: 0.25em;
            }
        </style>
        @yield('styles')
	</head>

	<!-- end::Head -->

	<!-- begin::Body -->
	<body class="kt-page-content-white kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-page--loading">
		<!-- begin:: Page -->

        <!-- begin:: Header Mobile -->
        <div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
            <div class="kt-header-mobile__logo">
                <a href="{{ route('admin.dashboard') }}">
                    <img alt="Sistem Ujian Online" src="{{ asset('assets/img/logo.png') }}" height="50"/>
                </a>
            </div>
            <div class="kt-header-mobile__toolbar">
                <button class="kt-header-mobile__toolbar-toggler kt-header-mobile__toolbar-toggler--left" id="kt_aside_mobile_toggler"><span></span></button>
                <button class="kt-header-mobile__toolbar-topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more-1"></i></button>
            </div>
        </div>

		<!-- end:: Header Mobile -->
		<div class="kt-grid kt-grid--hor kt-grid--root">
			<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
				<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

                    @if (Auth::user())
                        {{-- begin:: Header --}}
                        <div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed " data-ktheader-minimize="on">
                            <div class="kt-container  kt-container--fluid ">

                                {{-- begin:: Brand --}}
                                <div class="kt-header__brand " id="kt_header_brand">
                                    <div class="kt-header__brand-logo">
                                        <a href="{{ route('admin.dashboard') }}">
                                            <img alt="Online Exam" src="{{ asset('assets/img/logo.png') }}" height="55"/>
                                        </a>
                                    </div>
                                </div>
                                {{-- end:: Brand --}}

                                {{-- begin: User bar --}}
                                <div class="kt-header__topbar">
                                    <div class="kt-header__topbar-item kt-header__topbar-item--user">
                                        <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
                                            <span class="kt-header__topbar-welcome kt-visible-desktop">Hello, {{Auth::user()->name}}</span>
                                            <span class="kt-header__topbar-username kt-visible-desktop">
                                                {{-- {{Auth::user()->name}} --}}
                                            </span>
                                            <img alt="Pic" src="{{ asset('assets/img/user.png') }}" />
                                            <span class="kt-header__topbar-icon kt-bg-brand kt-hidden"><b>S</b></span>
                                        </div>
                                        <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">

                                            <!--begin: Head -->
                                            <div class="kt-user-card kt-user-card--skin-light kt-notification-item-padding-x">
                                                <div class="kt-user-card__avatar">
                                                    <img class="kt-hidden-" alt="Pic" src="{{ asset('assets/img/user.png') }}" />

                                                    <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                                                    <span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold kt-hidden">S</span>
                                                </div>
                                                <div class="kt-user-card__name">
                                                    {{-- {{Auth::user()->name}} --}}
                                                </div>
                                                <div class="kt-user-card__badge">
                                                    {{-- <span class="btn btn-label-primary btn-sm btn-bold btn-font-md">23 messages</span> --}}
                                                </div>
                                            </div>

                                            <!--end: Head -->

                                            <!--begin: Navigation -->
                                            <div class="kt-notification">
                                                <a href="custom/apps/user/profile-1/personal-information.html" class="kt-notification__item">
                                                    <div class="kt-notification__item-icon">
                                                        <i class="flaticon2-calendar-3 kt-font-success"></i>
                                                    </div>
                                                    <div class="kt-notification__item-details">
                                                        <div class="kt-notification__item-title kt-font-bold">
                                                            My Profile
                                                        </div>
                                                        <div class="kt-notification__item-time">
                                                            Account settings and more
                                                        </div>
                                                    </div>
                                                </a>
                                                <div class="kt-notification__custom kt-space-between pull-right">
                                                    <form action="{{route('admin.logout')}}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-label btn-label-danger btn-sm btn-bold">Sign Out</button>
                                                    </form>
                                                </div>
                                            </div>

                                            <!--end: Navigation -->
                                        </div>
                                    </div>
                                </div>
                                {{-- end: User bar --}}
                            </div>
                        </div>
                        {{-- end:: Header --}}
                    @endif

					<div class="kt-body kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-grid--stretch" id="kt_body">
						<div class="kt-container  kt-container--fluid  kt-grid kt-grid--ver">

                            @if (Auth::user() && Auth::user()->level != 'entry')
                                <!-- begin:: Aside -->
                                <button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
                                <div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">

                                    <!-- begin:: Aside Menu -->
                                    <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
                                        <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1">
                                            <ul class="kt-menu__nav ">
                                                @include('layouts.sidebar')
                                            </ul>
                                        </div>
                                    </div>

                                    <!-- end:: Aside Menu -->
                                </div>
                            @endif

							<!-- end:: Aside -->
							<div class="@if(Auth::user() && Auth::user()->level != 'entry') kt-content @endif  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

								<!-- begin:: Subheader -->
								<div class="kt-subheader   kt-grid__item" id="kt_subheader">
									<div class="kt-container  kt-container--fluid ">
										<div class="kt-subheader__main">
											@yield('breadcrumb')
										</div>
									</div>
								</div>

								<!-- end:: Subheader -->

								{{-- begin:: Content --}}
								<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
                                    @yield('content')
                                </div>
								{{-- end:: Content --}}
							</div>
						</div>
					</div>

                    @if (Auth::user())
                        {{-- begin:: Footer --}}
                        <div class="kt-footer kt-grid__item" id="kt_footer">
                            <div class="kt-container  kt-container--fluid ">
                                <div class="kt-footer__wrapper">
                                    <div class="kt-footer__copyright">
                                        2021&nbsp;&copy;&nbsp;<a href="#" target="_blank" class="kt-link">Online Exam</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- end:: Footer --}}
                    @endif
				</div>
			</div>
		</div>
		<!-- end:: Page -->


		{{-- begin::Scrolltop --}}
		<div id="kt_scrolltop" class="kt-scrolltop">
			<i class="fa fa-arrow-up"></i>
		</div>
		{{-- end::Scrolltop --}}

		<!-- begin::Global Config(global config for global JS sciprts) -->
		<script>
			var KTAppOptions = {
				"colors": {
					"state": {
						"brand": "#5d78ff",
						"light": "#ffffff",
						"dark": "#282a3c",
						"primary": "#5867dd",
						"success": "#34bfa3",
						"info": "#36a3f7",
						"warning": "#ffb822",
						"danger": "#fd3995"
					},
					"base": {
						"label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
						"shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
					}
				}
			};
		</script>
		<!-- end::Global Config -->

		{{-- <!--begin::Global Theme Bundle(used by all pages) --> --}}
            <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}" type="text/javascript"></script>
            <script src="{{ asset('assets/js/scripts.bundle.js') }}" type="text/javascript"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
        {{-- <!--end::Global Theme Bundle --> --}}

        <script>
            $('body').on('click', '.btn-delete', function (event) {
                event.preventDefault();

                var me = $(this),
                    url = me.attr('href'),
                    title = me.attr('title'),
                    csrf_token = $('meta[name="csrf-token"]').attr('content');

                swal.fire({
                    title: 'Are you sure want to delete ' + title + ' ?',
                    text: 'You won\'t be able to revert this!',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: url,
                            type: "POST",
                            data: {
                                '_method': 'DELETE',
                                '_token': csrf_token,
                            },
                            success: function (response) {
                                // $('#loading').hide();
                                if (response) {
                                    swal.fire({
                                        type: 'success',
                                        title: 'Success!',
                                        text: 'Data has been deleted!'
                                    });
                                    location.reload();
                                }else{
                                    console.log(response.messages)
                                    swal.fire({
                                        type: 'error',
                                        title: 'Oops...',
                                        text: response.messages
                                    });
                                }
                            },
                            error: function (xhr) {
                                // $('#loading').hide();
                                swal.fire({
                                    type: 'error',
                                    title: 'Oops...',
                                    text: 'Something went wrong!'
                                });
                            }
                        });
                    }
                });
            });
        </script>

        <script src="{{url('assets/plugins/custom/datatables/datatables.bundle.js')}}" type="text/javascript"></script>
        <script>
            var DatatablesDataSourceHtml = {
            init: function() {
                $("#datatable").DataTable({
                    scrollX: true,
                    responsive: true,
                    searching : true,
                    lengthChange : false,
                    paging : true
                }),

                $("#datatable2").DataTable({
                    scrollX: true,
                    responsive: true,
                    searching : true,
                    lengthChange : false,
                    paging : true
                })
            }
        };
        jQuery(document).ready(function() {
            DatatablesDataSourceHtml.init()
        });
        </script>

        @yield('scripts')

	</body>

	<!-- end::Body -->
</html>
