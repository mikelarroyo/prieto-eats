@extends('layouts.plantilla')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">Mis pedidos</h2>

    @if(session('info'))
        <div class="alert alert-success">{{ session('info') }}</div>
    @endif

    @if($orders->isEmpty())
        <div class="alert alert-info">No tienes pedidos todavía.</div>
    @else
        @foreach($orders as $o)
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <strong>Pedido #{{ $o->id }}</strong>
                            <div class="text-muted small">{{ $o->created_at->format('d/m/Y H:i') }}</div>
                        </div>
                        <div>
                            <strong>Total: {{ number_format($o->total, 2) }} €</strong>
                        </div>
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
                                    $po = $l->productOffer;
                                    $p = $po->product;
                                    $price = $po->price ?? $p->price ?? 0;
                                    $subtotal = $l->quantity * $price;
                                @endphp
                                <tr>
                                    <td>{{ $p->name }}</td>
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
    @endif
</div>
@endsection
