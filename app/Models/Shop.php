<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_name',
        'address_id',
        'warehouse_id',
    ];

    public function address()
    {
        return $this->belongsTo(Addresses::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function shopWorkers()
    {
        return $this->hasMany(ShopWorkers::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
