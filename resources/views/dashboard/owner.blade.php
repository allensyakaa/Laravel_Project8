@extends('layouts.app')
@section('title', 'Dashboard Owner')
@section('content')
  <h1 class="h2 mb-1">Dashboard Owner</h1>
  <p class="text-secondary mb-6">Ringkasan toko kamu, {{ auth()->user()->name }}.</p>

  <div class="row g-6 mb-6">
    @include('partials.stat-card', ['icon' => 'ti-home', 'label' => 'Pemesanan dalam kota', 'value' => $dalamKota])
    @include('partials.stat-card', ['icon' => 'ti-truck', 'label' => 'Pemesanan luar kota', 'value' => $luarKota])
    @include('partials.stat-card', ['icon' => 'ti-clock', 'label' => 'Pesanan menunggu diterima', 'value' => $pesananBaru])
    @include('partials.stat-card', ['icon' => 'ti-packages', 'label' => 'Total produk', 'value' => $productCount])
  </div>
  <div class="row g-6">
    @include('partials.stat-card', ['icon' => 'ti-chart-bar', 'label' => 'Penjualan bulan ini', 'value' => 'Rp '.number_format($penjualanBulanIni, 0, ',', '.')])
    @include('partials.stat-card', ['icon' => 'ti-chart-line', 'label' => 'Penjualan bulan lalu', 'value' => 'Rp '.number_format($penjualanBulanLalu, 0, ',', '.')])
    @include('partials.stat-card', ['icon' => 'ti-users', 'label' => 'Jumlah kasir', 'value' => $kasirCount])
    @include('partials.stat-card', ['icon' => 'ti-user-circle', 'label' => 'Jumlah pelanggan', 'value' => $pelangganCount])
  </div>
@endsection
