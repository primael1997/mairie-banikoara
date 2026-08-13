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
            <h6 class="m-0 font-weight-bold text-primary">Ajout des Membres</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.secretariat.store') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-6">
                @csrf

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
                            <input type="text" name="nom" value="{{ old('nom') }}" class="form-control" id="inputEmail3" placeholder="Nom au complet">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-form-label"><b>Contact<span class="text-danger">* </span>:</b></label>
                            <input type="text" name="contact" value="{{ old('contact') }}" class="form-control" id="inputEmail3" placeholder="Contact">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-form-label"><b>Email <span class="text-danger">* </span>:</b></label>
                            <input type="text" name="email" value="{{ old('email') }}" class="form-control" id="inputEmail3" placeholder="Email">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-form-label"><b>Poste<span class="text-danger">* </span>:</b></label>
                            <input type="text" name="poste" value="{{ old('poste') }}"  class="form-control" id="inputEmail3" placeholder="Email">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-form-label"><b>Niveau<span class="text-danger">* </span>:</b></label>
                            <select name="niveau" class="form-control">
                                <option value="1"> 1</option>
                                <option value="2"> 2</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-form-label"><b>Ordre d'affichage   <span class="text-danger">* </span>:</b></label>
                            <select name="ordre" class="form-control">
                                <option value="1"> 1</option>
                                <option value="2"> 2</option>
                                <option value="3"> 3</option>
                                <option value="4"> 4</option>
                                <option value="5"> 5</option>
                                <option value="6"> 6</option>
                                <option value="7"> 7</option>
                                <option value="8"> 8</option>
                                <option value="9"> 9</option>
                                <option value="10"> 10</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-form-label"><b>Attribution<span class="text-danger">* </span>:</b></label>
                            <textarea id="summernote" name="attributions" rows="6" class="form-control" id="inputEmail3"></textarea>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <a type="button" href="{{route('admin.secretariat.index')}}" class="btn btn-secondary" type="submit"><i class="fas fa-arrow-left"></i> Retour</a>
                    <button class="btn btn-primary" type="submit"><i class="fas fa-edit"></i> Ajouter</button>
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
