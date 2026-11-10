@extends('layouts.app')
@section('title', 'Dashboard Kasir')
@section('content')
  <div class="mb-6">
    <h1 class="h2 mb-1">Dashboard Kasir</h1>
    <p class="text-secondary mb-0">Halo {{ auth()->user()->name }}, siap melayani transaksi hari ini.</p>
  </div>
  <div class="row g-6 mb-6">
    @include('partials.stat-card', ['icon' => 'ti-packages', 'label' => 'Total produk', 'value' => $productCount])
    @include('partials.stat-card', ['icon' => 'ti-cash-register', 'label' => 'Transaksi hari ini', 'value' => 0])
  </div>
  @include('partials.product-table', ['title' => 'Daftar Produk', 'products' => $products])
@endsection
