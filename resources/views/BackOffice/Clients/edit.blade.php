@extends('layouts.header')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Modifier le client</h1>
        @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ route('clients.update', $client->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-gray-700 mb-2">Nom complet</label>
                    <input type="text" name="name" class="w-full px-3 py-2 border rounded-lg" value="{{ old('name', $client->name) }}" 
                          class="w-full px-3 py-2 border rounded-lg @error('name') border-red-500 @enderror"   >
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-gray-700 mb-2">Téléphone</label>
                    <input type="text" name="phone" class="w-full px-3 py-2 border rounded-lg" value="{{ old('phone', $client->phone) }}" 
                    class="w-full px-3 py-2 border rounded-lg @error('phone') border-red-500 @enderror">
                    @error('phone')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                   @enderror
                </div>
                <div>
                    <label class="block text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" class="w-full px-3 py-2 border rounded-lg" value="{{ old('email', $client->email) }}">
                </div>
                <div>
                    <label class="block text-gray-700 mb-2">Adresse</label>
                    <input type="text" name="address" class="w-full px-3 py-2 border rounded-lg" value="{{ old('address', $client->address) }}">
                </div>
                <div>
                    <label class="block text-gray-700 mb-2">Ville</label>
                    <input type="text" name="city" class="w-full px-3 py-2 border rounded-lg" value="{{ old('city', $client->city) }}">
                </div>
            </div>
            <div class="mt-6">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Mettre à jour</button>
            </div>
        </form>
    </div>
@endsection

