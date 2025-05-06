@extends('layouts.header')

@section('content')
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div class="text-2xl font-bold text-gray-800">Gestion des Clients</div>
        <div class="flex items-center space-x-4">
            <form method="GET" action="{{ route('clients.index') }}" class="relative">
                <input 
                    type="text" 
                    name="search"
                    value="{{ request('search') }}"
                    class="pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    placeholder="Rechercher un client..."
                >
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                @if(request('search'))
                    <a href="{{ route('clients.index') }}" class="absolute right-3 top-3 text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times"></i>
                    </a>
                @endif
            </form>
            <a href="{{ route('clients.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center">
                <i class="fas fa-plus mr-2"></i> Nouveau Client
            </a>
        </div>
    </div>

    <!-- Client Cards -->
    @if($clients->isEmpty())
        <div class="bg-white rounded-lg shadow-md p-8 text-center">
            <i class="fas fa-user-slash text-4xl text-gray-400 mb-4"></i>
            <p class="text-gray-600">Aucun client trouvé</p>
            @if(request('search'))
                <a href="{{ route('clients.index') }}" class="text-blue-500 hover:text-blue-700 mt-2 inline-block">
                    Réinitialiser la recherche
                </a>
            @endif
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
            @foreach ($clients as $client)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <div class="bg-blue-500 p-4 text-white flex justify-between items-center">
                        <div class="font-semibold">{{ $client->name }}</div>
                        <div class="flex space-x-2">
                            <a href="{{ route('clients.edit', $client->id) }}" class="text-white hover:text-blue-200 transition-colors duration-200">
                                <i class="fas fa-edit"></i>
                            </a>
                            {{-- <form action="{{ route('clients.destroy', $client->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce client?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-white hover:text-blue-200 transition-colors duration-200">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form> --}}
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

        <!-- Pagination -->
        <div class="mt-8">
            {{ $clients->appends(['search' => request('search')])->links('vendor.pagination.tailwind') }}
        </div>
    @endif
    
@endsection