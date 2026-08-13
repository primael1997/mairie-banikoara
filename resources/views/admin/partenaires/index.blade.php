@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Liste des partenaires</h2>

    <a href="{{ route('partenaires.create') }}" class="btn btn-success mb-3">Ajouter un partenaire</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Logo</th>
                <th>Nom</th>
                <th>Site web</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($partenaires as $partenaire)
            <tr>
                <td>
                    @if($partenaire->logo)
                        <img src="{{ asset('uploads/partenaire/' . $partenaire->logo) }}" alt="Logo" width="60">
                    @endif
                </td>
                <td>{{ $partenaire->nom }}</td>
                <td>
                    @if($partenaire->site_web)
                        <a href="{{ $partenaire->site_web }}" target="_blank">{{ $partenaire->site_web }}</a>
                    @endif
                </td>
                <td>
                    <a href="{{ route('partenaires.edit', $partenaire) }}" class="btn btn-sm btn-primary">Modifier</a>

                    <form action="{{ route('partenaires.destroy', $partenaire) }}" method="POST" class="d-inline" onsubmit="return confirm('Confirmer la suppression ?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
