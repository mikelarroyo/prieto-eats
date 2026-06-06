@extends('layouts.plantilla')

@section('content')

<div class="pe-page-header">
    <div class="container">
        <h2><i class="fas fa-list-alt me-2"></i>Pedidos por oferta</h2>
        <p>Selecciona una oferta para ver sus pedidos</p>
    </div>
</div>

<div class="container pb-5">

    @if($offers->isEmpty())
        <div class="text-center py-5">
            <div style="font-size:3.5rem; opacity:.2; margin-bottom:16px;"><i class="fas fa-clipboard-list"></i></div>
            <h5 style="color:var(--pe-muted);">No hay ofertas disponibles.</h5>
        </div>
    @else
        <div class="table-card fade-in">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Fecha entrega</th>
                        <th>Hora</th>
                        <th style="width:160px;">Ver pedidos</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($offers as $offer)
                        <tr>
                            <td style="color:var(--pe-muted); font-size:.82rem;">{{ $offer->id }}</td>
                            <td class="fw-600">
                                <i class="fas fa-calendar-day me-2 text-prieto" style="font-size:.85rem;"></i>
                                {{ $offer->date_delivery->locale('es')->isoFormat('D [de] MMMM YYYY') }}
                            </td>
                            <td style="color:var(--pe-muted);">
                                <i class="fas fa-clock me-1" style="font-size:.8rem;"></i>{{ $offer->time_delivery }}
                            </td>
                            <td>
                                <a href="{{ route('admin.orders.show', $offer->id) }}"
                                   class="btn btn-prieto btn-sm"
                                   style="font-size:.8rem;">
                                    <i class="fas fa-eye me-1"></i>Ver pedidos
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

</div>
@endsection
