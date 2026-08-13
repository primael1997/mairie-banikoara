@extends('admin.layouts.app')
@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Catégories des Documents</h1>
        {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Ajoutez une nouvelle catégorie pour organiser vos documents</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.mairie.documents.store') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-6">
                @csrf
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="nom">Nom de la Catégorie <b><span class="text-danger">*</span></b></label>
                    <div class="col-sm-10">
                        <input type="text" name="nom" class="form-control" value="{{ old('nom') }}">
                    </div>
                </div>

                <div class="input-group">
                    <label for="couleur" class="form-label fw-bold"><i class="fas fa-palette-fill me-2"></i>Couleur : </label>
                    <input type="color" class="form-control form-control-color" id="couleur" name="couleur" value="{{ old('couleur', '#007bff') }}" title="Choisissez une couleur">
                    <input type="text" class="form-control" id="couleur-text" value="{{ old('couleur', '#007bff') }}" placeholder="#007bff">
                </div>

                <div class="text-center mt-4">
                    <button class="btn btn-primary" type="submit"><i class="fas fa-edit"></i> Ajouter</button>
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
@endpush
