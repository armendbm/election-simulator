<nav class="navbar navbar-expand-lg navbar-light bg-light shadow">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Elections To-Go</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Home
                        {!! Route::is('home') ? ' <span class="sr-only">(current)</span>' : ''!!}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard">Dashboard
                        {!! Route::is('dashboard') ? ' <span class="sr-only">(current)</span>' : ''!!}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/documentation">Documentation
                        {!! Route::is('documentation') ? ' <span class="sr-only">(current)</span>' : ''!!}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/votingscreen">Voting Screen
                        {!! Route::is('votingscreen') ? ' <span class="sr-only">(current)</span>' : ''!!}
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown link
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
            </ul>
            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a class="nav-link" href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class="bi bi-person-square"></i> Log out
                    </a>
                </form>
            @endauth
            @guest
                <div class="d-flex justify-content-between">
                    <a class="nav-link" href="/login"><i class="bi bi-person-square"></i> Log in</a>
                    <a class="nav-link" href="/register"><i class="bi bi-file-earmark-text"></i> Register</a>
                </div>
            @endguest
        </div>
    </div>
</nav>

