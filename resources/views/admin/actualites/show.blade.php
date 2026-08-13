@extends('admin.layouts.app')
@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Les Actualités</h1>
        {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">{{ $actualite->categorie->libelle }}</h6>
        </div>
        <div class="card-body">
            <h5><b>{{ $actualite->titre }}</b></h5>
            <div class="row">
                <img class="img-fluid" src="{{ asset('mairie/public/uploads/actualites/' . $actualite->image) }}">
            </div>
            <p>{!! $actualite->contenu !!}</p>
            <p><i class="fas fa-calendar"></i> Publié le {{ \Carbon\Carbon::parse($actualite->date_publication)->translatedFormat('d F Y') }}</p>

            <div class="text-center mt-5">
                <a type="button" href="{{route('admin.actualites.index')}}" class="btn btn-secondary" type="submit"><i class="fas fa-arrow-left"></i> Retour</a>
                <a type="button" href="{{ route('admin.actualites.edit',$actualite->id) }}" class="btn btn-primary"><i class="fas fa-edit"></i> Modifier</a>
            </div>
        </div>
    </div>

@endsection

