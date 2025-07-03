<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Inertia\Inertia;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->paginate(5);

        return Inertia::render('admin/ProductsIndex', [
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return Inertia::render('admin/ProductsCreate', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $request->validated();

        $categoryName = Category::where('id', $request->category_id)->first()->name;

        Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($categoryName . '-' . $request->name),
            'description' => $request->description,
            'price' => $request->price,
            'discount_percentage' => $request->discount_percentage,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();

        return Inertia::render('admin/ProductsEdit', [
            'categories' => $categories,
            'product' => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $request->validated();

        $newSlug = Str::slug($product->category->name . '-' . $request->name);

        $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => $newSlug,
            'description' => $request->description,
            'price' => $request->price,
            'discount_percentage' => $request->discount_percentage,
        ]);

        return to_route('products.edit', ['product' => $product]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $deletionIdentifier = '-' . uniqid() . '-deleted';
        $product->name .= $deletionIdentifier;
        $product->slug .= $deletionIdentifier;
        $product->save();

        $product->delete();

        return to_route('products.index');
    }
}
