@extends('admin.layouts.app')
@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Les Catégories des Documents</h1>
        {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Gestion des Catégories</h6>
            <a href="#" data-toggle="modal" data-target="#addCategoryDocument" class="btn btn-primary"><i class="fas fa-plus"></i> Ajouter</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Icone</th>
                            <th>Catégorie</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th class="text-center" width="200">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $key=>$categorie)
                            <tr>
                                <td>{{ ++$key}}</td>
                                <td><i class="{{ $categorie->icone}}"></i></td>
                                <td>{{ $categorie->nom }}</td>
                                <td>{{ $categorie->description }}</td>
                                <td>
                                    @if ($categorie->active == 'Actif')
                                        <span class="badge badge-success">Actif</span>
                                    @else
                                        <span class="badge badge-danger">Inactif</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-primary" data-toggle="modal" data-target="#editCategoryDocument-{{$categorie->id}}"><i class="fas fa-edit"></i></a>
                                    <a class="btn btn-danger delete-item" href="{{ route('admin.categories-documents.destroy', $categorie->id) }}"><i class="fas fa-trash"></i></a>
                                </td>

                                <!--Edit Entite Modal-->
                                <div class="modal fade" id="editCategoryDocument-{{$categorie->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel"><b>Ajouter une Catégorie</b></h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('admin.categories-documents.update',$categorie->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="form-group">
                                                        <label for="nom">Nom de la Catégorie <b><span class="text-danger">*</span></b></label>
                                                        <input type="text" name="nom" value="{{$categorie->nom}}" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nom">Description de la Catégorie <b><span class="text-danger">*</span></b></label>
                                                        <textarea type="text" rows="4" name="description" class="form-control">{{$categorie->description}}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nom">Statut de la Catégorie <b><span class="text-danger">*</span></b></label>
                                                        <select class="form-control" name="active">
                                                            <option {{$categorie->active == 1 ? 'selected' : ''}} value="1">-- Actif --</option>
                                                            <option {{$categorie->active == 0 ? 'selected' : ''}} value="0">-- Inactif --</option>
                                                        </select>
                                                    </div>

                                                </div>

                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                                                    <button class="btn btn-primary" type="submit">Modifier</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">Aucun membre enregistré</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($categories->hasPages())
                <div class="mt-4">
                    {{ $categories->links() }}
                </div>
            @endif
        </div>
    </div>


<!--Add Entite Modal-->
<div class="modal fade" id="addCategoryDocument" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><b>Ajouter une Catégorie</b></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.categories-documents.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nom">Nom de la Catégorie <b><span class="text-danger">*</span></b></label>
                        <input type="text" name="nom" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nom">Description de la Catégorie <b><span class="text-danger">*</span></b></label>
                        <textarea type="text" rows="4" name="description" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="nom">Statut de la Catégorie <b><span class="text-danger">*</span></b></label>
                        <select class="form-control" name="active">
                            <option value="1">-- Actif --</option>
                            <option value="0">-- Inactif --</option>
                        </select>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                    <button class="btn btn-primary" type="submit">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection


