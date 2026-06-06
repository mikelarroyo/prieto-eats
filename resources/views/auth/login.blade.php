@extends('layouts.plantilla')

@section('content')
<div class="pe-auth-wrap">
    <div class="pe-auth-card fade-in">

        <div class="pe-auth-header">
            <div class="brand-icon">
                <i class="fas fa-utensils"></i>
            </div>
            <h2>Bienvenido de nuevo</h2>
            <p>Inicia sesión en tu cuenta de Prieto Eats</p>
        </div>

        <div class="pe-auth-body">

            @if ($errors->any())
                <div class="alert alert-danger mb-4">
                    @foreach ($errors->all() as $error)
                        <div><i class="fas fa-exclamation-circle me-2"></i>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login_prieto.post') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input id="email" type="email"
                           class="form-control @error('email') is-invalid @enderror"
                           name="email" value="{{ old('email') }}"
                           placeholder="tu@email.com" required autofocus>
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label">Contraseña</label>
                    <input id="password" type="password"
                           class="form-control @error('password') is-invalid @enderror"
                           name="password" placeholder="••••••••" required>
                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label" for="remember" style="font-size:.85rem; color:var(--pe-muted);">
                            Recordarme
                        </label>
                    </div>
                    @if (Route::has('password.request'))
                        <a class="text-decoration-none" href="{{ route('password.request') }}"
                           style="font-size:.82rem; color:var(--pe-green);">
                            ¿Olvidaste tu contraseña?
                        </a>
                    @endif
                </div>

                <button type="submit" class="btn btn-prieto w-100 py-2" style="font-size:.95rem; border-radius:12px;">
                    <i class="fas fa-sign-in-alt me-2"></i>Iniciar sesión
                </button>

                <p class="text-center mt-4 mb-0" style="font-size:.85rem; color:var(--pe-muted);">
                    ¿No tienes cuenta?
                    <a href="{{ route('register_prieto') }}" class="text-decoration-none fw-600" style="color:var(--pe-green);">
                        Regístrate
                    </a>
                </p>
            </form>
        </div>
    </div>
</div>
@endsection
