<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EMS Finance Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/sweetalert.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ auth()->user()?->isFinance() ? route('finance.dashboard') : url('/') }}">
                EMS Finance
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item">
                            <form action="{{ url('/logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-link nav-link" style="cursor: pointer;">Logout</button>
                            </form>
                        </li>
                    @endauth
                    @guest
                        <li class="nav-item"><a class="nav-link" href="{{ url('/login') }}">Login</a></li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            @auth
                <!-- Sidebar -->
                <div class="col-md-2 bg-light border-end vh-100 py-4" style="position: fixed;">
                    <ul class="nav flex-column">
                        @if(auth()->user()->isFinance())
                            <li class="nav-item">
                                <a href="{{ route('finance.dashboard') }}"
                                   class="nav-link {{ request()->routeIs('finance.dashboard') ? 'active text-primary fw-bold' : 'text-dark' }}">
                                    Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('finance.event-payments') }}"
                                   class="nav-link {{ request()->routeIs('finance.event-payments') ? 'active text-primary fw-bold' : 'text-dark' }}">
                                    Event Payment
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('finance.request-provider') }}"
                                   class="nav-link {{ request()->routeIs('finance.request-provider') ? 'active text-primary fw-bold' : 'text-dark' }}">
                                    Request Provider
                                </a>
                            </li>
                        @endif
                
                        <li class="nav-item">
                            <a href="{{ route('profile.edit') }}"
                               class="nav-link {{ request()->routeIs('profile.edit') ? 'active text-primary fw-bold' : 'text-dark' }}">
                                Profile
                            </a>
                        </li>
                    </ul>
                </div>
                
                {{-- <div class="col-md-2 bg-light border-end vh-100 py-4" style="position: fixed;">
                    <ul class="nav flex-column">
                        @if(auth()->user()->isFinance())
                        <li class="nav-item">
                            <a href="{{ route('finance.dashboard') }}" class="nav-link">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('finance.event-payments') }}" class="nav-link">Event Payment</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('finance.request-provider') }}" class="nav-link">Request Provider</a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a href="{{ route('profile.edit') }}" class="nav-link">Profile</a>
                        </li>
                    </ul>
                </div> --}}
                <!-- End Sidebar -->
                <div class="col-md-10 offset-md-2 py-4">
                    @yield('content')
                </div>
            @else
                <div class="col-12 py-4">
                    @yield('content')
                </div>
            @endauth
        </div>
    </div>

    <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert.js') }}"></script>
    @stack('scripts')
</body>
</html>
