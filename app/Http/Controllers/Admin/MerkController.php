<?php

namespace App\Http\Controllers\Admin;

use App\Models\Merk;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MerkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $merks = Merk::orderBy('name', 'ASC')->get();

        return view('admin.merk.index', compact('merks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.merk.create');
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
            'name' => ['required', 'unique:merks'],
            'image' => ['required', 'max:2048'],
        ], [
            'name.required' => 'Nama merk tidak boleh kosong.',
            'name.unique' => 'Merk sudah ada.',
            'image.required' => 'Logo merk tidak boleh kosong.',
            'image.max' => 'File tidak boleh lebih dari 2 MB.',
        ]);

        $merk = Merk::create($request->all());

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '-' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);

            Image::create([
                'url' => $imageName,
                'imageable_id' => $merk->id,
                'imageable_type' => Merk::class,
            ]);
        }

        return redirect()->route('merk.index')->with('success', 'Merk ' . $merk->name . ' berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Merk  $merk
     * @return \Illuminate\Http\Response
     */
    public function show(Merk $merk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Merk  $merk
     * @return \Illuminate\Http\Response
     */
    public function edit(Merk $merk)
    {
        return view('admin.merk.edit', compact('merk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Merk  $merk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Merk $merk)
    {
        $request->validate([
            'name' => ['required', 'unique:merks'],
            'image' => ['required', 'max:2048'],
        ], [
            'name.required' => 'Nama merk tidak boleh kosong.',
            'name.unique' => 'Merk sudah ada.',
            'image.required' => 'Logo merk tidak boleh kosong.',
            'image.max' => 'File tidak boleh lebih dari 2 MB.',
        ]);

        $merk->update($request->all());

        if ($request->hasFile('image')) {

            foreach ($merk->images as $image) {
                unlink(public_path('images/' . $image->url));
                $image->delete();
            }

            $image = $request->file('image');
            $imageName = time() . '-' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);

            Image::create([
                'url' => $imageName,
                'imageable_id' => $merk->id,
                'imageable_type' => Merk::class,
            ]);
        }

        return redirect()->route('merk.index')->with('success', 'Merk ' . $merk->name . ' berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Merk  $merk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Merk $merk)
    {
        foreach ($merk->images as $image) {
            unlink(public_path('images/' . $image->url));
            $image->delete();
        }

        $merk->delete();

        return redirect()->route('merk.index')->with('success', 'Merk ' . $merk->name . ' berhasil dihapus');
    }
}
