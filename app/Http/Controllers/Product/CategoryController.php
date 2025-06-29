<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreCategoryRequest;
use App\Http\Requests\Product\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Support\Str;
use Inertia\Inertia;

class CategoryController extends Controller
{
    protected $perPage = 5;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate($this->perPage);

        return Inertia::render('admin/CategoriesIndex', [
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $totalCategories = Category::count();

        return Inertia::render('admin/CategoriesCreate', [
            'totalCategories' => $totalCategories,
            'perPage' => $this->perPage,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $request->validated();

        $slug = Str::slug($request->name);

        Category::create([
            'name' => $request->name,
            'slug' => $slug,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $request->validated();

        $slug = Str::slug($request->name);

        $category->update([
            'name' => $request->name,
            'slug' => $slug,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->name .= '-' . uniqid() . '-deleted';
        $category->slug .= '-' . uniqid() . '-deleted';
        $category->save();

        $category->delete();

        $products = $category->products;

        foreach ($products as $product) {
            $product->name .= '-' . uniqid() . '-deleted';
            $product->slug .= '-deleted';
            $product->save();

            $product->delete();
        }
    }
}
