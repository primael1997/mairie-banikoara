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
            <h6 class="m-0 font-weight-bold text-primary">Modifier un document</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.mairie.documents.update', $document->id) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-6">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-form-label"><b>Titre <span class="text-danger">* </span>:</b></label>
                            <input type="text" name="titre" value="{{ old('titre', $document->titre) }}" class="form-control" id="inputEmail3" placeholder="Email">
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
                                    <option {{$categorie->id == $document->categorie_document_id ? 'selected':''}} value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
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
                            <textarea id="description" name="description" rows="6" class="form-control" id="inputEmail3">{{ $document->description }}</textarea>
                        </div>
                    </div>
                </div> --}}

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-form-label"><b>Date de publication <span class="text-danger">* </span>:</b></label>
                            <input type="date" name="date_publication" value="{{ old('date_publication', $document->date_publication ? $document->date_publication->format('Y-m-d') : '') }}" class="form-control" id="inputEmail3" placeholder="Email">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-form-label"><b>Fichier <span class="text-danger">* </span>:</b></label>
                            <input type="file" name="fichier" accept=".pdf" value="" class="form-control" id="inputEmail3" placeholder="Email">
                        </div>
                    </div>
                </div>

                {{-- <div class="form-group">
                    <h5>Type de document </h5>
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" name="public" type="checkbox" id="customCheckbox1" value="1" {{ old('public', $document->public) ? 'checked' : '' }}>
                        <label for="customCheckbox1" class="custom-control-label">Document public <small class="text-muted d-block">Les documents publics sont visibles par tous</small></label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" name="archive" type="checkbox" id="archive" value="1" {{ old('archive', $document->archive) ? 'checked' : '' }}>
                        <label for="customCheckbox2" class="custom-control-label">Document archivé <small class="text-muted d-block">Les documents archivés ne sont plus visibles au public</small></label>
                    </div>
                </div> --}}

                <hr>

                <!-- Statistiques -->
                <div class="mb-4">
                    <label class="form-label fw-bold">
                        <i class="bi bi-graph-up me-2"></i>Statistiques
                    </label>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card bg-light">
                                <div class="card-body text-center py-3">
                                    <i class="fas fa-download fs-4 text-success mb-2"></i>
                                    <h5 class="text-success">{{ $document->nb_telechargements }}</h5>
                                    <small class="text-muted">Téléchargements</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-light">
                                <div class="card-body text-center py-3">
                                    <i class="fas fa-eye fs-4 text-info mb-2"></i>
                                    <h5 class="text-info">{{ $document->nb_vues }}</h5>
                                    <small class="text-muted">Vues</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-light">
                                <div class="card-body text-center py-3">
                                    <i class="fas fa-clock fs-4 text-warning mb-2"></i>
                                    <h5 class="text-warning">{{ $document->derniere_vue ? $document->derniere_vue->diffForHumans() : 'Jamais' }}</h5>
                                    <small class="text-muted">Dernière vue</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a type="button" href="{{route('admin.mairie.documents.index')}}" class="btn btn-secondary" type="submit"><i class="fas fa-arrow-left"></i> Retour</a>
                    <button class="btn btn-primary" type="submit"><i class="fas fa-edit"></i> Modifier</button>
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


