<?php


namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Requests\ClientRequest;
use App\Http\Requests\UpdateClientRequest;

class ClientController extends Controller
{
    
    public function index(Request $request) 
    {
        $search = $request->input('search');
    
        $clients = Client::when($search, function($query,$search){
              return $query->where('name','like',"%{$search}%")
                           ->orWhere('email','like',"%{$search}%")
                           ->orWhere('phone','like',"%{$search}%")
                           ->orWhere('address','like',"%{$search}%")
                           ->orWhere('city','like',"%{$search}%");
        })->paginate(12); 
    
        return view('BackOffice.Clients.display', compact('clients'));
    }

    public function create()
    {
        return view('BackOffice.Clients.create');
    }

    public function store(ClientRequest $request)
    {
       

        Client::create( $request->validated());

        return redirect()->route('clients.index')->with('success', 'Client created successfully.');
    }

  
    public function edit(Client $client)
    {
        return view('BackOffice.Clients.edit', compact('client'));
    }


    public function update(UpdateClientRequest $request, Client $client)
    {

        $client->update($request->validated());

        return redirect()->route('clients.index')->with('success', 'Client updated successfully.');
    }


    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Client deleted successfully.');
    }
}
