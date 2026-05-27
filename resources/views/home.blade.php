@extends('layouts.plantilla')

@section('content')
<div class="container mt-4">

    <h2 class="mb-3 text-center">Nuestras ofertas</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('info'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            {{ session('info') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($offers->isEmpty())
        <div class="alert alert-info">
            No hay ofertas disponibles ahora mismo.
        </div>
    @else

        {{-- NAV TABS: una tab por oferta, etiqueta = fecha --}}
        <ul class="nav nav-tabs" id="offersTabs" role="tablist">
            @foreach($offers as $index => $offer)
                <li class="nav-item" role="presentation">
                    <button class="nav-link {{ $index === 0 ? 'active' : '' }}"
                            id="tab-offer-{{ $offer->id }}"
                            data-bs-toggle="tab"
                            data-bs-target="#offer-{{ $offer->id }}"
                            type="button" role="tab">
                        {{ $offer->date_delivery->locale('es')->isoFormat('D [de] MMMM') }}
                    </button>
                </li>
            @endforeach
        </ul>

        {{-- TAB CONTENT --}}
        <div class="tab-content border border-top-0 p-3" id="offersTabsContent">
            @foreach($offers as $index => $offer)
                <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}"
                     id="offer-{{ $offer->id }}"
                     role="tabpanel">

                    <div class="mb-3 text-muted small">
                        Recogida a las {{ $offer->time_delivery }}
                        @if($offer->datetime_limit)
                            &nbsp;·&nbsp;
                            <span class="text-danger">
                                Límite de pedido: {{ \Carbon\Carbon::parse($offer->datetime_limit)->locale('es')->isoFormat('D [de] MMMM [a las] H:mm') }}
                            </span>
                        @endif
                    </div>

                    @if($offer->productsOffer->isEmpty())
                        <div class="alert alert-warning">
                            Esta oferta no tiene productos asignados.
                        </div>
                    @else
                        <div class="row">
                            @foreach($offer->productsOffer as $po)
                                @php
                                    $p = $po->product;
                                    $precio = $po->price ?? $p->price ?? 0;
                                @endphp

                                <div class="col-md-4 mb-3">
                                    <div class="card h-100">
                                        @if(!empty($p->image))
                                            <img src="{{ asset($p->image) }}"
                                                 class="card-img-top"
                                                 alt="{{ $p->name }}"
                                                 style="height:200px; object-fit:cover;">
                                        @endif

                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title">{{ $p->name }}</h5>

                                            @if(!empty($p->description))
                                                <p class="card-text text-muted small">{{ $p->description }}</p>
                                            @endif

                                            <div class="mt-auto">
                                                <p class="fw-bold mb-2">Precio: {{ number_format($precio, 2) }} €</p>

                                                @auth
                                                    <form action="{{ route('cartAdd', $po->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success btn-sm">
                                                            Añadir al carrito
                                                        </button>
                                                    </form>
                                                @else
                                                    <p class="text-danger">Inicia sesión para comprar</p>
                                                @endauth
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        </div>
                    @endif

                </div>
            @endforeach
        </div>

    @endif

</div>
@endsection
