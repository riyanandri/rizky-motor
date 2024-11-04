@extends('layouts.spica')

@section('content')
    <div class="content-wrapper">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h2>Edit Kategori Produk</h2>
            <a href="{{ route('category.index') }}" class="btn btn-dark btn-icon-text"><i
                    class="mdi mdi-backburger btn-icon-prepend"></i>Kembali</a>
        </div>
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" action="{{ route('category.update', $category->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Nama Kategori</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" placeholder="Nama Kategori"
                                    value="{{ old('name', $category->name) }}">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Simpan Perubahan</button>
                            <a href="{{ route('category.index') }}" class="btn btn-light">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
