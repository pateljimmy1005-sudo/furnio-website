<div class="delete-account-section">
    <p class="delete-desc">Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.</p>
    
    <button type="button" class="delete-btn" onclick="document.getElementById('delete-account-modal').style.display = 'flex'">
        Delete Account
    </button>
</div>

<!-- Modal -->
<div id="delete-account-modal" class="modal-overlay delete-account-modal-hidden">
    <div class="modal-content">
        <h3>Are you sure you want to delete your account?</h3>
        <p>Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.</p>
        
        <form method="post" action="{{ route('profile.destroy') }}" class="modal-form">
            @csrf
            @method('delete')
            
            <div class="form-group">
                <label for="delete-password">Password</label>
                <input type="password" id="delete-password" name="password" placeholder="Enter your password" required>
                @if($errors->userDeletion->get('password'))
                    <span class="error-msg">{{ $errors->userDeletion->first('password') }}</span>
                @endif
            </div>
            
            <div class="modal-actions">
                <button type="button" class="cancel-btn" onclick="document.getElementById('delete-account-modal').style.display = 'none'">
                    Cancel
                </button>
                <button type="submit" class="confirm-delete-btn">
                    Delete Account
                </button>
            </div>
        </form>
    </div>
</div>

@if($errors->userDeletion->get('password'))
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('delete-account-modal').style.display = 'flex';
    });
</script>
@endif
