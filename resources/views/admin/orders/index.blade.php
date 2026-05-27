@extends('layouts.plantilla')

@section('content')
<div class="container mt-4">
    <h2>Pedidos por oferta (Admin)</h2>

    @if($offers->isEmpty())
        <div class="alert alert-info">No hay ofertas disponibles.</div>
    @else
        <table class="table table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Fecha</th>
                    <th>Hora de entrega</th>
                    <th>Pedidos</th>
                </tr>
            </thead>
            <tbody>
                @foreach($offers as $offer)
                    <tr>
                        <td>{{ $offer->id }}</td>
                        <td>{{ $offer->date_delivery->locale('es')->isoFormat('D [de] MMMM YYYY') }}</td>
                        <td>{{ $offer->time_delivery }}</td>
                        <td>
                            <a href="{{ route('admin.orders.show', $offer->id) }}" class="btn btn-primary btn-sm">
                                Ver pedidos
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
