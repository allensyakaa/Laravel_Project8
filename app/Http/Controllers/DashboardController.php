<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function pelanggan(): View
{
    $user = auth()->user();

    return view('dashboard.pelanggan', [
        'products' => Product::orderBy('jenis')->orderBy('name')->get(),
        'pesananAktif' => $user->orders()->with('product')
            ->where('status', '!=', 'sampai_tujuan')->latest()->get(),
        'riwayat' => $user->orders()->with('product')
            ->where('status', 'sampai_tujuan')->latest()->get(),
    ]);
}
    public function kasir(): View
    {
        return view('dashboard.kasir', [
            'products' => Product::latest()->take(10)->get(),
            'productCount' => Product::count(),
        ]);
    }

    public function owner(): View
    {
       $penjualan = fn ($tanggal) => Order::where('status', '!=', 'dalam_pesanan')
        ->whereYear('created_at', $tanggal->year)
        ->whereMonth('created_at', $tanggal->month)
        ->sum('total_harga');

    return view('dashboard.owner', [
        'dalamKota' => Order::where('wilayah', 'dalam_kota')->count(),
        'luarKota' => Order::where('wilayah', 'luar_kota')->count(),
        'pesananBaru' => Order::where('status', 'dalam_pesanan')->count(),
        'penjualanBulanIni' => $penjualan(now()),
        'penjualanBulanLalu' => $penjualan(now()->subMonthNoOverflow()),
        'productCount' => Product::count(),
        'kasirCount' => User::where('role', User::ROLE_KASIR)->count(),
        'pelangganCount' => User::where('role', User::ROLE_PELANGGAN)->count(),
    ]);
    }
}
