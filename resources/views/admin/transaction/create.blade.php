@extends('layouts.spica')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
    <div class="content-wrapper">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h2>Tambah Transaksi</h2>
            <a href="{{ route('transaction.index') }}" class="btn btn-dark btn-icon-text">
                <i class="mdi mdi-backburger btn-icon-prepend"></i>Kembali
            </a>
        </div>
        <form class="forms-sample" method="POST" action="{{ route('transaction.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Informasi Transaksi</h4>
                            <div class="form-group">
                                <label for="transaction_type">Tipe Transaksi</label>
                                <select id="transaction_type"
                                    class="form-control js-example-basic-single @error('transaction_type') is-invalid @enderror"
                                    name="transaction_type">
                                    <option value="">Pilih Tipe Transaksi</option>
                                    <option value="penjualan">Penjualan</option>
                                    <option value="pembelian">Pembelian</option>
                                </select>
                                @error('transaction_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group" id="customer">
                                <label for="user_id">Pelanggan</label>
                                <select class="form-control js-example-basic-single @error('user_id') is-invalid @enderror"
                                    name="user_id">
                                    <option value="">Pilih Pelanggan</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <input type="hidden" name="user_id" id="logged_in_user_id" value="{{ Auth::user()->id }}">
                            <div class="form-group">
                                <label for="deposit">Deposit</label>
                                <input type="number" class="form-control @error('deposit') is-invalid @enderror"
                                    name="deposit">
                                @error('deposit')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="notes">Catatan</label>
                                <textarea class="form-control @error('notes') is-invalid @enderror" rows="4" name="notes"></textarea>
                                @error('notes')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="image">Bukti Transaksi</label>
                                <input type="file" name="image" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <input type="text"
                                        class="form-control file-upload-info @error('image') is-invalid @enderror" disabled
                                        placeholder="Unggah Bukti Transaksi">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-primary" type="button">Unggah</button>
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
                </div>
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div id="productItems">
                                <h4 class="card-title">Produk Item</h4>
                                @foreach (old('product_id', ['']) as $index => $product_id)
                                    <div class="row product-item-row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="product_id">Produk</label>
                                                <select
                                                    class="form-control js-example-basic-single @error('product_id.' . $index) is-invalid @enderror"
                                                    name="product_id[]" id="product_id_{{ $index }}">
                                                    <option value="">Pilih Produk</option>
                                                    @foreach ($products as $product)
                                                        <option value="{{ $product->id }}"
                                                            {{ $product->id == old('product_id.' . $index) ? 'selected' : '' }}>
                                                            {{ $product->product_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('product_id.' . $index)
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="qty">Jumlah</label>
                                                <input type="text"
                                                    class="form-control form-control-sm @error('qty.' . $index) is-invalid @enderror"
                                                    name="qty[]" id="qty_{{ $index }}"
                                                    value="{{ old('qty.' . $index) }}" />
                                                @error('qty.' . $index)
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label for="">Hapus</label>
                                                <button type="button"
                                                    class="btn btn-inverse-danger btn-icon remove-product-item"><i
                                                        class="mdi mdi-delete"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="form-group">
                                    <button type="button" class="btn btn-dark btn-icon-text add-product-item">
                                        <i class="mdi mdi-plus btn-icon-prepend"></i>Tambah Produk
                                    </button>
                                </div>
                            </div>
                            <div id="serviceItems">
                                <h4 class="card-title">Jasa</h4>
                                @foreach (old('service_name', ['']) as $index => $service_name)
                                    <div class="row service-item-row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="service_name">Nama Jasa</label>
                                                <input type="text"
                                                    class="form-control form-control-sm @error('service_name.' . $index) is-invalid @enderror"
                                                    name="service_name[]" id="service_name_{{ $index }}"
                                                    value="{{ old('service_name.' . $index) }}" />
                                                @error('service_name.' . $index)
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="service_price">Harga Jasa</label>
                                                <input type="text"
                                                    class="form-control form-control-sm @error('service_price.' . $index) is-invalid @enderror"
                                                    name="service_price[]" id="service_price_{{ $index }}"
                                                    value="{{ old('service_price.' . $index) }}" />
                                                @error('service_price.' . $index)
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label for="">Hapus</label>
                                                <button type="button"
                                                    class="btn btn-inverse-danger btn-icon remove-service-item"><i
                                                        class="mdi mdi-delete"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="form-group">
                                    <button type="button" class="btn btn-dark btn-icon-text add-service-item">
                                        <i class="mdi mdi-plus btn-icon-prepend"></i>Tambah Jasa
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('transaction.index') }}" class="btn btn-danger">Batal</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('js')
    <script src="{{ asset('spica/js/file-upload.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('.js-example-basic-single').select2();

            // Hide or show customer and service items based on transaction type
            $('#transaction_type').on('change', function() {
                toggleTransactionTypeInput();
            });

            // Initial call to handle page load scenario
            toggleTransactionTypeInput();

            // Function to toggle the visibility of fields based on the selected transaction type
            function toggleTransactionTypeInput() {
                var transactionType = $('#transaction_type').val();
                if (transactionType === 'penjualan') {
                    $('#customer').show();
                    $('#serviceItems').show();
                    $('#logged_in_user_id').prop('disabled', true);
                } else if (transactionType === 'pembelian') {
                    $('#customer').hide();
                    $('#serviceItems').hide();
                    $('#logged_in_user_id').prop('disabled', false);
                } else {
                    $('#customer').hide();
                    $('#serviceItems').hide();
                    $('#logged_in_user_id').prop('disabled', true);
                }
            }

            // Function to add a new product item
            $('.add-product-item').click(function() {
                var index = $('.product-item-row').length;
                var html = `
                <div class="row product-item-row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="product_id">Produk</label>
                            <select class="form-control js-example-basic-single" name="product_id[]" id="product_id_${index}">
                                <option value="">Pilih Produk</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="qty">Jumlah</label>
                            <input type="text" class="form-control form-control-sm" name="qty[]" id="qty_${index}" />
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <label for="">Hapus</label>
                            <button type="button" class="btn btn-inverse-danger btn-icon remove-product-item"><i class="mdi mdi-delete"></i></button>
                        </div>
                    </div>
                </div>`;
                $('#productItems').append(html);
                $('.js-example-basic-single').select2(); // Reinitialize Select2
            });

            // Function to remove a product item
            $(document).on('click', '.remove-product-item', function() {
                $(this).closest('.product-item-row').remove();
            });

            // Function to add a new service item
            $('.add-service-item').click(function() {
                var index = $('.service-item-row').length;
                var html = `
                <div class="row service-item-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="service_name">Nama Jasa</label>
                            <input type="text" class="form-control form-control-sm" name="service_name[]" id="service_name_${index}" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="service_price">Harga Jasa</label>
                            <input type="text" class="form-control form-control-sm" name="service_price[]" id="service_price_${index}" />
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <label for="">Hapus</label>
                            <button type="button" class="btn btn-inverse-danger btn-icon remove-service-item"><i class="mdi mdi-delete"></i></button>
                        </div>
                    </div>
                </div>`;
                $('#serviceItems').append(html);
            });

            // Function to remove a service item
            $(document).on('click', '.remove-service-item', function() {
                $(this).closest('.service-item-row').remove();
            });
        });
    </script>
@endpush
