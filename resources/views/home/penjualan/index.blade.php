@extends('layouts.master')
@section('tittle','penjualan')
@section('content')

<div class="content-wrapper">
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Halaman Data Penjualan</h3>
                        <a class="btn btn-primary" href="/penjualan/tambah">Tambah</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Kasir</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Status</th>
                                        <!-- <th scope="col">Action</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($penjualan as $penjualan)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $penjualan->user->name }}</td>
                                        <td>Rp. {{ number_format($penjualan->total) }}</td>
                                        <td>{{ $penjualan->created_at }}</td>
                                        <td>{{ $penjualan->status }}</td>
                                        <td>
                                            @if ($penjualan->status == "Belum Selesai")
                                            <a class="btn btn-primary"href="/penjualan/transaksi/{{ $penjualan->id }}">Lengkapi Transaksi</a>
                                            @else ($penjualan->status == "Selesai")
                                            <a class="btn btn-primary"href="/penjualan/struk/{{ $penjualan->id }}">Cetak Struk</a>\
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</div>

@endsection
