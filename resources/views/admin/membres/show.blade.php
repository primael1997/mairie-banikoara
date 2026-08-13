@extends('admin.layouts.app')
@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Fiche du Membre</h1>
        {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Fiche du Membre</h6>
        </div>
        <div class="card-body">
            <div class="text-center">
                @if($membre->photo)
                    <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                        src="{{ asset($membre->photo) }}"
                        alt="Photo de {{ $membre->nom }}">
                @else
                    <img class="img-profile rounded-circle"
                        src="{{asset('admin/img/undraw_profile.svg')}}"
                        alt="Photo de {{ $membre->nom }}">
                @endif
            </div>
            <div class="text-center">
                <h2 class="text-xl font-bold">{{ $membre->nom }}</h2>
                <p class="">{{ $membre->poste }}</p>
            </div>
            <div class="text-center">
                <h3 class="font-semibold">Coordonnées</h3>
                <p>Email: {{ $membre->email ?? 'Non renseigné' }}</p>
                <p>Téléphone: {{ $membre->telephone ?? 'Non renseigné' }}</p>
            </div>
            <div class="text-center">
                <h3 class="font-semibold">Hiérarchie</h3>
                <p>Niveau: {{ $membre->niveau }}</p>
                <p>Ordre d'affichage: {{ $membre->ordre }}</p>
            </div>

            <!-- Entités -->
            <div class="text-center">
                @if($membre->entites->count() > 0)
                    <div class="mt-6">
                        <h3 class="font-semibold mb-2">Entités</h3>
                        <ul>
                            @foreach($membre->entites as $entite)
                            <li>
                                <strong>{{ $entite->nom }}</strong>
                                @if($entite->pivot->role)
                                    <br> {{ $entite->pivot->role }}
                                @endif
                            </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="text-center mt-2">
                <a href="{{ route('admin.membres.edit', $membre) }}"
                    class="btn btn-primary"> <i class="fas fa-edit"></i>
                    Modifier
                </a>
                <a href="{{ route('admin.membres.index') }}"
                    class="btn btn-secondary"> <i class="fas fa-arrow-left"></i>
                    Retour
                </a>
            </div>

        </div>
    </div>

@endsection
