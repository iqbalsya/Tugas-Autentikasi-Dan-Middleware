@extends('layouts.master')
@section('title', 'Product')

@section('content')
    <div class="container px-1 py-1">
        <div class="card bg-info rounded shadow border-0">
            <div class="d-flex justify-content-between text-center mb-3 p-3">
                <div class="align-items-start">
                    <h1 class="mb-0"><strong>PRODUCTS</strong></h1>
                </div>
                <div class="align-items-end">
                </div>
            </div>
            <div class="container px-3 py-1">
                <div class="row">
                    @foreach ($products as $p)
                    <div class="col-lg-3 col-md-3 col-sm-6 mb-4">
                        <div class="card rounded shadow border-0">
                            <img src="{{ asset('storage/images/' . $p->gambar) }}" class="card-img-top" alt="{{ $p->nama_produk }}">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-3">
                                    <h5 class="card-title">{{ $p->nama_produk }}</h5>
                                    <p class="card-text bg-warning rounded px-1">{{ $p->kondisi }}</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class="text-center">
                                        <p class="card-text bg-success rounded px-1">{{ number_format($p->stok) }}</p>
                                    </div>
                                    <div class="text-center">
                                        <p class="card-text bg-info rounded px-1">Rp. {{ number_format($p->harga) }}</p>
                                    </div>
                                    <div class="text-center">
                                        <p class="card-text bg-secondary rounded px-1">{{ number_format($p->berat) }}</p>
                                    </div>
                                </div>
                                <p class="card-text">{{ $p->deskripsi }}</p>
                                <a href="{{ route('product.show', ['id' => $p->id]) }}" class="btn btn-info btn-md px-4 me-md-2">Pesan Sekarang!</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <hr style="width: 100%; border-top: 1px solid black; margin: 20px auto 0;">
        </div>
    </div>
@endsection
