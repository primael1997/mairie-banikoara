@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Ajouter un partenaire</h2>

    <form action="{{ route('partenaires.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="nom" class="form-label">Nom *</label>
            <input type="text" name="nom" class="form-control" value="{{ old('nom') }}" required>
        </div>

        <div class="mb-3">
            <label for="site_web" class="form-label">Site web</label>
            <input type="url" name="site_web" class="form-control" value="{{ old('site_web') }}">
        </div>

        <div class="mb-3">
            <label for="logo" class="form-label">Logo</label>
            <input type="file" name="logo" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Enregistrer</button>
    </form>
</div>
@endsection
