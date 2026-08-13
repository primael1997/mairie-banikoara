@extends('admin.layouts.app')
@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Les Entités</h1>
        {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Gestion des Entitées</h6>
            <a href="#" data-toggle="modal" data-target="#AddEntiteModal" class="btn btn-primary"><i class="fas fa-plus"></i> Ajouter</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Type</th>
                            <th>Membres</th>
                            <th class="text-center" width="200">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($entites as $entite)
                            <tr>
                                <td>{{ $entite->nom }}</td>
                                <td>{{ $entite->type }}</td>
                                <td>{{ $entite->membres_count }}</td>
                                <td class="text-center">
                                    <a class="btn btn-primary" data-toggle="modal" data-target="#EditEntiteModal-{{$entite->id}}"><i class="fas fa-edit"></i></a>
                                    <a class="btn btn-danger delete-item" href="{{ route('admin.entites.destroy', $entite) }}"><i class="fas fa-trash"></i></a>
                                </td>

                                <!--Edit Entite Modal-->
                                <div class="modal fade" id="EditEntiteModal-{{$entite->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel"><b>Ajouter une entité</b></h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('admin.entites.update',$entite) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <label for="nom">Nom <b><span class="text-danger">*</span></b></label>
                                                        <input type="text" name="nom" id="nom" value="{{ $entite->nom }}" class="form-control">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="description">Description <b><span class="text-danger">*</span></b></label>
                                                        <textarea name="description" id="description" rows="8" class="form-control">{{ $entite->description }}</textarea>
                                                    </div>

                                                    <div class="mb-4">
                                                        <label for="type">Type <b><span class="text-danger">*</span></b></label>
                                                        <select name="type" id="type" class="form-control">
                                                            <option value="">Sélectionner...</option>
                                                            <option value="conseil" {{ $entite->type == 'conseil' ? 'selected' : '' }}>Conseil</option>
                                                            <option value="commission" {{ $entite->type == 'commission' ? 'selected' : '' }}>Commission</option>
                                                            <option value="delegation" {{ $entite->type == 'delegation' ? 'selected' : '' }}>Délégation</option>
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

        </div>
    </div>


<!--Add Entite Modal-->
<div class="modal fade" id="AddEntiteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><b>Ajouter une entité</b></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.entites.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nom">Nom <b><span class="text-danger">*</span></b></label>
                        <input type="text" name="nom" id="nom" value="{{ old('nom') }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="description">Description <b><span class="text-danger">*</span></b></label>
                        <textarea name="description" id="description" rows="4" class="form-control">{{ old('description') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="type">Type <b><span class="text-danger">*</span></b></label>
                        <select name="type" id="type" class="form-control">
                            <option value="">Sélectionner...</option>
                            <option value="conseil" {{ old('type') == 'conseil' ? 'selected' : '' }}>Conseil</option>
                            <option value="commission" {{ old('type') == 'commission' ? 'selected' : '' }}>Commission</option>
                            <option value="delegation" {{ old('type') == 'delegation' ? 'selected' : '' }}>Délégation</option>
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


