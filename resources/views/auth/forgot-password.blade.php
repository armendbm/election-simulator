<x-guest-layout>
    <div class="card">
        <div class="card-header text-center">
            <h1 class="fw-normal">Elections To-Go</h1>
            <h3 class="fw-light">Forgot password</p>
        </div>
        <div class="card-body text-center">
            @if (count($errors) > 0)
                @foreach ($errors->all() as $message)
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Whoops!</strong>
                        {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endforeach
            @endif
            <p class="text-center">Forgot your password? No problem. Just let us know your email address and we will email you a password-reset link that will allow you to choose a new one.</p>
            <form method="POST" action="{{ route('password.email') }}" class="needs-validation" novalidate>
                @csrf
                <div class="form-floating mb-3">
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email address" required>
                    <label for="email">Email address</label>
                    <div class="invalid-feedback">
                        Please enter a valid email address.
                    </div>
                </div>
                <button class="w-100 btn btn-lg btn-primary" type="submit">Email password-reset link</button>
            </form>
            <br>
            <a href="/" class="w-80 btn btn-md btn-secondary">Back Home</a>
        </div>
    </div>
</x-guest-layout>
