<!DOCTYPE html>
<html lang="en">

	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>Evo Transport | @yield('title')</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">

		{{-- begin::Fonts --}}
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Asap+Condensed:500">
		{{-- end::Fonts --}}


		{{-- begin::Global Theme Styles(used by all pages) --}}
		<link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/css/custom_switch_button.css') }}" rel="stylesheet" type="text/css" />
		{{-- end::Global Theme Styles --}}

        @yield('styles')
	</head>

	<!-- end::Head -->

	<!-- begin::Body -->
	<body class="kt-page-content-white kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-page--loading">
		<!-- begin:: Page -->

		<!-- begin:: Header Mobile -->
		<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
			<div class="kt-header-mobile__logo">
				<a href="{{route('admin.dashboard')}}">
					<img alt="Hemofilia Kita" src="{{ asset('assets/img/logo.png') }}" height="50"/>
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

					{{-- begin:: Header --}}
					<div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed " data-ktheader-minimize="on">
						<div class="kt-container  kt-container--fluid ">

							{{-- begin:: Brand --}}
							<div class="kt-header__brand " id="kt_header_brand">
								<div class="kt-header__brand-logo">
									<a href="{{route('admin.dashboard')}}">
										<img alt="Hemofilia Kita" src="{{ asset('assets/img/logo.png') }}" height="55"/>
									</a>
								</div>
							</div>
							{{-- end:: Brand --}}

                            {{-- begin: User bar --}}
							<div class="kt-header__topbar">
								<div class="kt-header__topbar-item kt-header__topbar-item--user">
									<div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
										<span class="kt-header__topbar-welcome kt-visible-desktop">Hello,</span>
										<span class="kt-header__topbar-username kt-visible-desktop">
											{{-- {{Auth::user()->name}} --}}
										</span>
										<img alt="Pic" src="{{ asset('assets/img/blank.png') }}" />
										<span class="kt-header__topbar-icon kt-bg-brand kt-hidden"><b>S</b></span>
									</div>
									<div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">

										<!--begin: Head -->
										<div class="kt-user-card kt-user-card--skin-light kt-notification-item-padding-x">
											<div class="kt-user-card__avatar">
												<img class="kt-hidden-" alt="Pic" src="{{ asset('assets/img/blank.png') }}" />

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
												<a href="{{route('admin.logout')}}" class="btn btn-label btn-label-danger btn-sm btn-bold">Sign Out</a>
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

					<div class="kt-body kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-grid--stretch" id="kt_body">
						<div class="kt-container  kt-container--fluid  kt-grid kt-grid--ver">

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

							<!-- end:: Aside -->
							<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

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

					{{-- begin:: Footer --}}
					<div class="kt-footer kt-grid__item" id="kt_footer">
						<div class="kt-container  kt-container--fluid ">
							<div class="kt-footer__wrapper">
								<div class="kt-footer__copyright">
									2020&nbsp;&copy;&nbsp;<a href="#" target="_blank" class="kt-link">Hemofilia Kita</a>
								</div>
							</div>
						</div>
					</div>

					{{-- end:: Footer --}}
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
        {{-- <!--end::Global Theme Bundle --> --}}
        @yield('scripts')
	</body>

	<!-- end::Body -->
</html>
