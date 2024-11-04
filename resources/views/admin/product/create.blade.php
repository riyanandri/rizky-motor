@extends('layouts.spica')

@section('content')
    <div class="content-wrapper">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h2>Tambah Produk</h2>
            <a href="{{ route('product.index') }}" class="btn btn-dark btn-icon-text"><i
                    class="mdi mdi-backburger btn-icon-prepend"></i>Kembali</a>
        </div>
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <form class="form-sample" action="{{ route('product.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <p class="card-description">
                                Informasi Produk
                            </p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category_id">Kategori Produk</label>
                                        <select class="form-control @error('category_id') is-invalid @enderror"
                                            name="category_id">
                                            <option value="">Pilih Kategori</option>
                                            @foreach ($categories as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="merk_id">Merk</label>
                                        <select class="form-control @error('merk_id') is-invalid @enderror" name="merk_id">
                                            <option value="">Pilih Merk</option>
                                            @foreach ($merks as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('merk_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_name">Nama Produk</label>
                                        <input type="text"
                                            class="form-control @error('product_name') is-invalid @enderror"
                                            name="product_name" placeholder="Nama Produk"
                                            value="{{ old('product_name') }}" />
                                        @error('product_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_code">Kode Produk</label>
                                        <input type="text"
                                            class="form-control @error('product_code') is-invalid @enderror"
                                            name="product_code" placeholder="Kode Produk"
                                            value="{{ old('product_code') }}" />
                                        @error('product_code')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="price">Harga</label>
                                        <input type="number" class="form-control @error('price') is-invalid @enderror"
                                            name="price" placeholder="Harga Produk" value="{{ old('price') }}" />
                                        @error('price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="unit">Satuan</label>
                                        <select class="form-control @error('unit') is-invalid @enderror" name="unit">
                                            <option value="">Pilih Satuan</option>
                                            <option value="pcs">Pcs</option>
                                            <option value="liter">Liter</option>
                                        </select>
                                        @error('unit')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="qty">Stok</label>
                                        <input type="number" class="form-control @error('qty') is-invalid @enderror"
                                            name="qty" placeholder="Stok Produk" value="{{ old('qty') }}" />
                                        @error('qty')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="condition">Kondisi</label>
                                        <select class="form-control @error('condition') is-invalid @enderror"
                                            name="condition">
                                            <option value="">Pilih Kondisi</option>
                                            <option value="baru">Baru</option>
                                            <option value="bekas">Bekas</option>
                                        </select>
                                        @error('condition')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="image">Gambar</label>
                                        <input type="file" name="image[]" class="file-upload-default" multiple>
                                        <div class="input-group col-xs-12">
                                            <input type="text"
                                                class="form-control file-upload-info @error('image') is-invalid @enderror"
                                                disabled placeholder="Unggah Gambar">
                                            <span class="input-group-append">
                                                <button class="file-upload-browse btn btn-primary"
                                                    type="button">Unggah</button>
                                            </span>
                                            @error('image')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description">Deskripsi</label>
                                        <textarea class="form-control" rows="4" name="description"></textarea>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="statusRadios"
                                                    id="statusRadios1" value="">
                                                Aktif
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="membershipRadios"
                                                    id="statusRadios2" value="">
                                                Nonaktif
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            <p class="card-description">
                                Spesifikasi
                            </p>
                            <div id="specifications">
                                @foreach (old('spec_name', ['']) as $index => $spec_name)
                                    <div class="row specification-row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="spec_name">Nama Spesifikasi</label>
                                                <input type="text"
                                                    class="form-control @error('spec_name.' . $index) is-invalid @enderror"
                                                    name="spec_name[]" value="{{ $spec_name }}" />
                                                @error('spec_name.' . $index)
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="spec_info">Informasi Spesifikasi</label>
                                                <input type="text"
                                                    class="form-control @error('spec_info.' . $index) is-invalid @enderror"
                                                    name="spec_info[]" value="{{ old('spec_info.' . $index) }}" />
                                                @error('spec_info.' . $index)
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="">Aksi</label>
                                            <div class="d-flex justify-content-start flex-nowrap">
                                                <button type="button" class="btn btn-inverse-danger btn-icon mr-1"
                                                    onclick="removeSpecification(this)">
                                                    <i class="mdi mdi-minus-box"></i>
                                                </button>
                                                <button type="button" class="btn btn-inverse-primary btn-icon ml-1"
                                                    onclick="addSpecification()">
                                                    <i class="mdi mdi-plus-box"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                            <a href="{{ route('product.index') }}" class="btn btn-light">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('spica/js/file-upload.js') }}"></script>
    <script>
        function addSpecification() {
            let specificationsDiv = document.getElementById('specifications');
            let newSpecIndex = specificationsDiv.childElementCount;
            let newSpecRow = `
            <div class="row specification-row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="spec_name">Nama Spesifikasi</label>
                        <input type="text" class="form-control" name="spec_name[]" value="" />
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="spec_info">Informasi Spesifikasi</label>
                        <input type="text" class="form-control" name="spec_info[]" value="" />
                    </div>
                </div>
                <div class="col-md-2">
                    <label for="">Aksi</label>
                    <div class="d-flex justify-content-start flex-nowrap">
                        <button type="button" class="btn btn-inverse-danger btn-icon mr-1" onclick="removeSpecification(this)">
                            <i class="mdi mdi-minus-box"></i>
                        </button>
                        <button type="button" class="btn btn-inverse-primary btn-icon ml-1" onclick="addSpecification()">
                            <i class="mdi mdi-plus-box"></i>
                        </button>
                    </div>
                </div>
            </div>`;
            specificationsDiv.insertAdjacentHTML('beforeend', newSpecRow);
        }

        function removeSpecification(button) {
            let row = button.closest('.specification-row');
            row.remove();
        }
    </script>
@endpush
