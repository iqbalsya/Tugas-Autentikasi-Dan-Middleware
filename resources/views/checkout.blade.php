@extends('layouts.master')

@section('title', 'Checkout')

@section('content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h1 class="display-4">Checkout</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-6 offset-lg-3">
            <h3>Transaction Details</h3>
            <p><strong>Invoice Number:</strong> {{ $invoiceNumber }}</p>
            <p><strong>Admin Fee:</strong> Rp. {{ number_format($adminFee) }}</p>
            <p><strong>Unique Code:</strong> {{ $uniqueCode }}</p>
            <p><strong>Total:</strong> Rp. {{ number_format($total) }}</p>
            <p><strong>Payment Method:</strong> {{ $paymentMethod }}</p>
            <p><strong>Status:</strong> {{ $status }}</p>
            <p><strong>Expiration Date:</strong> {{ $expirationDate->format('d M Y H:i') }}</p>

            <h3>Product Details</h3>
            <div class="card mb-4">
                <img src="{{ asset('storage/images/' . $product->gambar) }}" class="card-img-top" alt="{{ $product->nama_produk }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->nama_produk }}</h5>
                    <p class="card-text">{{ $product->deskripsi }}</p>
                    <p><strong>Price:</strong> Rp. {{ number_format($product->harga) }}</p>
                    <p><strong>Weight:</strong> {{ number_format($product->berat) }} grams</p>
                    <p><strong>Stock:</strong> {{ number_format($product->stok) }}</p>
                    <p><strong>Condition:</strong> {{ $product->kondisi }}</p>
                </div>
            </div>

            <form action="{{ route('processCheckout', ['id' => $product->id]) }}" method="POST">
                @csrf
            </form>
        </div>
    </div>
</div>
@endsection
