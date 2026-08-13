@extends('admin.layouts.app')
@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Le Sécretariat Exécutif</h1>
        {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Modification des Membres</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.secretariat.update', $membre->id) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-6">
                @csrf
                @method('PUT')
                @if($membre->photo)
                    <img class="img-fluid" src="{{ asset($membre->photo) }}" width="150px">
                @else
                    <img class="img-fluid" src="{{ asset('admin/img/undraw_profile.svg') }}">
                @endif
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-form-label"><b>Photo<span class="text-danger">* </span>:</b></label>
                            <input type="file" name="photo" accept="image/*"  class="form-control" id="inputEmail3" placeholder="Email">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-form-label"><b>Nom au Complet <span class="text-danger">* </span>:</b></label>
                            <input type="text" name="nom" value="{{ old('nom', $membre->nom) }}" class="form-control" id="inputEmail3" placeholder="Email">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-form-label"><b>Contact<span class="text-danger">* </span>:</b></label>
                            <input type="text" name="contact" value="{{ $membre->contact }}" class="form-control" id="inputEmail3" placeholder="Contact">
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
                            <label for="inputEmail3" class="col-form-label"><b>Niveau<span class="text-danger">* </span>:</b></label>
                            <select name="niveau" class="form-control">
                                <option {{ $membre->ordre == 1 ? 'selected' : '' }} value="1"> 1</option>
                                <option {{ $membre->ordre == 2 ? 'selected' : '' }} value="2"> 2</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-form-label"><b>Ordre d'affichage   <span class="text-danger">* </span>:</b></label>
                            <select name="ordre" class="form-control">
                                <option {{ $membre->ordre == 1 ? 'selected' : '' }} value="1"> 1</option>
                                <option {{ $membre->ordre == 2 ? 'selected' : '' }} value="2"> 2</option>
                                <option {{ $membre->ordre == 3 ? 'selected' : '' }} value="3"> 3</option>
                                <option {{ $membre->ordre == 4 ? 'selected' : '' }} value="4"> 4</option>
                                <option {{ $membre->ordre == 5 ? 'selected' : '' }} value="5"> 5</option>
                                <option {{ $membre->ordre == 6 ? 'selected' : '' }} value="6"> 6</option>
                                <option {{ $membre->ordre == 7 ? 'selected' : '' }} value="7"> 7</option>
                                <option {{ $membre->ordre == 8 ? 'selected' : '' }} value="8"> 8</option>
                                <option {{ $membre->ordre == 9 ? 'selected' : '' }} value="9"> 9</option>
                                <option {{ $membre->ordre == 10 ? 'selected' : '' }} value="10"> 10</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-form-label"><b>Attribution<span class="text-danger">* </span>:</b></label>
                            <textarea id="summernote" name="attributions" rows="6" class="form-control" id="inputEmail3">{{ $membre->attributions }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <a type="button" href="{{route('admin.secretariat.index')}}" class="btn btn-secondary" type="submit"><i class="fas fa-arrow-left"></i> Retour</a>
                    <button class="btn btn-primary" type="submit"><i class="fas fa-edit"></i> Modifier</button>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>
@endpush
