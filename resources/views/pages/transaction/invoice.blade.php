@extends('layouts.invoice')
@section('title')
    Invoice - Rental Mobil
@endsection

@section('content')
    <div class="container">
        <div class="float-right  mt-3">
            <h2 class="text-right">Logo</h2>
            <p>Jln Terusan Buah Batu komplek Buah Batu Regensi Blok D1 No.9 Bandung 40287</p>
        </div><br>
        <div style="margin-top: 100px">
            <hr style="height:2px;border-width:0;color:gray;background-color:gray">
            <div class="text-center">
                <h1 class="text-uppercase font-weight-bold">Invoice</h1>
            </div>
            <div class="row">
                <div class="col-md-12 my-5">
                    <h6 class="font-weight-bold">Kepada Yth :
                        <span class="font-weight-normal">{{ $getDetailInvoice->tenant }}</span>
                    </h6>
                </div>
                <div class="col-md-6">
                    <h6 class="font-weight-bold">No Invoice :
                        <span class="font-weight-normal">{{ $getDetailInvoice->invoice_number }}</span>
                    </h6>
                    <h6 class="font-weight-bold">Tanggal Invoice :
                        <span class="font-weight-normal">{{ $getDetailInvoice->invoice_date }}</span>
                    </h6>
                </div>
                <div class="col-md-6">
                    <h6 class="font-weight-bold">Project :
                        <span class="font-weight-normal">{{ $getDetailInvoice->project }}</span>
                    </h6>
                    <h6 class="font-weight-bold">Reff SPK :
                        <span class="font-weight-normal">{{ $getDetailInvoice->reff_spk }}</span>
                    </h6>
                </div>
            </div>
            <table class="table table-hover table-bordered mt-5">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Unit</th>
                        <th scope="col">Tanggal Sewa</th>
                        <th scope="col">Waktu (Hari)</th>
                        <th scope="col">Harga Satuan</th>
                        <th scope="col">Total (Rp)</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                        $total = 0;
                    @endphp
                    @foreach ($getDetailInvoice->invoiceDetail as $item)
                        @php
                            $total += $item->unit->price_unit * $item->rental_time;
                        @endphp
                        <tr>
                            <th>{{ $no++ }}</th>
                            <td>{{ $item->unit->name_unit }}</td>
                            <td>{{ $item->rental_date }}</td>
                            <td>{{ $item->rental_time }}</td>
                            <td>{{ number_format($item->unit->price_unit) }}</td>
                            <td>{{ number_format($item->unit->price_unit * $item->rental_time) }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="5" class="text-right">Total Invoice </td>
                        <td>{{ number_format($total) }}</td>
                    </tr>
                    <tr>
                        <td colspan="6" class="text-right font-weight-bold">Terbilang: "{{ terbilang($total) }}"</td>
                    </tr>
                </tbody>
            </table>

            <div class="row mt-5">
                <div class="col-md-6">
                    <h6>Pembayaran untuk invoice ini mohon di transfer ke Rekening:</h6>
                    <h6>CV.Antrans Agro Niaga</h6>
                    <h6>No Rekening</h6>
                    <h6>Bank Mandiri</h6>
                </div>
            </div>
            <div class="row mt-5 float-right">
                <div class="col-md-12 text-center">
                    <h6>Hormat Kami</h6>
                    <h6>CV.Antrans Agro Niaga</h6>
                    <div class="my-5"></div>
                    <h6>Anggie Rara Dewi Putri</h6>
                    <hr class="my-0" style="height:2px;border-width:0;color:gray;background-color:gray">
                    <h6>Direktur</h6>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('addon-script')
    <script>
        @php
            function penyebut($nilai)
            {
                $nilai = abs($nilai);
                $huruf = ['', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan', 'Sepuluh', 'Sebelas'];
                $temp = '';
                if ($nilai < 12) {
                    $temp = ' ' . $huruf[$nilai];
                } elseif ($nilai < 20) {
                    $temp = penyebut($nilai - 10) . ' Belas';
                } elseif ($nilai < 100) {
                    $temp = penyebut($nilai / 10) . ' Puluh' . penyebut($nilai % 10);
                } elseif ($nilai < 200) {
                    $temp = ' Seratus' . penyebut($nilai - 100);
                } elseif ($nilai < 1000) {
                    $temp = penyebut($nilai / 100) . ' Ratus' . penyebut($nilai % 100);
                } elseif ($nilai < 2000) {
                    $temp = ' Seribu' . penyebut($nilai - 1000);
                } elseif ($nilai < 1000000) {
                    $temp = penyebut($nilai / 1000) . ' Ribu' . penyebut($nilai % 1000);
                } elseif ($nilai < 1000000000) {
                    $temp = penyebut($nilai / 1000000) . ' Juta' . penyebut($nilai % 1000000);
                } elseif ($nilai < 1000000000000) {
                    $temp = penyebut($nilai / 1000000000) . ' Milyar' . penyebut(fmod($nilai, 1000000000));
                } elseif ($nilai < 1000000000000000) {
                    $temp = penyebut($nilai / 1000000000000) . ' trilyun' . penyebut(fmod($nilai, 1000000000000));
                }
                return $temp;
            }
            
            function terbilang($nilai)
            {
                if ($nilai < 0) {
                    $hasil = 'Minus ' . trim(penyebut($nilai));
                } else {
                    $hasil = trim(penyebut($nilai));
                }
                return $hasil;
            }
        @endphp
    </script>
@endsection
