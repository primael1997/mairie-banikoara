@extends('admin.layouts.app')
@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Les Anciens Maire</h1>
        {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Liste des Anciens Membres</h6>
            <a href="#" data-toggle="modal" data-target="#addMaire" class="btn btn-success"><i class="fas fa-plus"></i> Ajouter</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Photo</th>
                            <th>Nom</th>
                            <th>Mandat</th>
                            <th>Biographie</th>
                            <th width="200">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($anciens_maires as $key=>$maire)
                            <tr>
                                <td>{{++$key}}</td>
                                <td>
                                    @if ($maire->photo)
                                        <img src="{{ asset($maire->photo) }}" alt="Photo" class="maire-photo" width="75px">
                                    @else
                                        <span class="text-muted fst-italic">Aucune Photo</span>
                                    @endif
                                </td>
                                <td>{{ $maire->nom }}</td>
                                <td><b>{{ $maire->mandat }}</b></td>
                                <td>{{ \Illuminate\Support\Str::limit($maire->biographie, 80) }}</td>
                                <td class="text-center">
                                    <a class="btn btn-primary" data-toggle="modal" data-target="#editMaire-{{$maire->id}}" href="#"><i class="fas fa-edit"></i></a>
                                    <a class="btn btn-danger delete-item" href="{{ route('admin.anciens_maires.destroy', $maire->id) }}"><i class="fas fa-trash"></i></a>
                                </td>

                                <!-- Edit Maire Modal-->
                                <div class="modal fade" id="editMaire-{{$maire->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel"><b>Ajouter un ancien maire</b></h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('admin.anciens_maires.update',$maire->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    @if ($maire->photo)
                                                        <img src="{{ asset($maire->photo) }}" alt="Photo actuelle" width="95px">
                                                    @endif
                                                    <div class="form-group">
                                                        <label for="nom">Photo <b><span class="text-danger">*</span></b></label>
                                                        <input type="file" name="photo" id="photo" class="form-control" accept="image/*">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nom">Nom <b><span class="text-danger">*</span></b></label>
                                                        <input type="text" name="nom" id="nom" value="{{ old('nom', $maire->nom) }}" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nom">Mandat <b><span class="text-danger">*</span></b></label>
                                                        <input type="text" name="mandat" id="mandat" value="{{ old('mandat', $maire->mandat) }}" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="description">Biographie <b><span class="text-danger">*</span></b></label>
                                                        <textarea name="biographie" id="biographie" rows="5" class="form-control">{{ old('biographie', $maire->biographie) }}</textarea>
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
                                <td colspan="4">Aucun ancien maire enregistré</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

<!-- Add Maire Modal-->
<div class="modal fade" id="addMaire" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><b>Ajouter un ancien maire</b></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.anciens_maires.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nom">Photo <b><span class="text-danger">*</span></b></label>
                        <input type="file" name="photo" id="photo" class="form-control" accept="image/*">
                    </div>
                    <div class="form-group">
                        <label for="nom">Nom <b><span class="text-danger">*</span></b></label>
                        <input type="text" name="nom" id="nom" value="{{ old('nom') }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nom">Mandat <b><span class="text-danger">*</span></b></label>
                        <input type="text" name="mandat" id="mandat" value="{{ old('mandat') }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="description">Biographie <b><span class="text-danger">*</span></b></label>
                        <textarea name="biographie" id="biographie" rows="5" class="form-control">{{ old('biographie') }}</textarea>
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

