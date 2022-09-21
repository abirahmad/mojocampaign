@extends('frontend.layouts.master')

@section('title')
User History | Mojo Eid Campaign
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
                                <h3>All Results of</h3>
                                <h1>{{ $username->first_name . ' ' . $username->last_name }}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="tableList">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">SL</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Answer</th>
                                        <th scope="col">Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i = 1;
                                    @endphp
                                    @foreach($histories as $history)
                                    <tr>
                                        <th scope="row">{{ $i }}</th>
                                        <td>{{ $history->date }}</td>
                                        <td>{{ $history->correct_answers->count() }}</td>
                                        <td>{{ round($history->total_time / 60, 2) }} Minutes</td>
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