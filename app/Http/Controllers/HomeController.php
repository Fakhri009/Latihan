<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kapster;
use App\Models\Laporan;
use App\Models\Customer;
use App\Models\Pelayanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function admin()
    {
        $kapster = Kapster::count();
        $customer = Customer::count();
        $laporan = Laporan::count();
        $pelayanan = Pelayanan::count();
        $kapsterBaru = Kapster::orderByDesc('id')->take(5)->orderBy('id')->first();

        return view('pages.admin.dashboard', compact('kapster', 'customer', 'laporan', 'pelayanan', 'kapsterBaru'));
    }

    public function customer()
    {
        $customer = Customer::where('user_id', Auth::user()->id)->first();
        $jadwal = Barang::where('pelayanan_id', $customer->pelayanan_id)->get();
        return view('pages.customer.dashboard', compact('customer', 'barang'));
    }

    public function kapster()
    {
        $kapster = Kapster::where('nik', Auth::user()->nis)->first();
        $laporan = Laporan::findOrFail($kapster->laporan_id);
        $jadwal = Barang::where('laporan_id', $laporan->id)->get();
        return view('pages.kapster.dashboard', compact('kapster', 'laporan', 'barang'));
    }
}
