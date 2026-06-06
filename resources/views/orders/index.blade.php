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
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('info') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($orders->isEmpty())
        <div class="alert alert-info">No tienes pedidos todavía.</div>
    @else
        @foreach($orders as $o)
            <div class="card mb-3 pe-order-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <strong>Pedido #{{ $o->id }}</strong>
                            <div class="text-muted small">{{ $o->created_at->format('d/m/Y H:i') }}</div>
                        </div>
                        <div class="pe-order-total">{{ number_format($o->total, 2) }} €</div>
                    </div>

                    <hr>

                    <table class="table table-sm align-middle">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($o->products as $l)
                                @php
                                    $po       = $l->productOffer;
                                    $p        = $po ? $po->product : null;
                                    $price    = $po && $p ? ($po->price ?? $p->price ?? 0) : 0;
                                    $subtotal = $l->quantity * $price;
                                @endphp
                                <tr>
                                    <td>{{ $p ? $p->name : '—' }}</td>
                                    <td>{{ number_format($price, 2) }} €</td>
                                    <td>{{ $l->quantity }}</td>
                                    <td>{{ number_format($subtotal, 2) }} €</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach

        {{ $orders->links('vendor.pagination.custom') }}
    @endif

</div>
@endsection
