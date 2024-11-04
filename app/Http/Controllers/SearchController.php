<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Helpers\SearchHelper;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        $category_id = $request->input('category_id');

        if (empty($query)) {
            return redirect()->back()->with('error', 'Query tidak boleh kosong');
        }

        // Filter berdasarkan kategori jika ada kategori yang dipilih
        $products = Product::query();

        if ($category_id && $category_id != 0) {
            $products = $products->where('category_id', $category_id);
        }

        $products->get();

        $results = [];
        foreach ($products as $product) {
            $similarity = SearchHelper::jaccardSimilarity($query, $product->product_name);

            $results[] = [
                'product' => $product,
                'similarity' => $similarity
            ];
        }

        usort($results, function ($a, $b) {
            return $b['similarity'] <=> $a['similarity'];
        });

        dd($results);

        return view('pages.search', ['results' => $results]);
    }


    // public function search(Request $request)
    // {
    //     $query = $request->input('query');
    //     if (empty($query)) {
    //         return redirect()->back()->with('error', 'Query tidak boleh kosong');
    //     }
    //     $documents = Barang::all()->pluck('nama_barang')->toArray();
    //     $queryTerms = explode(' ', SearchHelper::normalize($query));

    //     $results = [];
    //     foreach (Barang::all() as $product) {
    //         $productTerms = explode(' ', SearchHelper::normalize($product->nama_barang));
    //         $tfidfVector1 = [];
    //         $tfidfVector2 = [];

    //         foreach ($queryTerms as $term) {
    //             $tfidfVector1[$term] = SearchHelper::tfidf($term, $product->nama_barang, $documents);
    //         }

    //         foreach ($productTerms as $term) {
    //             $tfidfVector2[$term] = SearchHelper::tfidf($term, $product->nama_barang, $documents);
    //         }

    //         $cosineSimilarity = SearchHelper::cosineSimilarity($tfidfVector1, $tfidfVector2);
    //         $levenshteinSimilarity = SearchHelper::levenshteinSimilarity($query, $product->nama_barang);

    //         // Gabungan kedua similarity
    //         $combinedSimilarity = ($cosineSimilarity + $levenshteinSimilarity) / 2;

    //         $results[] = [
    //             'product' => $product,
    //             'similarity' => $combinedSimilarity
    //         ];
    //     }

    //     usort($results, function ($a, $b) {
    //         return $b['similarity'] <=> $a['similarity'];
    //     });

    //     dd($results);

    //     return view('pages.search', ['results' => $results]);
    // }
}
