@extends('layouts.header')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Ajouter un nouveau client</h1>
    
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif  

    <form action="{{ route('clients.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-gray-700 mb-2">Nom complet</label>
                <input type="text" name="name" value="{{ old('name') }}" 
                       class="w-full px-3 py-2 border rounded-lg @error('name') border-red-500 @enderror"   >
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-gray-700 mb-2">Téléphone</label>
                <input type="text" name="phone" value="{{ old('phone') }}" 
                       class="w-full px-3 py-2 border rounded-lg @error('phone') border-red-500 @enderror"  >
                @error('phone')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-gray-700 mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" 
                       class="w-full px-3 py-2 border rounded-lg @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-gray-700 mb-2">Adresse</label>
                <input type="text" name="address" value="{{ old('address') }}" 
                       class="w-full px-3 py-2 border rounded-lg @error('address') border-red-500 @enderror">
                @error('address')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-gray-700 mb-2">Ville</label>
                <input type="text" name="city" value="{{ old('city') }}" 
                       class="w-full px-3 py-2 border rounded-lg @error('city') border-red-500 @enderror">
                @error('city')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="mt-6">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-200">
                Enregistrer
            </button>
        </div>
    </form>
</div>
    @section('scripts')
    <script>
        document.getElementById('createClientForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const form = this;
            
            Swal.fire({
                title: 'Confirmer la création',
                text: "Voulez-vous créer ce client?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, créer!',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    </script>
    @endsection
@endsection