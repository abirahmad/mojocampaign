@extends('frontend.auth.auth_master')

@section('title')
Registration | Mojo Eid Campaign
@endsection

@section('content')
<!-- registration start -->
<div class="registrationSection">
    <div class="container">
        <div class="row registrationForm">
            <div class="col-lg-6">
                <div class="registrationImg">
                    <img src="{{ asset('public/assets/frontend/img/mojoimg.png') }}" />
                </div>
            </div>
            <div class="col-lg-6">
                <div class="formbox login">
                    <img src="{{ asset('public/assets/frontend/img/loging.png')}}" alt="logo">
                    <form action="{{ route('user.login.submit') }}" method="post" data-parsley-validate>
                        @csrf
                        @include('frontend.layouts.partials.messages')

                        <div class="form-group">
                            <label>Mobile NUmber<span style="color: red; padding-left: 5px;">*</span></label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="phone_hint">+88</span>
                                </div>
                                <input type="text" class="form-control w-100" value="{{ old('phone_no') }}" placeholder="11 digit number" name="phone_no" aria-label="phone_no" aria-describedby="phone_hint" minlength="11" maxlength="11" required>
                            </div>
                        </div>

                        <a href="#"><button type="submit" class="btn btn-danger mt-4">START<i class="fa fa-sign-out-alt"></i></button></a>

                    </form>
                    <hr>
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
<!-- registration end -->
@endsection

@section('footer')
<!--  footer start-->
<div class="footer footertop">
    <div class="container">
        <div class="row">
            <div class="footerDetails">
                <a href="https://www.facebook.com/mojomasti/?epa=SEARCH_BOX" target="_blanck"><i class="fab fa-facebook-f active"></i></a>
                <a href="https://twitter.com/akijgroupit?lang=en" target="_blanck"><i class="fab fa-twitter"></i></a>
                <p>Developed by Akij info Tech </p>
            </div>

        </div>
    </div>
</div>
<!-- footer end -->
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#registration_form').parsley();
    });
</script>
@endsection