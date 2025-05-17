<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCategoryStoreRequest;
use App\Http\Requests\ProductCategoryUpdateRequest;
use App\Http\Resources\ProductCategoryResource;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productCategories = ProductCategory::all();

        return response()->json([
            'message' => 'Data kategori produk berhasil diambil',
            'data' => ProductCategoryResource::collection($productCategories)
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductCategoryStoreRequest $request)
    {
        $data = $request->validated();

        $productCategory = new ProductCategory();
        $productCategory->name = $data['name'];

        if (isset($data['image'])) {
            $productCategory->image = $data['image']->store('assets/category', 'public');
        }

        $productCategory->save();

        return response()->json([
            'message' => 'Data kategori produk berhasil ditambahkan',
            'data' => new ProductCategoryResource($productCategory)
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $productCategory = ProductCategory::find($id);

        if (!$productCategory) {
            return response()->json([
                'message' => 'Data kategori tidak ditemukan',
                'data' => null
            ], 404);
        }

        return response()->json([
            'message' => 'Data kategori produk berhasil diambil',
            'data' => new ProductCategoryResource($productCategory)
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductCategoryUpdateRequest $request, string $id)
    {
        $data = $request->validated();

        $productCategory = ProductCategory::find($id);

        if (!$productCategory) {
            return response()->json([
                'message' => 'Data kategori tidak ditemukan',
                'data' => null
            ], 404);
        }

        $productCategory->name = $data['name'];

        if (isset($data['image'])) {
            $productCategory->image = $data['image']->store('assets/category', 'public');
        }

        $productCategory->save();

        return response()->json([
            'message' => 'Data kategori produk berhasil diupdate',
            'data' => new ProductCategoryResource($productCategory)
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $productCategory = ProductCategory::find($id);

        if (!$productCategory) {
            return response()->json([
                'message' => 'Data kategori tidak ditemukan',
                'data' => null
            ], 404);
        }

        $productCategory->delete();

        return response()->json([
            'message' => 'Data kategori produk berhasil dihapus',
            'data' => null
        ], 200);
    }
}
