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
        
  
        $revenueData = $this->getRevenueChartData($startDate, $endDate);
        $serviceTypesData = $this->getServiceTypesData($startDate, $endDate);
        
        
        return view('dashboard', compact(
            'stats', 
            'recentDiagnostics', 
            'revenueData', 
            'serviceTypesData',
            'search',
            'month'
        ));
    }
    
    private function getRevenueChartData($startDate, $endDate)
    {
        $days = $startDate->diffInDays($endDate);
        $data = [
            'labels' => [],
            'revenue' => [],
            'expenses' => [] 
        ];
        
        for ($i = 0; $i <= $days; $i++) {
            $date = $startDate->copy()->addDays($i);
            $data['labels'][] = $date->format('d M');
            
            $dailyRevenue = Diagnostics::where('status', 'complete')
                ->whereDate('date', $date)
                ->with('service')
                ->get()
                ->sum(function($diagnostic) {
                    return $diagnostic->service->price ?? 0;
                });
                
            $data['revenue'][] = $dailyRevenue;
            $data['expenses'][] = 0; 
        }
        
        return $data;
    }
    
    private function getServiceTypesData($startDate, $endDate)
    {
        $serviceTypes = Diagnostics::whereBetween('date', [$startDate, $endDate])
            ->with('service')
            ->get()
            ->groupBy(function($item) {
                return $item->service->name ?? 'Autre';
            })
            ->map->count();
        
        return [
            'labels' => $serviceTypes->keys(),
            'data' => $serviceTypes->values(),
            'colors' => ['#3B82F6', '#F59E0B', '#10B981', '#6366F1', '#EC4899']
        ];
    }
}