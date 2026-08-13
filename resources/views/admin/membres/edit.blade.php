@extends('admin.layouts.app')
@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Le Maire et les Elus</h1>
        {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Modification des Membres</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.membres.update', $membre->id) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-6">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-form-label"><b>Nom au Complet <span class="text-danger">* </span>:</b></label>
                            <input type="text" name="nom" value="{{ old('nom', $membre->nom) }}" class="form-control" id="inputEmail3" placeholder="Email">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-form-label"><b>Email <span class="text-danger">* </span>:</b></label>
                            <input type="text" name="email" value="{{ old('email', $membre->email) }}" class="form-control" id="inputEmail3" placeholder="Email">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-form-label"><b>Poste<span class="text-danger">* </span>:</b></label>
                            <input type="text" name="poste" value="{{ old('poste', $membre->poste) }}"  class="form-control" id="inputEmail3" placeholder="Email">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-form-label"><b>Ordre d'affichage   <span class="text-danger">* </span>:</b></label>
                            <select name="ordre" class="form-control">
                                <option {{ $membre->ordre == 1 ? 'selected' : '' }} value="1"> 1</option>
                                <option {{ $membre->ordre == 2 ? 'selected' : '' }} value="2"> 2</option>
                                <option {{ $membre->ordre == 3 ? 'selected' : '' }} value="3"> 3</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-form-label"><b>Niveau hiérarchique<span class="text-danger">* </span>:</b></label>
                            <select name="niveau" class="form-control">
                                @for($i = 1; $i <= 6; $i++)
                                    <option value="{{ $i }}" {{ (old('niveau') ?? $membre->niveau) == $i ? 'selected' : '' }}>
                                        Niveau {{ $i }} - @switch($i)
                                            @case(1) Maire @break
                                            @case(2) Adjoints @break
                                            @case(3) Chefs d'arrondissement @break
                                            @case(4) Présidents de commission @break
                                            @case(5) Conseillers @break
                                            @default Équipe municipale
                                        @endswitch
                                    </option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-form-label"><b>Photo<span class="text-danger">* </span>:</b></label>
                            <input type="file" name="photo" accept="image/*"  class="form-control" id="inputEmail3" placeholder="Email">
                        </div>
                    </div>
                </div>
                <hr>
                <h5 class="mt-4 mb-2">Affectation aux entités</h5>
                @if($entites->isEmpty())
                    <div class="text-center">
                        <p class="text-black-700">Aucune entité disponible. <br>
                        <a href="{{ route('entites.create') }}" type="button" class="btn btn-primary">Créer une entité</a></p>
                    </div>
                @else
                    <div class="row">
                        @foreach($entites as $entite)
                            <div class="col-sm-6 mt-2">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <input type="checkbox" name="entites[]" value="{{ $entite->id }}" id="entite_{{ $entite->id }}"
                                            @if(in_array($entite->id, old('entites', $membre->entites->pluck('id')->toArray()))) checked @endif> {{ $entite->nom }}
                                        </span>
                                    </div>
                                    <input type="text" name="roles[{{ $entite->id }}]"
                                        class="form-control" placeholder="Rôle (Optionnel)"
                                        value="{{ old('roles.'.$entite->id, $membre->entites->find($entite->id)->pivot->role ?? '') }}">
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
                <div class="mt-4">
                    <a type="button" href="{{route('admin.membres.index')}}" class="btn btn-secondary" type="submit"><i class="fas fa-arrow-left"></i> Retour</a>
                    <button class="btn btn-primary" type="submit"><i class="fas fa-edit"></i> Modifier</button>
                </div>
            </form>
        </div>
    </div>

@endsection
