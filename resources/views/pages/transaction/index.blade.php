@extends('layouts.home')

@section('title')
    form-transaction - Rental
@endsection

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Form Transaksi</h1>
    </div>
    <div class="row">

        <div class="col-lg-12">
            <form action="{{ route('transaction.store') }}" method="POST">
                @csrf
                @method('POST')
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
                        <div class="card border-left-primary shadow">
                            <div class="card-body">
                                <h5>Invoice</h5>
                                <div class="form-group">
                                    <label for="">No Invoice </label>
                                    <input readonly name="invoice_number"
                                        class="form-control @error('invoice_number') is-invalid @enderror" type="text"
                                        value="{{ $invoiceNumber }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Tanggal </label>
                                    <input type="date" name="invoice_date"
                                        class="form-control @error('invoice_date') is-invalid @enderror" value="">
                                    @error('invoice_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Reff SPK </label>
                                    <input type="text" name="reff_spk"
                                        class="form-control @error('reff_spk') is-invalid @enderror" value="">
                                    @error('reff_spk')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Project </label>
                                    <input type="text" name="project"
                                        class="form-control @error('project') is-invalid @enderror" value="">
                                    @error('project')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
                        <div class="card border-left-success shadow">
                            <div class="card-body">
                                <h5>Penyewa</h5>
                                <div class="form-group">
                                    <label for="tenant">Nama Penyewa</label>
                                    <input type="text" name="tenant" id="tenant"
                                        class="form-control @error('tenant') is-invalid @enderror">
                                    @error('tenant')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-lg-12">
                        <div class="card border-left-danger shadow">
                            <div class="card-body">
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                <span class="mb-3 float-lg-right btn btn-sm btn-primary shadow-sm" data-toggle="modal"
                                    data-target="#addItem"><i class="fa fa-plus fa-sm text-white-50"></i> Tambah
                                    Unit</span>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr class="text-center">
                                                <th>No</th>
                                                <th>Unit</th>
                                                <th>Tanggal Sewa</th>
                                                <th>Waktu (Hari)</th>
                                                <th>Harga Sewa</th>
                                                <th>Total</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (session('cart'))
                                                @php
                                                    $total = 0;
                                                    $no = 1;
                                                @endphp
                                                @foreach (session('cart') as $id => $item)
                                                    @php $total += $item['subtotal'] ; @endphp
                                                    <tr data-id="{{ $id }}">
                                                        <td>{{ $no++ }}</td>
                                                        <td>{{ $item['name_unit'] }}</td>
                                                        <td>{{ $item['rental_date'] }}</td>
                                                        <td>{{ $item['rental_time'] }}</td>
                                                        <td>{{ number_format($item['price_unit']) }}</td>
                                                        <td>{{ number_format($item['subtotal']) }}</td>
                                                        <td>
                                                            <button class="btn btn-danger btn-sm remove-from-cart"><i
                                                                    class="fas fa-trash"></i></button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr class="text-center">
                                                    <td colspan="10">Data Tidak Tersedia</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row float-lg-right mt-3">
                    <div class="col-lg-12">
                        <div class="card border-left-warning shadow ">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="my-2">
                                            <b>Total Bayar:</b>
                                            <span id="total" class="float-right">{{ number_format($total ?? 0) }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-sm btn-success shadow-sm">Simpan</button>
                                    <a href="{{ route('transaction.index') }}"
                                        class="btn btn-sm btn-warning shadow-sm">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @include('pages.transaction.modalCreate')
@endsection

@push('addon-script')
    <script>
        $(".remove-from-cart").click(function(e) {
            e.preventDefault();
            var getAttr = $(this);
            if (confirm("Are you sure want to remove?")) {
                $.ajax({
                    url: '{{ route('transaction.destroy') }}',
                    method: "DELETE",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: getAttr.parents("tr").attr("data-id")
                    },
                    success: function(response) {
                        window.location.reload();
                    }
                });
            }
        });
    </script>
@endpush
