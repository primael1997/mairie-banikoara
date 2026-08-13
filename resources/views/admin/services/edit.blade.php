@extends('admin.layouts.app')
@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Les Services</h1>
        {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Modification des Services</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.services.update', $service->id) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-6">
                @csrf
                @method('PUT')
                <div class="text-center">
                    @if($service->image)
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="{{ asset('uploads/' . $service->image) }}" alt="...">
                    @else
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="{{ asset('admin/img/undraw_posting_photo.svg')}}" alt="...">
                    @endif
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-form-label"><b>Image<span class="text-danger">* </span>:</b></label>
                            <input type="file" name="image" accept="image/*"  class="form-control" id="inputEmail3" placeholder="Email">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-form-label"><b>Coût (CFA)<span class="text-danger">* </span>:</b></label>
                            <input type="text" name="cout" value="{{ old('cout', $service->cout) }}" class="form-control" id="inputEmail3" placeholder="Contact">
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-form-label"><b>Titre du service <span class="text-danger">* </span>:</b></label>
                        <input type="text" name="titre" value="{{ old('titre', $service->titre) }}" class="form-control" id="inputEmail3" placeholder="Email">
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-7">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-form-label"><b>Catégorie<span class="text-danger">* </span>:</b></label>
                            <select class="form-control" id="categorie_id" name="categorie_service_id" required>
                                <option value="">Sélectionner une catégorie</option>
                                @foreach ($categories as $categorie)
                                    <option {{ $categorie->id == $service->categorie_service_id ? 'selected':''}} value="{{ $categorie->id }}" {{ old('categorie_id') == $categorie->id ? 'selected' : '' }}>{{ $categorie->libelle }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3 mt-5">
                        <div class="form-group">
                            <a href="#" data-toggle="modal" data-target="#addCategory" class="btn btn-success"><i class="fas fa-plus"></i> Ajouter une catégorie</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control form-textarea" id="description" name="description">{{ old('description', $service->description) }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="description">Pièces à fournir</label>
                            <textarea class="form-control form-textarea" id="pieces_fournir" name="pieces_fournir">{{ old('pieces_fournir', $service->pieces_fournir) }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <a type="button" href="{{route('admin.mairie.documents.index')}}" class="btn btn-secondary" type="submit"><i class="fas fa-arrow-left"></i> Retour</a>
                    <button class="btn btn-primary" type="submit"><i class="fas fa-edit"></i> Modifier</button>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#description').summernote({
                height: 150
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#pieces_fournir').summernote({
                height: 150
            });
        });
    </script>
@endpush
