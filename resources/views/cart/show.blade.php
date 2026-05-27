@extends('layouts.plantilla')

@section('content')
<div class="container mt-4">

    <h2 class="mb-3">Carrito</h2>

    @if(session('info'))
        <div class="alert alert-info">{{ session('info') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $e) {{ $e }}<br> @endforeach
        </div>
    @endif

    <div class="card mb-4 shadow-sm">
        <div class="card-body">

            @if(empty($carrito))
                <p>El carrito está vacío.</p>
                <a href="{{ route('home_prieto') }}" class="btn btn-primary">Volver a ofertas</a>
            @else
                @php $totalGeneral = 0; @endphp

                @foreach($carrito as $idOferta => $articulos)
                    @php
                        $oferta   = $ofertasPorId[$idOferta] ?? null;
                        $subtotal = 0;
                    @endphp

                    <div class="card mb-3">
                        <div class="card-header">
                            <strong>Oferta:</strong> {{ $oferta->date_delivery->format('d/m/Y') }}
                            <small class="text-muted">{{ $oferta->time_delivery }}</small>
                        </div>

                        <div class="card-body">
                            @foreach($articulos as $idPO => $qty)
                                @php
                                    $po        = $productosOfertaPorId[$idPO] ?? null;
                                    $prod      = $po->product;
                                    $lineTotal = $prod->price * (int) $qty;
                                    $subtotal     += $lineTotal;
                                    $totalGeneral += $lineTotal;
                                @endphp

                                @if($po)
                                    <div class="row align-items-center py-2 border-bottom">
                                        <div class="col-3 col-md-1">
                                            @if(!empty($prod->image))
                                                <img src="{{ asset($prod->image) }}"
                                                     alt="{{ $prod->name }}"
                                                     style="width:50px; height:50px; object-fit:cover; border-radius:6px;">
                                            @endif
                                        </div>
                                        <div class="col-4 col-md-3">
                                            <div class="fw-semibold">{{ $prod->name }}</div>
                                            <div class="text-muted small">{{ $prod->description }}</div>
                                        </div>
                                        <div class="col-3 col-md-2">
                                            <span class="fw-semibold">{{ number_format($prod->price, 2) }} €</span>
                                        </div>
                                        <div class="col-3 col-md-3 mt-md-2">
                                            <form method="POST" action="{{ route('cartRemoveOne', [$po->id, $idOferta]) }}" class="d-inline">
                                                @csrf
                                                <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-dash"></i></button>
                                            </form>
                                            {{ $qty }}
                                            <form method="POST" action="{{ route('cartAddOne', $po->id) }}" class="d-inline">
                                                @csrf
                                                <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-plus"></i></button>
                                            </form>
                                        </div>
                                        <div class="col-3 col-md-2 text-end">
                                            <strong>{{ number_format($lineTotal, 2) }} €</strong>
                                        </div>
                                        <div class="col-1">
                                            <form method="POST" action="{{ route('cartRemove', [$po->id, $idOferta]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger">Quitar</button>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        <div class="card-footer d-flex justify-content-between">
                            <span>Subtotal oferta:</span>
                            <strong>{{ number_format($subtotal, 2) }} €</strong>
                        </div>
                    </div>
                @endforeach

                <div class="text-end fs-5 mt-2">
                    <strong>Total: {{ number_format($totalGeneral, 2) }} €</strong>
                </div>

            @endif

        </div>
    </div>

    @if(!empty($carrito))
        {{-- TOTAL GENERAL --}}
        <div class="card mb-4 shadow-sm">
            <div class="card-body d-flex justify-content-between align-items-center">
                <h4 class="mb-0">TOTAL GENERAL: {{ number_format($totalGeneral, 2) }} €</h4>

                <div class="d-flex gap-2">
                    <form method="POST" action="{{ route('cartClear') }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-danger">Vaciar carrito</button>
                    </form>

                    <form method="POST" action="{{ route('cartOrder') }}">
                        @csrf
                        <button class="btn btn-success">Realizar pedido</button>
                    </form>
                </div>
            </div>
        </div>
    @endif

</div>
@endsection
