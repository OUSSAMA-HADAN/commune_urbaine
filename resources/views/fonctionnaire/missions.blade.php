<x-master>
    @section('main')
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Mes Missions</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
        <style>
            .status-completed {
                background-color: #28a745;
            }
            .status-attend {
                background-color: #ffc107;
            }
            .status-pending {
                background-color: #6c757d;
            }
            .mission-status {
                padding: 0.25rem 0.5rem;
                border-radius: 0.25rem;
                color: white;
                font-size: 0.875rem;
            }
        </style>
    </head>
    <body class="bg-light">
        <div class="container py-4">
            <h2 class="mb-4 text-primary">
                <i class="bi bi-briefcase me-2"></i>Mes Ordres de Mission
            </h2>
            
            @forelse ($missions as $mission)
                <div class="card mb-3 shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center bg-white">
                        <h5 class="mb-0">Ordre #{{ $mission->id }}</h5>
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
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <i class="bi bi-calendar-event text-primary me-2"></i>
                                    <span class="text-muted">Début:</span> {{ \Carbon\Carbon::parse($mission->dateDebut)->format('d/m/Y') }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <i class="bi bi-calendar-check text-primary me-2"></i>
                                    <span class="text-muted">Fin:</span> {{ \Carbon\Carbon::parse($mission->dateFin)->format('d/m/Y') }}
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <i class="bi bi-geo-alt-fill text-danger me-2"></i>
                            <span class="text-muted">Destination:</span> <strong>{{ $mission->destination }}</strong>
                        </div>
                        
                        <div class="mb-3 p-3 bg-light rounded">
                            <i class="bi bi-quote text-secondary me-2"></i>
                            {{ Str::limit($mission->objectif, 150) }}
                        </div>
                    </div>
                    <div class="card-footer bg-white d-flex justify-content-between align-items-center">
                        <div>
                            <i class="bi bi-truck text-primary me-2"></i>
                            <span class="text-muted">Transport:</span> <strong>{{ $mission->transport }}</strong>
                        </div>
                        <a href="{{ route('fonctionnaire.mission.show', $mission->id) }}" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-eye me-1"></i> Voir détails
                        </a>
                    </div>
                </div>
            @empty
                <div class="text-center py-5 bg-white rounded shadow-sm">
                    <i class="bi bi-inbox text-secondary" style="font-size: 3rem;"></i>
                    <p class="mt-3 text-muted">Aucun ordre de mission n'a été trouvé</p>
                </div>
            @endforelse
            
            <div class="mt-4">
                {{ $missions->links() }}
            </div>
        </div>
    </body>
    </html>
    @endsection
</x-master>