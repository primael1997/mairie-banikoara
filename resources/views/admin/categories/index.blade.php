@extends('admin.layouts.app')
@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Les Catégories des Actualités</h1>
        {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Gestion des Catégories</h6>
            <a href="#" data-toggle="modal" data-target="#addCategoryModal" class="btn btn-primary"><i class="fas fa-plus"></i> Ajouter</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Catégorie</th>
                            <th class="text-center" width="200">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $key=>$categorie)
                            <tr>
                                <td>{{ ++$key}}</td>
                                <td>{{ $categorie->libelle }}</td>
                                <td class="text-center">
                                    <a class="btn btn-primary" data-toggle="modal" data-target="#editCategoryModal-{{$categorie->id}}"><i class="fas fa-edit"></i></a>
                                    <a class="btn btn-danger delete-item" href="{{ route('admin.categories.destroy', $categorie->id) }}"><i class="fas fa-trash"></i></a>
                                </td>

                                <!--Edit Entite Modal-->
                                <div class="modal fade" id="editCategoryModal-{{$categorie->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel"><b>Modifier une catégorie</b></h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('admin.categories.update',$categorie->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <label for="nom">Nom de la Catégorie<b><span class="text-danger">*</span></b></label>
                                                        <input type="text" name="libelle" id="libelle" value="{{ $categorie->libelle }}" class="form-control">
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
<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><b>Ajouter une categorie</b></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.categories.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nom">Nom de la Catégorie <b><span class="text-danger">*</span></b></label>
                        <input type="text" name="libelle" id="libelle" value="{{ old('libelle') }}" class="form-control">
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


