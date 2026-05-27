@extends('layouts.plantilla')  @section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 bg-white p-5 rounded shadow-sm border">

            <h2 class="text-center text-prieto mb-4 fw-bold">Registro de nuevo usuario/a</h2>

            <form method="POST" action="{{ route('register_prieto.post') }}">
                @csrf

                @if ($errors->any())
                    <div class="alert alert-danger mb-3">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <div class="mb-3">
                    <label for="name" class="form-label fw-bold text-secondary">Name</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                           name="name" value="{{ old('name') }}" required autofocus>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label fw-bold text-secondary">Email</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                           name="email" value="{{ old('email') }}" required>
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label fw-bold text-secondary">Password</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                           name="password" required>
                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-4">
                    <label for="password-confirm" class="form-label fw-bold text-secondary">Confirm Password</label>
                    <input id="password-confirm" type="password" class="form-control"
                           name="password_confirmation" required>
                </div>

                <div class="d-flex justify-content-end align-items-center gap-3">
                    <a class="text-decoration-none text-secondary small" href="{{ route('login_prieto') }}">
                        Already registered?
                    </a>
                    <button type="submit" class="btn btn-dark px-4 fw-bold">REGISTER</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
