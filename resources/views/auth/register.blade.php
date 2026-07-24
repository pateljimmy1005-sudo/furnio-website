<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="form-floating mb-3 text-start">
    <input id="name" type="text" class="form-control rounded-2 " name="name" value="{{ old('name') }}" required autofocus autocomplete="name" style="border-color: #eeeeee; background-color: #f9f9f9;" placeholder="Name">
    <label for="name" class="form-label fw-bold text-secondary">Name</label>
    @error('name')
                <div class="text-danger mt-1 small">{{ $message }}
</div>
            @enderror
        </div>

        <!-- Email Address -->
        <div class="form-floating mb-3 text-start">
    <input id="email" type="email" class="form-control rounded-2 " name="email" value="{{ old('email') }}" required autocomplete="username" style="border-color: #eeeeee; background-color: #f9f9f9;" placeholder="Email">
    <label for="email" class="form-label fw-bold text-secondary">Email</label>
    @error('email')
                <div class="text-danger mt-1 small">{{ $message }}
</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="form-floating mb-3 text-start">
    <input id="password" type="password" class="form-control rounded-2 " name="password" required autocomplete="new-password" style="border-color: #eeeeee; background-color: #f9f9f9;" placeholder="Password">
    <label for="password" class="form-label fw-bold text-secondary">Password</label>
    @error('password')
                <div class="text-danger mt-1 small">{{ $message }}
</div>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-4 text-start">
            <label for="password_confirmation" class="form-label fw-bold text-secondary">Confirm Password</label>
            <input id="password_confirmation" type="password" class="form-control rounded-2 py-2" name="password_confirmation" required autocomplete="new-password" style="border-color: #eeeeee; background-color: #f9f9f9;">
            @error('password_confirmation')
                <div class="text-danger mt-1 small">{{ $message }}</div>
            @enderror
        </div>

        <!-- Submit Button & Login Link -->
        <div class="d-flex align-items-center justify-content-between mb-2">
            <a class="text-decoration-none fw-semibold" href="{{ route('login') }}" style="color: #C06B1F; font-size: 17px;">
                {{ __('Already registered?') }}
            </a>

            <button type="submit" class="btn text-white px-4 py-2 fw-bold" style="background-color: #C06B1F; border: none; border-radius: 6px;">
                {{ __('Register') }}
            </button>
        </div>
    </form>
</x-guest-layout>
