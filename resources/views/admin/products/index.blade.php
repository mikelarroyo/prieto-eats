@extends('layouts.plantilla')

@section('content')

<div class="pe-page-header">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h2><i class="fas fa-box me-2"></i>Productos</h2>
                <p>Gestiona el catálogo de productos</p>
            </div>
            <a href="{{ route('admin.products.create') }}" class="btn btn-prieto px-4">
                <i class="fas fa-plus me-2"></i>Nuevo producto
            </a>
        </div>
    </div>
</div>

<div class="container pb-5">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($products->isEmpty())
        <div class="text-center py-5">
            <div style="font-size:3.5rem; opacity:.2; margin-bottom:16px;"><i class="fas fa-box-open"></i></div>
            <h5 style="color:var(--pe-muted);">No hay productos todavía.</h5>
        </div>
    @else
        <div class="table-card fade-in">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width:50px;">#</th>
                        <th style="width:70px;">Imagen</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th style="width:180px;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $p)
                        <tr>
                            <td style="color:var(--pe-muted); font-size:.82rem;">{{ $p->id }}</td>
                            <td>
                                @if($p->image)
                                    <img src="{{ asset($p->image) }}"
                                         alt="{{ $p->name }}"
                                         style="height:46px; width:46px; object-fit:cover; border-radius:10px;">
                                @else
                                    <div style="height:46px; width:46px; background:var(--pe-green-light); border-radius:10px; display:flex; align-items:center; justify-content:center;">
                                        <i class="fas fa-utensils" style="color:var(--pe-green); font-size:.9rem;"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <span class="fw-600">{{ $p->name }}</span>
                                @if($p->description)
                                    <div style="font-size:.78rem; color:var(--pe-muted); margin-top:1px;">{{ Str::limit($p->description, 50) }}</div>
                                @endif
                            </td>
                            <td>
                                <span style="font-weight:700; color:var(--pe-green-dark);">{{ number_format($p->price, 2) }} €</span>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.products.edit', $p) }}"
                                       class="btn btn-sm btn-warning fw-500"
                                       style="font-size:.8rem;">
                                        <i class="fas fa-edit me-1"></i>Editar
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $p) }}" method="POST"
                                          onsubmit="return confirm('¿Borrar este producto?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger fw-500" style="font-size:.8rem;">
                                            <i class="fas fa-trash me-1"></i>Borrar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

</div>
@endsection
