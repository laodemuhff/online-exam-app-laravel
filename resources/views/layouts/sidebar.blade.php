<li class="kt-menu__item {{ Request::route()->getName() == 'admin.dashboard' ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
    <a href="{{route('admin.dashboard')}}" class="kt-menu__link ">
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
@if(adminFeature(['admin_management_create','admin_management_list','admin_management_update','admin_management_delete']))
    {{-- Admin Management --}}
    <li class="kt-menu__section ">
        <h4 class="kt-menu__section-text">User Management</h4>
        <i class="kt-menu__section-icon flaticon-more-v2"></i>
    </li>

    @if(adminFeature(['admin_management_create','admin_management_list','admin_management_update','admin_management_delete']))
        <li class="kt-menu__item  kt-menu__item--submenu @yield('admin-management')" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                <i class="kt-menu__link-icon flaticon-users"></i>
                <span class="kt-menu__link-text">Admin</span>
                <i class="kt-menu__ver-arrow la la-angle-right"></i>
            </a>
            <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                <ul class="kt-menu__subnav">
                    <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true">
                        <span class="kt-menu__link">
                            <span class="kt-menu__link-text">
                                Admin
                            </span>
                        </span>
                    </li>
                    @if(adminFeature(['admin_management_create']))
                        <li class="kt-menu__item {{ Request::route()->getName() == 'admin.admin.management.create' ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                            <a href="{{route('admin.admin.management.create')}}" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i>
                                <span class="kt-menu__link-text">Create Admin</span>
                            </a>
                        </li>
                    @endif
                    @if(adminFeature(['admin_management_list','admin_management_update','admin_management_delete']))
                        <li class="kt-menu__item {{ Request::route()->getName() == 'admin.admin.management.list' ? 'kt-menu__item--active' : '' }}{{ Request::route()->getName() == 'admin.admin.management.edit' ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                            <a href="{{route('admin.admin.management.list')}}" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i>
                                <span class="kt-menu__link-text">List Admin</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </li>
    @endif
@endif
{{-- END::Route USER --}}


