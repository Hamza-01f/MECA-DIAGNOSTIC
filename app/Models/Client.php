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

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
    
    
    public function services()
    {
        return $this->hasManyThrough(Service::class, Vehicule::class);
    
    }
    public function vehicules()
    {
        return $this->hasMany(Vehicule::class);
    }

}
