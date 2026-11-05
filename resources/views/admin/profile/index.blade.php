@extends('admin.layouts.app')
@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Profile</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-6 col-lg-6">

            <!-- Area Chart -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informations Personnelles</h6>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.profile.update')}}" method="POST">
                        @csrf

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Nom au Complet :</label>
                            <div class="col-sm-8">
                                <input type="text" name="name" class="form-control" value="{{$user->name}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Email :</label>
                            <div class="col-sm-8">
                                <input type="email" name="email" class="form-control" value="{{$user->email}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Télephone :</label>
                            <div class="col-sm-8">
                                <input type="text" name="email" class="form-control" value="{{$user->telephone}}">
                            </div>
                        </div>
                        <div class="text-center mt-5">
                            <button class="btn btn-primary" type="submit"><i class="fas fa-edit"></i> Modifier</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

        <div class="col-xl-6 col-lg-6">
            <!-- Donut Chart -->
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Changement du mot de passe</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <form action="{{route('admin.password.update')}}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Mot de passe actuel :</label>
                            <div class="col-sm-8">
                                <input type="password" name="current_password" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Nouveau Mot de passe :</label>
                            <div class="col-sm-8">
                                <input type="password" name="password" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Confirmation Mot de passe :</label>
                            <div class="col-sm-8">
                                <input type="password" name="password_confirmation" class="form-control">
                            </div>
                        </div>
                        <div class="text-center mt-5">
                            <button class="btn btn-primary" type="submit"><i class="fas fa-edit"></i> Modifier</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection
