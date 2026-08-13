@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Modifier le partenaire</h2>

    <form action="{{ route('partenaires.update', $partenaire) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nom" class="form-label">Nom *</label>
            <input type="text" name="nom" class="form-control" value="{{ old('nom', $partenaire->nom) }}" required>
        </div>

        <div class="mb-3">
            <label for="site_web" class="form-label">Site web</label>
            <input type="url" name="site_web" class="form-control" value="{{ old('site_web', $partenaire->site_web) }}">
        </div>

        <div class="mb-3">
            <label for="logo" class="form-label">Logo</label><br>
            @if($partenaire->logo)
                <img src="{{ asset('uploads/partenaire/' . $partenaire->logo) }}" alt="Logo" width="80" class="mb-2"><br>
            @endif
            <input type="file" name="logo" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection
