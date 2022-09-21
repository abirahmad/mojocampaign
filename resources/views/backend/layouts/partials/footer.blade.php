@php
    $settings = App\Models\Setting::first();
@endphp
<!-- footer start-->
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 footer-copyright text-right">
                <p class="mb-0">Copyright 2020 © Endless All rights reserved.</p>
            </div>
            <div class="col-md-6">
                <p class="pull-right mb-0">
                    {{ $settings->footer_text }}    
                <i class="fa fa-heart"></i></p>
            </div>
        </div>
    </div>
</footer>