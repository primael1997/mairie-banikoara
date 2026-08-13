@extends('admin.layouts.app')
@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Les Documents</h1>
        {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Gestion des Documents</h6>
            <a href="{{route('admin.categories-documents.index')}}" class="btn btn-success"><i class="fas fa-list"></i> Catégorie des Documents</a>
            <a href="{{ route('admin.mairie.documents.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Ajouter</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Titre du document</th>
                            <th>Publié le</th>
                            <th width="200">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($documents as $key=>$document)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td><b><i class="fas fa-file"></i> {{ $document->titre }}</b></td>
                            <td class="text-center">{{ $document->created_at->format('d/m/Y à H:i') }}</td>
                            <td class="text-center">
                                <a class="btn btn-success" target="_blank" href="{{ route('admin.documents.show', $document->id) }}"><i class="fas fa-eye"></i></a>
                                <a class="btn btn-primary" href="{{ route('admin.mairie.documents.edit', $document->id) }}"><i class="fas fa-edit"></i></a>
                                <a class="btn btn-danger delete-item" href="{{ route('admin.mairie.documents.destroy', $document->id) }}"><i class="fas fa-trash"></i></a>
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
        </div>
    </div>

@endsection

