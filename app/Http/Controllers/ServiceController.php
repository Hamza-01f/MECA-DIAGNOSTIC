<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
   
    public function index()
    {
        $services = Service::all();
        return view('BackOffice.Services.index', compact('services'));
    }

   
    public function create()
    {
        return view('BackOffice.Services.update');
    }

    
    public function store(Request $request)
    {
      
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image',
            'vehicle_model' => 'nullable|string|max:255',
            'mileage' => 'nullable|integer',
        ]);

        $service = new Service();
        $service->name = $request->name;
        $service->type = $request->type;
        $service->price = $request->price;
        $service->vehicle_model = $request->vehicle_model;
        $service->mileage = $request->mileage;
        $service->image = $request->image;
        // dd(vars: $service->image);
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads', 'public');
           
            $service->image = $imagePath;
        }

        $service->save();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'service' => $service,
            ]);
        }

        return redirect()->route('services.index')->with('success', 'Service created successfully.');
    
    }
 
    public function edit(Service $service)
    {
        return response()->json($service);
    }

    
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image',
            'vehicle_model' => 'nullable|string|max:255',
            'mileage' => 'nullable|integer',
        ]);

        $service->name = $request->name;
        $service->type = $request->type;
        $service->price = $request->price;
        $service->vehicle_model = $request->vehicle_model;
        $service->mileage = $request->mileage;

        if ($request->hasFile('image')) {
            if ($service->image) {
                \Storage::delete('public/' . $service->image);
            }
            $imagePath = $request->file('image')->store('services', 'public');
            $service->image = $imagePath;
        }

        $service->save();

        return response()->json([
            'success' => true,
            'service' => $service,
        ]);
    }

  
    public function destroy(Service $service)
    {
        if ($service->image) {
            \Storage::delete('public/' . $service->image);
        }

        $service->delete();

        return response()->json([
            'success' => true,
        ]);
    }
}
