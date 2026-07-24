<form method="post" action="{{ route('password.update') }}" class="profile-form">
    @csrf
    @method('put')

    @if (session('status') === 'password-updated')
        <div class="success-msg" id="password-success-msg">
            Password updated successfully!
        </div>
        <script>
            setTimeout(function() {
                var msg = document.getElementById('password-success-msg');
                if (msg) {
                    msg.style.transition = 'opacity 0.5s ease';
                    msg.style.opacity = '0';
                    setTimeout(function() { msg.style.display = 'none'; }, 500);
                }
            }, 3000);
        </script>
    @endif

    <div class="form-group">
        <label for="current_password">Current Password</label>
        <input type="password" id="current_password" name="current_password" autocomplete="current-password">
        @error('current_password')
            <span class="error-msg">{{ $message }}</span>
        @enderror
        @if($errors->updatePassword->get('current_password'))
            <span class="error-msg">{{ $errors->updatePassword->first('current_password') }}</span>
        @endif
    </div>

    <div class="form-group">
        <label for="password">New Password</label>
        <input type="password" id="password" name="password" autocomplete="new-password">
        @error('password')
            <span class="error-msg">{{ $message }}</span>
        @enderror
        @if($errors->updatePassword->get('password'))
            <span class="error-msg">{{ $errors->updatePassword->first('password') }}</span>
        @endif
    </div>

    <div class="form-group">
        <label for="password_confirmation">Confirm New Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" autocomplete="new-password">
        @if($errors->updatePassword->get('password_confirmation'))
            <span class="error-msg">{{ $errors->updatePassword->first('password_confirmation') }}</span>
        @endif
    </div>

    <div class="form-actions">
        <button type="submit" class="save-btn">Update Password</button>
    </div>
</form>
