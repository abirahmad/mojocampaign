<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Mojo Eid Campaign - Registration')</title>
  @include('frontend.layouts.partials.analytical')
  <link rel="shortcut icon" href="{{ asset('public/assets/frontend/img/rankLogo.png') }}" type="image/x-icon">
  @include('frontend.layouts.partials.styles')
</head>

<body>

  <!--  start navigation-->
  <div class="navigation">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav class="navbar navbar-expand-lg ">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="fas fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav">
                <li class="nav-item  {{ Route::is('user.quizes.index') ? 'active' : '' }}">
                    <a class="nav-link {{ Route::is('user.quizes.index') ? 'actives' : '' }}" href="{{ route('user.quizes.index') }}">Start Quiz</a>
                </li>
                <li class="nav-item  {{ Route::is('user.ranking') ? 'active' : '' }}">
                    <a class="nav-link {{ Route::is('user.ranking') ? 'actives' : '' }}" href="{{ route('user.ranking') }}">Ranking</a>
                </li>
                <li class="nav-item {{ Route::is('user.registration') ? 'active' : '' }}">
                  <a class="nav-link {{ Route::is('user.registration') ? 'actives' : '' }}" href="{{ route('user.registration') }}">Registration</a>
                </li>
                <li class="nav-item {{ Route::is('user.login') ? 'active' : '' }}">
                  <a class="nav-link {{ Route::is('user.login') ? 'actives' : '' }}" href="{{ route('user.login') }}">Login</a>
                </li>
              </ul>
            </div>
          </nav>
        </div>
      </div>
    </div>

  </div>
  <!-- navigation end -->

  @yield('content')

  @yield('footer')

  @include('frontend.layouts.partials.scripts')
</body>

</html>