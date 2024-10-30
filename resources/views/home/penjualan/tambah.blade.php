@extends('layouts.master')
@section('title','penjualan')
@section('content')

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="caed">
                        <div class="card-header">
                            <h3>Halaman Tambah Data Penjualan</h3>
                        </div>
                        <hr>
                        <div class="card-body">
                            <form action="/penjualan/scan" method="post">
                            @csrf
                                <!--  -->
                                <div class="mb-3">
                                    <input 
                                    type="hidden"
                                    name="id_produk"
                                    value="{{ $penjualan->id }}"
                                    />
                                    @if (session("error"))
                                        <p style="color : red"><i>Produk Tidak Ditemukan</i></p>
                                        @endif
                                <div class="col-1">
                                    <div class="mb-3">
                                    <input 
                                    type="text"
                                    onblur="this.focus()"
                                    class="form-control"
                                    name="id_produk"
                                    placeholder="Barcode"
                                    autofocus
                                    id="id_produk"
                                    />
                                    @if (session("error"))
                                        <p style="color :red">Produk Tidak Ditemukan</p>
                                        @endif
                                    
                                    <div class="col-1">
                                        <div class="mb-3">
                                        <input 
                                        type="number"
                                        class="form-control"
                                        name="qty"
                                        min="1"
                                        placeholder=""
                                        autofocus
                                        id=qty
                                        value="1"
                                        required
                                        />
                                        </div>
                                        <div class="col-md-1">
                                            <button type="submit" class="btn btn-primary">Check</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No Bon</th>
                            <th scope="col">Id Produk</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Sub Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $total = 0;
                        @endphp
                        @foreach ($detailpenjualan as $detailpenjualan)
                        @php
                        $subtotal =
                        $detailpenjualan->harga *
                        ($produkCounts[$detailpenjualan->barcode] ?? 0);

                        $total += $subtotal

                        @endphp

                        <tr class="">
                            <td>{{ $detailpenjualan->nobon }}</td>
                            <td>{{ $detailpenjualan->produk->id_produk }}</td>
                            <td>{{ $detailpenjualan->produk->harga }}</td>
                            <td>{{ $produkCounts[$detailpenjualan->id_produk] ?? 0 }}</td>
                            <td>{{ $detailpenjualan->produk->harga * ($produkCounts[$detailpenjualan->id_produk] ?? 0)}}</td>
                            <td>
                                <a href="/detailpenjualan/delete/{{ $detailpenjualan->id_produk }}/{{ $detailpenjualan->nobon }}"
                                class="btn btn-danger"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
<footer class="main-footer">
    <form action="/penjualan/update/{{ $penjualan->id }}" method="post">
        <input type="hidden" value="{{$total}}" name="ttl">
        @csrf
        Total 
        <h1 style="color : black">
            Rp. {{ number_format($total) }}
            <button type="submit" class="btn btn-primary">Check Out</button>
        </h1>
    </form>
</footer>

@endsection