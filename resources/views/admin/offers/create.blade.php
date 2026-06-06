@extends('layouts.plantilla')

@section('content')

<div class="pe-page-header">
    <div class="container">
        <h2><i class="fas fa-plus-circle me-2"></i>Nueva oferta</h2>
        <p>Crea una nueva oferta con sus productos y precios</p>
    </div>
</div>

<div class="container pb-5">
    <div class="pe-section-card fade-in">

        @if ($errors->any())
            <div class="alert alert-danger mb-4">
                @foreach ($errors->all() as $error)
                    <div><i class="fas fa-exclamation-circle me-2"></i>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('admin.offers.store') }}" method="POST">
            @csrf

            <div class="row g-4 mb-4">
                <div class="col-md-4">
                    <label class="form-label">Fecha de recogida <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" name="date_delivery" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Hora de recogida <span class="text-danger">*</span></label>
                    <input type="time" class="form-control" name="time_delivery" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Límite de pedido</label>
                    <input type="datetime-local" class="form-control" name="datetime_limit">
                    <div style="font-size:.77rem; color:var(--pe-muted); margin-top:4px;">Opcional. Después de esta fecha/hora no se aceptan pedidos.</div>
                </div>
            </div>

            <hr style="border-color:var(--pe-green-light); margin:28px 0;">

            <h5 class="fw-600 mb-3"><i class="fas fa-box me-2 text-prieto"></i>Selecciona productos</h5>

            <div class="table-card">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width:50px;">Sel.</th>
                            <th>Nombre</th>
                            <th class="text-center">Precio base</th>
                            <th>Precio oferta</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($productos as $p)
                            <tr>
                                <td>
                                    <input type="checkbox"
                                           class="form-check-input"
                                           name="dish_selected[]"
                                           value="{{ $p->id }}"
                                           style="width:18px; height:18px; margin:0; cursor:pointer;">
                                </td>
                                <td class="fw-500">{{ $p->name }}</td>
                                <td class="text-center" style="color:var(--pe-muted);">{{ $p->price }} €</td>
                                <td>
                                    <div class="input-group" style="max-width:160px;">
                                        <span class="input-group-text" style="border-radius:8px 0 0 8px; border:1.5px solid #dce8de; background:var(--pe-green-light); color:var(--pe-green-dark); font-weight:600; font-size:.85rem;">€</span>
                                        <input type="number" step="0.01" min="0"
                                               class="form-control form-control-sm"
                                               name="dish_price[{{ $p->id }}]"
                                               placeholder="Sin cambio"
                                               style="border-radius:0 8px 8px 0; font-size:.85rem;">
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex gap-3 mt-4">
                <button type="submit" class="btn btn-prieto px-4">
                    <i class="fas fa-save me-2"></i>Guardar oferta
                </button>
                <a href="{{ route('admin.offers.index') }}" class="btn btn-secondary px-4">
                    <i class="fas fa-arrow-left me-2"></i>Volver
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
