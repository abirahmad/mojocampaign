@extends('frontend.layouts.master')

@section('title')
Ranking | Mojo Eid Campaign
@endsection


@section('social_meta')
@include('frontend.layouts.partials.social_meta')
@endsection

@section('content')
<!-- ranking starts -->
<div class="registrationSection">
    <div class="container">
        <div class="row registrationForm">

            <div class="offset-lg-2 col-lg-8">
                <div class="formbox">

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="logohere">
                                <img src="{{ asset('public/assets/frontend/img/rankLogo.png') }}" alt="">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="logoDetails">
                                <h3>{{ $showDate }}</h3>
                                <h1>Top 10 Ranking</h1>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="tableList">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Ranking</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Correct Answer</th>
                                        <th scope="col">Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i = 1;
                                    @endphp
                                    @foreach($dailyWinners as $dailyWinner)
                                    <tr>
                                        <th scope="row">{{ $i }}</th>
                                        <td>{{ $dailyWinner->username }}</td>
                                        <td>{{ $dailyWinner->total_correct }} (out of {{ $dailyWinner->total_answer }})</td>
                                        {{-- <td>{{ round($dailyWinner->total_time / 60, 2) }} Minutes</td> --}}
                                        <td>{{ $dailyWinner->total_time }} Seconds</td>
                                    </tr>

                                    @php
                                    $i++;
                                    @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="alert alert-danger p-2">
                            <h4>Daily Winning Rules:</h4>
                            <p>Any Perticipant who has selected as a <strong>Daily Winner</strong> <mark>once</mark>, he will not be selected again as a daily winner <mark>twice</mark>!!</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="logohere">
                                <!-- <img src="{{ asset('public/assets/frontend/img/rankLogo.png') }}" alt=""> -->
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="logoDetails">
                                <h1>Top 3 Ranking</h1>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="tableList">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Ranking</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Correct Answer</th>
                                        <th scope="col">Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i = 1;
                                    @endphp
                                    @foreach($monthlyWinners as $monthlyWinner)
                                    <tr>
                                        <th scope="row">{{ $i }}</th>
                                        <td>{{ $monthlyWinner->username }}</td>
                                        <td>{{ $monthlyWinner->total_correct }} (out of {{ $monthlyWinner->total_answer }})</td>
                                        {{-- <td>{{ round($monthlyWinner->total_time / 60, 2) }} Minutes</td> --}}
                                        <td>{{ round($monthlyWinner->total_time) }} Seconds</td>
                                    </tr>

                                    @php
                                    $i++;
                                    @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="timeLieft">
                            <div class="titletime">
                                <h3>
                                    Time Left
                                </h3>
                                <p id="demo"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
<!-- ranking end -->
@endsection

@section('footer')
@include('frontend.layouts.partials.footer')
@endsection