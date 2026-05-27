<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class productController extends Controller
{
    public function index()
    {
        $products = Product::orderBy("id", "desc")->get();
        return view("admin.products.index", compact("products"));
    }

    public function create()
    {
        return view("admin.products.create");
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            "name" => "required|string|max:255",
            "description" => "nullable|string",
            "price" => "required|numeric|min:0",
            "image" => "nullable|image|mimes:jpg,jpeg,png,webp|max:2048",
        ]);

        $product = new Product();
        $product->name = $data["name"];
        $product->description = $data["description"] ?? null;
        $product->price = $data["price"];

        // Guardamos imagen en storage/app/public/img y en BD guardamos "storage/img/xxx.png"
        if ($request->hasFile("image")) {
            $path = $request->file("image")->store("img", "public");
            $product->image = "storage/" . $path;
        }

        $product->save();

        return redirect()->route("admin.products.index");
    }

    public function edit(Product $product)
    {
        return view("admin.products.edit", compact("product"));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            "name" => "required|string|max:255",
            "description" => "nullable|string",
            "price" => "required|numeric|min:0",
            "image" => "nullable|image|mimes:jpg,jpeg,png,webp|max:2048",
        ]);

        $product->name = $data["name"];
        $product->description = $data["description"] ?? null;
        $product->price = $data["price"];

        if ($request->hasFile("image")) {
            $path = $request->file("image")->store("img", "public");
            $product->image = "storage/" . $path;
        }

        $product->save();

        return redirect()->route("admin.products.index");
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route("admin.products.index");
    }

    public function show(Product $product)
    {
        return redirect()->route("admin.products.index");
    }
}
