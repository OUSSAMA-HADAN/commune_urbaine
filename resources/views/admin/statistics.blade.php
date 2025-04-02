<x-master>
    @section('main')
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Statistiques</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
        <!-- Chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <style>
            .stats-card {
                background-color: white;
                border-radius: 10px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                padding: 1.5rem;
                margin-bottom: 1.5rem;
                transition: transform 0.3s ease;
            }
            
            .stats-card:hover {
                transform: translateY(-5px);
            }
            
            .stats-icon {
                width: 48px;
                height: 48px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-bottom: 1rem;
            }
            
            .icon-primary {
                background-color: #e8f4fd;
                color: #0d6efd;
            }
            
            .icon-success {
                background-color: #e8f5e9;
                color: #4caf50;
            }
            
            .icon-warning {
                background-color: #fff8e1;
                color: #ffa000;
            }
            
            .icon-danger {
                background-color: #ffebee;
                color: #f44336;
            }
            
            .stats-title {
                font-size: 14px;
                font-weight: 600;
                color: #6c757d;
                margin-bottom: 0.5rem;
            }
            
            .stats-value {
                font-size: 24px;
                font-weight: 700;
                color: #344767;
                margin-bottom: 0.5rem;
            }
            
            .chart-container {
                background-color: white;
                border-radius: 10px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                padding: 1.5rem;
                margin-bottom: 1.5rem;
            }
            
            .chart-title {
                font-size: 18px;
                font-weight: 600;
                color: #344767;
                margin-bottom: 1rem;
            }
            
            .recent-activity {
                background-color: white;
                border-radius: 10px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                padding: 1.5rem;
                margin-bottom: 1.5rem;
            }
            
            .activity-item {
                padding: 10px 0;
                border-bottom: 1px solid #f0f0f0;
            }
            
            .activity-item:last-child {
                border-bottom: none;
            }
            
            .status-badge {
                padding: 4px 10px;
                border-radius: 20px;
                font-size: 12px;
                font-weight: 600;
            }
            
            .status-attend {
                background-color: #fff8e1;
                color: #ffa000;
            }
            
            .status-completed {
                background-color: #e8f5e9;
                color: #4caf50;
            }
            
            .status-pending {
                background-color: #fff7e0;
                color: #ff9800;
            }
        </style>
    </head>
    <body>
        <div class="container mt-4">
            <h2 class="mb-4">Tableau de Bord - Statistiques</h2>
            
            <!-- Stats Overview Cards -->
            <div class="row">
                <div class="col-md-3">
                    <div class="stats-card">
                        <div class="stats-icon icon-primary">
                            <i class="bi bi-clipboard-check fs-4"></i>
                        </div>
                        <div class="stats-title">Ordres de Mission</div>
                        <div class="stats-value">{{ $totalOrders }}</div>
                        <div class="stats-description text-muted">Total des ordres créés</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card">
                        <div class="stats-icon icon-success">
                            <i class="bi bi-file-text fs-4"></i>
                        </div>
                        <div class="stats-title">Rapports</div>
                        <div class="stats-value">{{ $totalReports }}</div>
                        <div class="stats-description text-muted">Rapports soumis</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card">
                        <div class="stats-icon icon-warning">
                            <i class="bi bi-people fs-4"></i>
                        </div>
                        <div class="stats-title">Fonctionnaires</div>
                        <div class="stats-value">{{ $totalFonctionnaires }}</div>
                        <div class="stats-description text-muted">Utilisateurs actifs</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card">
                        <div class="stats-icon icon-danger">
                            <i class="bi bi-person-badge fs-4"></i>
                        </div>
                        <div class="stats-title">Utilisateurs</div>
                        <div class="stats-value">{{ $totalUsers }}</div>
                        <div class="stats-description text-muted">Tous utilisateurs</div>
                    </div>
                </div>
            </div>
            
            <!-- Charts Row -->
            <div class="row">
                <div class="col-md-8">
                    <div class="chart-container">
                        <h4 class="chart-title">Ordres de Mission par Mois ({{ date('Y') }})</h4>
                        <canvas id="monthlyOrdersChart"></canvas>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="chart-container">
                        <h4 class="chart-title">État des Remboursements</h4>
                        <canvas id="statusChart"></canvas>
                    </div>
                </div>
            </div>
            
            <!-- Second Row (Top Destinations and Recent Activity) -->
            <div class="row">
                <div class="col-md-4">
                    <div class="chart-container">
                        <h4 class="chart-title">Top 5 Destinations</h4>
                        <canvas id="destinationsChart"></canvas>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="recent-activity">
                        <h4 class="chart-title">Activité Récente</h4>
                        @foreach($recentOrders as $order)
                            <div class="activity-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>{{ $order->user->name }}</strong> - Mission à <span class="fw-bold">{{ $order->destination }}</span>
                                        <div class="text-muted small">{{ \Carbon\Carbon::parse($order->dateDebut)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($order->dateFin)->format('d/m/Y') }}</div>
                                    </div>
                                    <div>
                                        @if($order->etatRemboursement == 'Completed')
                                            <span class="status-badge status-completed">Completed</span>
                                        @elseif($order->etatRemboursement == 'EN ATTEND')
                                            <span class="status-badge status-attend">EN ATTEND</span>
                                        @else
                                            <span class="status-badge status-pending">{{ $order->etatRemboursement }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        
        <!-- JavaScript for Charts -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Monthly Orders Chart
                const monthNames = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'];
                const monthlyData = @json(array_values($monthlyData));
                
                new Chart(document.getElementById('monthlyOrdersChart'), {
                    type: 'bar',
                    data: {
                        labels: monthNames,
                        datasets: [{
                            label: 'Nombre d\'ordres',
                            data: monthlyData,
                            backgroundColor: 'rgba(59, 130, 246, 0.7)',
                            borderColor: 'rgba(59, 130, 246, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    precision: 0
                                }
                            }
                        }
                    }
                });
                
                // Status Chart
                const statusData = @json($ordersByStatus);
                const statusLabels = statusData.map(item => item.etatRemboursement);
                const statusCounts = statusData.map(item => item.total);
                const statusColors = statusData.map(item => {
                    if (item.etatRemboursement === 'Completed') return 'rgba(76, 175, 80, 0.7)';
                    if (item.etatRemboursement === 'EN ATTEND') return 'rgba(255, 160, 0, 0.7)';
                    return 'rgba(255, 152, 0, 0.7)';
                });
                
                new Chart(document.getElementById('statusChart'), {
                    type: 'doughnut',
                    data: {
                        labels: statusLabels,
                        datasets: [{
                            data: statusCounts,
                            backgroundColor: statusColors,
                            borderColor: 'white',
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });
                
                // Top Destinations Chart
                const destinationsData = @json($topDestinations);
                const destinationLabels = destinationsData.map(item => item.destination);
                const destinationCounts = destinationsData.map(item => item.total);
                
                new Chart(document.getElementById('destinationsChart'), {
                    type: 'pie',
                    data: {
                        labels: destinationLabels,
                        datasets: [{
                            data: destinationCounts,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.7)',
                                'rgba(54, 162, 235, 0.7)',
                                'rgba(255, 206, 86, 0.7)',
                                'rgba(75, 192, 192, 0.7)',
                                'rgba(153, 102, 255, 0.7)'
                            ],
                            borderColor: 'white',
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });
            });
        </script>
    </body>
    </html>
    @endsection
</x-master>