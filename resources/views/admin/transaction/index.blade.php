@extends('layouts.spica')

@section('content')
    <div class="content-wrapper">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h2>Data Transaksi</h2>
            <a href="{{ route('transaction.create') }}" class="btn btn-primary btn-icon-text"><i
                    class="mdi mdi-database-plus btn-icon-prepend"></i>Tambah
                Transaksi</a>
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
                                            Kode Transaksi
                                        </th>
                                        <th class="font-weight-bold">
                                            Tipe Transaksi
                                        </th>
                                        <th class="font-weight-bold">
                                            Total Nominal
                                        </th>
                                        <th class="font-weight-bold">
                                            User
                                        </th>
                                        <th class="font-weight-bold">
                                            Status
                                        </th>
                                        <th class="font-weight-bold">
                                            Tanggal Transaksi
                                        </th>
                                        <th class="font-weight-bold">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($transactions as $transaction)
                                        <tr>
                                            <td>{{ $transaction->transaction_code }}</td>
                                            <td>
                                                @if ($transaction->transaction_type == 'penjualan')
                                                    <button type="button"
                                                        class="btn btn-sm btn-rounded btn-inverse-success btn-fw">{{ $transaction->transaction_type }}</button>
                                                @else
                                                    <button type="button"
                                                        class="btn btn-sm btn-rounded btn-inverse-info btn-fw">{{ $transaction->transaction_type }}</button>
                                                @endif
                                            </td>
                                            <td></td>
                                            <td>
                                                @if ($transaction->user->images->isNotEmpty())
                                                    @foreach ($transaction->user->images as $image)
                                                        <img src="{{ asset('images/' . $image->url) }}" alt="image"
                                                            class="mr-1">
                                                    @endforeach
                                                @else
                                                    <img src="{{ asset('spica/images/default.jpg') }}" alt="default image"
                                                        class="mr-1">
                                                @endif
                                                {{ $transaction->user->name }}
                                            </td>
                                            <td>
                                                @if ($transaction->status == 'lunas')
                                                    <button type="button"
                                                        class="btn btn-sm btn-rounded btn-inverse-success btn-fw">{{ $transaction->status }}</button>
                                                @else
                                                    <button type="button"
                                                        class="btn btn-sm btn-rounded btn-inverse-danger btn-fw">{{ $transaction->status }}</button>
                                                @endif
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($transaction->created_at)->setTimezone('Asia/Jakarta')->format('d-m-Y | H.i T') }}
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-start flex-nowrap">
                                                    <a href="#" class="mr-1">
                                                        <button type="button" class="btn btn-inverse-dark btn-icon">
                                                            <i class="mdi mdi-cash"></i>
                                                        </button>
                                                    </a>
                                                    <a href="#">
                                                        <button type="button" class="btn btn-inverse-danger btn-icon">
                                                            <i class="mdi mdi-file-pdf"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Data tidak ditemukan!</td>
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
