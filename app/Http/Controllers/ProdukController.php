<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Crypt;
use App\Models\Produk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produk = Produk::OrderBy('nama_produk', 'asc')->get();
        return view('pages.admin.produk.index', compact('produk'));
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
           'nama_produk' => 'required',
           'harga' => 'required',
           'pcs' => 'required',
           //'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
           'foto' => 'required|image|mimes:jpeg,png,jpg,gif'
   ]);
  ([
           'nama_produk.required' => 'Nama Produk harus diisi',
           'harga.required' => 'Harga harus diisi',
           'pcs.required' => 'Banyaknya harus diisi',

       ]);
       $data = [];

       if ($request->file('foto')) {
        $data['foto'] = $request->file('foto')->store('images/produk'); 
    }

$produk = new Produk;
$produk->nama_produk = $request->nama_produk;
$produk->pcs = $request->pcs;
$produk->harga = $request->harga;
//$produk->foto = $data['foto'];
if (array_key_exists('foto', $data)) {
    $produk->foto = $data['foto'];
}
$produk->save();

        return back()->with('success', 'Data produk berhasil dibuat!');
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
        $produk = produk::findOrFail($id);

        return view('pages.admin.produk.profile', compact('produk'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        return view('pages.admin.produk.edit', compact('produk'));
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
           'nama_produk' => 'required|unique:produks,nama_produk,' . $id,
           'harga' => 'required',
          'pcs' => 'required',
           'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
       ]);
        ([
           'nama_produk.unique' => 'Nama Produk sudah ada',
           'harga.required' => 'Harga harus diisi',
           'pcs.required' => 'Banyaknya harus diisi',
           'foto.required' => 'Foto produk harus diunggah',
          'foto.image' => 'File harus berupa gambar',
           'foto.mimes' => 'Format file harus jpeg, png, jpg, atau gif',
           'foto.max' => 'Ukuran file foto maksimum 2MB',
       ]);
       $produk = Produk::find($id);
       $produk->nama_produk = $request->input('nama_produk');
       $produk->pcs = $request->input('pcs');
       $produk->harga = $request->input('harga');
       $produk->foto = $request->input('foto');
       // $produk->update();

        if ($request->file('foto')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $data['foto'] = $request->file('foto')->store('images/produk');
        }
        
        $produk = Produk::find($id)->update($data);
        $filename =date ('Y-m-d').$request->file('foto')->getClientOriginalName();
        $path = '/images/produk'.$filename;
        return redirect()->route('produk.index')->with('success', 'Data produk berhasil diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produk = Produk::find($id);
    
        if ($produk) {
            $foto = $produk->foto;
    
            if ($foto) {
                Storage::delete($foto);
            }
    
            $produk->delete();
    
            // Hapus data user
            if ($user = User::where('id', $produk->user_id)->first()) {
                $user->delete();
            }
    
            return back()->with('success', 'Data produk berhasil dihapus!');
        } else {
            return back()->with('error', 'Data produk tidak ditemukan.');
        }
    }

}

