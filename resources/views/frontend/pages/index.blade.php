@extends('frontend.layouts.master')

@section('title')
Home | {{ config('app.name') }}
@endsection

@section('meta_tags')
<meta property="og:title" content="{{ config('app.name') }}">
<meta property="og:description" content="{{ config('app.name') }}">
<meta property="og:image" content="{{ asset('public/assets/img/logo.png') }}">
<meta property="og:url" content="{{ url('/') }}">

<meta name="twitter:title" content="{{ config('app.name') }}">
<meta name="twitter:description" content=" {{ config('app.name') }}">
<meta name="twitter:image" content="{{ asset('public/assets/img/logo.png') }}">
<meta name="twitter:card" content="summary_large_image">
@endsection

@section('styles')

@endsection

@section('main-content')
<div class="main-content">
    
</div>
@endsection

@section('scripts')

@endsection