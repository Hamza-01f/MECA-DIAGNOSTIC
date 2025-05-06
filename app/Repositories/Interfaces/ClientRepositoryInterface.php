<?php

namespace App\Repositories\Interfaces;

use App\Models\Client;

interface ClientRepositoryInterface
{
    public function all($search);
    public function create(array $data);
    public function update(Client $client, array $data);
    public function delete(Client $client);
    public function find($id);
}