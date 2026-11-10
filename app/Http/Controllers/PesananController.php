<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PesananController extends Controller
{
    public function create(Request $request)
    {
        return view('pesanan.create', [
            'products' => Product::orderBy('name')->get(),
            'selected' => $request->query('product'), // untuk tombol "Pesan" dari tabel barang
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'jumlah' => ['required', 'integer', 'min:1'],
            'alamat' => ['required', 'string', 'max:500'],
            'metode_pembayaran' => ['required', Rule::in(['transfer_bank', 'e_wallet', 'cod'])],
            'bukti_pembayaran' => ['required_unless:metode_pembayaran,cod', 'nullable', 'image', 'max:2048'],
            'wilayah' => ['required', Rule::in(['dalam_kota', 'luar_kota'])],
        ]);

        $product = Product::findOrFail($data['product_id']);

        $path = $request->hasFile('bukti_pembayaran')
            ? $request->file('bukti_pembayaran')->store('bukti', 'public')
            : null;

        $request->user()->orders()->create([
            'product_id' => $product->id,
            'jumlah' => $data['jumlah'],
            'total_harga' => $product->price * $data['jumlah'], // dihitung di server, jangan dari form
            'alamat' => $data['alamat'],
            'metode_pembayaran' => $data['metode_pembayaran'],
            'bukti_pembayaran' => $path,
            'status' => 'dalam_pesanan',
            'wilayah' => $data['wilayah'],
            'total_harga' => $product->priceFor($request->user()) * $data['jumlah'],
        ]);

        return redirect()->route('pelanggan.dashboard')
            ->with('success', 'Pesanan berhasil dibuat.');
    }
}
