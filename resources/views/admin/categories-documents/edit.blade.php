@extends('admin.layouts.app')

@section('title', 'Modifier la Catégorie')

@section('content')
<div class="container-fluid px-5 py-4 bg-light-subtle">
    <div class="container-fluid">
        <!-- Header Section -->
        <div class="text-center mb-5">
            <h1 class="display-5 fw-bold text-primary mb-3">
                <i class="bi bi-pencil-square me-2"></i>Modifier la Catégorie
            </h1>
            <p class="lead text-muted opacity-75">
                Modifiez les informations de la catégorie "{{ $categorieDocument->nom }}"
            </p>
        </div>

        <!-- Form Card -->
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow rounded-4">
                    <div class="card-header bg-primary text-white py-3">
                        <h5 class="mb-0">
                            <i class="bi bi-pencil-square me-2"></i>Informations de la catégorie
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('admin.categories-documents.update', $categorieDocument) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <!-- Nom -->
                                <div class="col-md-6 mb-3">
                                    <label for="nom" class="form-label fw-bold">
                                        <i class="bi bi-tag-fill me-2"></i>Nom de la catégorie *
                                    </label>
                                    <input type="text"
                                           class="form-control @error('nom') is-invalid @enderror"
                                           id="nom"
                                           name="nom"
                                           value="{{ old('nom', $categorieDocument->nom) }}"
                                           required>
                                    @error('nom')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Couleur -->
                                <div class="col-md-6 mb-3">
                                    <label for="couleur" class="form-label fw-bold">
                                        <i class="bi bi-palette-fill me-2"></i>Couleur *
                                    </label>
                                    <input type="color"
                                           class="form-control @error('couleur') is-invalid @enderror"
                                           id="couleur"
                                           name="couleur"
                                           value="{{ old('couleur', $categorieDocument->couleur) }}">
                                    @error('couleur')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <!-- Icône -->
                                <div class="col-md-6 mb-3">
                                    <label for="icone" class="form-label fw-bold">
                                        <i class="bi bi-emoji-smile me-2"></i>Icône *
                                    </label>
                                    <input type="text"
                                           class="form-control @error('icone') is-invalid @enderror"
                                           id="icone"
                                           name="icone"
                                           value="{{ old('icone', $categorieDocument->icone) }}">
                                    @error('icone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Ordre -->
                                <div class="col-md-6 mb-3">
                                    <label for="ordre" class="form-label fw-bold">
                                        <i class="bi bi-sort-numeric-down me-2"></i>Ordre d'affichage
                                    </label>
                                    <input type="number"
                                           class="form-control @error('ordre') is-invalid @enderror"
                                           id="ordre"
                                           name="ordre"
                                           value="{{ old('ordre', $categorieDocument->ordre) }}"
                                           min="0">
                                    @error('ordre')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="mb-3">
                                <label for="description" class="form-label fw-bold">
                                    <i class="bi bi-text-paragraph me-2"></i>Description
                                </label>
                                <textarea class="form-control @error('description') is-invalid @enderror"
                                          id="description"
                                          name="description"
                                          rows="3">{{ old('description', $categorieDocument->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Statut -->
                            <div class="mb-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input"
                                           type="checkbox"
                                           id="active"
                                           name="active"
                                           value="1"
                                           {{ old('active', $categorieDocument->active) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-bold" for="active">
                                        <i class="bi bi-toggle-on me-2"></i>Catégorie active
                                    </label>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('admin.categories-documents.index') }}" class="btn btn-outline-secondary rounded-3 px-4">
                                    <i class="bi bi-arrow-left me-2"></i>Retour
                                </a>
                                <button type="submit" class="btn btn-primary rounded-3 px-4">
                                    <i class="bi bi-check-lg me-2"></i>Mettre à jour
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-light-subtle {
        background-color: #f8f9fa;
    }

    .rounded-4 {
        border-radius: 1rem !important;
    }
</style>
@endsection
