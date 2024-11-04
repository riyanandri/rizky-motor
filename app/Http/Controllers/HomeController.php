<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Merk;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class HomeController extends Controller
{
    public function home()
    {
        $categories = Category::orderBy('name', 'ASC')->get();
        $merks = Merk::latest()->get();
        $products = Product::latest()->take(8)->get();

        return view('home', compact('categories','merks', 'products'));
    }

    public function show($id)
    {
        $product = Product::with('images', 'category', 'merk')->findOrFail($id);

        return view('pages.detail-product', compact('product'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $category_id = $request->input('category_id');
        $similarityThreshold = 0.1;

        $productsQuery = Product::query();

        if ($category_id && $category_id != 0) {
            $productsQuery->where('category_id', $category_id);
        }

        $products = $productsQuery->get();

        $results = $products->map(function ($product) use ($query, $similarityThreshold) {
            $similarity = Product::jaccardSimilarityNgram($query, $product->product_name);

            if ($similarity >= $similarityThreshold) {
                return [
                    'product' => $product,
                    'similarity' => $similarity
                ];
            }
            return null;
        })->filter();

        $sortedResults = $results->sortByDesc('similarity');

        $perPage = 9;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $paginatedResults = new LengthAwarePaginator(
            $sortedResults->slice(($currentPage - 1) * $perPage, $perPage)->values(),
            $sortedResults->count(),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        $totalResults = $sortedResults->count();

        $categoryName = null;
        if ($category_id && $category_id != 0) {
            $category = Category::find($category_id);
            $categoryName = $category ? $category->name : 'semua kategori';
        } else {
            $categoryName = 'semua kategori';
        }

        return view('pages.search', [
            'results' => $paginatedResults,
            'query' => $query,
            'categoryName' => $categoryName,
            'totalResults' => $totalResults
        ]);
    }

    public function allProducts()
    {
        $products = Product::latest()->paginate(12);

        return view('pages.all-products', compact('products'));
    }

    public function showProductsByMerk($merkId)
    {
        $merk = Merk::with('product')->findOrFail($merkId);
        $products = $merk->product()->paginate(6);

        return view('pages.product-by-merk', compact('merk', 'products'));
    }

    public function showProductsByCategory($categoryId)
    {
        $category = Category::with('product')->findOrFail($categoryId);
        $products = $category->product()->paginate(6);

        return view('pages.product-by-category', compact('category', 'products'));
    }
}
