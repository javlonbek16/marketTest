<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWalletRequest;
use App\Http\Requests\UpdateWalletRequest;
use App\Models\Wallet;

class WalletController extends Controller
{

    public function index()
    {

        // if ($this->canOffice('all_wallet') != 'can')

        // return response()->json(['message' => ['forbidden' => ['Amalyotga huquq yo\'q']]], 403);

        $wallet = Wallet::all();

        return ($wallet);
    }

    public function store(StoreWalletRequest $request)
    {

        $wallet = Wallet::create($request->validated());

        return ($wallet);
    }

    public function show(Wallet $wallet)
    {
        if (!$wallet)
            return response()->json(['message' => 'Wallet not found'], 404);

        return ($wallet);
    }

    public function update(UpdateWalletRequest $request, Wallet $wallet)
    {
        // if ($this->canOffice('update_wallet') != 'can')

        //     return response()->json(['message' => ['forbidden' => ['Amalyotga huquq yo\'q']]], 403);

        $wallet->update($request->validated());

        return ($wallet);
    }

    public function destroy(Wallet $wallet)
    {
        // if ($this->canOffice('delete_wallet') != 'can')

        //     return response()->json(['message' => ['forbidden' => ['Amalyotga huquq yo\'q']]], 403);

        $wallet->delete();

        return ($wallet);
    }
}
