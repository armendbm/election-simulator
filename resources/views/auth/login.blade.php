<x-guest-layout>
    <div class="card">
        <div class="card-header text-center">
            <h1 class="fw-normal">Elections To-Go</h1>
            <h3 class="fw-light">Sign in</p>
        </div>
        <div class="card-body">
            @if (count($errors) > 0)
                @foreach ($errors->all() as $message)
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Whoops!</strong>
                        {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endforeach
            @endif
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-floating mb-3">
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="Email address" required
                        @if (!old('name'))
                            autofocus
                        @endif
                    >
                    <label for="email">Email address</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" required autocomplete="current-password" autofocus>
                    <label for="password">Password</label>
                </div>
                <div class="d-flex justify-content-between checkbox mb-3">
                    <label>
                        <input type="checkbox" name="remember" id="remember"> Remember me
                    </label>
                    <a href="{{ route('password.request') }}">Forgot password?</a>
                </div>
                <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
            </form>
        </div>
    </div>
</x-guest-layout>
