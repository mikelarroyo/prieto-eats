@extends('layouts.plantilla')

@section('content')
<div class="container mt-4">
    <h2>Ofertas (Admin)</h2>

    <a href="{{ route('admin.offers.create') }}" class="btn btn-primary mb-3">
        Nueva oferta
    </a>

    @if($offers->isEmpty())
        <div class="alert alert-info">No hay ofertas.</div>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Nº productos</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($offers as $o)
                    <tr>
                        <td>{{ $o->id }}</td>
                        <td>{{ $o->date_delivery }}</td>
                        <td>{{ $o->time_delivery }}</td>
                        <td>{{ $o->products_offer_count }}</td>
                        <td>
                            <form action="{{ route('admin.offers.destroy', $o->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">
                                    Borrar
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
