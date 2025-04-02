<x-master>
    @section('main')
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Fonctionnaire Dashboard</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
        <style>
            .dashboard-stats {
                display: flex;
                gap: 20px;
                margin-bottom: 30px;
            }
            
            .stat-card {
                flex: 1;
                background-color: white;
                border-radius: 10px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                padding: 20px;
                display: flex;
                flex-direction: column;
                align-items: center;
                transition: transform 0.3s;
            }
            
            .stat-card:hover {
                transform: translateY(-5px);
            }
            
            .stat-icon {
                width: 60px;
                height: 60px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-bottom: 15px;
                font-size: 24px;
            }
            
            .stat-blue {
                background-color: #e6f2ff;
                color: #0d6efd;
            }
            
            .stat-green {
                background-color: #e6fff2;
                color: #198754;
            }
            
            .stat-yellow {
                background-color: #fff8e6;
                color: #ffc107;
            }
            
            .stat-red {
                background-color: #ffe6e6;
                color: #dc3545;
            }
            
            .stat-value {
                font-size: 28px;
                font-weight: 700;
                margin-bottom: 5px;
            }
            
            .stat-label {
                font-size: 14px;
                color: #6c757d;
                text-align: center;
            }
            
            .mission-card {
                background-color: white;
                border-radius: 10px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                margin-bottom: 20px;
                overflow: hidden;
                transition: transform 0.3s;
            }
            
            .mission-card:hover {
                transform: translateY(-5px);
            }
            
            .mission-header {
                padding: 15px 20px;
                background-color: #f8f9fa;
                border-bottom: 1px solid #e9ecef;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
            
            .mission-title {
                font-weight: 600;
                font-size: 18px;
                margin: 0;
            }
            
            .mission-body {
                padding: 20px;
            }
            
            .mission-dates {
                display: flex;
                margin-bottom: 15px;
                color: #6c757d;
                font-size: 14px;
            }
            
            .mission-dates div {
                margin-right: 20px;
            }
            
            .mission-dates i {
                margin-right: 5px;
            }
            
            .mission-destination {
                font-weight: 500;
                margin-bottom: 15px;
                display: flex;
                align-items: center;
            }
            
            .mission-destination i {
                margin-right: 10px;
                color: #0d6efd;
            }
            
            .mission-objectif {
                background-color: #f8f9fa;
                padding: 15px;
                border-radius: 8px;
                margin-bottom: 15px;
                font-style: italic;
                color: #495057;
            }
            
            .mission-footer {
                display: flex;
                align-items: center;
                justify-content: space-between;
            }
            
            .mission-status {
                padding: 5px 12px;
                border-radius: 20px;
                font-size: 12px;
                font-weight: 600;
            }
            
            .status-pending {
                background-color: #fff7e0;
                color: #ff9800;
            }
            
            .status-completed {
                background-color: #e8f5e9;
                color: #4caf50;
            }
            
            .status-attend {
                background-color: #fff8e1;
                color: #ffa000;
            }
            
            .btn-view {
                background-color: #0d6efd;
                color: white;
                border: none;
                padding: 8px 15px;
                border-radius: 5px;
                text-decoration: none;
                font-size: 14px;
                transition: background-color 0.3s;
                display: inline-flex;
                align-items: center;
            }
            
            .btn-view i {
                margin-right: 5px;
            }
            
            .btn-view:hover {
                background-color: #0b5ed7;
                color: white;
            }
            
            .no-missions {
                text-align: center;
                padding: 50px 20px;
                color: #6c757d;
            }
            
            .no-missions i {
                font-size: 48px;
                margin-bottom: 15px;
                opacity: 0.4;
            }
        </style>
    </head>
    <body>
        <div class="container mt-4">
            <h2 class="mb-4">Tableau de Bord - Fonctionnaire</h2>
            
            <!-- Stats Cards -->
            <div class="dashboard-stats">
                <div class="stat-card">
                    <div class="stat-icon stat-blue">
                        <i class="bi bi-briefcase"></i>
                    </div>
                    <div class="stat-value">{{ $totalMissions }}</div>
                    <div class="stat-label">Total Missions</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon stat-green">
                        <div class="stat-icon stat-green">
                            <i class="bi bi-check-circle"></i>
                        </div>
                    </div>
                    <div class="stat-value">{{ $completedMissions }}</div>
                    <div class="stat-label">Missions Complétées</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon stat-yellow">
                        <i class="bi bi-hourglass-split"></i>
                    </div>
                    <div class="stat-value">{{ $pendingMissions }}</div>
                    <div class="stat-label">Missions en Attente</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon stat-red">
                        <i class="bi bi-file-text"></i>
                    </div>
                    <div class="stat-value">{{ $rapports }}</div>
                    <div class="stat-label">Rapports Soumis</div>
                </div>
            </div>
            
            <h3 class="mb-3">Mes Ordres de Mission</h3>
            
            @forelse ($missions as $mission)
                <div class="mission-card">
                    <div class="mission-header">
                        <h5 class="mission-title">Ordre #{{ $mission->id }}</h5>
                        <div>
                            @if($mission->etatRemboursement == 'Completed')
                                <span class="mission-status status-completed">Completed</span>
                            @elseif($mission->etatRemboursement == 'EN ATTEND')
                                <span class="mission-status status-attend">EN ATTEND</span>
                            @else
                                <span class="mission-status status-pending">{{ $mission->etatRemboursement }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mission-body">
                        <div class="mission-dates">
                            <div><i class="bi bi-calendar-event"></i> Début: {{ \Carbon\Carbon::parse($mission->dateDebut)->format('d/m/Y') }}</div>
                            <div><i class="bi bi-calendar-check"></i> Fin: {{ \Carbon\Carbon::parse($mission->dateFin)->format('d/m/Y') }}</div>
                        </div>
                        
                        <div class="mission-destination">
                            <i class="bi bi-geo-alt-fill"></i> Destination: <strong>{{ $mission->destination }}</strong>
                        </div>
                        
                        <div class="mission-objectif">
                            "{{ Str::limit($mission->objectif, 150) }}"
                        </div>
                        
                        <div class="mission-footer">
                            <div>
                                <i class="bi bi-truck"></i> Transport: <strong>{{ $mission->transport }}</strong>
                            </div>
                            <a href="{{ route('fonctionnaire.mission.show', $mission->id) }}" class="btn-view">
                                <i class="bi bi-eye"></i> Voir détails
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="no-missions">
                    <i class="bi bi-inbox"></i>
                    <p>Aucun ordre de mission n'a été trouvé</p>
                </div>
            @endforelse
            
            {{ $missions->links() }}
        </div>
    </body>
    </html>
    @endsection
</x-master>