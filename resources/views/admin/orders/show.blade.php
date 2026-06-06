@extends('layouts.plantilla')

@section('content')

<div class="pe-page-header">
    <div class="container">
        <a href="{{ route('admin.orders.index') }}"
           style="display:inline-flex; align-items:center; gap:6px; color:rgba(255,255,255,0.75); text-decoration:none; font-size:.85rem; margin-bottom:12px;">
            <i class="fas fa-arrow-left"></i> Volver a ofertas
        </a>
        <h2><i class="fas fa-receipt me-2"></i>Pedidos</h2>
        <p>Oferta del {{ $offer->date_delivery->locale('es')->isoFormat('D [de] MMMM YYYY') }} &nbsp;·&nbsp; {{ $offer->time_delivery }}</p>
    </div>
</div>

<div class="container pb-5">

    @if($orders->isEmpty())
        <div class="text-center py-5">
            <div style="font-size:3.5rem; opacity:.2; margin-bottom:16px;"><i class="fas fa-inbox"></i></div>
            <h5 style="color:var(--pe-muted);">No hay pedidos para esta oferta.</h5>
        </div>
    @else
        <div class="table-card fade-in">
            <table class="table">
                <thead>
                    <tr>
                        <th>Usuario</th>
                        @foreach($offer->productsOffer as $po)
                            <th class="text-center" style="font-size:.78rem;">{{ $po->product->name }}</th>
                        @endforeach
                        <th class="text-end">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div style="width:32px; height:32px; background:var(--pe-green-light); border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:.8rem; font-weight:700; color:var(--pe-green-dark);">
                                        {{ strtoupper(substr($order->user->name, 0, 1)) }}
                                    </div>
                                    <span class="fw-500">{{ $order->user->name }}</span>
                                </div>
                            </td>
                            @foreach($offer->productsOffer as $po)
                                @php $line = $order->products->firstWhere('product_offer_id', $po->id); @endphp
                                <td class="text-center">
                                    @if($line && $line->quantity > 0)
                                        <span style="background:var(--pe-green-light); color:var(--pe-green-dark); border-radius:20px; padding:2px 10px; font-size:.82rem; font-weight:700;">
                                            {{ $line->quantity }}
                                        </span>
                                    @else
                                        <span style="color:#ddd;">—</span>
                                    @endif
                                </td>
                            @endforeach
                            <td class="text-end">
                                <span style="font-weight:700; color:var(--pe-green-dark);">{{ number_format($order->total, 2) }} €</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

</div>
@endsection
