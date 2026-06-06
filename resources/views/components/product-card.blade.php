@props(['po'])

@php
    $p      = $po->product;
    $precio = $po->price ?? $p->price ?? 0;
@endphp

<div class="col-md-4 col-sm-6">
    <div class="card card-lift h-100" style="border-radius:16px; overflow:hidden;">

        {{-- Image --}}
        @if(!empty($p->image))
            <div style="position:relative; overflow:hidden; height:190px;">
                <img src="{{ asset($p->image) }}"
                     class="w-100 h-100"
                     alt="{{ $p->name }}"
                     style="object-fit:cover; transition:transform 0.4s ease;">
            </div>
        @else
            <div style="height:190px; background:var(--pe-green-light); display:flex; align-items:center; justify-content:center;">
                <i class="fas fa-utensils" style="font-size:2.5rem; color:var(--pe-green); opacity:.4;"></i>
            </div>
        @endif

        <div class="card-body d-flex flex-column p-3">
            {{-- Price badge --}}
            <div class="d-flex align-items-start justify-content-between mb-1">
                <h5 class="card-title mb-0 fw-600" style="font-size:.98rem; line-height:1.3;">{{ $p->name }}</h5>
                <span style="background:var(--pe-green-light); color:var(--pe-green-dark); font-weight:700; font-size:.85rem; padding:3px 10px; border-radius:20px; white-space:nowrap; margin-left:8px;">
                    {{ number_format($precio, 2) }} €
                </span>
            </div>

            @if(!empty($p->description))
                <p class="card-text mt-1 mb-3" style="font-size:.82rem; color:var(--pe-muted); flex-grow:1; line-height:1.5;">
                    {{ $p->description }}
                </p>
            @else
                <div class="flex-grow-1"></div>
            @endif

            {{-- Action --}}
            @auth
                <form action="{{ route('cartAdd', $po->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-prieto btn-sm w-100" style="border-radius:10px; padding:8px;">
                        <i class="fas fa-shopping-bag me-1"></i> Añadir al carrito
                    </button>
                </form>
            @else
                <a href="{{ route('login_prieto') }}"
                   class="btn btn-outline-prieto btn-sm w-100"
                   style="border-radius:10px; padding:8px; font-size:.82rem;">
                    <i class="fas fa-sign-in-alt me-1"></i> Inicia sesión para comprar
                </a>
            @endauth
        </div>
    </div>
</div>
