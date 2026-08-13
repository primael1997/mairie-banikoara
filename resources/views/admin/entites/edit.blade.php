@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-blue-700">Modifier : {{ $entite->nom }}</h1>
        <a href="{{ route('admin.entites.index') }}"
           class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 transition duration-200">
           Retour à la liste
        </a>
    </div>

    @if($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.entites.update', $entite) }}" method="POST" class="bg-white shadow-md rounded-lg p-6">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="nom" class="block text-gray-700 font-medium mb-2">Nom *</label>
            <input type="text" name="nom" id="nom" value="{{ old('nom', $entite->nom) }}" required
                   class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-medium mb-2">Description</label>
            <textarea name="description" id="description" rows="4"
                      class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-2 focus:ring-blue-500">{{ old('description', $entite->description) }}</textarea>
        </div>

        <div class="mb-4">
            <label for="type" class="block text-gray-700 font-medium mb-2">Type *</label>
            <select name="type" id="type" required
                    class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-2 focus:ring-blue-500">
                <option value="">Sélectionner...</option>
                <option value="conseil" {{ old('type', $entite->type) == 'conseil' ? 'selected' : '' }}>Conseil</option>
                <option value="commission" {{ old('type', $entite->type) == 'commission' ? 'selected' : '' }}>Commission</option>
                <option value="delegation" {{ old('type', $entite->type) == 'delegation' ? 'selected' : '' }}>Délégation</option>
            </select>
        </div>

        <div class="flex justify-between pt-4 border-t">
            <a href="{{ route('admin.entites.show', $entite) }}"
               class="text-blue-600 hover:underline">
               Voir les membres
            </a>
            <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition duration-200">
                Mettre à jour
            </button>
        </div>
    </form>
</div>
@endsection
