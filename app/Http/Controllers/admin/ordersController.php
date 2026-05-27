<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\Order;

class ordersController extends Controller
{

    public function index()
    {

        $offers = Offer::where('date_delivery', '>=', today())
            ->orderBy('date_delivery', 'desc')
            ->get();

        return view('admin.orders.index', compact('offers'));
    }

    public function show(int $id)
    {
        $offer = Offer::with('productsOffer.product')->findOrFail($id);

        $orders = Order::with(['user', 'products.productOffer.product'])
            ->whereHas('products.productOffer', function ($q) use ($id) {
                $q->where('offer_id', $id);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.orders.show', compact('offer', 'orders'));
    }
}