@if(adminFeature(['armada_list','armada_create','armada_update','armada_delete']))
    <li class="kt-menu__section ">
        <h4 class="kt-menu__section-text">Rental Management</h4>
        <i class="kt-menu__section-icon flaticon-more-v2"></i>
    </li>

    @if(adminFeature(['armada_list','armada_create','armada_update','armada_delete']))
        <li class="kt-menu__item  kt-menu__item--submenu @yield('armada')" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                <i class="kt-menu__link-icon la la-car" style="font-size:1.6em"></i>
                <span class="kt-menu__link-text">Armada</span>
                <i class="kt-menu__ver-arrow la la-angle-right"></i>
            </a>
            <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                <ul class="kt-menu__subnav">
                    <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true">
                        <span class="kt-menu__link">
                            <span class="kt-menu__link-text">
                                Armada
                            </span>
                        </span>
                    </li>
                    @if(adminFeature(['tipe_armada_list', 'tipe_armada_create', 'tipe_armada_update', 'tipe_armada_delete']))
                        <li class="kt-menu__item {{ Request::route()->getName() == 'tipe_armada.list' ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                            <a href="{{route('tipe_armada.list')}}" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i>
                                <span class="kt-menu__link-text">Tipe Armada</span>
                            </a>
                        </li>
                    @endif
                    @if(adminFeature(['armada_create']))
                        <li class="kt-menu__item {{ Request::route()->getName() == 'armada.create' ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                            <a href="{{route('armada.create')}}" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i>
                                <span class="kt-menu__link-text">Add Armada</span>
                            </a>
                        </li>
                    @endif
                    @if(adminFeature(['armada_list','armada_update','armada_delete']))
                        <li class="kt-menu__item {{ Request::route()->getName() == 'armada.list' ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                            <a href="{{route('armada.list')}}" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i>
                                <span class="kt-menu__link-text">List Armada</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </li>
    @endif

    <li class="kt-menu__item  kt-menu__item--submenu @yield('driver')" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
            <i class="kt-menu__link-icon flaticon-car"></i>
            <span class="kt-menu__link-text">Driver</span>
            <i class="kt-menu__ver-arrow la la-angle-right"></i>
        </a>
        <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
            <ul class="kt-menu__subnav">
                <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true">
                    <span class="kt-menu__link">
                        <span class="kt-menu__link-text">
                            Driver
                        </span>
                    </span>
                </li>
                <li class="kt-menu__item {{ Request::route()->getName() == 'driver.list' ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                    <a href="{{route('driver.list')}}" class="kt-menu__link ">
                        <i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i>
                        <span class="kt-menu__link-text">List Driver</span>
                    </a>
                </li>
                <li class="kt-menu__item {{ Request::route()->getName() == 'driver.assign' ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                    <a href="{{route('driver.assign')}}" class="kt-menu__link ">
                        <i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i>
                        <span class="kt-menu__link-text">Assign Driver</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>


    <li class="kt-menu__item  kt-menu__item--submenu @yield('syarat_dan_jaminan')" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
            <i class="kt-menu__link-icon la la-paperclip" style="font-size: 1.6em"></i>
            <span class="kt-menu__link-text">Syarat & Jaminan</span>
            <i class="kt-menu__ver-arrow la la-angle-right"></i>
        </a>
        <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
            <ul class="kt-menu__subnav">
                <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true">
                    <span class="kt-menu__link">
                        <span class="kt-menu__link-text">
                            Syarat & Jaminan
                        </span>
                    </span>
                </li>
                {{-- <li class="kt-menu__item {{ Request::route()->getName() == 'driver_create' ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                    <a href="{{route('driver.create')}}" class="kt-menu__link ">
                        <i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i>
                        <span class="kt-menu__link-text">Add Syarat & Jaminan</span>
                    </a>
                </li>
                <li class="kt-menu__item {{ Request::route()->getName() == 'driver_list' ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                    <a href="{{route('driver.list')}}" class="kt-menu__link ">
                        <i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i>
                        <span class="kt-menu__link-text">List Syarat & Jaminan</span>
                    </a>
                </li> --}}
            </ul>
        </div>
    </li>
    
    <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon la la-cart-plus" style="font-size: 1.6em"></i><span class="kt-menu__link-text">Transaction</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
        <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
            <ul class="kt-menu__subnav">
                <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">Transaction</span></span></li>
                <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">List Transaction</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            <li class="kt-menu__item " aria-haspopup="true"><a href="custom/apps/user/list-default.html" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Pending</span><span class="kt-menu__link-badge"><span class="kt-badge kt-badge--warning kt-badge--inline" style="color:white">13 fleet</span></span></a></li>
                            <li class="kt-menu__item " aria-haspopup="true"><a href="custom/apps/user/list-datatable.html" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Cancelled</span></a></li>
                            <li class="kt-menu__item " aria-haspopup="true"><a href="custom/apps/user/list-columns-1.html" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">On Rent</span><span class="kt-menu__link-badge"><span class="kt-badge kt-badge--success kt-badge--inline">5 fleet</span></span></a></li>
                            <li class="kt-menu__item " aria-haspopup="true"><a href="custom/apps/user/list-columns-2.html" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">History</span></a></li>
                        </ul>
                    </div>
                </li>
                <li class="kt-menu__item " aria-haspopup="true"><a href="custom/apps/inbox.html" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">Create Transaction</span></a></li>
            </ul>
        </div>
    </li>
@endif
{{-- END::Route Armada --}}



{{-- START::Route SETTING --}}
@if(adminFeature(['setting_maintenance_mode', 'setting_app_version']))
    <li class="kt-menu__section ">
        <h4 class="kt-menu__section-text">Settings</h4>
        <i class="kt-menu__section-icon flaticon-more-v2"></i>
    </li>

    {{-- Maintenance Mode --}}
    @if(adminFeature(['setting_maintenance_mode']))
        <li class="kt-menu__item {{ Request::route()->getName() == 'setting.maintenance.mode' ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
            <a href="{{route('setting.maintenance.mode')}}" class="kt-menu__link ">
                <i class="kt-menu__link-icon la la-gears" style="font-size: 1.6em"></i><span class="kt-menu__link-text">Maintenance Mode</span>
            </a>
        </li>
    @endif

    <li class="kt-menu__item {{ Request::route()->getName() == 'setting.wordings' ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
        <a href="{{route('setting.wordings')}}" class="kt-menu__link ">
            <i class="kt-menu__link-icon la la-font" style="font-size: 1.6em"></i><span class="kt-menu__link-text">App Wordings</span>
        </a>
    </li>

@endif
{{-- END::Route SETTING --}}

