@extends('frontend.layouts.master')

@php
$username = $response->user->first_name . ' ' . $response->user->last_name;
$settings = App\Models\Setting::first();
@endphp

@section('title')
{{ $username }} Result - {{ count($response->correct_answers) }} (out of {{ $response->total_answer }}) | Mojo Eid Campaign
@endsection


@section('social_meta')
<meta property="og:url" content="{{ route('user.result', $response->id) }}" />
<meta property="og:type" content="website" />
<meta property="og:title" content="Mojo Eid Campaign Quiz Contest" />
<meta property="og:description" content="{{ $username }} Result - {{ count($response->correct_answers) }} (out of {{ $response->total_answer }}) | Mojo Eid Campaign" />
<meta property="og:image" content="{{ url('public/assets/backend/images/logo/'.$settings->logo) }}" />
@endsection


@section('content')
<!-- user start -->
<div class="winnerDetails">
    <div class="container ">



        <div class="row formbox">
            <div class="col-lg-2">
                <div class="belunbox">
                    <img src="{{ asset('public/assets/frontend/img/left-belun.png') }}" alt="">
                </div>
            </div>
            <div class="col-lg-8">
                <div class="winnerImg">
                    <img src="{{ asset('public/assets/frontend/img/mojoimg.png') }}">
                    <h2>CONGRATULATION</h2>
                    <h1>{{ $username }}</h1>
                    <p>your life full of mojo</p>
                </div>
                <div class="winnerbox">
                    <div class="winnerInfoOne">
                        <div class="questionTitle">QUESTION ANSWER</div>
                        <div class="buttons">{{ count($response->correct_answers) }} (out of {{ $response->total_answer }})</div>
                    </div>
                    <div class="winnerInfoOne">
                        <div class="questionTitle">TIME</div>
                        <div class="buttons">{{ $response->total_time }} SEC</div>
                    </div>
                </div>

            </div>
            <div class="col-lg-2">
                <div class="belunbox">
                    <img src="{{ asset('public/assets/frontend/img/belun.png') }}" alt="">
                </div>
            </div>
            <div class="col-lg-12">
                @php
                $apiURL = route('user.result', $response->id);
                @endphp
                <span>Share on: </span>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('user.result', $response->id) }}" class="btn btn-primary btn-sm pl-3 pr-3" target="_blank">Facebook</a>
                {{-- <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.akijfood.com" target="_blank">Facebook</a> --}}
                <!-- Facebook share button code -->
                <!-- <div class="fb-share-button" data-href="{{ $apiURL }}" data-layout="button_count"> -->
                {{-- <div class="fb-share-button" data-href="https://www.akijfood.com/" data-layout="button_count"> --}}
            </div>
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
<!-- user end -->
@endsection

@section('footer')
@include('frontend.layouts.partials.footer')
@endsection

@section('scripts')
<script>
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
@endsection