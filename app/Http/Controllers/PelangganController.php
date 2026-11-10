<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;

class PelangganController extends Controller
{
    public function index()
    {
        return view('owner.pelanggan.index', [
            'pelanggan' => User::where('role', User::ROLE_PELANGGAN)->withCount('orders')->latest()->get(),
        ]);
    }

    public function show(User $user)
    {
        abort_unless($user->role === User::ROLE_PELANGGAN, 404);

        return view('owner.pelanggan.show', [
            'pelanggan' => $user,
            'orders' => $user->orders()->with('product')->latest()->get(),
        ]);
    }

    public function toggleLangganan(User $user)
    {
        abort_unless($user->role === User::ROLE_PELANGGAN, 404);

        $user->is_langganan = ! $user->is_langganan;
        $user->save();

        return back()->with('success', $user->is_langganan ? 'Pelanggan dijadikan langganan.' : 'Status langganan dicabut.');
    }

    // Owner menerima pesanan -> status di sisi pelanggan jadi "Sudah Dikemas"
    public function terimaPesanan(Order $order)
    {
        if ($order->status === 'dalam_pesanan') {
            $order->update(['status' => 'sudah_dikemas']);
        }

        return back()->with('success', 'Pesanan diterima dan ditandai sudah dikemas.');
    }
}
