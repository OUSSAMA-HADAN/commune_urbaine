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
            /* You can reuse styles from dashboard.blade.php */
        </style>
    </head>
    <body>
        <div class="container mt-4">
            <h2 class="mb-4">Mes Ordres de Mission</h2>
            
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