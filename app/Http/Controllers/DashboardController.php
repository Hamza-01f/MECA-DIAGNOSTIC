<?php

//Namespaces and imports
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
        $search = $request->input('search');
        $selectedDate = now();
        $startDate = $selectedDate->copy()->startOfMonth();
        $endDate = $selectedDate->copy()->endOfMonth();
        
        // Basic stats calculations
        $stats = [
            'total_clients' => Client::count(),
            'monthly_revenue' => Diagnostics::where('status', 'complete')
                ->whereBetween('date', [$startDate, $endDate])
                ->with('service')
                ->get()
                ->sum(function($diagnostic) {
                    //?? => null coalescing operator
                    return $diagnostic->service->price ?? 0;
                }),
            'total_diagnostics' => Diagnostics::count(),
        ];
        
        // Recent diagnostics with search
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
        
        // Chart data 
        $revenueData = $this->getRevenueChartData($startDate, $endDate);
        $yearlyRevenueData = $this->getYearlyRevenueData($selectedDate->year);
        $serviceTypesData = $this->getServiceTypesData($startDate, $endDate);
        
        return view('dashboard', compact(
            'stats', 
            'recentDiagnostics',
            'revenueData',
            'yearlyRevenueData',
            'serviceTypesData',
            'search'
        ));
    }
    
    private function getRevenueChartData($startDate, $endDate)
    {
        //Calculate how many days in this month
        $days = $startDate->diffInDays($endDate);
        $data = [
            'labels' => [],//storing date label like "01 april"
            'revenue' => [],//store the total revenue
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
        }
        
        return $data;
    }
    
    private function getYearlyRevenueData($year)
    {
        $data = [
            'labels' => [],
            'revenue' => [],
        ];
        
        for ($i = 1; $i <= 12; $i++) {
            $start = Carbon::createFromDate($year, $i, 1)->startOfMonth();
            $end = Carbon::createFromDate($year, $i, 1)->endOfMonth();
            
            $data['labels'][] = $start->format('M');
            
            $monthlyRevenue = Diagnostics::where('status', 'complete')
                ->whereBetween('date', [$start, $end])
                ->with('service')
                ->get()
                ->sum(function($diagnostic) {
                    return $diagnostic->service->price ?? 0;
                });
                
            $data['revenue'][] = $monthlyRevenue;
        }
        
        return $data;
    }
    
    private function getServiceTypesData($startDate, $endDate)
    {
        $serviceTypes = Diagnostics::whereBetween('date', [$startDate, $endDate])
            ->with('service')
            ->get()
            //Grouping diagnostics with their service name
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