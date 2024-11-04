<?php

namespace App\Http\Controllers\Admin;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\User;
use App\Models\Product;
use App\Models\Image;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::all();

        return view('admin.transaction.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::orderBy('name', 'ASC')
            ->whereDoesntHave('roles', function ($query) {
                $query->where('name', 'superadmin');
            })
            ->get();

        $products = Product::orderBy('product_name', 'ASC')->get();

        return view('admin.transaction.create', compact('users', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'transaction_type' => ['required'],
            'user_id' => ['required_if:transaction_type,penjualan', 'exists:users,id'],
            'deposit' => ['nullable', 'numeric'],
            'notes' => ['nullable', 'string'],
            'image.*' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'product_id.*' => ['required', 'exists:products,id'],
            'qty.*' => ['required', 'numeric'],
            'service_name.*' => ['nullable', 'string'],
            'service_price.*' => ['nullable', 'numeric'],
        ], [
            'transaction_type.required' => 'Tipe transaksi harus dipilih.',
            'user_id.exists' => 'Pelanggan harus dipilih.',
            'deposit.numeric' => 'Deposit harus berupa angka.',
            'notes.string' => 'Catatan harus berupa teks.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'File harus berformat jpeg, png, jpg.',
            'image.max' => 'File tidak boleh lebih dari 2 MB.',
            'product_id.*.required' => 'Produk harus dipilih.',
            'product_id.*.exists' => 'Produk tidak valid.',
            'qty.*.required' => 'Jumlah harus diisi.',
            'qty.*.numeric' => 'Jumlah harus berupa angka.',
            'service_name.*.string' => 'Nama jasa harus berupa teks.',
            'service_price.*.numeric' => 'Harga jasa harus berupa angka.',
        ]);

        if ($request->transaction_type == 'pembelian') {
            $validated['user_id'] = Auth::user()->id;
        }

        if (isset($request->deposit) && $request->deposit > 0) {
            $validated['status'] = 'belum lunas';
        } else {
            $validated['status'] = 'lunas';
        }

        $transactionCode = 'TRX' . Carbon::now()->format('Ymd');

        $lastTransaction = Transaction::where('transaction_code', 'like', $transactionCode . '%')
            ->orderBy('id', 'desc')
            ->first();

        if ($lastTransaction) {
            $lastSequence = intval(substr($lastTransaction->transaction_code, -3)); // Ambil 3 digit terakhir sebagai nomor urut
            $nextSequence = str_pad($lastSequence + 1, 3, '0', STR_PAD_LEFT); // Tambahkan satu dan format ulang sebagai 3 digit
        } else {
            $nextSequence = '001';
        }

        $validated['transaction_code'] = $transactionCode . $nextSequence;

        DB::beginTransaction();

        try {
            $transaction = Transaction::create($validated);

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '-' . $image->getClientOriginalName();
                $image->move(public_path('images'), $imageName);

                Image::create([
                    'url' => $imageName,
                    'imageable_id' => $transaction->id,
                    'imageable_type' => Transaction::class,
                ]);
            }

            foreach ($request->product_id as $index => $product_id) {
                $product = Product::find($product_id);

                if ($product) {
                    $qty = $request->qty[$index];
                    $total_price = $qty * $product->price;

                    TransactionDetail::create([
                        'transaction_id' => $transaction->id,
                        'product_id' => $product_id,
                        'qty' => $qty,
                        'total_price' => $total_price,
                    ]);

                    // Update stok berdasarkan tipe transaksi
                    if ($request->transaction_type == 'penjualan') {
                        // Pengurangan stok untuk transaksi penjualan
                        if ($product->qty >= $qty) {
                            $product->qty -= $qty;
                            $product->save();
                        } else {
                            // Rollback transaksi jika stok tidak mencukupi
                            DB::rollback();
                            return redirect()->back()->with('error', 'Stok produk ' . $product->name . ' tidak mencukupi.');
                        }
                    } elseif ($request->transaction_type == 'pembelian') {
                        // Penambahan stok untuk transaksi pembelian
                        $product->qty += $qty;
                        $product->save();
                    }
                }
            }

            if (isset($request->service_name)) {
                foreach ($request->service_name as $index => $service_name) {
                    if (!empty($service_name)) {
                        $service_price = $request->service_price[$index] ?? null;

                        Service::create([
                            'transaction_id' => $transaction->id,
                            'service_name' => $service_name,
                            'service_price' => $service_price,
                        ]);
                    }
                }
            }

            // Commit transaksi jika sukses
            DB::commit();

            return redirect()->route('transaction.index')->with('success', 'Transaksi berhasil ditambahkan');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi exception
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
