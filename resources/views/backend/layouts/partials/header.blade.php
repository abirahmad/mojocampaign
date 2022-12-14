<!-- Page Header Start-->
<div class="page-main-header">
<div class="main-header-right row">
    <div class="main-header-left d-lg-none">
        <div class="logo-wrapper">
            <!--<a href=""><img src="{{ asset('public/backend/images/logo-sm.png') }}" alt=""></a>-->
            <a href=""><img src="https://www.akijcement.com/wp-content/uploads/2018/10/logo.png" alt="" style="width: 150px"></a>
        </div>
    </div>
    <div class="mobile-sidebar d-block">
    <div class="media-body text-right switch-sm">
        <label class="switch"><a href="#"><i id="sidebar-toggle" data-feather="align-left"></i></a></label>
    </div>
    </div>
    <div class="nav-right col p-0">
    <ul class="nav-menus">
        <li></li>
        <li class="onhover-dropdown">
        <div class="media align-items-center"><img class="align-self-center pull-right img-50 rounded-circle" src="{{ asset('public/assets/backend/images/dashboard/user.png') }}" alt="header-user">
            <div class="dotted-animation"><span class="animate-circle"></span><span class="main-circle"></span></div>
        </div>
        @php
            $user = Auth::user();
        @endphp
        <ul class="profile-dropdown onhover-show-div p-20">
            <li><a href="{{ action('Backend\UserController@edit',$user->id) }}"><i data-feather="user"></i> Edit Profile</a></li>
            <li>
                <a href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i data-feather="log-out"></i> 
                    Logout
                </a>
            </li>
        </ul>
        </li>
    </ul>

    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    
    <div class="d-lg-none mobile-toggle pull-right"><i data-feather="more-horizontal"></i></div>
    </div>
    <script id="result-template" type="text/x-handlebars-template">
    <div class="ProfileCard u-cf">                        
    <div class="ProfileCard-avatar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
    <div class="ProfileCard-details">
    <div class="ProfileCard-realName"> Test Name</div>
    </div>
    </div>
    </script>
    <script id="empty-template" type="text/x-handlebars-template">
    <div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div>
    
    </script>
</div>
</div>
<!-- Page Header Ends  -->