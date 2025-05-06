<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Vehicule extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'matricule',
        'model',
        'marque',
        'kilometrage',
        'last_visit',
        'service_id',
        'service_period',
        'days_until_service',
        'status'
    ];

    protected $casts = [
        'last_visit' => 'datetime'
    ];


    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

  
    public function calculateDaysUntilService()
    {
        if ($this->last_visit && $this->service_period) {
            $nextServiceDate = $this->last_visit->addDays($this->service_period);
            $this->days_until_service = (int) now()->diffInDays($nextServiceDate, false);
            
            if ($this->days_until_service <= 0) {
                $this->status = 'Maintenance requise';
            } else {
                $this->status = 'À jour';
            }
            
            $this->save();
        }
    }

    
    //static special eloquent method
    //allowing to run code authonatically 
    protected static function boot()
    {
        parent::boot();

        static::retrieved(function ($vehicule) {
            $vehicule->calculateDaysUntilService();
        });
    }
}