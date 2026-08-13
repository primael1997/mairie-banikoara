@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Modifier la Catégorie</h2>

    <a href="{{ route('categorie_services.index') }}" class="btn btn-secondary mb-3">Retour</a>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('categorie_services.update', $categorie->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="libelle">Libellé :</label>
            <input type="text" name="libelle" id="libelle" class="form-control" value="{{ $categorie->libelle }}" required>
        </div>

        <button type="submit" class="btn btn-primary mt-2">Mettre à jour</button>
    </form>
</div>
@endsection
