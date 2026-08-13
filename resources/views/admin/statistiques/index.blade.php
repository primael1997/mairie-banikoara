@extends('admin.layouts.app')

@section('content')
<style>
    .dashboard-container {
        background-color: #f8f9fa;
        padding: 2rem 0;
    }

    .stat-card {
        background: #fff;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        margin-bottom: 1.5rem;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: 1px solid rgba(0, 0, 0, 0.03);
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
    }

    .section-title {
        font-weight: 700;
        font-size: 1.8rem;
        color: #2c3e50;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .chart-container {
        position: relative;
        width: 100%;
        min-height: 300px;
    }

    .chart-header {
        font-weight: 600;
        color: #34495e;
        margin-bottom: 1rem;
        text-align: center;
        font-size: 1.1rem;
    }

    .filter-form {
        background: #fff;
        padding: 0.75rem 1rem;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .filter-form .form-control {
        border-radius: 8px;
        padding: 0.5rem 1rem;
        border: 1px solid #e0e0e0;
    }

    .filter-form button {
        border-radius: 8px;
        padding: 0.5rem 1.25rem;
        font-weight: 500;
    }

    .table-container {
        background: #fff;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }

    .table th {
        background-color: #2c3e50;
        color: white;
        font-weight: 500;
        padding: 0.75rem 1rem;
    }

    .table td {
        padding: 0.75rem 1rem;
        vertical-align: middle;
    }

    .pagination {
        justify-content: center;
    }

    .empty-state {
        padding: 2rem;
        text-align: center;
        color: #7f8c8d;
    }

    @media (max-width: 768px) {
        .section-title {
            font-size: 1.5rem;
        }

        .filter-form {
            flex-direction: column;
            gap: 0.75rem;
        }
    }
</style>

<div class="dashboard-container">
    <div class="container">
        <!-- Header Section -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
            <div>
                <h2 class="section-title">
                    <i class="bi bi-speedometer2"></i> Tableau de bord analytique
                </h2>
                <p class="text-muted mb-0">Visualisation des données de trafic et des performances</p>
            </div>

            <form method="GET" class="filter-form d-flex flex-wrap gap-2 align-items-center">
                <div class="d-flex align-items-center gap-2">
                    <input type="date" name="start" value="{{ request('start') }}" class="form-control">
                    <span class="text-muted">à</span>
                    <input type="date" name="end" value="{{ request('end') }}" class="form-control">
                </div>
                <button class="btn btn-primary d-flex align-items-center gap-2">
                    <i class="bi bi-funnel"></i> Filtrer
                </button>
            </form>
        </div>

        <!-- Charts Section -->
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="stat-card">
                    <h5 class="chart-header">
                        <i class="bi bi-globe me-2"></i>Visites par pays
                    </h5>
                    <div class="chart-container">
                        <canvas id="chartPays"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="stat-card">
                    <h5 class="chart-header">
                        <i class="bi bi-browser-chrome me-2"></i>Navigateurs
                    </h5>
                    <div class="chart-container">
                        <canvas id="chartNavigateurs"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="stat-card">
                    <h5 class="chart-header">
                        <i class="bi bi-laptop me-2"></i>Plateformes
                    </h5>
                    <div class="chart-container">
                        <canvas id="chartPlateformes"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="stat-card">
                    <h5 class="chart-header">
                        <i class="bi bi-phone me-2"></i>Appareils
                    </h5>
                    <div class="chart-container">
                        <canvas id="chartDevices"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 col-md-12">
                <div class="stat-card">
                    <h5 class="chart-header">
                        <i class="bi bi-file-earmark-text me-2"></i>Pages consultées
                    </h5>
                    <div class="chart-container">
                        <canvas id="chartPages"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Table Section -->
        <div class="table-container mt-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0 d-flex align-items-center">
                    <i class="bi bi-table me-2"></i>Détail des visites
                </h5>
                <div class="text-muted small">
                    Affichage de {{ $visites->firstItem() }} à {{ $visites->lastItem() }} sur {{ $visites->total() }} résultats
                </div>
            </div>

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
                    {{ $visites->withQueryString()->onEachSide(1)->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

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
@endsection
