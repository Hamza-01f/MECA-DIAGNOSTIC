<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
        'city',
        'role'
    ];

    public function vehicules()
    {
        return $this->hasMany(Vehicule::class);
    }

}
