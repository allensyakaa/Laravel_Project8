<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public const STATUS = [
        'dalam_pesanan' => ['Dalam Pesanan', 'bg-warning'],
        'sudah_dikemas' => ['Sudah Dikemas', 'bg-info'],
        'diperjalanan'  => ['Diperjalanan', 'bg-primary'],
        'sampai_tujuan' => ['Sampai Tujuan', 'bg-success'],
    ];

    protected $fillable = [
        'product_id', 'jumlah', 'total_harga', 'alamat',
        'metode_pembayaran', 'bukti_pembayaran', 'status','wilayah' ,
    ];

    public function product() { return $this->belongsTo(Product::class); }
    public function user()    { return $this->belongsTo(User::class); }
}
