@extends('layouts.master')

@section('title', 'Product Detail')

@section('content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h1 class="display-4">{{ $product->nama_produk }}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-6 text-center">
            <img src="{{ asset('storage/images/' . $product->gambar) }}" class="img-fluid rounded" alt="{{ $product->nama_produk }}">
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12 col-lg-6 offset-lg-3">
            <h3>Description</h3>
            <p>{{ $product->deskripsi }}</p>
            <h3>Price</h3>
            <p>Rp. {{ number_format($product->harga) }}</p>
            <h3>Other Details</h3>
            <p>Weight: {{ number_format($product->berat) }} grams</p>
            <p>Stock: {{ number_format($product->stok) }}</p>
            <p>Condition: {{ $product->kondisi }}</p>
            <div class="d-grid gap-2">
                <a href="{{ route('checkout', ['id' => $product->id]) }}" class="btn btn-primary btn-lg">Checkout</a>
            </div>
        </div>
    </div>
</div>
@endsection
