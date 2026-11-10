<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        return view('owner.produk.index', [
            'products' => Product::orderBy('jenis')->orderBy('name')->get(),
        ]);
    }

    public function create()
    {
        return view('owner.produk.form', ['product' => new Product]);
    }

    public function store(Request $request)
    {
        Product::create($this->validated($request));
        return redirect()->route('owner.produk.index')->with('success', 'Barang ditambahkan.');
    }

    public function edit(Product $product)
    {
        return view('owner.produk.form', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $product->update($this->validated($request));
        return redirect()->route('owner.produk.index')->with('success', 'Barang diperbarui.');
    }

    public function destroy(Product $product)
    {
        // orders.product_id dilindungi foreign key, jadi cek dulu supaya tidak error
        if ($product->orders()->exists()) {
            return back()->with('error', 'Barang ini sudah pernah dipesan, tidak bisa dihapus.');
        }
        $product->delete();
        return back()->with('success', 'Barang dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'jenis' => ['required', 'string', 'max:100'],
            'satuan' => ['required', 'string', 'max:30'],
            'price' => ['required', 'integer', 'min:0'],            // harga umum
            'price_langganan' => ['required', 'integer', 'min:0'],  // harga langganan
        ]);
    }
}
