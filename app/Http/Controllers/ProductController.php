<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductsImport;


class ProductController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $users = User::all();
        $products = Product::all();
        return view('product')->with('users', $users)->with('products', $products);
    }


    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            abort(404);
        }
        return view('detail-product', compact('product'));
    }


        public function create($id)
    {
        $product = new Product();
        $user = User::find($id);

        return view('form')->with('product', $product)->with('user', $user);
    }


    public function store(Request $request, $id)
    {

        $validatedData = $request->validate([
            'nama_produk' => 'required|string',
            'berat' => 'required|numeric',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'kondisi' => 'required|string',
            'deskripsi' => 'required|string|max:2000',
            'gambar' => 'required|image|max:2048'
        ],
        [
            'gambar.required' => 'Error, Gambar wajib diisi.',
            'gambar.image' => 'Error, Harus memilih file gambar.',
            'gambar.max' => 'Error, Ukuran gambar tidak boleh lebih dari 2MB.',
            'nama_produk.required' => 'Error, Nama Produk wajib diisi.',
            'berat.required' => 'Error, Berat wajib diisi.',
            'harga.required' => 'Error, Harga wajib diisi.',
            'stok.required' => 'Error, Stok wajib diisi.',
            'kondisi.required' => 'Error, Kondisi wajib diisi.',
            'deskripsi.max' => 'Error, Deskripsi tidak boleh lebih dari 2000 karakter.',
        ]);

        $user = User::find($id);

        $gambarPath = $request->file('gambar')->store('public/images');

        $namaGambar = basename($gambarPath);

        $product = new Product();
        $product->nama_produk = $request->nama_produk;
        $product->berat = $request->berat;
        $product->harga = $request->harga;
        $product->stok = $request->stok;
        $product->kondisi = $request->kondisi;
        $product->deskripsi = $request->deskripsi;
        $product->gambar = $namaGambar;
        $product->user_id = $user->id;
        $product->save();

        return redirect()->route('list-product-by-user', ['id' => $user->id])->with('success', 'Product berhasil ditambahkan!');
    }


    public function edit($id)
    {
        $product = Product::find($id);
        $user_id = $product->user_id;

        return view('/form')->with('product', $product)->with('user_id', $user_id);
    }


    public function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'nama_produk' => 'required|string',
            'berat' => 'required|numeric',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'kondisi' => 'required|string',
            'deskripsi' => 'required|string',
            'gambar' => 'required|url'
        ],
        [
            'gambar.required' => 'Error, URL Gambar wajib diisi.',
            'nama_produk.required' => 'Error, Nama Produk wajib diisi.',
            'berat.required' => 'Error, Berat wajib diisi.',
            'harga.required' => 'Error, Harga wajib diisi.',
            'stok.required' => 'Error, Stok wajib diisi.',
            'kondisi.required' => 'Error, Kondisi wajib diisi.',
            'deskripsi.required' => 'Error, Deskripsi wajib diisi.',
        ]);


        $product = Product::find($id);
        $user_id = $product->user_id;
        $product->nama_produk = $request->nama_produk;
        $product->berat = $request->berat;
        $product->harga = $request->harga;
        $product->stok = $request->stok;
        $product->kondisi = $request->kondisi;
        $product->deskripsi = $request->deskripsi;
        $product->gambar = $request->gambar;
        $product->save();


        return redirect()->route('list-product-by-user', ['id' => $user_id])->with('success', 'Product berhasil ditambahkan!');
    }


    public function destroy($id)
    {
        $product = Product::find($id);
        $user_id = $product->user_id;
        $product->delete();

        return redirect()->route('list-product-by-user', ['id' => $user_id])->with('success', 'Produk berhasil dihapus!');
    }

public function checkout($id)
    {
        $product = Product::find($id);

        if (!$product) {
            abort(404);
        }

        $invoiceNumber = strtoupper(Str::random(10));
        $adminFee = 5000;
        $uniqueCode = rand(100, 999);
        $total = $product->harga + $adminFee + $uniqueCode;
        $paymentMethod = 'Bank Transfer';
        $status = 'Pending';
        $expirationDate = Carbon::now()->addDays(1);

        return view('checkout', compact('product', 'invoiceNumber', 'adminFee', 'uniqueCode', 'total', 'paymentMethod', 'status', 'expirationDate'));
    }

    public function processCheckout(Request $request, $id)
    {

        return redirect()->route('product.index')->with('success', 'Checkout successful!');
    }

    public function import(Request $request)
    {
        $request->validate([
            'csvFile' => 'required|mimes:csv,txt',
        ]);

        $file = $request->file('csvFile');

        Excel::import(new ProductsImport, $file);

        return redirect()->route('product.index')->with('success', 'Data Produk berhasil diimpor');
    }


}
