@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Produk</h2>
    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nama Produk:</label>
            <input type="text" class="form-control" id="name" name="nama_product" value="{{ $product->nama_product }}">
        </div>
        <div class="form-group">
            <label for="price">Harga Produk:</label>
            <input type="text" class="form-control" id="price" name="harga_product"
                value="{{ $product->harga_product }}">
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
@endsection