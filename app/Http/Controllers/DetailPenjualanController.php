<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Penjualan;
use App\Models\DetailPenjualan;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;

class DetailPenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $barcode = $request->input('id_produk');
        $scan = Produk::where('barcode', $barcode)->first();

        if($scan) {

            $qty = $request->input('qty');

            for ($i = 0; $i < $qty; $i++) {

                DetailPenjualan::create([
                    'nobon' => $request->nobon,
                    'id_produk' => $scan->id,
                    'harga' => $scan->harga,
                    'subtotal' => $qty,
                    'jumlah' => 0,                    
                ]);
            }
            return redirect()->back();
        } else {
            return redirect()->back()->with('error', 'Produk Tidak Ditemukan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $penjualan = Penjualan::find($id);
        return view('update', compact('penjualan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $detail = DetailPenjualan::where('nobon', $nobon)
        ->where('id_produk',$id_produk);

        if ($detail) {
        $detail->delete();
        return redirect()->back()->with('success', 'Produk Berhasil Dihapus');
        } else {
        return redirect('/');
        }
    }
}
