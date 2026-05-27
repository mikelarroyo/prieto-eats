@extends('layouts.plantilla')

@section('content')
<div class="container mt-4">

    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary btn-sm mb-3">
        &larr; Volver
    </a>

    <h2>Pedidos de la oferta del {{ $offer->date_delivery->locale('es')->isoFormat('D [de] MMMM YYYY') }}</h2>

    @if($orders->isEmpty())
        <div class="alert alert-info">No hay pedidos para esta oferta.</div>
    @else
        <table class="table table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Usuario</th>
                    @foreach($offer->productsOffer as $po)
                        <th>{{ $po->product->name }}</th>
                    @endforeach
                    <th class="text-end">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->user->name }}</td>
                        @foreach($offer->productsOffer as $po)
                            @php $line = $order->products->firstWhere('product_offer_id', $po->id); @endphp
                            <td>{{ $line ? $line->quantity : 0 }}</td>
                        @endforeach
                        <td class="text-end fw-bold">{{ number_format($order->total, 2) }} €</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</div>
@endsection
