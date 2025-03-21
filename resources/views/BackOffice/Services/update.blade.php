@extends('layouts.header')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Modifier le Service</h1>

        <form action="{{ route('services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Type de Service</label>
                <select name="type" class="w-full border rounded-lg px-3 py-2">
                    <option value="quick" @if($service->type == 'quick') selected @endif>Service Rapide</option>
                    <option value="long" @if($service->type == 'long') selected @endif>Service Long Terme</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Nom du Service</label>
                <input type="text" name="name" class="w-full border rounded-lg px-3 py-2" value="{{ $service->name }}" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Véhicule</label>
                <input type="text" name="vehicle_model" class="w-full border rounded-lg px-3 py-2" value="{{ $service->vehicle_model }}">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Kilométrage</label>
                <input type="number" name="mileage" class="w-full border rounded-lg px-3 py-2" value="{{ $service->mileage }}">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Prix</label>
                <input type="number" name="price" class="w-full border rounded-lg px-3 py-2" value="{{ $service->price }}" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Image du Service</label>
                <input type="file" name="image" accept="image/*" class="w-full border rounded-lg px-3 py-2">
                @if($service->image)
                    <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}" class="mt-2 w-32 h-32 object-cover rounded-lg">
                @endif
            </div>
            <div class="flex justify-between">
                <a href="{{ route('services.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg">Annuler</a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg">Mettre à jour</button>
            </div>
        </form>
    </div>
@endsection
