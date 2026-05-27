@extends('layouts.plantilla')  @section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 bg-white p-5 rounded shadow-sm border">

            <h2 class="text-center text-prieto mb-4 fw-bold">Login</h2>

            <form method="POST" action="{{ route('login_prieto.post') }}">
                @csrf

                @if ($errors->any())
                    <div class="alert alert-danger mb-3">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <div class="mb-3">
                    <label for="email" class="form-label fw-bold text-secondary">Email</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                           name="email" value="{{ old('email') }}" required autofocus>
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label fw-bold text-secondary">Password</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                           name="password" required>
                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-4 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label text-secondary" for="remember">Remember me</label>
                    </div>
                    @if (Route::has('password.request'))
                        <a class="text-decoration-none text-secondary small" href="{{ route('password.request') }}">
                            Forgot your password?
                        </a>
                    @endif
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-dark px-4 fw-bold">LOG IN</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
