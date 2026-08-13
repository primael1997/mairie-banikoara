@extends('admin.layouts.app')
@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Les Actualités</h1>
        {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Liste des Actualités</h6>
            <a href="{{route('admin.categories.index')}}" class="btn btn-success"><i class="fas fa-list"></i> Liste des Catégories</a>
            <a href="{{ route('admin.actualites.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Ajouter</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Titre</th>
                            <th>Catégorie</th>
                            <th>Date</th>
                            <th width="200">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($actualites as $key=>$actualite)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>
                                @if ($actualite->image)
                                    <img src="{{ asset($actualite->image) }}" alt="Image" class="img-fluid" style="max-width:30% !important;">
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td><b>{{ Str::limit($actualite->titre, 40) }}</b></td>
                            <td class="text-center"><span class="badge badge-secondary">{{ $actualite->categorie->libelle }}</span></td>
                            <td><b>{{ $actualite->date_publication->format('d/m/Y') }}</b></td>
                            <td class="text-center">
                                <a class="btn btn-success" href="{{ route('admin.actualites.show', $actualite->slug) }}"><i class="fas fa-eye"></i></a>
                                <a class="btn btn-primary" href="{{ route('admin.actualites.edit', $actualite->id) }}"><i class="fas fa-edit"></i></a>
                                <a class="btn btn-danger delete-item" href="{{ route('admin.actualites.destroy', $actualite->id) }}"><i class="fas fa-trash"></i></a>
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
            @if($actualites->hasPages())
                <div class="mt-4">
                    {!! $actualites->withQueryString()->links('pagination::bootstrap-5') !!}
                </div>
            @endif
        </div>
    </div>

@endsection

