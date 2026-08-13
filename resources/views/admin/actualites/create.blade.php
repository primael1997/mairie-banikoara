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
            <h6 class="m-0 font-weight-bold text-primary">Créer une nouvelle actualité</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.actualites.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label"><b>Titre <span class="text-danger">* </span>:</b></label>
                    <div class="col-sm-10">
                        <input type="text" name="titre" value="{{ old('titre') }}" class="form-control" id="inputEmail3" placeholder="Titre">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label"><b>Date de publication <span class="text-danger">* </span>:</b></label>
                    <div class="col-sm-4">
                        <input type="date" name="date_publication" value="{{ old('date_publication') }}" class="form-control" id="inputEmail3" placeholder="Titre">
                    </div>
                    <label for="inputEmail3" class="col-sm-2 col-form-label"><b>Image de publication <span class="text-danger">* </span>:</b></label>
                    <div class="col-sm-4">
                        <input type="file" name="image" value="{{ old('image') }}" class="form-control">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label"><b>Catégorie <span class="text-danger">* </span>:</b></label>
                    <div class="col-sm-7">
                        <select class="form-control" id="categorie_id" name="categorie_id" required>
                            <option value="">Sélectionner une catégorie</option>
                            @foreach ($categories as $categorie)
                                <option value="{{ $categorie->id }}" {{ old('categorie_id') == $categorie->id ? 'selected' : '' }}>{{ $categorie->libelle }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <a href="#" data-toggle="modal" data-target="#addCategory" class="btn btn-success"><i class="fas fa-plus"></i> Ajouter une catégorie</a>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label"><b>Contenu <span class="text-danger">* </span>:</b></label>
                    <div class="col-sm-10">
                        <textarea type="text" id="contenu" name="contenu" value="{{ old('contenu') }}" class="form-control"></textarea>
                    </div>
                </div>

                <div class="text-center mt-5">
                    <a type="button" href="{{route('admin.actualites.index')}}" class="btn btn-secondary" type="submit"><i class="fas fa-arrow-left"></i> Retour</a>
                    <button class="btn btn-primary" type="submit"><i class="fas fa-edit"></i> Ajouter</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Add Catégory Modal-->
    <div class="modal fade" id="addCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                    <form action="{{ route('admin.categories.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nom">Nom de la Catégorie <b><span class="text-danger">*</span></b></label>
                            <input type="text" name="libelle" class="form-control">
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




@push('scripts')
    <script>
        $(document).ready(function() {
            $('#contenu').summernote({
                height: 300
            });
        });
    </script>
@endpush
