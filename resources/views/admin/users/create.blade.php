@extends('admin.layouts.app')
@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Les Utilisateurs</h1>
        {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Créer un nouveau utilisateur</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label"><b>Nom Complet <span class="text-danger">* </span>:</b></label>
                    <div class="col-sm-10">
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="inputEmail3" placeholder="Nom et Prénoms">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label"><b>Email <span class="text-danger">* </span>:</b></label>
                    <div class="col-sm-10">
                        <input type="text" name="email" value="{{ old('email') }}" class="form-control" id="inputEmail3" placeholder="Email">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label"><b>Télephone <span class="text-danger">* </span>:</b></label>
                    <div class="col-sm-10">
                        <input type="text" name="phone" value="{{ old('phone') }}" class="form-control" id="inputEmail3" placeholder="Télephone">
                    </div>
                </div>

                <div class="text-center mt-5">
                    <a type="button" href="{{route('admin.users.index')}}" class="btn btn-secondary" type="submit"><i class="fas fa-arrow-left"></i> Retour</a>
                    <button class="btn btn-primary" type="submit"><i class="fas fa-plus"></i> Ajouter</button>
                </div>
            </form>
        </div>
    </div>

@endsection


