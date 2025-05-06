<?php

namespace App\Repositories;

use App\Models\Client;
use App\Repositories\Interfaces\ClientRepositoryInterface;

class ClientRepository implements ClientRepositoryInterface
{
    public function all($search)
    {
        return Client::when($search, function($query, $search) {
            return $query->where('name','like',"%{$search}%")
                       ->orWhere('email','like',"%{$search}%")
                       ->orWhere('phone','like',"%{$search}%")
                       ->orWhere('address','like',"%{$search}%")
                       ->orWhere('city','like',"%{$search}%");
        })->paginate(12);
    }

    public function create(array $data)
    {
        return Client::create($data);
    }

    public function update(Client $client, array $data)
    {
        return $client->update($data);
    }

    public function delete(Client $client)
    {
        return $client->delete();
    }

    public function find($id)
    {
        return Client::findOrFail($id);
    }
}