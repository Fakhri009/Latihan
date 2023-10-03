<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Laporan;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kapster;
use App\Models\Pelayanan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $laporan = DB::table('laporans')
    ->leftJoin('customers', 'customers.id', '=', 'laporans.customer_id')
    ->leftJoin('produks', 'produks.id', '=', 'laporans.produk_id')
    ->leftJoin('kapsters', 'kapsters.id', '=', 'laporans.kapster_id')
    ->leftJoin('pelayanans', 'pelayanans.id', '=', 'laporans.pelayanan_id')
    ->select('laporans.*', 'customers.nama_customer', 'produks.nama_produk', 'pelayanans.nama_pelayanan', 'pelayanans.harga')
    ->get();
        //$laporan = Laporan::orderBy('jumlah_potong', 'asc')->get();
        //$customer = Customer::orderBy('nama_customer', 'asc')->get();
        //$produk = Produk::orderBy('nama_produk', 'asc')->get();
        //$laporan = Laporan::with(['customer', 'produk'])->orderBy('jumlah_potong', 'asc')->get();
        // return view('pages.admin.laporan.index', compact('laporan'));
        $laporan = Laporan::with(['customer', 'produk', 'kapster', 'pelayanan'])->orderBy('jumlah_potong', 'asc')->get();
        $customer = Customer::orderBy('nama_customer', 'asc')->get();
        $produk = Produk::orderBy('nama_produk', 'asc')->get();
        $kapster = Kapster::orderBy('nama_kapster', 'asc')->get();
        $pelayanan = Pelayanan::orderBy('nama_pelayanan', 'asc')->get();
        $pelayanan = Pelayanan::orderBy('harga', 'asc')->get();
    
        return view('pages.admin.laporan.index', compact('laporan', 'customer', 'produk', 'kapster', 'pelayanan'));
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

        //$this->validate($request, [
       //     'jumlah_potong' => 'required|unique:laporan',
       //     'customer_id' => 'required|unique:laporan'
      //  ], [
       //     'jumlah_potong.unique' => 'Laporan sudah ada',
       //     'customer_id.unique' => 'Customer sudah melakukan laporan'
       // ]);

        Laporan::create($request->all());

        return redirect()->route('laporan.index')->with('success', 'Data berhasil disimpan');
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
        // $id = Crypt::decrypt($id);
        $laporan = Laporan::findOrFail($id);
        $produk = Produk::all();
        $customer = Customer::all();
        $kapster = Kapster::all();
        return view('pages.admin.laporan.edit', compact('laporan', 'produk', 'customer', 'kapster'));
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
        $this->validate($request, [
            'customer_id' => 'required'
        ], [
            'customer_id.required' => 'Nama Customer wajib di isi'
        ]);

        $data = $request->all();
        $laporan = Laporan::findOrFail($id);
        $laporan->update($data);

        return redirect()->route('laporan.index')->with('success', 'Data laporan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Laporan::find($id)->delete();
        return back()->with('success', 'Data laporan berhasil dihapus!');
    }
}
