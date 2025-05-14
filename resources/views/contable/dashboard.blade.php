<x-master>
    @section('main')
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Contable Dashboard</title>
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
        </style>
    </head>
    <body>
        <div class="container mt-4">
            <h2 class="mb-4">Tableau de Bord - Comptable</h2>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="reimbursement-card">
                        <h5>Total Remboursements en Attente</h5>
                        <div class="display-4 text-warning">
                            {{ number_format($totalPendingAmount, 2) }} MAD
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="reimbursement-card">
                        <h5>Missions en Attente</h5>
                        <div class="display-4 text-primary">
                            {{ $pendingReimbursements->total() }}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="reimbursement-card">
                        <h5>Missions Remboursées</h5>
                        <div class="display-4 text-success">
                            {{ $completedMissions->count() }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    Remboursements en Attente
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Employé</th>
                                <th>Destination</th>
                                <th>Date Début</th>
                                <th>Montant</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pendingReimbursements as $mission)
                            <tr>
                                <td>{{ $mission->user->name }}</td>
                                <td>{{ $mission->destination }}</td>
                                <td>{{ $mission->dateDebut }}</td>
                                <td>{{ number_format($mission->montantRemboursement, 2) }} MAD</td>
                                <td>
                                    <button class="btn btn-primary btn-sm" onclick="window.location.href='{{ route('contable.reimbursement.detail', $mission->id) }}'">
                                        Traiter
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $pendingReimbursements->links() }}
            </div>
        </div>

    </body>
    </html>
    @endsection
</x-master>