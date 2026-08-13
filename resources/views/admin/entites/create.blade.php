@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-blue-700">Créer une Nouvelle Entité</h1>
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

    <form action="{{ route('admin.entites.store') }}" method="POST" class="bg-white shadow-md rounded-lg p-6">
        @csrf

        <div class="mb-4">
            <label for="nom" class="block text-gray-700 font-medium mb-2">Nom *</label>
            <input type="text" name="nom" id="nom" value="{{ old('nom') }}" required
                   class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-medium mb-2">Description</label>
            <textarea name="description" id="description" rows="4"
                      class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-2 focus:ring-blue-500">{{ old('description') }}</textarea>
        </div>

        <div class="mb-4">
            <label for="type" class="block text-gray-700 font-medium mb-2">Type *</label>
            <select name="type" id="type" required
                    class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-2 focus:ring-blue-500">
                <option value="">Sélectionner...</option>
                <option value="conseil" {{ old('type') == 'conseil' ? 'selected' : '' }}>Conseil</option>
                <option value="commission" {{ old('type') == 'commission' ? 'selected' : '' }}>Commission</option>
                <option value="delegation" {{ old('type') == 'delegation' ? 'selected' : '' }}>Délégation</option>
            </select>
        </div>

        <div class="flex justify-end pt-4 border-t">
            <button type="submit"
                    class="bg-blue-600 text-black px-6 py-2 rounded hover:bg-blue-700 transition duration-200">
                Enregistrer
            </button>
        </div>
    </form>
</div>
@endsection
