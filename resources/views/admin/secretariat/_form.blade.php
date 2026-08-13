@csrf

<div class="mb-4">
    <label class="block text-gray-700">Nom</label>
    <input type="text" name="nom" value="{{ old('nom', $membre->nom ?? '') }}" required class="w-full border rounded px-3 py-2">
</div>

<div class="mb-4">
    <label class="block text-gray-700">Poste</label>
    <input type="text" name="poste" value="{{ old('poste', $membre->poste ?? '') }}" required class="w-full border rounded px-3 py-2">
</div>

<div class="mb-4">
    <label class="block text-gray-700">Contact</label>
    <input type="text" name="contact" value="{{ old('contact', $membre->contact ?? '') }}" class="w-full border rounded px-3 py-2">
</div>

<div class="mb-4">
    <label class="block text-gray-700">Email</label>
    <input type="email" name="email" value="{{ old('email', $membre->email ?? '') }}" class="w-full border rounded px-3 py-2">
</div>

<div class="mb-4">
    <label class="block text-gray-700">Attributions</label>
    <textarea name="attributions" rows="4" class="w-full border rounded px-3 py-2">{{ old('attributions', $membre->attributions ?? '') }}</textarea>
</div>

<div class="mb-4">
    <label class="block text-gray-700">Photo</label>
    <input type="file" name="photo" class="w-full border px-4 py-2 rounded bg-gray-50">
    @if (!empty($membre->photo))
        <img src="{{ asset('uploads/'.$membre->photo) }}" class="h-16 mt-2 rounded" alt="Photo actuelle">
    @endif
</div>

<div class="mb-4 flex space-x-4">
    <div class="flex-1">
        <label class="block text-gray-700">Niveau</label>
        <input type="number" name="niveau" value="{{ old('niveau', $membre->niveau ?? 1) }}" required class="w-full border rounded px-3 py-2">
    </div>
    <div class="flex-1">
        <label class="block text-gray-700">Ordre</label>
        <input type="number" name="ordre" value="{{ old('ordre', $membre->ordre ?? 1) }}" required class="w-full border rounded px-3 py-2">
    </div>
</div>

<div class="text-right">
    <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">Enregistrer</button>
</div>
