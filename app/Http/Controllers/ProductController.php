<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

        return response()->json([
            'message' => 'Data produk berhasil diambil',
            'data' => ProductResource::collection($products)
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request)
    {
        $data = $request->validated();

        $product = new Product();

        $product->product_category_id = $data['product_category_id'];
        $product->thumbnail = $data['thumbnail']->store('assets/product', 'public');
        $product->name = $data['name'];
        $product->description = $data['description'];
        $product->price = $data['price'];

        $product->save();

        return response()->json([
            'message' => 'Data produk berhasil ditambahkan',
            'data' => new ProductResource($product)
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'message' => 'Data produk tidak ditemukan',
                'data' => null
            ], 404);
        }

        return response()->json([
            'message' => 'Data produk berhasil diambil',
            'data' => new ProductResource($product)
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, string $id)
    {
        $data = $request->validated();

        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'message' => 'Data produk tidak ditemukan',
                'data' => null
            ], 404);
        }

        $product->product_category_id = $data['product_category_id'];

        if (isset($data['thumbnail'])) {
            $product->thumbnail = $data['thumbnail']->store('assets/product', 'public');
        }

        $product->name = $data['name'];
        $product->description = $data['description'];
        $product->price = $data['price'];

        $product->save();

        return response()->json([
            'message' => 'Data produk berhasil diupdate',
            'data' => new ProductResource($product)
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'message' => 'Data produk tidak ditemukan',
                'data' => null
            ], 404);
        }

        $product->delete();

        return response()->json([
            'message' => 'Data produk berhasil dihapus',
            'data' => null
        ], 200);
    }
}
