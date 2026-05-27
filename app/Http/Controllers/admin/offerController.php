<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ProductOffer;
use App\Models\Offer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class offerController extends Controller
{
    public function index()
    {
        $offers = Offer::withCount("productsOffer")->get();
        return view("admin.offers.index", ["offers" => $offers]);
    }

    public function create()
    {
        $productos = Product::all();
        return view("admin.offers.create", ["productos" => $productos]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "date_delivery"   => "required|date|after:today",
            "time_delivery"   => "required",
            "datetime_limit"  => "nullable|date|after:now",

            "dish_selected"   => "required|array|min:1",
            "dish_selected.*" => "integer|distinct|exists:products,id",

            "dish_price"      => "nullable|array",
            "dish_price.*"    => "nullable|numeric|min:0",
        ]);

        DB::transaction(function () use ($validated) {

            $oferta = Offer::create([
                "time_delivery"  => $validated["time_delivery"],
                "date_delivery"  => $validated["date_delivery"],
                "datetime_limit" => $validated["datetime_limit"] ?? null,
            ]);

            $products = Product::whereIn("id", $validated["dish_selected"])
                                ->get()
                                ->keyBy("id");

            $rows = [];

            foreach ($validated["dish_selected"] as $productId) {
                $precioFormulario = $validated["dish_price"][$productId] ?? null;
                $precioFinal = $precioFormulario !== null
                    ? $precioFormulario
                    : $products[$productId]->price;

                $rows[] = [
                    "product_id" => $productId,
                    "price"      => $precioFinal,
                ];
            }

            $oferta->productsOffer()->createMany($rows);
        });

        return redirect()->route('admin.offers.index');
    }

    public function destroy(string $id)
    {
        try {
            $offer = Offer::findOrFail($id);
            $offer->delete();
        } catch (\Throwable $th) {
            return back()->withErrors(['error' => 'No se pudo eliminar la oferta.']);
        }

        return redirect()->route('admin.offers.index');
    }
}
