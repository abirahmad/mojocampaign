@php
$site = App\Models\Setting::first();
@endphp
<!--  footer start-->
<div class="footer">
    <div class="container">
        <div class="row">
            <div class="footerDetails">
                <a href="{{ $site->facebook_link }}" target="_blank"><i class="fab fa-facebook-f active"></i></a>
                <a href="{{ $site->twitter_link }}" target="_blank"><i class="fab fa-twitter"></i></a>
                <p>{{ $site->footer_text }} </p>
            </div>
        </div>
    </div>
</div>
<!-- footer end -->