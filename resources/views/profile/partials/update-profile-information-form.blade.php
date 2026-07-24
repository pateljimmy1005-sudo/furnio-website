<form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
</form>

<form method="post" action="{{ route('profile.update') }}" class="profile-form" enctype="multipart/form-data">
    @csrf
    @method('patch')

    @if (session('status') === 'profile-updated')
        <div class="success-msg" id="profile-success-msg">
            Profile updated successfully!
        </div>
        <script>
            setTimeout(function() {
                var msg = document.getElementById('profile-success-msg');
                if (msg) {
                    msg.style.transition = 'opacity 0.5s ease';
                    msg.style.opacity = '0';
                    setTimeout(function() { msg.style.display = 'none'; }, 500);
                }
            }, 3000);
        </script>
    @endif

    <div class="form-group">
        <label for="name">Full Name</label>
        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
        @error('name')
            <span class="error-msg">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required autocomplete="username">
        @error('email')
            <span class="error-msg">{{ $message }}</span>
        @enderror

        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div class="mt-2">
                <p class="profile-verify-text">
                    Your email address is unverified.
                    <button form="send-verification" class="profile-verify-btn">
                        Click here to re-send the verification email.
                    </button>
                </p>

                @if (session('status') === 'verification-link-sent')
                    <p class="profile-verify-success">
                        A new verification link has been sent to your email address.
                    </p>
                @endif
            </div>
        @endif
    </div>

    <div class="form-group">
        <label for="phone">Phone Number</label>
        <input type="tel" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" autocomplete="tel">
        @error('phone')
            <span class="error-msg">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="address">Address</label>
        <textarea id="address" name="address" rows="3" autocomplete="street-address">{{ old('address', $user->address) }}</textarea>
        @error('address')
            <span class="error-msg">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="profile_photo">Profile Photo</label>
        <input type="file" id="profile_photo" name="profile_photo" accept="image/*">
        @error('profile_photo')
            <span class="error-msg">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-actions">
        <button type="submit" class="save-btn">Save Changes</button>
    </div>
</form>
