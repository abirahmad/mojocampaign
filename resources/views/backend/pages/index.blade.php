@extends('backend.layouts.app')

@section('top-content')
<div class="page-header">
    <div class="row">
        <div class="col">
            <div class="page-header-left">
                <h3>Welcome {{ $user->first_name }}</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"><i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection

@section('admin-content')

<div class="row">
    <div class="col-xl-8 xl-100 dashboard-page">
        <div class="row">

            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="chart-widget-dashboard">
                            <div class="media" onclick='location.href="{{ route("admin.users.index") }}"'>
                                <div class="media-body">
                                    <h5>User List</h5>
                                </div><i data-feather="user"></i>
                            </div>
                            <div class="dashboard-chart-container">
                                <div class="small-chart-gradient-1"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- Single item -->

            {{-- <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="chart-widget-dashboard">
                            <div class="media" onclick='location.href="{{ route("admin.users.create") }}"'>
                                <div class="media-body">
                                    <h5>User Create</h5>
                                </div><i data-feather="info"></i>
                            </div>
                            <div class="dashboard-chart-container">
                                <div class="small-chart-gradient-1"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- Single item --> --}}

            {{-- <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="chart-widget-dashboard">
                            <div class="media" onclick='location.href="{{ route("admin.roles.index") }}"'>
                                <div class="media-body">
                                    <h5>Role List</h5>
                                </div><i data-feather="info"></i>
                            </div>
                            <div class="dashboard-chart-container">
                                <div class="small-chart-gradient-1"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- Single item --> --}}

            {{-- <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="chart-widget-dashboard">
                            <div class="media" onclick='location.href="{{ route("admin.roles.index") }}"'>
                                <div class="media-body">
                                    <h5>Role Create</h5>
                                </div><i data-feather="info"></i>
                            </div>
                            <div class="dashboard-chart-container">
                                <div class="small-chart-gradient-1"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- Single item --> --}}

            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="chart-widget-dashboard">
                            <div class="media" onclick='location.href="{{ route("admin.daily-winners.index") }}"'>
                                <div class="media-body">
                                    <h5>Daily Winner</h5>
                                </div><i data-feather="award"></i>
                            </div>
                            <div class="dashboard-chart-container">
                                <div class="small-chart-gradient-1"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- Single item -->

            
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="chart-widget-dashboard">
                            <div class="media" onclick='location.href="{{ route("admin.monthly-winners.index") }}"'>
                                <div class="media-body">
                                    <h5>Monthly Winner</h5>
                                </div><i data-feather="award"></i>
                            </div>
                            <div class="dashboard-chart-container">
                                <div class="small-chart-gradient-1"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- Single item -->
            
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="chart-widget-dashboard">
                            <div class="media" onclick='location.href="{{ route("admin.responses.index") }}"'>
                                <div class="media-body">
                                    <h5>All Responses</h5>
                                </div><i data-feather="globe"></i>
                            </div>
                            <div class="dashboard-chart-container">
                                <div class="small-chart-gradient-1"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- Single item -->
            
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="chart-widget-dashboard">
                            <div class="media" onclick='location.href="{{ route("admin.questions.index") }}"'>
                                <div class="media-body">
                                    <h5>All Questions</h5>
                                </div><i data-feather="shopping-cart"></i>
                            </div>
                            <div class="dashboard-chart-container">
                                <div class="small-chart-gradient-1"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- Single item -->

            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="chart-widget-dashboard">
                            <div class="media" onclick='location.href="{{ route("admin.question-set.index") }}"'>
                                <div class="media-body">
                                    <h5>Question Sets</h5>
                                </div><i data-feather="shopping-cart"></i>
                            </div>
                            <div class="dashboard-chart-container">
                                <div class="small-chart-gradient-1"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- Single item -->

            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="chart-widget-dashboard">
                            <div class="media" onclick='location.href="{{ route("admin.pages.settings") }}"'>
                                <div class="media-body">
                                    <h5>Settings</h5>
                                </div><i data-feather="settings"></i>
                            </div>
                            <div class="dashboard-chart-container">
                                <div class="small-chart-gradient-1"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- Single item -->

        </div>
    </div>
</div> <!-- end .row -->


{{-- <div class="row">
    <div class="col-xl-8 xl-100 dashboard-page">
        <div class="row">

            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="chart-widget-dashboard">
                            <div class="media" onclick='location.href="{{ route("admin.questions.index") }}"'>
                                <div class="media-body">
                                    <h5>Blogs List</h5>
                                </div><i data-feather="info"></i>
                            </div>
                            <div class="dashboard-chart-container">
                                <div class="small-chart-gradient-1"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- Single item -->
        </div>
    </div>
</div> <!-- end .row --> --}}


@endsection