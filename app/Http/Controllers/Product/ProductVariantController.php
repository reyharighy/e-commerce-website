<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductVariantRequest;
use App\Http\Requests\Product\UpdateProductVariantRequest;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use Inertia\Inertia;
use Illuminate\Support\Str;

class ProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Product $product)
    {
        return Inertia::render('admin/VariantsIndex', [
            'product' => $product->load('category'),
            'productVariants' => $product->productVariants()->paginate(5),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Product $product)
    {
        return Inertia::render('admin/VariantsCreate', [
            'product' => $product->load('category'),
            'sizeAvailability' => ProductVariant::$sizeAvailability,
            'colorAvailability' => ProductVariant::$colorAvailability,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductVariantRequest $request, Product $product)
    {
        $request->validated();

        $sku = $request->sku . '-' . uniqid();

        $productVariant = ProductVariant::create([
            'product_id' => $product->id,
            'sku' => $sku,
            'slug' => Str::slug($product->slug . '-' . $sku),
            'size' => $request->size,
            'color' => $request->color,
            'stock' => $request->stock,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->storePublicly('images');

                ProductImage::create([
                    'product_variant_id' => $productVariant->id,
                    'url' => $path,
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductVariant $variant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product, ProductVariant $variant)
    {
        return Inertia::render('admin/VariantsEdit', [
            'product' => $product->load('category'),
            'variant' => $variant->with('productImages'),
            'images' => $variant->productImages,
            'sizeAvailability' => ProductVariant::$sizeAvailability,
            'colorAvailability' => ProductVariant::$colorAvailability,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductVariantRequest $request, Product $product, ProductVariant $variant)
    {
        $request->validated();

        $newSKU = $request->sku . '-' . uniqid();
        $newSlug = Str::slug($product->slug . '-' . $newSKU);

        $variant->update([
            'product_id' => $product->id,
            'sku' => $newSKU,
            'slug' => $newSlug,
            'size' => $request->size,
            'color' => $request->color,
            'stock' => $request->stock,
        ]);

        return to_route('products.variants.edit', ['product' => $product, 'variant' => $variant]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product, ProductVariant $variant)
    {
        $deletionIdentifier = '-deleted';
        $variant->sku .= $deletionIdentifier;
        $variant->slug .= $deletionIdentifier;
        $variant->save();

        $variant->delete();

        return to_route('products.variants.index', ['product' => $product]);
    }
}
