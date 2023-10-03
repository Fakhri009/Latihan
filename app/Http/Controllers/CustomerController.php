<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use App\Models\Pelayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Testing\exists;
class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pelayanan = Pelayanan::orderBy('nama_pelayanan', 'asc')->get();
        $customer = Customer::orderBy('nama_customer', 'asc')->get();
        return view('pages.admin.customer.index', compact('customer', 'pelayanan'));
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
        //$data = $request->all();
       $this->validate($request, [
            'nama_customer' => 'required',
            'nic' => 'required|unique:customers',
            'pelayanan_id' => 'required',
            'telp' => 'required',
            'alamat' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
         ([
            'nic.unique' => 'NIC sudah terdaftar',
            'pelayanan_id.required' => 'pelayanan wajib diisi',
        ]);
        if ($request->file('foto')) {
            $data['foto'] = $request->file('foto')->store('images/customer'); 
        }
        
      
        $customer = new Customer;
        $customer->nama_customer = $request->nama_customer;
        $customer->nic = $request->nic;
        $customer->telp = $request->telp;
        $customer->alamat = $request->alamat;
        $customer->pelayanan_id = $request->pelayanan_id;
        $customer->foto = $data['foto'];
        $customer->save();

        return back()->with('success', 'Data customer berhasil dibuat!');
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
        $pelayanan = Pelayanan::all();
        $customer = Customer::findOrFail($id);

        return view('pages.admin.customer.edit', compact('customer', 'pelayanan'));
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
       // $this->validate($request, [
        //    'nic' => 'required|unique:customers'
       // ], [
       //     'nic.unique' => 'NIC sudah terdaftar',
       // ]);

        $customer = Customer::find($id);
        $customer->nama_customer = $request->input('nama_customer');
        $customer->nic = $request->input('nic');
        $customer->telp = $request->input('telp');
        $customer->alamat = $request->input('alamat');
        $customer->pelayanan_id = $request->input('pelayanan_id');
        $customer->foto = $request->input('foto');
        $customer->update();

        if ($request->file('foto')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $data['foto'] = $request->file('foto')->store('images/customer');
        }
        $customer = Customer::find($id)->update($data);
        $filename =date ('Y-m-d').$request->file('foto')->getClientOriginalName();
        $path = '/images/customer'.$filename;
        return redirect()->route('customer.index')->with('success', 'Data customer berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $foto = Customer::find($id)->foto;
        if ($foto) {
            Storage::delete($foto);
        }

        $customer = Customer::find($id);
        $customer->delete();

        // Hapus data user
        if($user = User::where('id', $customer->user_id)->first()){
            $user->delete();
        }


        return back()->with('success', 'Data pelayanan berhasil dihapus!');
    }
}

