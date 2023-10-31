<?php

namespace App\Http\Controllers;

use App\Models\OfficeWorkers;
use App\Models\ShopWorkers;
use App\Models\WarehouseWorkers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function canWarehouse(string $key)
    {
        $checked = WarehouseWorkers::select('warehouse_workers.id')
            ->join('works as w', 'w.id', '=', 'warehouse_workers.work_id')
            ->where('w.work_name', $key)
            ->where('warehouse_workers.user_id', auth()->id())
            ->count();
        if ($checked > 0)
            return 'can';
        return 'denied';
    }


    public function canShop(string $key)
    {
        $checked = ShopWorkers::select('shop_workers.id')
            ->join('works as w', 'w.id', '=', 'shop_workers.work_id')
            ->where('w.work_name', $key)
            ->where('shop_workers.user_id', auth()->id())
            ->count();
        if ($checked > 0)
            return 'can';
        return 'denied';
    }
    public function canOffice(string $key)
    {
        $checked = OfficeWorkers::select('office_workers.id')
            ->join('works as w', 'w.id', '=', 'office_workers.work_id')
            ->where('w.work_name', $key)
            ->where('office_workers.user_id', auth()->id())
            ->count();
        if ($checked > 0)
            return 'can';
        return 'denied';
    }
}
