@extends('admin.layouts.app')
@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Le mot du Maire</h1>
        {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Modifier le mot du Maire</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.mot-du-maire.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @if($mot->photo)
                    <img src="{{ asset('uploads/'.$mot->photo) }}" alt="Photo actuelle" width="150" class="img-fluid mb-2"> <br>
                @endif
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Photo actuelle :</label>
                   <div class="col-sm-10">
                        <input type="file" name="photo" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label"><b>Nom au Complet <span class="text-danger">* </span>:</b></label>
                    <div class="col-sm-10">
                        <input type="text" name="nom" value="{{ old('nom', $mot->nom) }}" class="form-control" id="inputEmail3" placeholder="Nom au complet">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label"><b>Titre <span class="text-danger">* </span>:</b></label>
                    <div class="col-sm-10">
                        <input type="text" name="titre" value="{{ old('titre', $mot->titre) }}" class="form-control" id="inputEmail3" placeholder="Titre">
                    </div>
                </div>
                <div class="row">
                <label for="inputEmail3" class="col-sm-2 col-form-label"><b>Message<span class="text-danger">* </span>:</b></label>
                    <div class="col-sm-10">
                        <textarea name="message_1" id="message" rows="4" class="form-control" required>{{ old('message_1', $mot->message_1) }}</textarea>
                    </div>
                </div>

                <div class="text-center mt-5">
                    <a type="button" href="{{route('dashboard')}}" class="btn btn-secondary" type="submit"><i class="fas fa-arrow-left"></i> Retour</a>
                    <button class="btn btn-primary" type="submit"><i class="fas fa-edit"></i> Modifier</button>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#message').summernote();
        });
    </script>
@endpush
