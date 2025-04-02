<x-master>
    @section('main')
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Historique des Remboursements</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
        <style>
            .reimbursement-card {
                background-color: white;
                border-radius: 10px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                padding: 20px;
                margin-bottom: 20px;
            }

            .status-badge {
                padding: 5px 10px;
                border-radius: 20px;
                font-size: 0.8em;
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

            .status-rejected {
                background-color: #ffebee;
                color: #f44336;
            }

            .filter-section {
                background-color: #f8f9fa;
                border-radius: 8px;
                padding: 20px;
                margin-bottom: 20px;
            }
        </style>
    </head>
    <body>
        <div class="container mt-4">
            <h2 class="mb-4">Historique des Remboursements</h2>

            <!-- Filters -->
            <div class="filter-section">
                <form action="{{ route('contable.reimbursement.history') }}" method="GET">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Statut</label>
                            <select name="status" class="form-select">
                                <option value="">Tous les statuts</option>
                                <option value="EN ATTEND" {{ request('status') == 'EN ATTEND' ? 'selected' : '' }}>En Attente</option>
                                <option value="Completed" {{ request('status') == 'Completed' ? 'selected' : '' }}>Complété</option>
                                <option value="Rejected" {{ request('status') == 'Rejected' ? 'selected' : '' }}>Rejeté</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Date de Début</label>
                            <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Date de Fin</label>
                            <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-filter"></i> Filtrer
                        </button>
                    </div>
                </form>
            </div>

            <!-- Reimbursement Table -->
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Employé</th>
                                <th>Destination</th>
                                <th>Date Début</th>
                                <th>Date Fin</th>
                                <th>Montant</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($reimbursements as $mission)
                            <tr>
                                <td>{{ $mission->user->name }}</td>
                                <td>{{ $mission->destination }}</td>
                                <td>{{ \Carbon\Carbon::parse($mission->dateDebut)->format('d/m/Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($mission->dateFin)->format('d/m/Y') }}</td>
                                <td>{{ number_format($mission->montantRemboursement ?? 0, 2) }} MAD</td>
                                <td>
                                    @switch($mission->etatRemboursement)
                                        @case('EN ATTEND')
                                            <span class="status-badge status-pending">En Attente</span>
                                            @break
                                        @case('Completed')
                                            <span class="status-badge status-completed">Complété</span>
                                            @break
                                        @case('Rejected')
                                            <span class="status-badge status-rejected">Rejeté</span>
                                            @break
                                        @default
                                            <span class="status-badge">{{ $mission->etatRemboursement }}</span>
                                    @endswitch
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-info" data-bs-toggle="modal" 
                                        data-bs-target="#missionDetailsModal{{ $mission->id }}">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">
                                    <div class="alert alert-info">
                                        Aucun remboursement trouvé
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <div class="card-footer">
                    {{ $reimbursements->appends(request()->query())->links() }}
                </div>
            </div>
        </div>

        <!-- Modals for Mission Details (you can expand this) -->
        @foreach($reimbursements as $mission)
        <div class="modal fade" id="missionDetailsModal{{ $mission->id }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Détails de la Mission</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <strong>Employé:</strong> {{ $mission->user->name }}
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>Destination:</strong> {{ $mission->destination }}
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>Date Début:</strong> {{ \Carbon\Carbon::parse($mission->dateDebut)->format('d/m/Y') }}
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>Date Fin:</strong> {{ \Carbon\Carbon::parse($mission->dateFin)->format('d/m/Y') }}
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>Montant:</strong> {{ number_format($mission->montantRemboursement ?? 0, 2) }} MAD
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>Statut:</strong> 
                                @switch($mission->etatRemboursement)
                                    @case('EN ATTEND')
                                        <span class="status-badge status-pending">En Attente</span>
                                        @break
                                    @case('Completed')
                                        <span class="status-badge status-completed">Complété</span>
                                        @break
                                    @case('Rejected')
                                        <span class="status-badge status-rejected">Rejeté</span>
                                        @break
                                    @default
                                        <span class="status-badge">{{ $mission->etatRemboursement }}</span>
                                @endswitch
                            </div>
                        </div>
                        @if($mission->commentairesRemboursement)
                        <div class="mt-3">
                            <strong>Commentaires:</strong>
                            <p>{{ $mission->commentairesRemboursement }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </body>
    </html>
    @endsection
</x-master>