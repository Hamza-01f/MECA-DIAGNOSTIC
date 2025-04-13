<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'matricule',
        'model',
        'kilometrage',
        'last_visit',
        'service_id',
        'service_period',
        'days_until_service',
        'status',
    ];

    protected $dates = ['last_visit'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function updateServiceStatus()
    {
        $this->days_until_service = $this->service_period - (now()->diffInDays($this->last_visit));
        $this->status = $this->days_until_service > 0 ? 'À jour' : 'Maintenance requise';
        $this->save();
    }
}
