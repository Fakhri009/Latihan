<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Pelayanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class PelayananController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $produk = Produk::OrderBy('nama_produk', 'asc')->get();
        //dd($produk);
        $pelayanan = Pelayanan::OrderBy('nama_pelayanan',  'asc')->get();
        return view('pages.admin.pelayanan.index', compact('pelayanan', 'produk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_pelayanan' => 'required',
            
        ], [
            'nama_pelayanan.required' => 'Nama pelayanan wajib diisi',
        ]);

        Pelayanan::Create(
            [
                'id' => $request->pelayanan_id,
                'nama_pelayanan' => $request->nama_pelayanan,
                'nama_model' => $request->nama_model,
                'produk_id' => $request->produk_id,
                'harga' => $request->harga,
            ]);
        
   
        return back()->with('success', 'Data pelayanan berhasil diperbarui!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $pelayanan = Pelayanan::findOrFail($id);
        $produk = Produk::all();

        return view('pages.admin.pelayanan.edit', compact('pelayanan','produk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $pelayanan = Pelayanan::findOrFail($id);
        $pelayanan->update($data);

        return redirect()->route('pelayanan.index')->with('success', 'Data pelayanan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pelayanan::find($id)->delete();
        return back()->with('success', 'Data pelayanan berhasil dihapus!');
    }
}
