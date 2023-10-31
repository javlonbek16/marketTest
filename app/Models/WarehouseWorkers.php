<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseWorkers extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'work_id',
        'address_id',
        'warehouse_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function work()
    {
        return $this->belongsTo(Work::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

}
