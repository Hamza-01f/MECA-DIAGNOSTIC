@extends('layouts.header')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Modifier le Service</h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <form action="{{ route('services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Type de Service</label>
                <select name="type" class="w-full border rounded-lg px-3 py-2">
                    <option value="quick" @if($service->type == 'quick') selected @endif>Service Rapide</option>
                    <option value="long" @if($service->type == 'long') selected @endif>Service Long Terme</option>
                </select>
                @error('type')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Nom du Service</label>
                <input type="text" name="name" class="w-full border rounded-lg px-3 py-2" value="{{ old('name', $service->name) }}" required>
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Period du service</label>
                <input type="number" name="period" class="w-full border rounded-lg px-3 py-2" value="{{ old('mileage', $service->period) }}">
                @error('mileage')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Prix (DH)</label>
                <input type="number" name="price" class="w-full border rounded-lg px-3 py-2" value="{{ old('price', $service->price) }}" required>
                @error('price')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Image du Service</label>
                <input type="file" name="image" accept="image/*" class="w-full border rounded-lg px-3 py-2">
                @error('image')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
                @if($service->image)
                    <div class="mt-4">
                        <p class="text-sm text-gray-600 mb-2">Image actuelle:</p>
                        <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}" class="w-32 h-32 object-cover rounded-lg">
                    </div>
                @endif
            </div>
            <div class="flex justify-between">
                <a href="{{ route('services.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300">Annuler</a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Mettre à jour</button>
            </div>
        </form>
    </div>
@endsection