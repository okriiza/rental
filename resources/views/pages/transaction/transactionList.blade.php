@extends('layouts.home')
@section('title')
    Transaksi Data - Rental Mobil
@endsection

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Transaksi</h1>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card border-left-primary shadow ">
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Invoice Number</th>
                                    <th>Invoice Dibuat</th>
                                    <th>Penyewa</th>
                                    <th>Project</th>
                                    <th>Reff SPK</th>
                                    <th>Total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($invoices as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->invoice_number }}</td>
                                        <td>{{ $item->invoice_date }}</td>
                                        <td>{{ $item->tenant }}</td>
                                        <td>{{ $item->project }}</td>
                                        <td>{{ $item->reff_spk }}</td>
                                        <td>{{ number_format($item->total) }}</td>
                                        <td>
                                            <a href="{{ route('transaction.invoice', $item->id) }}"
                                                class="btn btn-outline-primary btn-circle btn-sm">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
