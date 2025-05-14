<x-master>
    @section('main')
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Détails du Remboursement</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
        <style>
            .mission-detail-card {
                background-color: white;
                border-radius: 10px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                padding: 20px;
                margin-bottom: 20px;
            }
            .section-title {
                border-bottom: 2px solid #f1f1f1;
                padding-bottom: 10px;
                margin-bottom: 20px;
            }
            .document-preview {
                border: 1px solid #e0e0e0;
                border-radius: 8px;
                padding: 15px;
                margin-bottom: 20px;
            }
        </style>
    </head>
    <body>
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-8">
                    <div class="mission-detail-card">
                        <h3 class="section-title">Détails de la Mission</h3>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <strong>Employé:</strong> {{ $mission->user->name }}
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>Email:</strong> {{ $mission->user->email }}
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>Destination:</strong> {{ $mission->destination }}
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>Transport:</strong> {{ $mission->transport }}
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>Date Début:</strong> {{ \Carbon\Carbon::parse($mission->dateDebut)->format('d/m/Y') }}
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>Date Fin:</strong> {{ \Carbon\Carbon::parse($mission->dateFin)->format('d/m/Y') }}
                            </div>
                            <div class="col-12 mb-3">
                                <strong>Objectif:</strong> {{ $mission->objectif }}
                            </div>
                        </div>

                        @if($mission->file_path)
                        <div class="document-preview">
                            <strong>Document de Mission:</strong>
                            <a href="{{ asset('storage/' . $mission->file_path) }}" 
                               target="_blank" 
                               class="btn btn-sm btn-primary ms-2">
                                <i class="bi bi-eye"></i> Voir le document
                            </a>
                        </div>
                        @endif
                    </div>

                    @if($mission->rapport)
                    <div class="mission-detail-card">
                        <h3 class="section-title">Rapport de Mission</h3>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <strong>Sujet:</strong> {{ $mission->rapport->sujet }}
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>Date Soumission:</strong> 
                                {{ \Carbon\Carbon::parse($mission->rapport->dateSoumission)->format('d/m/Y') }}
                            </div>
                            <div class="col-12 mb-3">
                                <strong>Contenu:</strong>
                                <p>{{ $mission->rapport->contenu }}</p>
                            </div>
                        </div>

                        @if($mission->rapport->file_path)
                        <div class="document-preview">
                            <strong>Document du Rapport:</strong>
                            <a href="{{ asset('storage/' . $mission->rapport->file_path) }}" 
                               target="_blank" 
                               class="btn btn-sm btn-primary ms-2">
                                <i class="bi bi-eye"></i> Voir le document
                            </a>
                        </div>
                        @endif
                    </div>
                    @else
                    <div class="alert alert-warning">
                        Aucun rapport n'a été soumis pour cette mission.
                    </div>
                    @endif
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            Validation du Remboursement
                        </div>
                        <div class="card-body">
                            <form action="{{ route('contable.reimbursement.validate', $mission->id) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Montant de Remboursement</label>
                                    <div class="input-group">
                                        <input type="number" 
                                               name="montant_remboursement" 
                                               class="form-control" 
                                               step="0.01" 
                                               min="0" 
                                               placeholder="Montant à rembourser" 
                                               required>
                                        <span class="input-group-text">MAD</span>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Statut</label>
                                    <select name="status" class="form-select" required>
                                        <option value="">Sélectionner un statut</option>
                                        <option value="Completed">Approuvé</option>
                                        <option value="Rejected">Rejeté</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Commentaires</label>
                                    <textarea name="commentaires" 
                                              class="form-control" 
                                              rows="4" 
                                              placeholder="Commentaires de validation (optionnel)"></textarea>
                                </div>

                                <button type="submit" class="btn btn-primary w-100">
                                    Valider le Remboursement
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    </html>
    @endsection
</x-master>