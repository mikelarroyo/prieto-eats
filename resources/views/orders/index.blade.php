@extends('layouts.plantilla')

@section('content')

<div class="pe-page-header">
    <div class="container">
        <h2><i class="fas fa-receipt me-2"></i>Mis pedidos</h2>
        <p>Historial de todos tus pedidos realizados</p>
    </div>
</div>

<div class="container pb-5">

    @if(session('info'))
        <div class="alert alert-success alert-dismissible fade show fade-in" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('info') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($orders->isEmpty())
        <div class="text-center py-5 fade-in">
            <div style="font-size:4rem; opacity:.2; margin-bottom:20px;"><i class="fas fa-receipt"></i></div>
            <h4 style="color:var(--pe-muted); font-weight:600;">Aún no tienes pedidos</h4>
            <p style="color:#bbb; font-size:.92rem; margin-bottom:24px;">Cuando realices un pedido aparecerá aquí.</p>
            <a href="{{ route('home_prieto') }}" class="btn btn-prieto px-4">
                <i class="fas fa-store me-2"></i>Ver ofertas
            </a>
        </div>
    @else

        @foreach($orders as $o)
            <div class="pe-order-card fade-in">
                <div class="pe-order-header">
                    <div>
                        <div class="order-id"><i class="fas fa-hashtag" style="font-size:.8rem;"></i>{{ $o->id }} &nbsp;·&nbsp; Pedido</div>
                        <div class="order-date"><i class="fas fa-clock me-1"></i>{{ $o->created_at->format('d/m/Y') }} a las {{ $o->created_at->format('H:i') }}</div>
                    </div>
                    <div class="pe-order-total">{{ number_format($o->total, 2) }} €</div>
                </div>

                <div class="p-3">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th class="text-center">Precio</th>
                                <th class="text-center">Cant.</th>
                                <th class="text-end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($o->products as $l)
                                @php
                                    $po    = $l->productOffer;
                                    $p     = $po->product;
                                    $price = $po->price ?? $p->price ?? 0;
                                    $sub   = $l->quantity * $price;
                                @endphp
                                <tr>
                                    <td>
                                        <span class="fw-500">{{ $p->name }}</span>
                                    </td>
                                    <td class="text-center" style="color:var(--pe-muted);">{{ number_format($price, 2) }} €</td>
                                    <td class="text-center">
                                        <span style="background:var(--pe-green-light); color:var(--pe-green-dark); border-radius:20px; padding:2px 10px; font-size:.82rem; font-weight:600;">
                                            × {{ $l->quantity }}
                                        </span>
                                    </td>
                                    <td class="text-end fw-600">{{ number_format($sub, 2) }} €</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach

        <div class="d-flex justify-content-center mt-4">
            {{ $orders->links() }}
        </div>

    @endif
</div>
@endsection
