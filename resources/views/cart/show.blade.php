@extends('layouts.plantilla')

@section('content')

    <h2>Carrito</h2>

    @if(session('info'))
        {{ session('info') }}
    @endif

    @if($errors->any())
        @foreach($errors->all() as $e) {{ $e }} @endforeach
    @endif

    @if(empty($carrito))
        <p>El carrito está vacío.</p>
        <a href="{{ route('home_prieto') }}">Volver a ofertas</a>
    @else
        @php $totalGeneral = 0; @endphp

        @foreach($carrito as $idOferta => $articulos)
            @php
                $oferta   = $ofertasPorId[$idOferta] ?? null;
                $subtotal = 0;
            @endphp

            <p>Oferta: {{ $oferta->date_delivery->format('d/m/Y') }} {{ $oferta->time_delivery }}</p>

            @foreach($articulos as $idPO => $qty)
                @php
                    $po        = $productosOfertaPorId[$idPO] ?? null;
                    $prod      = $po->product;
                    $lineTotal = $prod->price * (int) $qty;
                    $subtotal     += $lineTotal;
                    $totalGeneral += $lineTotal;
                @endphp

                @if($po)
                    <img src="{{ asset($prod->image) }}" alt="{{ $prod->name }}">
                    <p>{{ $prod->name }} - {{ $prod->description }}</p>
                    <p>{{ number_format($prod->price, 2) }} €</p>

                    <form method="POST" action="{{ route('cartRemoveOne', [$po->id, $idOferta]) }}">
                        @csrf
                        <button>-</button>
                    </form>
                    {{ $qty }}
                    <form method="POST" action="{{ route('cartAddOne', $po->id) }}">
                        @csrf
                        <button>+</button>
                    </form>

                    <strong>{{ number_format($lineTotal, 2) }} €</strong>

                    <form method="POST" action="{{ route('cartRemove', [$po->id, $idOferta]) }}">
                        @csrf
                        @method('DELETE')
                        <button>Quitar</button>
                    </form>
                @endif
            @endforeach

            <p>Subtotal oferta: {{ number_format($subtotal, 2) }} €</p>

        @endforeach

        <p>Total: {{ number_format($totalGeneral, 2) }} €</p>

        <form method="POST" action="{{ route('cartClear') }}">
            @csrf
            @method('DELETE')
            <button>Vaciar carrito</button>
        </form>

        <form method="POST" action="{{ route('cartOrder') }}">
            @csrf
            <button>Realizar pedido</button>
        </form>

    @endif

@endsection
