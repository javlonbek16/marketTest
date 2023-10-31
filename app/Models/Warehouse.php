<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'address_id',
    ];

    public function address()
    {
        return $this->belongsTo(Addresses::class);
    }

    public function shop()
    {
        return $this->hasOne(Shop::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function warehouseWorkers()
    {
        return $this->hasMany(WarehouseWorker::class);
    }
}
