<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kapster;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdatePasswordRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::OrderBy('roles', 'asc')->get();
        return view('pages.admin.user.index', compact('user'));
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
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'roles' => 'required'
        ], [
            'email.unique' => 'Email sudah terdaftar',
        ]);

        if ($request->roles == 'customer') {
            $countCostumer = Customer::where('nic', $request->nic)->count();
            $customer_id = Customer::where('nic', $request->nic)->get();
            foreach ($customer_id as $val) {
                $customer = Customer::findOrFail($val->id);
            }

            if ($countCostumer >= 1) {
                User::create([
                    'name' => $customer->nama,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'roles' => $request->roles,
                    'nic' => $request->nic
                ]);

                // Add user id to customer table
                $customer->user_id = User::where('email', $request->email)->first()->id;
                $customer->save();


                return redirect()->route('user.index')->with('success', 'Data user berhasil ditambahkan');
            } else {
                return redirect()->route('user.index')->with('error', 'NIP tidak terdaftar sebagai customer');
            }
        } elseif ($request->roles == "kapster") {
            $countKapster = Kapster::where('nik', $request->nik)->count();
            $kapsterId = Kapster::where('nik', $request->nik)->get();
            foreach ($kapsterId as $val) {
                $kapster = Kapster::findOrFail($val->id);
            }

            if ($countKapster >= 1) {
                User::create([
                    'name' => $kapster->nama,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'roles' => $request->roles,
                    'nik' => $request->nik
                ]);

                // Add user id to kapster table
                $kapster->user_id = User::where('email', $request->email)->first()->id;
                $kapster->save();

                return redirect()->route('user.index')->with('success', 'Data user berhasil ditambahkan');
            } else {
                return redirect()->route('user.index')->with('error', 'NIK tidak terdaftar sebagai kapster');
            }
        } else {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'roles' => $request->roles
            ]);
            return redirect()->route('user.index')->with('success', 'Data user berhasil ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $customer = Customer::where('user_id', Auth::user()->id)->first();
        $kapster = Kapster::where('user_id', Auth::user()->id)->first();
        $customer = User::findOrFail(Auth::user()->id);

        return view('pages.profile', compact('customer', 'kapster', 'customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (Auth::user()->roles == 'customer') {

            $data = $request->all();

            // Save to customer table
            $customer = Customer::where('user_id', Auth::user()->id)->first();
            $customer->nama = $data['nama'];
            $customer->nic = $data['nic'];
            $customer->alamat = $data['alamat'];
            $customer->no_telp = $data['no_telp'];
            $customer->update($data);

            // Save to user table
            $user = Auth::user();
            $user->name = $data['nama'];
            $user->email = $data['email'];
            $user->update($data);
        } else if (Auth::user()->roles == 'kapster') {

            $data = $request->all();

            // Save to kapster table
            $kapster = Kapster::where('user_id', Auth::user()->id)->first();
            $kapster->nama = $data['nama'];
            $kapster->nik = $data['nik'];
            $kapster->alamat = $data['alamat'];
            $kapster->telp = $data['telp'];
            $kapster->update($data);

            // Save to user table
            $user = Auth::user();
            $user->name = $data['nama'];
            $user->email = $data['email'];
            $user->update($data);
        } else {
            $data = $request->all();

            // Save to user table
            $user = Auth::user();
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->update($data);
        }

        return redirect()->route('profile')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('user.index')->with('success', 'Data user berhasil dihapus');
    }

    public function editPassword()
    {
        $customer = Customer::where('user_id', Auth::user()->id)->first();
        $kapster = Kapster::where('user_id', Auth::user()->id)->first();
        $customer = User::findOrFail(Auth::user()->id);

        return view('pages.ubah-password', compact('customer', 'kapster', 'customer'));
    }

    public function updatePassword(Request $request)
    {

        // dd($request->all());

        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            return redirect()->back()->with("error", "Password lama tidak sesuai");
        }

        if (strcmp($request->get('current-password'), $request->get('new-password')) == 0) {
            return redirect()->back()->with("error", "Password baru tidak boleh sama dengan password lama");
        }

        $this->validate($request, [
            'current-password' => 'required',
            'new-password' => 'required|string|min:6',
        ], [
            'new-password.min' => 'Password baru minimal 6 karakter',
        ]);

        // Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();


        return redirect()->route('profile')->with('success', 'Password berhasil diubah');
    }
}
