@extends('layouts.plantilla')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Productos (Admin)</h3>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Nuevo producto</a>
    </div>

    @if($products->isEmpty())
        <div class="alert alert-info">No hay productos.</div>
    @else
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th style="width: 220px">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $p)
                    <tr>
                        <td>{{ $p->id }}</td>
                        <td>
                            @if($p->image)
                                <img src="{{ asset($p->image) }}" alt="{{ $p->name }}" style="height:50px">
                            @endif
                        </td>
                        <td>{{ $p->name }}</td>
                        <td>{{ number_format($p->price, 2) }} €</td>
                        <td class="d-flex gap-2">
                            <a href="{{ route('admin.products.edit', $p) }}" class="btn btn-sm btn-warning">Editar</a>

                            <form action="{{ route('admin.products.destroy', $p) }}" method="POST"
                                  onsubmit="return confirm('¿Borrar producto?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Borrar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</div>
@endsection
