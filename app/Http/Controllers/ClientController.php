<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ClientRepository;
use App\Http\Requests\ClientRequest;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $clientRepository = new ClientRepository(new Client());

        if($request->has('filter')) {
            $clientRepository->filter($request->filter);          
        }

        if($request->has('attributes')) {
            $attributes = explode(',', $request->get('attributes'));
            $clientRepository->selectAttributes($attributes);
        }

        return response()->json($clientRepository->getResult(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClientRequest $request)
    {
        $client = Client::create([
            'name' => $request->name
        ]);

        return response()->json($client, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $client = Client::find($id);

        if($client === null) {
            return response()->json([
                'message' => 'The requested resource does not exist.'
            ], 404);
        }

        return response()->json($client, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClientRequest $request, $id)
    {
        $client = Client::find($id);

        if($client === null) {
            return response()->json([
                'message' => 'Unable to update. The requested resource does not exist.'
            ], 404);
        }

        if($request->has('name')) {
            $client->name = $request->name;
        }

        $client->save();

        return response()->json($client, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $client = Client::find($id);

        if($client === null) {
            return response()->json([
                'message' => 'Unable to delete. The requested resource does not exist.'
            ], 404);
        }

        $client->delete();

        return response()->json([
            'message' => 'Client deleted.'
        ], 200);
    }
}
