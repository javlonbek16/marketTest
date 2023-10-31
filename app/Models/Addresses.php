<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addresses extends Model
{
    use HasFactory;

    protected $fillable = [

        'country',
        'province',
        'phone',
        'city_or_region',
        'street',
        'email'

    ];

    public function shops()
    {
        return $this->hasMany(Shop::class);
    }
    
    public function offices()
    {
        return $this->hasMany(Office::class);
    }

    public function warehouses()
    {
        return $this->hasMany(Warehouse::class);
    }

    public function shopworkers()
    {
        return $this->hasMany(ShopWorkers::class);
    }

    public function officeworkers()
    {
        return $this->hasMany(OfficeWorkers::class);
    }

    public function warehouseworkers()
    {
        return $this->hasMany(WarehouseWorkers::class);
    }
    
}
