@extends('layouts.header')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Ajouter un nouveau client</h1>
        <form action="{{ route('clients.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-gray-700 mb-2">Nom complet</label>
                    <input type="text" name="name" class="w-full px-3 py-2 border rounded-lg" required>
                </div>
                <div>
                    <label class="block text-gray-700 mb-2">Téléphone</label>
                    <input type="text" name="phone" class="w-full px-3 py-2 border rounded-lg" required>
                </div>
                <div>
                    <label class="block text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" class="w-full px-3 py-2 border rounded-lg">
                </div>
                <div>
                    <label class="block text-gray-700 mb-2">Adresse</label>
                    <input type="text" name="address" class="w-full px-3 py-2 border rounded-lg">
                </div>
                <div>
                    <label class="block text-gray-700 mb-2">Ville</label>
                    <input type="text" name="city" class="w-full px-3 py-2 border rounded-lg">
                </div>
            </div>
            <div class="mt-6">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Enregistrer</button>
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