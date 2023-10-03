<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Crypt;
use App\Models\Barang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang = Barang::OrderBy('nama_barang', 'asc')->get();
        return view('pages.admin.barang.index', compact('barang'));
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
           'nama_barang' => 'required',
           'harga' => 'required',
           'pcs' => 'required',
           //'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
           'foto' => 'required|image|mimes:jpeg,png,jpg,gif'
   ]);
  ([
           'nama_barang.required' => 'Nama Barang harus diisi',
           'harga.required' => 'Harga harus diisi',
           'pcs.required' => 'Banyaknya harus diisi',

       ]);
       $data = [];

       if ($request->file('foto')) {
        $data['foto'] = $request->file('foto')->store('images/barang'); 
    }

$barang = new Barang;
$barang->nama_barang = $request->nama_barang;
$barang->pcs = $request->pcs;
$barang->harga = $request->harga;
//$barang->foto = $data['foto'];
if (array_key_exists('foto', $data)) {
    $barang->foto = $data['foto'];
}
$barang->save();

        return back()->with('success', 'Data barang berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = Crypt::decrypt($id);
        $barang = barang::findOrFail($id);

        return view('pages.admin.barang.profile', compact('barang'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        return view('pages.admin.barang.edit', compact('barang'));
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
           'nama_barang' => 'required|unique:barangs,nama_barang,' . $id,
           'harga' => 'required',
          'pcs' => 'required',
           'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
       ]);
        ([
           'nama_barang.unique' => 'Nama Barang sudah ada',
           'harga.required' => 'Harga harus diisi',
           'pcs.required' => 'Banyaknya harus diisi',
           'foto.required' => 'Foto barang harus diunggah',
          'foto.image' => 'File harus berupa gambar',
           'foto.mimes' => 'Format file harus jpeg, png, jpg, atau gif',
           'foto.max' => 'Ukuran file foto maksimum 2MB',
       ]);
       $barang = Barang::find($id);
       $barang->nama_barang = $request->input('nama_barang');
       $barang->pcs = $request->input('pcs');
       $barang->harga = $request->input('harga');
       $barang->foto = $request->input('foto');
       // $barang->update();

        if ($request->file('foto')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $data['foto'] = $request->file('foto')->store('images/barang');
        }
        
        $barang = Barang::find($id)->update($data);
        $filename =date ('Y-m-d').$request->file('foto')->getClientOriginalName();
        $path = '/images/barang'.$filename;
        return redirect()->route('barang.index')->with('success', 'Data barang berhasil diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang = Barang::find($id);
    
        if ($barang) {
            $foto = $barang->foto;
    
            if ($foto) {
                Storage::delete($foto);
            }
    
            $barang->delete();
    
            // Hapus data user
            if ($user = User::where('id', $barang->user_id)->first()) {
                $user->delete();
            }
    
            return back()->with('success', 'Data barang berhasil dihapus!');
        } else {
            return back()->with('error', 'Data barang tidak ditemukan.');
        }
    }

}

