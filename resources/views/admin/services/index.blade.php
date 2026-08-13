@extends('admin.layouts.app')
@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Les Services</h1>
        {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Gestion des Services</h6>
                <a href="{{route('admin.categorie_services.index')}}" class="btn btn-success"><i class="fas fa-list"></i> Catégorie des Services</a>
                <a href="{{route('admin.services.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Ajouter</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Titre</th>
                            <th>Catégorie</th>
                            <th>Coût</th>
                            <th>Pièces à fournir</th>
                            <th width="200">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($services as $service)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if ($service->image)
                                    <img src="{{ asset('uploads/services/' . $service->image) }}" alt="image" class="service-image">
                                @else
                                    <span class="text-muted fst-italic">Aucune</span>
                                @endif
                            </td>
                            <td>{{ $service->titre }}</td>
                            <td>{{ $service->categorie->libelle }}</td>
                            <td>{{ number_format($service->cout, 0, ',', ' ') }} FCFA</td>
                            <td>{!! $service->pieces_fournir !!}</td>
                            <td class="text-center">
                                <a class="btn btn-success" href="{{ route('admin.services.show', $service->id) }}"><i class="fas fa-eye"></i></a>
                                <a class="btn btn-primary" href="{{ route('admin.services.edit', $service->id) }}"><i class="fas fa-edit"></i></a>
                                <a class="btn btn-danger delete-item" href="{{ route('admin.services.destroy', $service->id) }}"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">Aucun service enregistré</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            @if($services->hasPages())
                <div class="mt-4">
                    {!! $services->withQueryString()->links('pagination::bootstrap-5') !!}
                </div>
            @endif
        </div>
    </div>

@endsection

