<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use App\Models\Merk;
use App\Models\Image;
use App\Models\Specification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        return view('admin.product.index', compact('products'));
    }

    public function toggleStatus($id, Request $request)
    {
        $product = Product::findOrFail($id);
        $product->update(['status' => $request->status]);

        return response()->json(['success' => true]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name', 'ASC')->get();
        $merks = Merk::orderBy('name', 'ASC')->get();

        return view('admin.product.create', compact('categories', 'merks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => ['required'],
            'merk_id' => ['required'],
            'product_code' => ['required', 'unique:products'],
            'product_name' => ['required', 'unique:products'],
            'price' => ['required', 'numeric'],
            'unit' => ['required'],
            'qty' => ['required', 'numeric'],
            'condition' => ['required'],
            'image.*' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'spec_name.*' => ['required'],
            'spec_info.*' => ['required'],
        ], [
            'category_id.required' => 'Kategori produk tidak boleh kosong.',
            'merk_id.required' => 'Merk produk tidak boleh kosong.',
            'product_code.required' => 'Kode produk tidak boleh kosong.',
            'product_code.unique' => 'Kode produk sudah ada.',
            'product_name.required' => 'Nama produk tidak boleh kosong.',
            'product_name.unique' => 'Nama produk sudah ada.',
            'price.required' => 'Harga produk tidak boleh kosong.',
            'price.numeric' => 'Harga produk harus berupa angka.',
            'unit.required' => 'Satuan produk tidak boleh kosong.',
            'qty.required' => 'Stok produk tidak boleh kosong.',
            'qty.numeric' => 'Stok produk harus berupa angka.',
            'condition.required' => 'Kondisi produk tidak boleh kosong.',
            'image.*.image' => 'File harus berupa gambar.',
            'image.*.max' => 'File tidak boleh lebih dari 2 MB.',
            'image.*.mimes' => 'File harus berformat jpeg, png, jpg.',
            'spec_name.*.required' => 'Nama spesifikasi tidak boleh kosong.',
            'spec_info.*.required' => 'Informasi spesifikasi tidak boleh kosong.',
        ]);

        $product = Product::create($request->all());

        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $imageName = time() . '-' . $image->getClientOriginalName();
                $image->move(public_path('images'), $imageName);

                Image::create([
                    'url' => $imageName,
                    'imageable_id' => $product->id,
                    'imageable_type' => Product::class,
                ]);
            }
        }

        foreach ($request->spec_name as $index => $spec_name) {
            $spec_info = $request->spec_info[$index];

            Specification::create([
                'product_id' => $product->id,
                'spec_name' => $spec_name,
                'spec_info' => $spec_info,
            ]);
        }

        return redirect()->route('product.index')->with('success', 'Produk ' . $product->name . ' berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $merks = Merk::all();

        return view('admin.product.edit', compact('product', 'categories', 'merks'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id' => ['required'],
            'merk_id' => ['required'],
            'product_code' => ['required', 'unique:products,product_code,' . $product->id],
            'product_name' => ['required', 'unique:products,product_name,' . $product->id],
            'price' => ['required', 'numeric'],
            'unit' => ['required'],
            'qty' => ['required', 'numeric'],
            'condition' => ['required'],
            'image.*' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'spec_name.*' => ['required'],
            'spec_info.*' => ['required'],
        ], [
            'category_id.required' => 'Kategori produk tidak boleh kosong.',
            'merk_id.required' => 'Merk produk tidak boleh kosong.',
            'product_code.required' => 'Kode produk tidak boleh kosong.',
            'product_code.unique' => 'Kode produk sudah ada.',
            'product_name.required' => 'Nama produk tidak boleh kosong.',
            'product_name.unique' => 'Nama produk sudah ada.',
            'price.required' => 'Harga produk tidak boleh kosong.',
            'price.numeric' => 'Harga produk harus berupa angka.',
            'unit.required' => 'Satuan produk tidak boleh kosong.',
            'qty.required' => 'Stok produk tidak boleh kosong.',
            'qty.numeric' => 'Stok produk harus berupa angka.',
            'condition.required' => 'Kondisi produk tidak boleh kosong.',
            'image.*.image' => 'File harus berupa gambar.',
            'image.*.max' => 'File tidak boleh lebih dari 2 MB.',
            'image.*.mimes' => 'File harus berformat jpeg, png, jpg, gif, svg.',
            'spec_name.*.required' => 'Nama spesifikasi tidak boleh kosong.',
            'spec_info.*.required' => 'Informasi spesifikasi tidak boleh kosong.',
        ]);

        $product->update($request->all());

        if ($request->hasFile('image')) {
            // Delete existing images
            foreach ($product->images as $image) {
                $imagePath = public_path('images/' . $image->url);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
                $image->delete();
            }

            // Add new images
            foreach ($request->file('image') as $image) {
                $imageName = time() . '-' . $image->getClientOriginalName();
                $image->move(public_path('images'), $imageName);

                Image::create([
                    'url' => $imageName,
                    'imageable_id' => $product->id,
                    'imageable_type' => Product::class,
                ]);
            }
        }

        $product->specification()->delete();

        // Add new specifications
        foreach ($request->spec_name as $index => $spec_name) {
            $spec_info = $request->spec_info[$index];

            Specification::create([
                'product_id' => $product->id,
                'spec_name' => $spec_name,
                'spec_info' => $spec_info,
            ]);
        }

        return redirect()->route('product.index')->with('success', 'Produk ' . $product->product_name . ' berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        foreach ($product->images as $image) {
            $imagePath = public_path('images/' . $image->url);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            $image->delete();
        }

        $product->specification()->delete();
        $product->delete();

        return redirect()->route('product.index')->with('success', 'Produk ' . $product->product_name . ' berhasil dihapus');
    }
}
