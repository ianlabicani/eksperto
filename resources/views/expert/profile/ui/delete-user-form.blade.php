<form method="POST" action="{{ route('profile.destroy') }}">
    @csrf
    @method('DELETE')

    <div class="mb-3">
        <label for="password" class="form-label">Confirm Password</label>
        <input type="password" class="form-control" id="password_delete" name="password" required>
    </div>

    <button type="submit" class="btn btn-danger">Delete Account</button>
</form>