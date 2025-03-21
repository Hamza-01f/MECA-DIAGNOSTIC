@extends('layouts.header')

@section('content')
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div class="text-2xl font-bold text-gray-800">Gestion des Clients</div>
        <div class="flex items-center space-x-4">
            <div class="relative">
                <input type="text" class="pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Rechercher un client...">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            </div>
            <a href="{{ route('clients.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center">
                <i class="fas fa-plus mr-2"></i> Nouveau Client
            </a>
        </div>
    </div>

    <!-- Client Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
        @foreach ($clients as $client)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="bg-blue-500 p-4 text-white flex justify-between items-center">
                    <div class="font-semibold">{{ $client->name }}</div>
                    <div class="flex space-x-2">
                        <a href="{{ route('clients.edit', $client->id) }}" class="text-white hover:text-blue-200">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('clients.destroy', $client->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-white hover:text-blue-200">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="p-4">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-phone text-gray-500 w-5"></i>
                        <span class="ml-2 text-gray-700">{{ $client->phone }}</span>
                    </div>
                    <div class="flex items-center mb-3">
                        <i class="fas fa-envelope text-gray-500 w-5"></i>
                        <span class="ml-2 text-gray-700">{{ $client->email ?? 'N/A' }}</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-map-marker-alt text-gray-500 w-5"></i>
                        <span class="ml-2 text-gray-700">{{ $client->address ?? 'N/A' }}, {{ $client->city ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
