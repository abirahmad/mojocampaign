@php
$site=App\Models\Setting::first();    
@endphp

<!-- Header Top Area Start -->
     <div class="HeaderTopArea">
         <div class="container">
             <div class="row">
                 <div class="col-lg-6 col-6">
                     <div class="follow_us">
                         <div class="leftColl">
                             <p>Follow Us</p>
                         </div>
                         <div class="rightColl">
                            <a href="{{ $site->facebook_link }}" target="_blanck"><i class="fab fa-facebook-f"></i></a> 
                             <a href="{{ $site->twitter_link }}" target="_blanck"><i class="fab fa-twitter"></i></a>
                             <a href="{{ $site->linkdin_link }}" target="_blanck"><i class="fab fa-linkedin-in"></i></a>
                         </div>
                     </div>
                  </div>
                 <div class="col-lg-6 col-6">
                     <a href="http://www.akij.net" target="_blanck">
                         <div class="webmail_us">
                             <p>A concern of Akij Group</p><img src="{{ asset('public/assets//img/web-25x30.a807981f.svg') }}">
                         </div>
                     </a>
                 </div>
             </div>
         </div>
     </div>
     <!-- Header Top Area End  -->

     <!-- Logo Area Start -->
     <div class="logoArea">
         <div class="container">
             <div class="row">
                 <div class="col-lg-4 col-4">
                     <a href="{{ route('index') }}">
                         <div class="logoHere"><img src="{{ asset('public/assets/img/logo.png') }}"></div>
                     </a>
                 </div>
                 <div class="col-lg-8 col-8">
                     <div class="quick_box_wrapper">
                         <div class="quick_box hotline">
                             <div class="quick_icon"><i class="fas fa-phone"></i></div>
                             <div class="quick_details">
                                 <h3>Toll Free: {{ $site->contact_toll_free_number }}</h3>
                                 <p>Hot Line: {{ $site->contact_hotline_number }}</p>
                             </div>
                         </div>
                         <div class="quick_box">
                             <div class="quick_icon"><i class="fas fa-envelope"></i></div>
                             <div class="quick_details">
                                 <h3>Email Us:</h3>
                                 <p>{{ $site->email }}</p>
                             </div>
                         </div>
                         <div class="quick_box qualityFirst  ">
                             <div class="boxtopright"></div>
                             <h3>Quality First</h3>
                             <p>- SK.AKIJ UDDIN</p>
                             <div class="boxbottomleft"></div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <!-- Logo Area End -->