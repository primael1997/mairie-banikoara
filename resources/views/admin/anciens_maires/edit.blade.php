@extends('admin.layouts.app')

@section('content')
<style>
    .form-section {
        background: #f9fafb;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
    }

    .form-section h3 {
        margin-bottom: 25px;
        color: #1f2937;
        font-weight: 600;
    }

    .image-preview img {
        max-width: 200px;
        margin-top: 10px;
        border-radius: 8px;
        border: 1px solid #ccc;
    }
</style>

<div class="container py-4">
    <div class="form-section">
        <h3>✏️ Modifier : {{ $anciens_maires->nom }}</h3>

        @if ($errors->any())
            <div class="alert alert-danger mb-3">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.anciens_maires.update', $anciens_maires->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nom" class="form-label">Nom complet</label>
                <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom', $anciens_maires->nom) }}" required>
            </div>

            <div class="mb-3">
                <label for="mandat" class="form-label">Mandat</label>
                <input type="text" name="mandat" id="mandat" class="form-control" value="{{ old('mandat', $anciens_maires->mandat) }}" required>
            </div>

            <div class="mb-3">
    <label for="biographie" class="form-label">Biographie</label>
    <textarea name="biographie" id="biographie" rows="5" class="form-control">{{ old('biographie', $anciens_maires->biographie) }}</textarea>
</div>

            <div class="mb-3">
                <label for="photo" class="form-label">Photo (facultatif)</label>
                <input type="file" name="photo" id="photo" class="form-control" accept="image/*" onchange="previewImage(event)">
                <div class="image-preview" id="image-preview">
                    @if ($anciens_maires->photo)
                        <img src="{{ asset('mairie/public/uploads/maires/' . $anciens_maires->photo) }}" alt="Photo actuelle">
                    @endif
                </div>
            </div>

            <div class="text-end">
                <button class="btn btn-success"><i class="bi bi-check2-circle me-1"></i> Mettre à jour</button>
                <a href="{{ route('admin.anciens_maires.index') }}" class="btn btn-secondary ms-2">↩️ Retour</a>
            </div>
        </form>
    </div>
</div>

<script>
    function previewImage(event) {
        const preview = document.getElementById('image-preview');
        preview.innerHTML = '';
        const file = event.target.files[0];
        if (file) {
            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            preview.appendChild(img);
        }
    }
</script>
@endsection
