<?php


namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Requests\ClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Repositories\Interfaces\ClientRepositoryInterface;

class ClientController extends Controller
{
    protected $clientRepository;

    public function __construct(ClientRepositoryInterface $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    public function index(Request $request) 
    {
        $search = $request->input('search');
        $clients = $this->clientRepository->all($search);
        return view('BackOffice.Clients.display', compact('clients'));
    }

    public function create()
    {
        return view('BackOffice.Clients.create');
    }

    public function store(ClientRequest $request)
    {
        $this->clientRepository->create($request->validated());
        return redirect()->route('clients.index')->with('success', 'Client created successfully.');
    }

    public function edit(Client $client)
    {
        return view('BackOffice.Clients.edit', compact('client'));
    }

    public function update(UpdateClientRequest $request, Client $client)
    {
        $this->clientRepository->update($client, $request->validated());
        return redirect()->route('clients.index')->with('success', 'Client updated successfully.');
    }

    public function destroy(Client $client)
    {
        $this->clientRepository->delete($client);
        return redirect()->route('clients.index')->with('success', 'Client deleted successfully.');
    }
}