@extends('layouts.plantilla')

@section('content')

<div class="pe-page-header">
    <div class="container">
        <h2><i class="fas fa-shopping-bag me-2"></i>Mi carrito</h2>
        <p>Revisa tus productos antes de confirmar el pedido</p>
    </div>
</div>

<div class="container pb-5">

    @if(session('info'))
        <div class="alert alert-success alert-dismissible fade show fade-in" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('info') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger fade-in">
            @foreach($errors->all() as $e)
                <div><i class="fas fa-exclamation-circle me-2"></i>{{ $e }}</div>
            @endforeach
        </div>
    @endif

    @if(empty($carrito))
        <div class="text-center py-5 fade-in">
            <div style="font-size:4rem; opacity:.2; margin-bottom:20px;"><i class="fas fa-shopping-bag"></i></div>
            <h4 style="color:var(--pe-muted); font-weight:600;">Tu carrito está vacío</h4>
            <p style="color:#bbb; font-size:.92rem; margin-bottom:24px;">Añade productos desde las ofertas disponibles.</p>
            <a href="{{ route('home_prieto') }}" class="btn btn-prieto px-4">
                <i class="fas fa-store me-2"></i>Ver ofertas
            </a>
        </div>
    @else

        @php $totalGeneral = 0; @endphp

        <div class="row g-4 align-items-start">
            <div class="col-lg-8">

                @foreach($carrito as $idOferta => $articulos)
                    @php
                        $oferta   = $ofertasPorId[$idOferta] ?? null;
                        $subtotal = 0;
                    @endphp

                    <div class="pe-cart-section fade-in">
                        <div class="pe-cart-section-header">
                            <h6>
                                <i class="fas fa-calendar-day me-2"></i>
                                Oferta del {{ $oferta ? $oferta->date_delivery->format('d/m/Y') : 'Desconocida' }}
                                @if($oferta)
                                    &nbsp;·&nbsp;
                                    <span style="font-weight:400; color:var(--pe-muted);">
                                        Recogida {{ $oferta->time_delivery }}
                                    </span>
                                @endif
                            </h6>
                        </div>

                        @foreach($articulos as $idPO => $qty)
                            @php $po = $productosOfertaPorId[$idPO] ?? null; @endphp

                            @if($po)
                            @php
                                $prod      = $po->product;
                                $lineTotal = $prod->price * (int) $qty;
                                $subtotal     += $lineTotal;
                                $totalGeneral += $lineTotal;
                            @endphp
                                <div class="pe-cart-row">
                                    {{-- Image --}}
                                    @if(!empty($prod->image))
                                        <img src="{{ asset($prod->image) }}" alt="{{ $prod->name }}" class="pe-cart-img">
                                    @else
                                        <div class="pe-cart-img-placeholder">
                                            <i class="fas fa-utensils"></i>
                                        </div>
                                    @endif

                                    {{-- Info --}}
                                    <div class="pe-cart-info">
                                        <div class="name">{{ $prod->name }}</div>
                                        <div class="price">{{ number_format($prod->price, 2) }} € / unidad</div>
                                    </div>

                                    {{-- Qty controls --}}
                                    <div class="pe-qty-control">
                                        <form method="POST" action="{{ route('cartRemoveOne', [$po->id, $idOferta]) }}">
                                            @csrf
                                            <button type="submit" class="btn-qty">−</button>
                                        </form>
                                        <span class="pe-qty-num">{{ $qty }}</span>
                                        <form method="POST" action="{{ route('cartAddOne', $po->id) }}">
                                            @csrf
                                            <button type="submit" class="btn-qty">+</button>
                                        </form>
                                    </div>

                                    {{-- Line total --}}
                                    <div class="pe-line-total">{{ number_format($lineTotal, 2) }} €</div>

                                    {{-- Remove --}}
                                    <form method="POST" action="{{ route('cartRemove', [$po->id, $idOferta]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-qty remove" title="Quitar">
                                            <i class="fas fa-trash-alt" style="font-size:.7rem;"></i>
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @endforeach

                        <div style="padding:12px 20px; text-align:right; font-size:.88rem; color:var(--pe-muted); border-top:1px solid #f5f5f5;">
                            Subtotal oferta: <strong style="color:var(--pe-green-dark);">{{ number_format($subtotal, 2) }} €</strong>
                        </div>
                    </div>

                @endforeach

            </div>

            {{-- Summary sidebar --}}
            <div class="col-lg-4">
                <div class="pe-cart-summary fade-in" style="position:sticky; top:90px;">
                    <h5 class="fw-700 mb-4" style="font-size:1.05rem;">Resumen del pedido</h5>

                    <div class="pe-cart-total-row grand">
                        <span>Total</span>
                        <span>{{ number_format($totalGeneral, 2) }} €</span>
                    </div>

                    <form method="POST" action="{{ route('cartOrder') }}" class="mt-4">
                        @csrf
                        <button type="submit" class="btn btn-prieto w-100 py-3" style="font-size:1rem; border-radius:12px;">
                            <i class="fas fa-check-circle me-2"></i>Realizar pedido
                        </button>
                    </form>

                    <form method="POST" action="{{ route('cartClear') }}" class="mt-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger w-100 py-2" style="border-radius:12px; font-size:.88rem;">
                            <i class="fas fa-trash me-2"></i>Vaciar carrito
                        </button>
                    </form>

                    <div class="mt-3 text-center">
                        <a href="{{ route('home_prieto') }}" style="font-size:.82rem; color:var(--pe-muted); text-decoration:none;">
                            <i class="fas fa-arrow-left me-1"></i>Seguir comprando
                        </a>
                    </div>
                </div>
            </div>
        </div>

    @endif
</div>
@endsection
