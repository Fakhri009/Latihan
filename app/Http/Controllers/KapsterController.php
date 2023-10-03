<?php

namespace App\Http\Controllers;
use App\Models\Kapster;
use App\Models\Laporan;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Testing\File;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
class KapsterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kapster = Kapster::OrderBy('nama_kapster', 'asc')->get();
        $laporan = Laporan::all();
        return view('pages.admin.kapster.index', compact('kapster', 'laporan'));
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
            'nama_kapster' => 'required',
            'nik' => 'required|unique:kapsters',
            'telp' => 'required',
            'alamat' => 'required',
            'laporan_id' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ], [
            'nik.unique' => 'NIK sudah terdaftar',
          
        ]);
       // dd($request);
       if ($request->hasFile('foto')) {
        $data['foto'] = $request->file('foto')->store('images/produk');
    }

        $kapster = new Kapster;
        $kapster->nama_kapster = $request->nama_kapster;
        $kapster->nik = $request->nik;
        $kapster->telp = $request->telp;
        $kapster->alamat = $request->alamat;
        $kapster->laporan_id = $request->laporan_id;
        $kapster->foto = $data['foto'];
        $kapster->save();
//dd($request);

        return redirect()->route('kapster.index')->with('success', 'Data kapster berhasil ditambahkan');
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
      $kapster = Kapster::findOrFail($id);

     return view('pages.admin.kapster.profile', compact('kapster'));
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
        $laporan = Laporan::all();
        $kapster = Kapster::findOrFail($id);

        return view('pages.admin.kapster.edit', compact('kapster', 'laporan'));
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
        //if ($request->nik != $kapster->nik) {
         //   $this->validate($request, [
         //       'nik' => 'unique:kapsters'
         //   ], [
         //       'nik.unique' => 'NIK sudah terdaftar',
        //    ]);
       // }
        $kapster = Kapster::find($id);
        $kapster->nama_kapster = $request->input('nama_kapster');
        $kapster->nik = $request->input('nik');
        $kapster->telp = $request->input('telp');
        $kapster->alamat = $request->input('alamat');
        $kapster->laporan_id = $request->input('laporan_id');
        $kapster->update();


        if ($request->file('foto')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $data['foto'] = $request->file('foto')->store('images/kapster');
        }
        $kapster = Kapster::find($id)->update($data);
        $filename =date ('Y-m-d').$request->file('foto')->getClientOriginalName();
        $path = '/images/kapster'.$filename;
        return redirect()->route('kapster.index')->with('success', 'Data kapster berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $foto = Kapster::find($id)->foto;
        if ($foto) {
            Storage::delete($foto);
        }

        $customer = Kapster::find($id);
        $customer->delete();

        // Hapus data user
        if($user = User::where('id', $customer->user_id)->first()){
            $user->delete();
        }


        return back()->with('success', 'Data pelayanan berhasil dihapus!');
    }
}

