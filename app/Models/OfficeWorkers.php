<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeWorkers extends Model
{
    use HasFactory;

    protected $fillable = [

        'user_id',
        'work_id',
        'address_id',
        'office_id',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function work()
    {
        return $this->belongsTo(Work::class);
    }

    public function office()
    {
        return $this->belongsTo(Office::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }
}
    