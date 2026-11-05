@extends('admin.layouts.app')
@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tableau de board analytique</h1>
        {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Elus Municipaux</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$elus}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Services</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$services}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Actualités
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$posts}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Utilisateurs</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$users}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Visualisation des données de trafic et des performances</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                      {{-- <form method="GET">
                        <input type="date" name="start" value="{{ request('start') }}" class="form-control">
                        <span class="text-muted">à</span>
                        <input type="date" name="end" value="{{ request('end') }}" class="form-control">
                        <button class="btn btn-primary">
                            <i class="bi bi-funnel"></i> Filtrer
                        </button>
                    </form> --}}
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="chartPays"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Navigateurs</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="chartNavigateurs"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-6 mb-4">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Plateformes</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="chartPlateformes"></canvas>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-lg-6 mb-4">

            <!-- Illustrations -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Appareils</h6>
                </div>
                <div class="card-body">
                    <div class="chart-bar">
                        <canvas id="chartDevices"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-xl-12">

            <!-- Area Chart -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Page Consultés</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="chartPages"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 mb-4">
            <!-- Approach -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Détail des visites de {{ $visites->firstItem() }} à {{ $visites->lastItem() }} sur {{ $visites->total() }} résultats</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Page</th>
                                    <th>Pays</th>
                                    <th>Ville</th>
                                    <th>IP</th>
                                    <th>Appareil</th>
                                    <th>Navigateur</th>
                                    <th>Plateforme</th>
                                    <th>Référent</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($visites as $v)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($v->visited_at)->format('d/m/Y H:i') }}</td>
                                        <td class="text-truncate" style="max-width: 200px;" title="{{ $v->url }}">{{ $v->url }}</td>
                                        <td>{{ $v->country ?? 'Inconnu' }}</td>
                                        <td>{{ $v->city ?? 'Inconnue' }}</td>
                                        <td>{{ $v->ip_address }}</td>
                                        <td>{{ $v->device }}</td>
                                        <td>{{ $v->browser }}</td>
                                        <td>{{ $v->platform }}</td>
                                        <td class="text-truncate" style="max-width: 150px;" title="{{ $v->referrer }}">
                                            {{ $v->referrer ? parse_url($v->referrer, PHP_URL_HOST) : '-' }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="empty-state">
                                            <i class="bi bi-exclamation-circle display-5"></i>
                                            <p class="mt-3">Aucune visite trouvée pour cette période</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($visites->hasPages())
                        <div class="d-flex justify-content-center mt-4">
                            {!! $visites->withQueryString()->links('pagination::bootstrap-5') !!}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>



    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Colors configuration
                const colors = {
                    primary: '#3498db',
                    success: '#2ecc71',
                    warning: '#f39c12',
                    danger: '#e74c3c',
                    info: '#1abc9c',
                    secondary: '#95a5a6'
                };

                // Common chart options
                const chartOptions = {
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                usePointStyle: true,
                            }
                        },
                        tooltip: {
                            backgroundColor: '#2c3e50',
                            titleFont: { size: 14 },
                            bodyFont: { size: 12 },
                            padding: 12,
                            cornerRadius: 8
                        }
                    }
                };

                // Visits by Country Chart
                new Chart(document.getElementById('chartPays'), {
                    type: 'bar',
                    data: {
                        labels: {!! json_encode($visitesParPays->pluck('country')) !!},
                        datasets: [{
                            label: 'Visites',
                            data: {!! json_encode($visitesParPays->pluck('total')) !!},
                            backgroundColor: colors.primary,
                            borderRadius: 6
                        }]
                    },
                    options: {
                        ...chartOptions,
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: { drawBorder: false }
                            },
                            x: {
                                grid: { display: false }
                            }
                        }
                    }
                });

                // Browsers Chart
                new Chart(document.getElementById('chartNavigateurs'), {
                    type: 'doughnut',
                    data: {
                        labels: {!! json_encode($navigateurs->pluck('browser')) !!},
                        datasets: [{
                            data: {!! json_encode($navigateurs->pluck('total')) !!},
                            backgroundColor: [
                                colors.primary,
                                colors.success,
                                colors.warning,
                                colors.danger,
                                colors.info,
                                colors.secondary
                            ],
                            borderWidth: 0
                        }]
                    },
                    options: {
                        ...chartOptions,
                        cutout: '70%'
                    }
                });

                // Platforms Chart
                new Chart(document.getElementById('chartPlateformes'), {
                    type: 'pie',
                    data: {
                        labels: {!! json_encode($plateformes->pluck('platform')) !!},
                        datasets: [{
                            data: {!! json_encode($plateformes->pluck('total')) !!},
                            backgroundColor: [
                                colors.primary,
                                colors.success,
                                colors.warning,
                                colors.danger
                            ],
                            borderWidth: 0
                        }]
                    },
                    options: chartOptions
                });

                // Devices Chart
                new Chart(document.getElementById('chartDevices'), {
                    type: 'bar',
                    data: {
                        labels: {!! json_encode($devices->pluck('device')) !!},
                        datasets: [{
                            label: 'Appareils',
                            data: {!! json_encode($devices->pluck('total')) !!},
                            backgroundColor: colors.info,
                            borderRadius: 6
                        }]
                    },
                    options: {
                        ...chartOptions,
                        indexAxis: 'y',
                        scales: {
                            x: { beginAtZero: true, grid: { drawBorder: false } },
                            y: { grid: { display: false } }
                        }
                    }
                });

                // Pages Chart
                new Chart(document.getElementById('chartPages'), {
                    type: 'bar',
                    data: {
                        labels: {!! json_encode($pages->pluck('url')) !!},
                        datasets: [{
                            label: 'Visites',
                            data: {!! json_encode($pages->pluck('total')) !!},
                            backgroundColor: colors.primary,
                            borderRadius: 6
                        }]
                    },
                    options: {
                        ...chartOptions,
                        scales: {
                            y: { beginAtZero: true, grid: { drawBorder: false } },
                            x: { grid: { display: false } }
                        }
                    }
                });
            });
        </script>
    @endpush

@endsection
