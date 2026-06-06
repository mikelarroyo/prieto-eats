@extends('layouts.plantilla')

@section('content')

<div class="pe-page-header">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h2><i class="fas fa-tags me-2"></i>Ofertas</h2>
                <p>Gestiona las ofertas y sus productos</p>
            </div>
            <a href="{{ route('admin.offers.create') }}" class="btn btn-prieto px-4">
                <i class="fas fa-plus me-2"></i>Nueva oferta
            </a>
        </div>
    </div>
</div>

<div class="container pb-5">

    @if($offers->isEmpty())
        <div class="text-center py-5">
            <div style="font-size:3.5rem; opacity:.2; margin-bottom:16px;"><i class="fas fa-tags"></i></div>
            <h5 style="color:var(--pe-muted);">No hay ofertas todavía.</h5>
        </div>
    @else
        <div class="table-card fade-in">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Fecha entrega</th>
                        <th>Hora</th>
                        <th class="text-center">Productos</th>
                        <th style="width:120px;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($offers as $o)
                        <tr>
                            <td style="color:var(--pe-muted); font-size:.82rem;">{{ $o->id }}</td>
                            <td class="fw-600">{{ $o->date_delivery->format('d/m/Y') }}</td>
                            <td style="color:var(--pe-muted);">{{ $o->time_delivery }}</td>
                            <td class="text-center">
                                <span style="background:var(--pe-green-light); color:var(--pe-green-dark); border-radius:20px; padding:3px 12px; font-size:.82rem; font-weight:700;">
                                    {{ $o->products_offer_count }}
                                </span>
                            </td>
                            <td>
                                <form action="{{ route('admin.offers.destroy', $o->id) }}" method="POST"
                                      onsubmit="return confirm('¿Borrar esta oferta?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger fw-500" style="font-size:.8rem;">
                                        <i class="fas fa-trash me-1"></i>Borrar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

</div>
@endsection
