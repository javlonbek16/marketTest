<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;

class ClientController extends Controller
{
    public function index()
    {

        // if ($this->canOffice('all_wallet') != 'can')

        // return response()->json(['message' => ['forbidden' => ['Amalyotga huquq yo\'q']]], 403);

        $client = Client::all();

        return ($client);
    }

    public function store(StoreClientRequest $request)
    {

        $client = Client::create($request->validated());

        return ($client);
    }

    public function show(Client $client)
    {
        if (!$client)
            return response()->json(['message' => 'Client not found'], 404);

        return ($client);
    }

    public function update(UpdateClientRequest $request, Client $client)
    {
        // if ($this->canOffice('update_wallet') != 'can')

        //     return response()->json(['message' => ['forbidden' => ['Amalyotga huquq yo\'q']]], 403);

        $client->update($request->validated());

        return ($client);
    }

    public function destroy(Client $client)
    {
        // if ($this->canOffice('delete_wallet') != 'can')

        //     return response()->json(['message' => ['forbidden' => ['Amalyotga huquq yo\'q']]], 403);

        $client->delete();

        return ($client);
    }
}
