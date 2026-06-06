@extends('layouts.plantilla')

@section('content')

{{-- Hero --}}
<section class="pe-hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1>Comida fresca,<br><em>lista para recoger</em></h1>
                <p>Elige tu menú del día y pasa a recogerlo. Sencillo y rápido.</p>
            </div>
            <div class="col-md-4 d-none d-md-block pe-hero-icon">
                <i class="fas fa-utensils"></i>
            </div>
        </div>
    </div>
</section>

<div class="container py-4">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show fade-in" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('info'))
        <div class="alert alert-info alert-dismissible fade show fade-in" role="alert">
            <i class="fas fa-info-circle me-2"></i>{{ session('info') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show fade-in" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($offers->isEmpty())
        <div class="text-center py-5">
            <div style="font-size:3.5rem; opacity:.25; margin-bottom:16px;"><i class="fas fa-store-slash"></i></div>
            <h5 style="color:var(--pe-muted);">No hay ofertas disponibles en este momento.</h5>
            <p style="color:#bbb; font-size:.9rem;">Vuelve pronto para ver las próximas.</p>
        </div>
    @else

        {{-- Tabs --}}
        <ul class="nav nav-tabs" id="offersTabs" role="tablist">
            @foreach($offers as $index => $offer)
                <li class="nav-item" role="presentation">
                    <button class="nav-link {{ $index === 0 ? 'active' : '' }}"
                            id="tab-offer-{{ $offer->id }}"
                            data-bs-toggle="tab"
                            data-bs-target="#offer-{{ $offer->id }}"
                            type="button" role="tab">
                        <i class="fas fa-calendar-day me-1" style="font-size:.8rem;"></i>
                        {{ $offer->date_delivery->locale('es')->isoFormat('D [de] MMMM') }}
                    </button>
                </li>
            @endforeach
        </ul>

        <div class="tab-content border border-top-0 p-4" id="offersTabsContent">
            @foreach($offers as $index => $offer)
                <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}"
                     id="offer-{{ $offer->id }}"
                     role="tabpanel">

                    <div class="pe-offer-meta">
                        <span><i class="fas fa-clock me-1"></i> Recogida a las <strong>{{ $offer->time_delivery }}</strong></span>
                        @if($offer->datetime_limit)
                            <span class="deadline">
                                <i class="fas fa-hourglass-half me-1"></i>
                                Límite: {{ \Carbon\Carbon::parse($offer->datetime_limit)->locale('es')->isoFormat('D [de] MMMM [a las] H:mm') }}
                            </span>
                        @endif
                    </div>

                    @if($offer->productsOffer->isEmpty())
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Esta oferta no tiene productos asignados.
                        </div>
                    @else
                        <div class="row g-3">
                            @foreach($offer->productsOffer as $po)
                                <x-product-card :po="$po" />
                            @endforeach
                        </div>
                    @endif

                </div>
            @endforeach
        </div>

    @endif
</div>
@endsection
