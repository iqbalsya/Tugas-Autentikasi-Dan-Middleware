@extends('layouts.master')

@section('content')

    <div class="container w-50 p-3 mt-2 fw-medium">

            {{-- @if ($errors->any())
                <div class="alert alert-danger">
                    <ul style="margin-bottom: 0;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif --}}

        <div class="bg-info p-3 rounded">
                <h3 class="text-center"><strong>Form Produk</strong></h3>
            <form id="product-form"
                    @if(isset($product->id))
                        action="{{ route('product.update', $product->id) }}"
                    @else
                        action="{{ route('product.store', ['id' => $user->id]) }}"
                    @endif
                    method="POST" enctype="multipart/form-data">

                    @csrf

                    @if(isset($product->id))
                        @method('PUT')
                    @endif

                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar</label>
                        <input type="file" class="form-control @error('gambar') is-invalid @enderror" id="gambar" name="gambar" accept="image/*">
                        @error('gambar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nama_produk" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control @error('nama_produk') is-invalid @enderror" id="nama_produk" name="nama_produk" value="{{ old('nama_produk', $product->nama_produk) }}">
                        @error('nama_produk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="berat" class="form-label">Berat</label>
                        <input type="number" class="form-control @error('berat') is-invalid @enderror" id="berat" name="berat" value="{{ old('berat', $product->berat) }}">
                        @error('berat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value="{{ old('harga', $product->harga) }}">
                        @error('harga')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="stok" class="form-label">Stok</label>
                        <input type="number" class="form-control @error('stok') is-invalid @enderror" id="stok" name="stok" value="{{ old('stok', $product->stok) }}">
                        @error('stok')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="kondisi" class="form-label">Kondisi</label>
                        <select class="form-select @error('kondisi') is-invalid @enderror" id="kondisi" name="kondisi">
                            <option value=""  selected disabled>Pilih Kondisi Barang</option>
                            <option value="Bekas" {{ $product->kondisi == 'Bekas' ? 'selected' : '' }}>Bekas</option>
                            <option value="Baru" {{ $product->kondisi == 'Baru' ? 'selected' : '' }}>Baru</option>
                        </select>
                        @error('kondisi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" rows="3" id="deskripsi" name="deskripsi">{{ old('deskripsi', $product->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-center gap-2">
                        @if(isset($product->id))
                            <a href="{{ route('list-product-by-user', ['id' => $user_id]) }}" class="btn btn-secondary">Kembali</a>
                        @else
                            <a href="{{ route('list-product-by-user', ['id' => $user->id]) }}" class="btn btn-secondary">Kembali</a>
                        @endif

                        <button type="submit" class="btn btn-dark">
                            @if(isset($product->id))
                                Update
                            @else
                                Submit
                            @endif
                        </button>
                    </div>
            </form>
        </div>
    </div>

@endsection
