@php
    $settings = App\Models\Setting::first();
@endphp
<!-- Page Sidebar Start-->
<div class="page-sidebar">
    <div class="main-header-left d-none d-lg-block">
        <div class="logo-wrapper">
            <a href="{{ route('admin.index') }}">
                <img class="report-min-img" src="{{ url('public/assets/backend/images/logo/'.$settings->logo) }}">
            </a>
        </div>
    </div>
    <div class="sidebar custom-scrollbar">
        <div class="sidebar-user text-center">
            <div><img class="img-60 rounded-circle" src="{{ asset('public/assets/backend/images/user/1.jpg') }}" alt="#">
                <div class="profile-edit"><a href="#" target="_blank"><i data-feather="edit"></i></a></div>
            </div>
            <h6 class="mt-3 f-14">{{ Auth::user()->username }}</h6>
            <p></p>
        </div>
        <ul class="sidebar-menu">
            <li class="{{ Route::is('admin.index') ? 'active' : '' }}"><a class="sidebar-header" href="{{ route('admin.index') }}"><i data-feather="home"></i><span> Dashboard</span></a></li>

            <!-- User Management -->
            <li class=""><a class="sidebar-header" href="{{ route('admin.users.index') }}"><i data-feather="user"></i><span> All Users</span></a></li>

            <!-- Response Management -->
            <li class=""><a class="sidebar-header" href="{{ route('admin.responses.index') }}"><i data-feather="aperture"></i><span> All Responses</span></a></li>

            <!-- Winner Management -->
            <li class="{{ (Route::is('admin.daily-winners.index') || Route::is('admin.monthly-winners.index')) ? 'active' : '' }}">
                <a class="sidebar-header" href="#"><i data-feather="award"></i><span>Winners</span><i class="fa fa-angle-right pull-right"></i></a>

                <ul class="sidebar-submenu {{ (Route::is('admin.daily-winners.index') || Route::is('admin.monthly-winners.index')) ? 'menu-open' : '' }}">
                    <li class=""><a href="{{route('admin.daily-winners.index')}}"><i class="fa fa-chevron-right"></i>
                            Daily</a>
                    </li>
                    <li class=""><a href="{{ route('admin.monthly-winners.index') }}"><i class="fa fa-chevron-right"></i>
                            Monthly</a>
                    </li>
                </ul>
            </li>

            <!-- Site & Project -->
            <li class="">
                <a class="sidebar-header" href="#"><i data-feather="shopping-cart"></i><span>Qusetions</span><i class="fa fa-angle-right pull-right"></i></a>
                <ul class="sidebar-submenu">
                    <li class="">
                        <a href="{{route('admin.questions.index')}}"><i class="fa fa-chevron-right"></i>
                            Questions</a>
                    </li>
                    <li class="">
                        <a href="{{route('admin.question-set.index')}}"><i class="fa fa-chevron-right"></i>
                            Questions Set</a>
                    </li>

                    {{-- <li class="">
                        <a href="{{route('admin.questions.index')}}"><i class="fa fa-chevron-right"></i>
                            Blogs</a>
                    </li> --}}
                </ul>
            </li>

            <!-- Admin Management -->
            {{-- <li class="">
                <a class="sidebar-header" href="#"><i data-feather="users"></i><span>Admin Management</span><i class="fa fa-angle-right pull-right"></i></a>

                <ul class="sidebar-submenu">
                    <li class=""><a href="{{route('admin.admins.index')}}"><i class="fa fa-chevron-right"></i>
                            Admin</a>
                    </li>
                    <li class=""><a href="{{ route('admin.roles.index') }}"><i class="fa fa-chevron-right"></i>
                            Role</a>
                    </li>
                </ul>
            </li> --}}

            <li>
                <a class="sidebar-header" href="{{route('admin.pages.settings')}}" target="_blank"><i data-feather="settings"></i><span>
                        Settings</span></a>
            </li>
        </ul>
    </div>
</div>
<!-- Page Sidebar Ends-->