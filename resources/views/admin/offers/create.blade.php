@extends('layouts.plantilla')

@section('content')
<div class="container mt-4">

    <h2>Alta de Oferta</h2>

    <form action="{{ route('admin.offers.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Fecha recogida</label>
            <input type="date" class="form-control" name="date_delivery" required>
        </div>

        <div class="mb-3">
            <label>Hora recogida</label>
            <input type="time" class="form-control" name="time_delivery" required>
        </div>

        <div class="mb-3">
            <label>Fecha y hora límite</label>
            <input type="datetime-local" class="form-control" name="datetime_limit">
        </div>

        <h4>Listado de productos</h4>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Selecciona</th>
                    <th>Nombre</th>
                    <th>Precio base</th>
                    <th>Precio oferta</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productos as $p)
                <tr>
                    <td>
                        <input type="checkbox" name="dish_selected[]" value="{{ $p->id }}">
                    </td>
                    <td>{{ $p->name }}</td>
                    <td>{{ $p->price }} €</td>
                    <td>
                        <input type="number" step="0.01"
                               class="form-control form-control-sm"
                               name="dish_price[{{ $p->id }}]">
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <button class="btn btn-success">Guardar oferta</button>
        <a href="{{ route('admin.offers.index') }}" class="btn btn-secondary">
            Volver
        </a>
    </form>
</div>
@endsection
