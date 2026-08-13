@extends('admin.layouts.app')
@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Le Maire et ses Elus</h1>
        {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Gestion des Membres</h6>
                <a href="{{route('admin.entites.index')}}" class="btn btn-success"><i class="fas fa-list"></i> Liste des Entités</a>
                <a href="{{route('admin.membres.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Ajouter</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Photo</th>
                            <th>Nom</th>
                            <th>Poste</th>
                            <th>Niveau</th>
                            <th>Entité</th>
                            <th width="200">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($membres as $membre)
                        <tr>
                            <td>
                                @if($membre->photo)
                                    <img class="img-fluid"
                                        src="{{ asset($membre->photo) }}"
                                        alt="{{ $membre->nom }}" width="95px">
                                @endif
                            </td>
                            <td>{{ $membre->nom }}</td>
                            <td><b>{{ $membre->poste }}</b></td>
                            <td class="text-center">{{ $membre->niveau }}</td>
                            <td>
                                <ul>
                                    @forelse($membre->entites as $entite)
                                        <li>
                                            {{ $entite->nom }}
                                            @if($entite->pivot->role)
                                                ({{ $entite->pivot->role }})
                                            @endif
                                        </li>
                                    @empty
                                        <span class="text-gray-400 text-sm">Aucune entité</span>
                                    @endforelse
                                </ul>
                            </td>
                            <td class="text-center">
                                <a class="btn btn-success" href="{{ route('admin.membres.show', $membre->id) }}"><i class="fas fa-eye"></i></a>
                                <a class="btn btn-primary" href="{{ route('admin.membres.edit', $membre->id) }}"><i class="fas fa-edit"></i></a>
                                <a class="btn btn-danger delete-item" href="{{ route('admin.membres.destroy', $membre->id) }}"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">Aucun membre enregistré</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            @if($membres->hasPages())
                <div class="mt-4">
                    {!! $membres->withQueryString()->links('pagination::bootstrap-5') !!}
                </div>
            @endif
        </div>
    </div>

@endsection

