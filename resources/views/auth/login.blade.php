<x-guest-layout>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    @if(session('success'))
        <div class="alert alert-success fw-bold mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Error Message -->
    @if(session('error'))
        <div class="alert alert-danger fw-bold mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="form-floating mb-3 text-start">
    <input id="email" type="email" class="form-control rounded-2 " name="email" value="{{ old('email') }}" required autofocus autocomplete="username" style="border-color: #eeeeee; background-color: #f9f9f9;" placeholder="Email">
    <label for="email" class="form-label fw-bold text-secondary">Email</label>
    @error('email')
                <div class="text-danger mt-1 small">{{ $message }}
</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="form-floating mb-3 text-start">
    <input id="password" type="password" class="form-control rounded-2 " name="password" required autocomplete="current-password" style="border-color: #eeeeee; background-color: #f9f9f9;" placeholder="Password">
    <label for="password" class="form-label fw-bold text-secondary">Password</label>
    @error('password')
                <div class="text-danger mt-1 small">{{ $message }}
</div>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="mb-4 form-check text-start">
            <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
            <label class="form-check-label text-secondary" for="remember_me">
                {{ __('Remember me') }}
            </label>
        </div>

        <!-- Submit Button & Forgot Password -->
        <div class="d-flex align-items-center justify-content-between mb-4">
            @if (Route::has('password.request'))
                <a class="text-decoration-none fw-semibold" href="{{ route('password.request') }}" style="color: #C06B1F; font-size: 17px;">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <button type="submit" class="btn text-white px-4 py-2 fw-bold" style="background-color: #C06B1F; border: none; border-radius: 6px;">
                {{ __('Log in') }}
            </button>
        </div>

        <!-- Register Link -->
        <div class="mt-4 text-center">
            <p class="text-secondary m-0">
                New Customer?
                <a href="{{ route('register') }}" class="text-decoration-none fw-bold" style="color: #C06B1F;">
                    Create Account
                </a>
            </p>
        </div>
    </form>

</x-guest-layout>