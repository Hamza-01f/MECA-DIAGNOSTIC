@extends('layouts.header')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Modifier le Service</h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-md mb-6" role="alert">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">Il y a {{ $errors->count() }} erreur(s) dans votre formulaire</h3>
                        <div class="mt-2 text-sm text-red-700">
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <form action="{{ route('services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Type de Service</label>
                <select name="type" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('type') border-red-500 @enderror">
                    <option value="quick" @if(old('type', $service->type) == 'quick') selected @endif>Service Rapide</option>
                    <option value="long" @if(old('type', $service->type) == 'long') selected @endif>Service Long Terme</option>
                </select>
                @error('type')
                    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Nom du Service</label>
                <input type="text" name="name" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-500 @enderror" value="{{ old('name', $service->name) }}" required>
                @error('name')
                    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Période du service (jours)</label>
                <input type="number" name="period" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('period') border-red-500 @enderror" value="{{ old('period', $service->period) }}" min="1">
                @error('period')
                    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Prix (DH)</label>
                <input type="number" name="price" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('price') border-red-500 @enderror" value="{{ old('price', $service->price) }}" min="0" step="0.01" required>
                @error('price')
                    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Image du Service</label>
                <div class="border rounded-lg px-3 py-2 @error('image') border-red-500 @enderror">
                    <input type="file" name="image" accept="image/*" class="w-full">
                </div>
                @error('image')
                    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                @enderror
                @if($service->image)
                    <div class="mt-4">
                        <p class="text-sm text-gray-600 mb-2">Image actuelle:</p>
                        <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}" class="w-32 h-32 object-cover rounded-lg border">
                        <div class="mt-2 flex items-center">
                            <input type="checkbox" name="remove_image" id="remove_image" class="mr-2">
                            <label for="remove_image" class="text-sm text-gray-600">Supprimer l'image actuelle</label>
                        </div>
                    </div>
                @endif
            </div>

            <div class="flex justify-between pt-4">
                <a href="{{ route('services.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition-colors font-medium">
                    Annuler
                </a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors font-medium">
                    Mettre à jour
                </button>
            </div>
        </form>
    </div>
@endsection