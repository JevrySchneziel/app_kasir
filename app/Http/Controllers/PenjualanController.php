<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Barang;
use App\Models\DetailPenjualan;
use App\Models\Penjualan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penjualan = Penjualan::orderBy('id', 'desc')->get();
        return view('home.penjualan.index', compact('penjualan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Penjualan::create([
            'id_user' => Auth::user()->id,
            'id_pelanggan' => 1,
            'tanggal' => now(),
            'status' => 'Belum Selesai',
            'total' => 0,
        ]);
        return redirect()->back();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Penjualan::create([
            'id_user' => Auth::user()->id,
            'id_pelanggan' => 1,
            'tanggal' => now(),
            'status' => 'Belum Selesai',
            'total' => 0,
        ]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function transaksi(string $id)
    {
        $penjualan = Penjualan::find($id);
        $detailpenjualan = DetailPenjualan::where('nobon', $id)
        ->select('id_produk', 'nobon', 'harga', Db::raw('count(*) as total'))
        ->groupBy('id_produk','nobon','harga')
        ->get();

        $produkCounts = $detailpenjualan->pluck('total','id_produk');

        return view('home.penjualan.tambah', compact('detailpenjualan','produkCounts','penjualan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $penjualan = Penjualan::find($id);



            $penjualan->update([
                'total' => $date->ttl(),
                'status' =>'selesai',
            ]);


        return redirect('/penjualan')->with(['success' => 'Berhasil']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function cetak($id)
    {
        $penjualan = Penjualan::with(['produk'])
        ->where($id);
        $produk = Produk::all();
        $penjualan = Penjualan::find($id);
            return view('home.penjualan.struk', compact('penjualan'));
    }
}

