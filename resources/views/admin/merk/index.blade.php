@extends('layouts.spica')

@section('content')
    <div class="content-wrapper">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h2>Data Merk</h2>
            <a href="{{ route('merk.create') }}" class="btn btn-primary btn-icon-text"><i
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
                                            Merk
                                        </th>
                                        <th class="font-weight-bold">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($merks as $merk)
                                        <tr>
                                            <td width="70%">
                                                @if ($merk->images->isNotEmpty())
                                                    <img src="{{ asset('images/' . $merk->images->first()->url) }}"
                                                        alt="image" class="mr-3">
                                                @else
                                                    <img src="{{ asset('spica/images/default.jpg') }}" alt="default image"
                                                        class="mr-3">
                                                @endif
                                                {{ $merk->name }}
                                            </td>
                                            <td>
                                                <a href="{{ route('merk.edit', $merk->id) }}"
                                                    class="btn btn-sm btn-warning btn-icon-text">
                                                    <i class="mdi mdi-pen btn-icon-prepend"></i>
                                                    Edit
                                                </a>
                                                <button type="button" onclick="confirmDelete({{ $merk->id }})"
                                                    class="btn btn-sm btn-danger btn-icon-text">
                                                    <i class="mdi mdi-delete btn-icon-prepend"></i>
                                                    Hapus
                                                </button>
                                                <form id="delete-form-{{ $merk->id }}"
                                                    action="{{ route('merk.destroy', $merk->id) }}" method="POST"
                                                    class="d-none">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="text-center">Data tidak ditemukan!</td>
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
        function confirmDelete(merkId) {
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
                    document.getElementById('delete-form-' + merkId).submit();
                }
            });
        }
    </script>
@endpush
