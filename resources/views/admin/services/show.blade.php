@extends('admin.layouts.app')
@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Description du service</h1>
        {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Description du service</h6>
        </div>
        <div class="card-body">
            <div class="container">
                <h1>{{ $service->titre }}</h1>
                <p><strong>Description :</strong> {{ $service->description }}</p>
                <p><strong>Coût :</strong> {{ number_format($service->cout, 2, ',', ' ') }} FCFA</p>
                <p><strong>Pièces à fournir :</strong> {!! $service->pieces_fournir !!}</p>

                @if($service->image)
                    <div>
                        <img src="{{ asset('uploads/' . $service->image) }}" alt="{{ $service->titre }}" class="img-fluid">
                    </div>
                @endif

                <a href="{{ route('admin.services.index') }}" class="btn btn-secondary mt-3"><i class="fas fa-arrow-left"></i> Retour à la liste</a>
                <a href="{{ route('admin.services.index') }}" type="button" class="btn btn-primary mt-3"><i class="fas fa-edit"></i> Modifier</a>
            </div>
        </div>
    </div>
@endsection
