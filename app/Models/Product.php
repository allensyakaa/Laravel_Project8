<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'jenis', 'price', 'price_langganan', 'satuan'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // Harga yang berlaku untuk user tertentu
    public function priceFor(User $user): int
    {
        return $user->is_langganan ? $this->price_langganan : $this->price;
    }
}
