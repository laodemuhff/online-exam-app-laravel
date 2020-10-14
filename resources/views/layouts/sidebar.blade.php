<li class="kt-menu__item {{ Request::route()->getName() == 'home' ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
    <a href="{{ route('home') }}" class="kt-menu__link ">
        <i class="kt-menu__link-icon flaticon-home"></i><span class="kt-menu__link-text">Dashboard</span>
    </a>
</li>
{{-- <li class="kt-menu__section ">
    <h4 class="kt-menu__section-text">Custom</h4>
    <i class="kt-menu__section-icon flaticon-more-v2"></i>
</li>
<li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon-web"></i><span class="kt-menu__link-text">Applications</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
        <ul class="kt-menu__subnav">
            <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">Applications</span></span></li>
            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">Users</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                    <ul class="kt-menu__subnav">
                        <li class="kt-menu__item " aria-haspopup="true"><a href="custom/apps/user/list-default.html" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">List - Default</span></a></li>
                        <li class="kt-menu__item " aria-haspopup="true"><a href="custom/apps/user/list-datatable.html" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">List - Datatable</span></a></li>
                        <li class="kt-menu__item " aria-haspopup="true"><a href="custom/apps/user/list-columns-1.html" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">List - Columns 1</span></a></li>
                        <li class="kt-menu__item " aria-haspopup="true"><a href="custom/apps/user/list-columns-2.html" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">List - Columns 2</span></a></li>
                        <li class="kt-menu__item " aria-haspopup="true"><a href="custom/apps/user/add-user.html" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Add User</span></a></li>
                        <li class="kt-menu__item " aria-haspopup="true"><a href="custom/apps/user/edit-user.html" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Edit User</span></a></li>
                        <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Profile 1</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                            <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item " aria-haspopup="true"><a href="custom/apps/user/profile-1/overview.html" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">Overview</span></a></li>
                                    <li class="kt-menu__item " aria-haspopup="true"><a href="custom/apps/user/profile-1/personal-information.html" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">Personal Information</span></a></li>
                                    <li class="kt-menu__item " aria-haspopup="true"><a href="custom/apps/user/profile-1/account-information.html" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">Account Information</span></a></li>
                                    <li class="kt-menu__item " aria-haspopup="true"><a href="custom/apps/user/profile-1/change-password.html" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">Change Password</span></a></li>
                                    <li class="kt-menu__item " aria-haspopup="true"><a href="custom/apps/user/profile-1/email-settings.html" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">Email Settings</span></a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="kt-menu__item " aria-haspopup="true"><a href="custom/apps/user/profile-2.html" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Profile 2</span></a></li>
                        <li class="kt-menu__item " aria-haspopup="true"><a href="custom/apps/user/profile-3.html" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Profile 3</span></a></li>
                        <li class="kt-menu__item " aria-haspopup="true"><a href="custom/apps/user/profile-4.html" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Profile 4</span></a></li>
                    </ul>
                </div>
            </li>
            <li class="kt-menu__item " aria-haspopup="true"><a href="custom/apps/inbox.html" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">Inbox</span><span class="kt-menu__link-badge"><span class="kt-badge kt-badge--danger kt-badge--inline">new</span></span></a></li>
        </ul>
    </div>
</li> --}}

{{-- START::Route USER --}}

    {{-- Admin Management --}}
    <li class="kt-menu__section ">
        <h4 class="kt-menu__section-text">User Management</h4>
        <i class="kt-menu__section-icon flaticon-more-v2"></i>
    </li>


    <li class="kt-menu__item  kt-menu__item--submenu @yield('admin-management')" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
            <i class="kt-menu__link-icon flaticon-users"></i>
            <span class="kt-menu__link-text">User</span>
            <i class="kt-menu__ver-arrow la la-angle-right"></i>
        </a>
        <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
            <ul class="kt-menu__subnav">
                <li class="kt-menu__item" aria-haspopup="true">
                    <a href="#" class="kt-menu__link ">
                        <i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i>
                        <span class="kt-menu__link-text">Participants</span>
                    </a>
                </li>
                <li class="kt-menu__item" aria-haspopup="true">
                    <a href="#" class="kt-menu__link ">
                        <i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i>
                        <span class="kt-menu__link-text">Instructors</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>
{{-- END::Route USER --}}

    <li class="kt-menu__section ">
        <h4 class="kt-menu__section-text">Exam Session</h4>
        <i class="kt-menu__section-icon flaticon-more-v2"></i>
    </li>


    <li class="kt-menu__item  kt-menu__item--submenu @yield('admin-management')" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
            <i class="kt-menu__link-icon la la-laptop"></i>
            <span class="kt-menu__link-text">Exam Session</span>
            <i class="kt-menu__ver-arrow la la-angle-right"></i>
        </a>
        <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
            <ul class="kt-menu__subnav">
                <li class="kt-menu__item" aria-haspopup="true">
                    <a href="#" class="kt-menu__link ">
                        <i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i>
                        <span class="kt-menu__link-text">New Session</span>
                    </a>
                </li>
                <li class="kt-menu__item" aria-haspopup="true">
                    <a href="#" class="kt-menu__link ">
                        <i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i>
                        <span class="kt-menu__link-text">List Exam Session</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>


    <li class="kt-menu__item" aria-haspopup="true">
        <a href="{{ route('home') }}" class="kt-menu__link ">
            <i class="kt-menu__link-icon la la-check-square"></i><span class="kt-menu__link-text">Evaluate</span>
        </a>
    </li>

    <li class="kt-menu__item" aria-haspopup="true">
        <a href="{{ route('home') }}" class="kt-menu__link ">
            <i class="kt-menu__link-icon la la-user"></i><span class="kt-menu__link-text">User Enroll</span>
        </a>
    </li>

    <li class="kt-menu__item" aria-haspopup="true">
        <a href="{{ route('home') }}" class="kt-menu__link ">
            <i class="kt-menu__link-icon la la-file"></i><span class="kt-menu__link-text">Report</span>
        </a>
    </li>

{{-- START::Route FASKES --}}
    {{-- armada management --}}
    <li class="kt-menu__section ">
        <h4 class="kt-menu__section-text">Setting</h4>
        <i class="kt-menu__section-icon flaticon-more-v2"></i>
    </li>

    <li class="kt-menu__item  kt-menu__item--submenu @yield('armada')" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
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
                <li class="kt-menu__item" aria-haspopup="true">
                    <a href="#" class="kt-menu__link ">
                        <i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i>
                        <span class="kt-menu__link-text">Create New Exam</span>
                    </a>
                </li>
                <li class="kt-menu__item" aria-haspopup="true">
                    <a href="#" class="kt-menu__link ">
                        <i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i>
                        <span class="kt-menu__link-text">List Exam</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>

    <li class="kt-menu__item  kt-menu__item--submenu @yield('armada')" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
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
                <li class="kt-menu__item" aria-haspopup="true">
                    <a href="#" class="kt-menu__link ">
                        <i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i>
                        <span class="kt-menu__link-text">Create Question</span>
                    </a>
                </li>
                <li class="kt-menu__item" aria-haspopup="true">
                    <a href="#" class="kt-menu__link ">
                        <i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i>
                        <span class="kt-menu__link-text">List Question</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>


