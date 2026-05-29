<?php

namespace App\Http\Controllers;

use App\Models\ProductOffer;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use App\Models\Offer;


class cartController extends Controller
{
    public function cartShow(Request $request)
    {
        $carrito = session()->get('cart', []);

        if (empty($carrito)) {
            return view('cart.show', [
                'carrito'               => [],
                'ofertasPorId'          => collect(),
                'productosOfertaPorId'  => collect(),
            ]);
        }

        $idsOfertas = array_keys($carrito);
        $idsProductosOferta = [];

        foreach ($carrito as $idOferta => $articulos) {
            $idsProductosOferta = array_merge($idsProductosOferta, array_keys($articulos));
        }
        $idsProductosOferta = array_unique($idsProductosOferta);

        try {
            $ofertasPorId = Offer::whereIn('id', $idsOfertas)
                ->get(['id', 'date_delivery', 'time_delivery'])
                ->keyBy('id');

            $productosOfertaPorId = ProductOffer::with('product')
                ->whereIn('id', $idsProductosOferta)
                ->get()
                ->keyBy('id');
        } catch (\Exception) {
            return redirect()->back()->withErrors(['error' => 'Error al cargar el carrito.']);
        }

        return view('cart.show', compact('carrito', 'ofertasPorId', 'productosOfertaPorId'));
    }

    public function cartAdd(Request $request, $id)
    {
        try {
            $po = ProductOffer::with("offer")->findOrFail($id);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Producto no encontrado.']);
        }

        $carrito = session()->get('cart', []);
        $idOferta = $po->offer_id;

        if (!isset($carrito[$idOferta])) {
            $carrito[$idOferta] = [];
        }

        $carrito[$idOferta][$po->id] = ($carrito[$idOferta][$po->id] ?? 0) + 1;

        session()->put('cart', $carrito);
        return redirect()->back()->with('info', 'Producto añadido al carrito correctamente.');
    }

    public function cartAddOne(Request $request, $id)
    {
        return $this->cartAdd($request, $id);
    }

    public function cartRemoveOne(Request $request, $id, $ofertaId)
    {
        $carrito = session()->get('cart', []);

        if (isset($carrito[$ofertaId][$id])) {
            $carrito[$ofertaId][$id]--;

            if ($carrito[$ofertaId][$id] <= 0) {
                unset($carrito[$ofertaId][$id]);
            }

            if (empty($carrito[$ofertaId])) {
                unset($carrito[$ofertaId]);
            }
        } else {
            return redirect()->back();
        }

        session()->put('cart', $carrito);
        return redirect()->route('cartShow');
    }

    public function cartRemove(Request $request, $id, $ofertaId)
    {
        $carrito = session()->get('cart', []);

        if (isset($carrito[$ofertaId][$id])) {
            unset($carrito[$ofertaId][$id]);

            if (empty($carrito[$ofertaId])) {
                unset($carrito[$ofertaId]);
            }
        } else {
            return redirect()->back();
        }

        session()->put('cart', $carrito);
        return redirect()->route('cartShow');
    }

    public function cartClear(Request $request)
    {
        session()->forget('cart');
        return redirect()->route('cartShow');
    }

    public function cartOrder(Request $request)
{
    $carrito = session()->get('cart', []);

    if (empty($carrito)) {
        return redirect()->route('cartShow')->withErrors(['error' => 'El carrito está vacío.']);
    }

    $idsProductosOferta = [];
    foreach ($carrito as $idOferta => $articulos) {
        $idsProductosOferta = array_merge($idsProductosOferta, array_keys($articulos));
    }

    $productosOferta = ProductOffer::with('product')
        ->whereIn('id', $idsProductosOferta)
        ->get()
        ->keyBy('id');

    try {
        DB::beginTransaction();

        foreach ($carrito as $idOferta => $articulos) {
            $subtotal = 0;
            $rows     = [];

            foreach ($articulos as $idPO => $cantidad) {
                if (!isset($productosOferta[$idPO])) continue;

                $po = $productosOferta[$idPO];

                if ($po->price) {
                    $precio = $po->price;
                } else {
                    $precio = $po->product->price;
                }

                $subtotal += $cantidad * $precio;

                $rows[] = [
                    'product_offer_id' => $po->id,
                    'quantity'         => $cantidad,
                ];
            }

            $order = Order::create([
                'user_id' => auth()->id(),
                'total'   => $subtotal,
            ]);

            $order->products()->createMany($rows);
        }

        DB::commit();

    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->route('cartShow')->withErrors(['error' => 'Error al realizar el pedido.']);
    }

    session()->forget('cart');

    return redirect()->route('ordersShow')->with('info', 'Pedidos realizados correctamente.');
}




}
