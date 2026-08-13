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
            <h6 class="m-0 font-weight-bold text-primary">Ajouter un document</h6>
        </div>
        <div class="card-body">
            <form action="{{route('admin.mairie.documents.store')}}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-6">
                @csrf
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-form-label"><b>Titre <span class="text-danger">* </span>:</b></label>
                            <input type="text" name="titre" value="{{ old('titre') }}" class="form-control" id="inputEmail3" placeholder="Titre du document">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-7">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-form-label"><b>Catégorie <span class="text-danger">* </span>:</b></label>
                            <select class="form-control" name="categorie_document_id">
                                <option value="">Aucune catégorie</option>
                                @foreach($categories as $categorie)
                                    <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3 mt-4">
                        <div class="form-group">
                            <a href="#" data-toggle="modal" data-target="#addCategoryDocument" type="button" class="btn btn-success"><i class="fas fa-plus"></i> Ajouter une catégorie</a>
                        </div>
                    </div>
                </div>

                {{-- <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-form-label"><b>Description<span class="text-danger">* </span>:</b></label>
                            <textarea id="description" name="description" rows="6" class="form-control" id="inputEmail3"></textarea>
                        </div>
                    </div>
                </div> --}}

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-form-label"><b>Date de publication <span class="text-danger">* </span>:</b></label>
                            <input type="date" name="date_publication" value="{{ old('date_publication') }}" class="form-control" id="inputEmail3" placeholder="Email">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-form-label"><b>Fichier <span class="text-danger">* </span>:</b></label>
                            <input type="file" name="fichier" accept=".pdf" value="" class="form-control" id="inputEmail3">
                        </div>
                    </div>
                </div>


                <div class="text-center mt-4">
                    <a type="button" href="{{route('admin.mairie.documents.index')}}" class="btn btn-secondary" type="submit"><i class="fas fa-arrow-left"></i> Retour</a>
                    <button class="btn btn-primary" type="submit"><i class="fas fa-plus"></i> Ajouter</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Add Catégory Modal-->
    <div class="modal fade" id="addCategoryDocument" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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

