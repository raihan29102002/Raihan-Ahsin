<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view ('products.index', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_product' => 'required',
            'harga_product' => 'required|numeric',
        ]);

        Product::create([
            'nama_product' => $request->nama_product,
            'harga_product' => $request->harga_product,
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_product' => 'required',
            'harga_product' => 'required|numeric',
        ]);

        $product = Product::findOrFail($id);
        $product->update([
            'nama_product' => $request->nama_product,
            'harga_product' => $request->harga_product,
        ]);

        return redirect()->route('produts.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }
}