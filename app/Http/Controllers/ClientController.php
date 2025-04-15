<?php


namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    
    public function index(Request $request) 
    {
        // $clients = Client::all();
        $search = $request->input('search');

        $clients = Client::when($search, function($query,$search){
              return $query->where('name','like',"%{$search}%")
                           ->orWhere('email','like',"%{$search}%")
                           ->orWhere('phone','like',"%{$search}%")
                           ->orWhere('address','like',"%{$search}%")
                           ->orWhere('city','like',"%{$search}%");
        })->get();

        return view('BackOffice.Clients.display', compact('clients'));
    }


    public function create()
    {
        return view('BackOffice.Clients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            // 'name' => 'required|string|max:255',
            // 'phone' => 'required|string|unique:clients,phone',
            // 'email' => 'required|email|unique',
            // 'address' => 'nullable|string',
            // 'city' => 'nullable|string',
        ]);

        Client::create($request->all());

        return redirect()->route('clients.index')->with('success', 'Client updated successfully.');
    }

  
    public function edit(Client $client)
    {
        return view('BackOffice.Clients.edit', compact('client'));
    }


    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|unique:clients,phone,' . $client->id,
            'email' => 'nullable|email',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
        ]);

        $client->update($request->all());

        return redirect()->route('clients.index')->with('success', 'Client updated successfully.');
    }


    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Client deleted successfully.');
    }
}
