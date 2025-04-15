<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Diagnostics;
use App\Models\Service;
use App\Models\Vehicule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Get search parameters
        $search = $request->input('search');
        $month = $request->input('month', now()->format('F Y'));
        
        
        $selectedDate = Carbon::createFromFormat('F Y', $month);
        $startDate = $selectedDate->copy()->startOfMonth();
        $endDate = $selectedDate->copy()->endOfMonth();
        
      
        $stats = [
            'total_clients' => Client::count(),
            'ongoing_services' => Diagnostics::where('status', 'encours')->count(),
            'monthly_revenue' => Diagnostics::where('status', 'complete')
                ->whereBetween('date', [$startDate, $endDate])
                ->with('service')
                ->get()
                ->sum(function($diagnostic) {
                    return $diagnostic->service->price ?? 0;
                }),
            'total_diagnostics' => Diagnostics::count(),
        ];
        
        
        $recentDiagnostics = Diagnostics::with(['client', 'vehicule', 'service'])
            ->when($search, function($query) use ($search) {
                $query->whereHas('client', function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })
                ->orWhereHas('vehicule', function($q) use ($search) {
                    $q->where('matricule', 'like', "%{$search}%")
                      ->orWhere('marque', 'like', "%{$search}%")
                      ->orWhere('model', 'like', "%{$search}%");
                })
                ->orWhereHas('service', function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            })
            ->orderBy('date', 'desc')
            ->take(4)
            ->get();
        
  
        // $revenueData = $this->getRevenueChartData($startDate, $endDate);
        // $serviceTypesData = $this->getServiceTypesData($startDate, $endDate);
        
        
        return view('dashboard', compact(
            'stats', 
            'recentDiagnostics', 
            'revenueData', 
            'serviceTypesData',
            'search',
            'month'
        ));
    }
    

}