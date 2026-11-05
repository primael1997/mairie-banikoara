@extends('admin.layouts.app')
@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Gestion des Evenements</h1>
        {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Modifier un évenement</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.evenements.update',$event->id) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-6">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="nom">Titre de l'évenement <b><span class="text-danger">* </span>:</b></label>
                    <div class="col-sm-10">
                        <input type="text" name="titre" class="form-control" value="{{ $event->titre }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label"><b>Date de l'Evenement <span class="text-danger">* </span>:</b></label>
                    <div class="col-sm-4">
                        <input type="date" name="date" value="{{ $event->date->format('Y-m-d') }}" class="form-control">
                    </div>
                    <label for="inputEmail3" class="col-sm-2 col-form-label"><b>Image l'Evenement <span class="text-danger">* </span>:</b></label>
                    <div class="col-sm-4">
                        <input type="file" name="image" class="form-control">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="nom">Status de l'évenement <b><span class="text-danger">* </span>:</b></label>
                    <div class="col-sm-10">
                        <select name="status" class=" form-control">
                            <option {{ $event->status == 'a_venir' ? 'selected' : ''}} value="a_venir">-- A venir --</option>
                            <option {{ $event->status == 'cloturer' ? 'selected' : ''}} value="cloturer">-- Cloturer --</option>
                        </select>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <button class="btn btn-primary" type="submit"><i class="fas fa-edit"></i> Modifier</button>
                </div>
            </form>
        </div>
    </div>
@endsection

