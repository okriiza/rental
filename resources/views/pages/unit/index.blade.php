@extends('layouts.home')
@section('title')
    Unit - Rental Mobil
@endsection

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Unit</h1>
        <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal"
            data-target="#createUnit"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Unit</button>
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
                                    <th>Name Unit</th>
                                    <th>Price Unit</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($units as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->name_unit }}</td>
                                        <td>{{ number_format($item->price_unit) }}</td>
                                        <td>
                                            <button type="button" class="btn btn-outline-primary btn-circle btn-sm"
                                                data-toggle="modal" data-target="#updateUnit" data-id="{{ $item->id }}"
                                                data-name="{{ $item->name_unit }}" data-price="{{ $item->price_unit }}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                            <form action="{{ route('unit.destroy', $item->id) }}" method="post"
                                                class="d-inline" onclick="return confirm('Yakin hapus data?')">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-outline-danger btn-circle btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
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
    @include('pages.unit.modalCreate');
    @include('pages.unit.modalUpdate');
@endsection

@push('addon-script')
    <script>
        $(document).ready(function() {
            @if (Session::has('errors'))
                $('#createUnit').modal({
                    show: true
                });
            @endif
            $('#updateUnit').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                var id = button.data('id')
                var nameUnit = button.data('name')
                var priceUnit = button.data('price')
                console.log(nameUnit);
                var modal = $(this)
                $('#updateForm').attr('action', '/unit/' + id);
                modal.find('.modal-body #id').val(id)
                modal.find('.modal-body #name_unit').val(nameUnit)
                modal.find('.modal-body #price_unit').val(priceUnit)
            })
        });
    </script>
@endpush
