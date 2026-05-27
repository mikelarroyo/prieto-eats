@extends('layouts.plantilla')

@section('content')
<div class="container mt-4">
    <h3 class="mb-3">Editar producto #{{ $product->id }}</h3>

    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input class="form-control" name="name" value="{{ old('name', $product->name) }}" required>
            @error('name') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea class="form-control" name="description" rows="3">{{ old('description', $product->description) }}</textarea>
            @error('description') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Precio</label>
            <input class="form-control" type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" required>
            @error('price') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        @if($product->image)
            <div class="mb-3">
                <label class="form-label d-block">Imagen actual</label>
                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" style="height:80px">
            </div>
        @endif

        <div class="mb-3">
            <label class="form-label">Nueva imagen (opcional)</label>
            <input class="form-control" type="file" name="image" accept="image/*">
            @error('image') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <button class="btn btn-success">Actualizar</button>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Volver</a>
    </form>
</div>
@endsection
