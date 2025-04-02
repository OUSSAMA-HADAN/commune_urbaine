<x-master>
    @section('main')
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Mes Rapports</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
        <style>
            .report-card {
                background-color: white;
                border-radius: 10px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                margin-bottom: 20px;
                overflow: hidden;
                transition: transform 0.3s;
            }
            
            .report-card:hover {
                transform: translateY(-5px);
            }
            
            .report-header {
                padding: 15px 20px;
                background-color: #f8f9fa;
                border-bottom: 1px solid #e9ecef;
            }
            
            .report-title {
                font-weight: 600;
                font-size: 18px;
                margin: 0;
            }
            
            .report-body {
                padding: 20px;
            }
            
            .report-content {
                margin-bottom: 15px;
                color: #6c757d;
                font-size: 14px;
            }
            
            .report-footer {
                display: flex;
                align-items: center;
                justify-content: space-between;
                font-size: 14px;
            }
            
            .report-date {
                color: #6c757d;
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
            
            .no-reports {
                text-align: center;
                padding: 50px 20px;
                color: #6c757d;
            }
            
            .no-reports i {
                font-size: 48px;
                margin-bottom: 15px;
                opacity: 0.4;
            }
        </style>
    </head>
    <body>
        <div class="container mt-4">
            <h2 class="mb-4">Mes Rapports de Mission</h2>
            
            @forelse ($rapports as $rapport)
                <div class="report-card">
                    <div class="report-header">
                        <h5 class="report-title">{{ $rapport->sujet }}</h5>
                    </div>
                    <div class="report-body">
                        <div class="report-content">
                            {{ Str::limit($rapport->contenu, 200) }}
                        </div>
                        
                        <div class="report-footer">
                            <div class="report-date">
                                <i class="bi bi-calendar"></i> Soumis le {{ \Carbon\Carbon::parse($rapport->dateSoumission)->format('d/m/Y') }}
                            </div>
                            <a href="{{ route('fonctionnaire.mission.show', $rapport->idOrdreMission) }}" class="btn-view">
                                <i class="bi bi-eye"></i> Voir la mission
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="no-reports">
                    <i class="bi bi-file-earmark-text"></i>
                    <p>Vous n'avez soumis aucun rapport</p>
                </div>
            @endforelse
            
            {{ $rapports->links() }}
        </div>
    </body>
    </html>
    @endsection
</x-master>