<x-guest-layout>
    <div class="card">
        <div class="card-header text-center">
            <h1 class="fw-normal">Elections To-Go</h1>
            <h3 class="fw-light">Reset password</h3>
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
            <form method="POST" action="{{ route('password.update') }}" class="needs-validation" novalidate>
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                <div class="form-floating mb-3">
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="Email address" required>
                    <label for="email">Email address</label>
                    <div class="invalid-feedback">
                        Please enter a valid email address.
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" required minlength="8" autocomplete="new-password" autofocus>
                    <label for="password">Password</label>
                    <div class="invalid-feedback">
                        Please enter a password with at least 8 characters.
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm password" required>
                    <label for="password_confirmation">Confirm password</label>
                    <div class="invalid-feedback">
                        Please confirm your password.
                    </div>
                </div>
                <button class="w-100 btn btn-lg btn-primary" type="submit">Reset password</button>
            </form>
        </div>
    </div>
</x-guest-layout>
