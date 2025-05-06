<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnostics extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'vehicule_id',
        'service_id',
        'date',
        'status',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    protected $with = ['client', 'vehicule', 'service']; 

    public function client()
    {
        return $this->belongsTo(Client::class)->withDefault([
            'name' => 'Client Inconnu',
            'phone' => 'N/A'
        ]);
    }

    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class)->withDefault([
            'marque' => 'Inconnue',
            'model' => 'Inconnu',
            'matricule' => 'N/A'
        ]);
    }
    
    public function service()
    {
        return $this->belongsTo(Service::class)->withDefault([
            'name' => 'Service Inconnu',
            'price' => 0
        ]);
    }
    

    // public function getStatusAttribute($value)
    // {
    //     return str_replace('_', ' ', $value);
    // }

    // public function setStatusAttribute($value)
    // {
    //     $this->attributes['status'] = str_replace(' ', '_', $value);
    // }
}
