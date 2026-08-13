@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Ajouter une Catégorie</h2>

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

    <form action="{{ route('categorie_services.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="libelle">Libellé :</label>
            <input type="text" name="libelle" id="libelle" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success mt-2">Enregistrer</button>
    </form>
</div>
@endsection
