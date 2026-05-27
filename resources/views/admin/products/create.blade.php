@extends('layouts.plantilla')

@section('content')
<div class="container mt-4" style="max-width: 600px;">

    <h2 class="mb-4">Alta de Producto</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label fw-bold">Nombre</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror"
                   name="name" value="{{ old('name') }}" required>
            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Descripción</label>
            <textarea class="form-control @error('description') is-invalid @enderror"
                      name="description" rows="3">{{ old('description') }}</textarea>
            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Precio (€)</label>
            <input type="number" step="0.01" min="0"
                   class="form-control @error('price') is-invalid @enderror"
                   name="price" value="{{ old('price') }}" required>
            @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-4">
            <label class="form-label fw-bold">Imagen</label>
            <input type="file" class="form-control @error('image') is-invalid @enderror"
                   name="image" accept="image/*">
            @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success">Guardar producto</button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </form>

</div>
@endsection
