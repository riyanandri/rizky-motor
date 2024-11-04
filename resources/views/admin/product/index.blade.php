@extends('layouts.spica')

@section('content')
    <div class="content-wrapper">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h2>Data Produk</h2>
            <a href="{{ route('product.create') }}" class="btn btn-primary btn-icon-text"><i
                    class="mdi mdi-database-plus btn-icon-prepend"></i>Tambah
                Data</a>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="font-weight-bold">
                                            Produk
                                        </th>
                                        <th class="font-weight-bold">
                                            Harga
                                        </th>
                                        <th class="font-weight-bold">
                                            Stok
                                        </th>
                                        <th class="font-weight-bold">
                                            Status
                                        </th>
                                        <th class="font-weight-bold">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($products as $product)
                                        <tr>
                                            <td width="50%">
                                                @if ($product->images->isNotEmpty())
                                                    @foreach ($product->images as $image)
                                                        <img src="{{ asset('images/' . $image->url) }}" alt="image"
                                                            class="mr-1">
                                                    @endforeach
                                                @else
                                                    <img src="{{ asset('spica/images/default.jpg') }}" alt="default image"
                                                        class="mr-1">
                                                @endif
                                                {{ $product->product_name }}
                                            </td>
                                            <td>{{ rp_format($product->price) }}</td>
                                            <td>{{ $product->qty }} {{ $product->unit }}</td>
                                            <td>
                                                <div class="form-check form-check-primary">
                                                    <label for="switchStatus{{ $product->id }}" class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="switchStatus{{ $product->id }}"
                                                            @if ($product->status == 'aktif') checked @endif
                                                            onchange="toggleProductStatus({{ $product->id }}, this.checked)">
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{ route('product.edit', $product->id) }}"
                                                    class="btn btn-sm btn-warning btn-icon-text">
                                                    <i class="mdi mdi-pen btn-icon-prepend"></i>
                                                    Edit
                                                </a>
                                                <button type="button" onclick="confirmDelete({{ $product->id }})"
                                                    class="btn btn-sm btn-danger btn-icon-text">
                                                    <i class="mdi mdi-delete btn-icon-prepend"></i>
                                                    Hapus
                                                </button>
                                                <form id="delete-form-{{ $product->id }}"
                                                    action="{{ route('product.destroy', $product->id) }}" method="POST"
                                                    class="d-none">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Data tidak ditemukan!</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        function confirmDelete(productId) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Data merk ini akan dihapus secara permanen!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#6640b2',
                cancelButtonColor: '#909192',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + productId).submit();
                }
            });
        }
    </script>
    <script>
        function toggleProductStatus(productId, isChecked) {
            if (!productId) {
                console.error('ID produk tidak valid');
                return;
            }

            let url = '{{ route('toggle.product.status', ':id') }}';
            url = url.replace(':id', productId);

            let status = isChecked ? 'aktif' : 'nonaktif';

            fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        status: status
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log('Status produk diperbarui');
                    } else {
                        console.log('Gagal memperbarui status produk');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    // Tambahkan logika atau feedback lain jika diperlukan
                });
        }
    </script>
@endpush
