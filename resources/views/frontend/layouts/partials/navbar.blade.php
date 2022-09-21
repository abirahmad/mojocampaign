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
                            </li>
                            @if(auth()->user() != null)
                            @php
                            $username = auth()->user()->first_name;
                            @endphp
                            <li class="nav-item {{ Route::is('user.history') ? 'active' : '' }}">
                                <div class="dropdown show">
                                    <a class="btn btn-secondary dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-user"></i> <span>{{ $username }}</span>
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="User01">
                                        <form action="{{ route('user.history', [auth()->user()->id]) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">My Results</button>
                                        </form>

                                        <form action="{{ route('user.logout') }}" method="POST">
                                            @csrf
                                            <!-- <a href="#" class="dropdown-item">Logout</a> -->
                                            <button type="submit" class="btn btn-danger">Logout<i class="fa fa-sign-out-alt"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </li>
                            @else
                            <li class="nav-item {{ Route::is('user.registration') ? 'active' : '' }}">
                                <a class="nav-link {{ Route::is('user.registration') ? 'actives' : '' }}" href="{{ route('user.registration') }}">Registration</a>
                            </li>
                            <li class="nav-item {{ Route::is('user.login') ? 'active' : '' }}">
                                <a class="nav-link {{ Route::is('user.login') ? 'actives' : '' }}" href="{{ route('user.login') }}">Login</a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>

</div>
<!-- navigation end -->