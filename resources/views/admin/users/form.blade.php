<div class="row">

    <!-- Name -->
    <div class="col-md-6 mb-3">

        <label for="name" class="form-label">
            Name
        </label>

        <input type="text"
               id="name"
               name="name"
               value="{{ old('name', $user->name ?? '') }}"
               class="form-control @error('name') is-invalid @enderror">

        @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>

    <!-- Email -->
    <div class="col-md-6 mb-3">

        <label for="email" class="form-label">
            Email
        </label>

        <input type="email"
               id="email"
               name="email"
               value="{{ old('email', $user->email ?? '') }}"
               class="form-control @error('email') is-invalid @enderror">

        @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>

</div>

<div class="row">

    <!-- Password -->
    <div class="col-md-6 mb-3">

        <label for="password" class="form-label">
            Password
        </label>

        <input type="password"
               id="password"
               name="password"
               class="form-control @error('password') is-invalid @enderror">

        @isset($user)
            <small class="text-muted">
                Leave blank to keep the current password.
            </small>
        @endisset

        @error('password')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>

    <!-- Confirm Password -->
    <div class="col-md-6 mb-3">

        <label for="password_confirmation" class="form-label">
            Confirm Password
        </label>

        <input type="password"
               id="password_confirmation"
               name="password_confirmation"
               class="form-control">

    </div>

</div>

<div class="mt-3">

    <button type="submit" class="btn btn-primary">

        <i class="bi bi-check-circle"></i>

        {{ isset($user) ? 'Update User' : 'Save User' }}

    </button>

    <a href="{{ route('users.index') }}" class="btn btn-secondary">

        Cancel

    </a>

</div>
