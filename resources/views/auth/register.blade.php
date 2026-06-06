@extends('layouts.plantilla')

@section('content')
<div class="pe-auth-wrap">
    <div class="pe-auth-card fade-in">

        <div class="pe-auth-header">
            <div class="brand-icon">
                <i class="fas fa-user-plus"></i>
            </div>
            <h2>Crear cuenta</h2>
            <p>Únete a Prieto Eats y empieza a pedir</p>
        </div>

        <div class="pe-auth-body">

            @if ($errors->any())
                <div class="alert alert-danger mb-4">
                    @foreach ($errors->all() as $error)
                        <div><i class="fas fa-exclamation-circle me-2"></i>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('register_prieto.post') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input id="name" type="text"
                           class="form-control @error('name') is-invalid @enderror"
                           name="name" value="{{ old('name') }}"
                           placeholder="Tu nombre" required autofocus>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input id="email" type="email"
                           class="form-control @error('email') is-invalid @enderror"
                           name="email" value="{{ old('email') }}"
                           placeholder="tu@email.com" required>
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input id="password" type="password"
                           class="form-control @error('password') is-invalid @enderror"
                           name="password" placeholder="Mínimo 8 caracteres" required>
                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-4">
                    <label for="password-confirm" class="form-label">Confirmar contraseña</label>
                    <input id="password-confirm" type="password"
                           class="form-control"
                           name="password_confirmation"
                           placeholder="Repite la contraseña" required>
                </div>

                <button type="submit" class="btn btn-prieto w-100 py-2" style="font-size:.95rem; border-radius:12px;">
                    <i class="fas fa-user-plus me-2"></i>Crear cuenta
                </button>

                <p class="text-center mt-4 mb-0" style="font-size:.85rem; color:var(--pe-muted);">
                    ¿Ya tienes cuenta?
                    <a href="{{ route('login_prieto') }}" class="text-decoration-none fw-600" style="color:var(--pe-green);">
                        Inicia sesión
                    </a>
                </p>
            </form>
        </div>
    </div>
</div>
@endsection
