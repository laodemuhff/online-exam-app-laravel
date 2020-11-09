<li class="kt-menu__item {{ Request::route()->getName() == 'home' ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
    <a href="{{ route('admin.dashboard') }}" class="kt-menu__link ">
        <i class="kt-menu__link-icon flaticon-home"></i><span class="kt-menu__link-text">Dashboard</span>
    </a>
</li>

@if (session('level') == 'admin' || session('level') == 'instructor')
<li class="kt-menu__section ">
    <h4 class="kt-menu__section-text">Master Data</h4>
    <i class="kt-menu__section-icon la la-cogs"></i>
</li>
@endif

{{-- User Management --}}
@if (session('level') == 'admin')
    {{-- <li class="kt-menu__section ">
        <h4 class="kt-menu__section-text">User Management</h4>
        <i class="kt-menu__section-icon flaticon-more-v2"></i>
    </li> --}}

    <li class="kt-menu__item  kt-menu__item--submenu @yield('user-management')" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
            <i class="kt-menu__link-icon flaticon-users"></i>
            <span class="kt-menu__link-text">User</span>
            <i class="kt-menu__ver-arrow la la-angle-right"></i>
        </a>
        <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
            <ul class="kt-menu__subnav">
                <li class="kt-menu__item @yield('user-create')" aria-haspopup="true">
                    <a href="{{ route('user.create') }}" class="kt-menu__link ">
                        <i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i>
                        <span class="kt-menu__link-text">Create User</span>
                    </a>
                </li>
                <li class="kt-menu__item @yield('user-list-admin')" aria-haspopup="true">
                    <a href="{{ route('user', ['level' => 'admin']) }}" class="kt-menu__link ">
                        <i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i>
                        <span class="kt-menu__link-text">Admin</span>
                    </a>
                </li>
                <li class="kt-menu__item @yield('user-list-entry')" aria-haspopup="true">
                    <a href="{{ route('user', ['level' => 'entry']) }}" class="kt-menu__link ">
                        <i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i>
                        <span class="kt-menu__link-text">Entry</span>
                    </a>
                </li>
                <li class="kt-menu__item @yield('user-list-instructor')" aria-haspopup="true">
                    <a href="{{ route('user', ['level' => 'instructor']) }}{{ '?level=instructors'}}" class="kt-menu__link ">
                        <i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i>
                        <span class="kt-menu__link-text">Instructors</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>
    {{-- END::Route USER --}}
@endif

@if (session('level') == 'admin' || session('level') == 'instructor')
<li class="kt-menu__item @yield('subject')" aria-haspopup="true">
    <a href="{{route('subject.list')}}" class="kt-menu__link">
        <i class="kt-menu__link-icon la la-book"></i><span class="kt-menu__link-text">Subject</span>
    </a>
</li>
@endif

@if (session('level') == 'admin' || session('level') == 'instructor')
    <li class="kt-menu__item  kt-menu__item--submenu @yield('question')" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
            <i class="kt-menu__link-icon la la-question-circle"></i>
            <span class="kt-menu__link-text">Questions</span>
            <i class="kt-menu__ver-arrow la la-angle-right"></i>
        </a>
        <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
            <ul class="kt-menu__subnav">
                <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true">
                    <span class="kt-menu__link">
                        <span class="kt-menu__link-text">
                            Questions
                        </span>
                    </span>
                </li>
                <li class="kt-menu__item @yield('question.create')" aria-haspopup="true">
                    <a href="{{route('question.create')}}" class="kt-menu__link ">
                        <i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i>
                        <span class="kt-menu__link-text">Create Question</span>
                    </a>
                </li>
                <li class="kt-menu__item @yield('question.list')" aria-haspopup="true">
                    <a href="{{route('question.list')}}" class="kt-menu__link ">
                        <i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i>
                        <span class="kt-menu__link-text">Collections</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>
@endif

@if (session('level') == 'admin' || session('level') == 'instructor')
<li class="kt-menu__item kt-menu__item--submenu @yield('exam')" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
        <i class="kt-menu__link-icon la la-clipboard"></i>
        <span class="kt-menu__link-text">Exam</span>
        <i class="kt-menu__ver-arrow la la-angle-right"></i>
    </a>
    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
        <ul class="kt-menu__subnav">
            <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true">
                <span class="kt-menu__link">
                    <span class="kt-menu__link-text">
                        Exam
                    </span>
                </span>
            </li>
            <li class="kt-menu__item @yield('exam.create')" aria-haspopup="true">
                <a href="#" class="kt-menu__link ">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i>
                    <span class="kt-menu__link-text">Create New Exam</span>
                </a>
            </li>
            <li class="kt-menu__item @yield('exam.list')" aria-haspopup="true">
                <a href="#" class="kt-menu__link ">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i>
                    <span class="kt-menu__link-text">List Exam</span>
                </a>
            </li>
        </ul>
    </div>
</li>
@endif

{{-- Exam Management --}}
@if (session('level') == 'admin' || session('level') == 'instructor')
    <li class="kt-menu__section ">
        <h4 class="kt-menu__section-text">Exam Management</h4>
        <i class="kt-menu__section-icon flaticon-more-v2"></i>
    </li>


    <li class="kt-menu__item  kt-menu__item--submenu @yield('exam-session')" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
            <i class="kt-menu__link-icon la la-laptop"></i>
            <span class="kt-menu__link-text">Exam Session</span>
            <i class="kt-menu__ver-arrow la la-angle-right"></i>
        </a>
        <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
            <ul class="kt-menu__subnav">
                <li class="kt-menu__item @yield('exam-session.create')" aria-haspopup="true">
                    <a href="#" class="kt-menu__link ">
                        <i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i>
                        <span class="kt-menu__link-text">New Session</span>
                    </a>
                </li>
                <li class="kt-menu__item @yield('exam-session.list')" aria-haspopup="true">
                    <a href="#" class="kt-menu__link ">
                        <i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i>
                        <span class="kt-menu__link-text">List Exam Session</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>
@endif

@if (session('level') == 'admin' || session('level') == 'instructor')
    <li class="kt-menu__item @yield('user-enroll')" aria-haspopup="true">
        <a href="{{ route('admin.dashboard') }}" class="kt-menu__link ">
            <i class="kt-menu__link-icon la la-user"></i><span class="kt-menu__link-text">User Enroll</span>
        </a>
    </li>
@endif

@if (session('level') == 'admin' || session('level') == 'instructor')
    <li class="kt-menu__item @yield('evaluate')" aria-haspopup="true">
        <a href="{{ route('admin.dashboard') }}" class="kt-menu__link ">
            <i class="kt-menu__link-icon la la-check-square"></i><span class="kt-menu__link-text">Evaluate</span>
        </a>
    </li>
@endif

@if (session('level') == 'admin' || session('level') == 'instructor')
    <li class="kt-menu__item @yield('report')" aria-haspopup="true">
        <a href="{{ route('admin.dashboard') }}" class="kt-menu__link ">
            <i class="kt-menu__link-icon la la-file"></i><span class="kt-menu__link-text">Report</span>
        </a>
    </li>
@endif


 


