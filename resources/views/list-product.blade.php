@extends('layouts.master')
@section('title', 'List-Product')

@section('content')

    <div class="container px-1 py-1 ">
        <div class="bg-info p-3 rounded">
            <div class="d-flex justify-content-between text-center mb-2 p-3">
                <div class="">
                    <h2>List Product</h2>
                </div>
                <div class="align-items-end">
                    <a href="{{ route('product.create', ['id' => $user->id]) }}" class="btn btn-dark">Tambah Produk</a>
                </div>
            </div>

            <form action="{{ route('product.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="csvFile" class="form-label">Impor Data Produk (CSV)</label>
                    <input type="file" class="form-control" id="csvFile" name="csvFile" accept=".csv" required>
                </div>
                <button type="submit" class="btn btn-primary">Impor Data</button>
            </form>

            <table class="table table-striped text-center mt-4">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Stok</th>
                        <th scope="col">Berat</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Kondisi</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $nomor = 1; @endphp
                    @foreach ($products as $p)
                        <tr>
                            <th scope="row">{{ $nomor }}.</th>
                            <td>{{ $p->nama_produk }}</td>
                            <td>{{ $p->stok }}</td>
                            <td>{{ $p->berat }} Kg</td>
                            <td>Rp. {{ $p->harga }}</td>
                            <td>{{ $p->kondisi }}</td>
                            <td style="width: 15%;">
                                <div>
                                    <a href="{{ route('product.edit', $p->id) }}" class="btn btn-dark">Edit</a>
                                    <form action="{{ route('product.destroy', $p->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-secondary">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @php $nomor++; @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
        <script type="text/javascript">
            $(document).ready(function() {
                $('.data-table').DataTable({
                    language: {
                        search: "Cari:",
                        lengthMenu: "Tampilkan _MENU_ data jurusan",
                        info: "Menampilkan _START_ - _END_ dari _TOTAL_ jurusan",
                        paginate: {
                            previous: '<i class="fas fa-angle-double-left" style="font-size: 1.1rem;"></i>',
                            next: '<i class="fas fa-angle-double-right" style="font-size: 1.1rem;"></i>'
                        }
                    }
                });
            });
        </script>
    </div>

@endsection
