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
            <h6 class="m-0 font-weight-bold text-primary">Liste des Evenements</h6>
            <a href="{{route('admin.evenements.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Ajouter</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Titre</th>
                            <th>Date</th>
                            <th width="200">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($events as $event)
                        <tr>
                            <td>
                                <img class="img-fluid"
                                    src="{{ asset($event->image) }}"
                                    alt="{{ $event->image }}" width="95px">
                            </td>
                            <td>{{ $event->titre }}</td>
                            <td><b>{{ $event->date->format('d/m/Y') }}</b></td>

                            <td class="text-center">
                                <a class="btn btn-success" href="{{ route('admin.evenements.edit',$event->id) }}"><i class="fas fa-edit"></i></a>
                                <a class="btn btn-danger delete-item" href="{{ route('admin.evenements.destroy', $event->id) }}"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="4">Aucun évenement enregistré</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            @if($events->hasPages())
                <div class="mt-4">
                    {!! $events->withQueryString()->links('pagination::bootstrap-5') !!}
                </div>
            @endif
        </div>
    </div>

@endsection

