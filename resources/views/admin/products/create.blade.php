@extends('layouts.plantilla')

@section('content')

<div class="pe-page-header">
    <div class="container">
        <h2><i class="fas fa-plus-circle me-2"></i>Nuevo producto</h2>
        <p>Añade un producto al catálogo</p>
    </div>
</div>

<div class="container pb-5">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="pe-section-card fade-in">

                @if ($errors->any())
                    <div class="alert alert-danger mb-4">
                        @foreach ($errors->all() as $error)
                            <div><i class="fas fa-exclamation-circle me-2"></i>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label class="form-label">Nombre <span class="text-danger">*</span></label>
                        <input type="text"
                               class="form-control @error('name') is-invalid @enderror"
                               name="name" value="{{ old('name') }}"
                               placeholder="Ej: Menú del día" required>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Descripción</label>
                        <textarea class="form-control @error('description') is-invalid @enderror"
                                  name="description" rows="3"
                                  placeholder="Descripción del producto...">{{ old('description') }}</textarea>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Precio (€) <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text" style="border-radius:10px 0 0 10px; border:1.5px solid #dce8de; background:var(--pe-green-light); color:var(--pe-green-dark); font-weight:600;">€</span>
                            <input type="number" step="0.01" min="0"
                                   class="form-control @error('price') is-invalid @enderror"
                                   name="price" value="{{ old('price') }}"
                                   placeholder="0.00"
                                   style="border-radius:0 10px 10px 0;" required>
                        </div>
                        @error('price') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-5">
                        <label class="form-label">Imagen</label>
                        <input type="file"
                               class="form-control @error('image') is-invalid @enderror"
                               name="image" accept="image/*">
                        @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-flex gap-3">
                        <button type="submit" class="btn btn-prieto px-4">
                            <i class="fas fa-save me-2"></i>Guardar producto
                        </button>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary px-4">
                            <i class="fas fa-arrow-left me-2"></i>Volver
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
