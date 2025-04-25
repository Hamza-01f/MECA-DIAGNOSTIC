<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index(Request $request)
    {  
        $search = $request->input('search');
        $type = $request->input('type');
        
        $services = Service::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%");
        })
        ->when($type, function ($query, $type) {
            return $query->where('type', $type);
        })
        ->get();
    
        return view('BackOffice.Services.index', compact('services'));
    }

    public function create(){
        
    }

    public function store(StoreServiceRequest $request)
    {
        $validated = $request->validated();
        
        $service = new Service();
        $service->name = $validated['name'];
        $service->type = $validated['type'];
        $service->price = $validated['price'];
        $service->period = $validated['period'];
        
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('services', 'public');
            $service->image = $imagePath;
        }
        
        $service->save();
    
        return redirect()->route('services.index')->with('success', 'Service créé avec succès.');
    }

    public function edit(Service $service)
    {
        return view('BackOffice.Services.update', compact('service'));
    }

    public function update(UpdateServiceRequest $request, Service $service)
    {
        $validated = $request->validated();

        $service->name = $validated['name'];
        $service->type = $validated['type'];
        $service->price = $validated['price'];
        $service->period = $validated['period'];

        if ($request->hasFile('image')) {
            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }
        
            $imagePath = $request->file('image')->store('services', 'public');
            $service->image = $imagePath;
        }

        $service->save();

        return redirect()->route('services.index')->with('success', 'Service mis à jour avec succès.');
    }

    public function destroy(Service $service)
    {
        if ($service->image) {
            Storage::disk('public')->delete($service->image);
        }

        $service->delete();

        return redirect()->route('services.index')->with('success', 'Service deleted successfully.');
    }
}