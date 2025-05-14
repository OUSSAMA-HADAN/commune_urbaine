<x-master>
    @section('main')
        <!DOCTYPE html>
        <html lang="fr">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>Détail de la Mission</title>
            @vite(['resources/css/app.css', 'resources/js/app.js'])
            <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
            <style>
                .mission-details {
                    background-color: white;
                    border-radius: 10px;
                    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                    padding: 25px;
                    margin-bottom: 30px;
                }

                .mission-header {
                    display: flex;
                    justify-content: space-between;
                    align-items: flex-start;
                    margin-bottom: 20px;
                    padding-bottom: 20px;
                    border-bottom: 1px solid #e9ecef;
                }

                .mission-title {
                    font-size: 24px;
                    font-weight: 700;
                    color: #344767;
                    margin-bottom: 10px;
                }

                .mission-status {
                    padding: 8px 16px;
                    border-radius: 30px;
                    font-size: 14px;
                    font-weight: 600;
                    letter-spacing: 0.5px;
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

                .section-label {
                    font-weight: 600;
                    color: #6c757d;
                    margin-bottom: 5px;
                    font-size: 14px;
                }

                .section-value {
                    font-weight: 400;
                    color: #344767;
                    margin-bottom: 15px;
                    font-size: 16px;
                }

                .dates-info {
                    display: flex;
                    gap: 30px;
                    margin-bottom: 20px;
                }

                .date-item {
                    padding: 10px 15px;
                    background-color: #f8f9fa;
                    border-radius: 8px;
                    flex: 1;
                }

                .date-icon {
                    margin-right: 10px;
                    color: #0d6efd;
                }

                .objectif-section {
                    background-color: #f8f9fa;
                    border-radius: 8px;
                    padding: 20px;
                    margin-bottom: 20px;
                    font-style: italic;
                    position: relative;
                }

                .objectif-section::before {
                    content: '"';
                    font-size: 60px;
                    color: rgba(0, 0, 0, 0.1);
                    position: absolute;
                    top: -15px;
                    left: 10px;
                }

                .objectif-section::after {
                    content: '"';
                    font-size: 60px;
                    color: rgba(0, 0, 0, 0.1);
                    position: absolute;
                    bottom: -45px;
                    right: 10px;
                }

                .rapport-section {
                    background-color: white;
                    border-radius: 10px;
                    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                    padding: 25px;
                    margin-bottom: 30px;
                }

                .rapport-header {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    margin-bottom: 20px;
                    padding-bottom: 20px;
                    border-bottom: 1px solid #e9ecef;
                }

                .rapport-title {
                    font-size: 20px;
                    font-weight: 700;
                    color: #344767;
                    margin: 0;
                }

                .rapport-content {
                    background-color: #f8f9fa;
                    border-radius: 8px;
                    padding: 20px;
                    white-space: pre-line;
                }

                .no-rapport {
                    text-align: center;
                    padding: 30px;
                    color: #6c757d;
                }

                .no-rapport i {
                    font-size: 48px;
                    margin-bottom: 15px;
                    opacity: 0.4;
                }

                .action-buttons {
                    display: flex;
                    justify-content: space-between;
                    margin-top: 30px;
                }

                .btn-back {
                    background-color: #6c757d;
                    color: white;
                    padding: 10px 20px;
                    border-radius: 5px;
                    text-decoration: none;
                    border: none;
                    display: flex;
                    align-items: center;
                    transition: all 0.3s;
                }

                .btn-back i {
                    margin-right: 10px;
                }

                .btn-back:hover {
                    background-color: #5a6268;
                    transform: translateY(-2px);
                    color: white;
                }

                .btn-create-rapport {
                    background-color: #4caf50;
                    color: white;
                    padding: 10px 20px;
                    border-radius: 5px;
                    text-decoration: none;
                    border: none;
                    display: flex;
                    align-items: center;
                    transition: all 0.3s;
                }

                .btn-create-rapport i {
                    margin-right: 10px;
                }

                .btn-create-rapport:hover {
                    background-color: #3d8b40;
                    transform: translateY(-2px);
                    color: white;
                }





                .custom-file {
                    position: relative;
                    display: inline-block;
                    width: 100%;
                    height: calc(1.5em + 0.75rem + 2px);
                    margin-bottom: 0;
                }

                .custom-file-input {
                    position: relative;
                    z-index: 2;
                    width: 100%;
                    height: calc(1.5em + 0.75rem + 2px);
                    margin: 0;
                    opacity: 0;
                }

                .custom-file-label {
                    position: absolute;
                    top: 0;
                    right: 0;
                    left: 0;
                    z-index: 1;
                    height: calc(1.5em + 0.75rem + 2px);
                    padding: 0.375rem 0.75rem;
                    font-weight: 400;
                    line-height: 1.5;
                    color: #495057;
                    background-color: #fff;
                    border: 1px solid #ced4da;
                    border-radius: 0.25rem;
                }

                .custom-file-label::after {
                    position: absolute;
                    top: 0;
                    right: 0;
                    bottom: 0;
                    z-index: 3;
                    display: block;
                    height: calc(1.5em + 0.75rem);
                    padding: 0.375rem 0.75rem;
                    line-height: 1.5;
                    color: #495057;
                    content: "Parcourir";
                    background-color: #e9ecef;
                    border-left: inherit;
                    border-radius: 0 0.25rem 0.25rem 0;
                }
            </style>
        </head>

        <body>
            <div class="container mt-4">
                <div class="mission-details">
                    <div class="mission-header">
                        <div>
                            <h2 class="mission-title">Ordre de Mission #{{ $mission->id }}</h2>
                            <div class="text-muted">Créé le
                                {{ \Carbon\Carbon::parse($mission->created_at)->format('d/m/Y à H:i') }}</div>
                        </div>
                        <div>
                            @if ($mission->etatRemboursement == 'Completed')
                                <span class="mission-status status-completed">Complété</span>
                            @elseif($mission->etatRemboursement == 'EN ATTEND')
                                <span class="mission-status status-attend">EN ATTENTE</span>
                            @else
                                <span class="mission-status status-pending">{{ $mission->etatRemboursement }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="dates-info">
                        <div class="date-item">
                            <div class="section-label">
                                <i class="bi bi-calendar-event date-icon"></i>Date de Début
                            </div>
                            <div class="section-value">{{ \Carbon\Carbon::parse($mission->dateDebut)->format('d/m/Y') }}
                            </div>
                        </div>

                        <div class="date-item">
                            <div class="section-label">
                                <i class="bi bi-calendar date-icon"></i>Date d'Arrivée
                            </div>
                            <div class="section-value">{{ \Carbon\Carbon::parse($mission->dateAriver)->format('d/m/Y') }}
                            </div>
                        </div>

                        <div class="date-item">
                            <div class="section-label">
                                <i class="bi bi-calendar-check date-icon"></i>Date de Fin
                            </div>
                            <div class="section-value">{{ \Carbon\Carbon::parse($mission->dateFin)->format('d/m/Y') }}</div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="section-label">Destination</div>
                            <div class="section-value">
                                <i class="bi bi-geo-alt-fill text-primary"></i> {{ $mission->destination }}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="section-label">Transport</div>
                            <div class="section-value">
                                <i class="bi bi-truck text-primary"></i> {{ $mission->transport }}
                            </div>
                        </div>
                    </div>

                    <div class="section-label">Objectif de la Mission</div>
                    <div class="objectif-section">
                        {{ $mission->objectif }}
                    </div>

                    @if ($mission->file_path)
                        <div class="section-label">Document de Mission</div>
                        <div class="section-value">
                            <i class="bi bi-file-earmark-text text-primary"></i>
                            <a href="{{ asset('storage/' . $mission->file_path) }}" download>Télécharger le
                                document</a>
                        </div>
                    @endif
                </div>

                @if (isset($rapport))
                    <div class="rapport-section">
                        <div class="rapport-header">
                            <h3 class="rapport-title">Rapport de Mission</h3>
                            <div class="text-muted">Soumis le
                                {{ \Carbon\Carbon::parse($rapport->dateSoumission)->format('d/m/Y') }}</div>
                        </div>

                        <div class="section-label">Sujet</div>
                        <div class="section-value">{{ $rapport->sujet }}</div>

                        <div class="section-label">Contenu</div>
                        <div class="rapport-content">{{ $rapport->contenu }}</div>

                        @if ($rapport->file_path)
                            <div class="section-label mt-3">Document joint</div>
                            <div class="section-value">
                                <a href="{{ asset('storage/' . $rapport->file_path) }}" target="_blank"
                                    class="btn btn-sm btn-primary">
                                    <i class="bi bi-file-earmark-text"></i> Télécharger le document
                                </a>
                            </div>
                        @endif
                    </div>
                @else
                    <div class="rapport-section">
                        <div class="no-rapport">
                            <i class="bi bi-file-earmark-text"></i>
                            <h4>Aucun rapport soumis</h4>
                            <p>Vous devez soumettre un rapport pour cette mission.</p>
                            <a href="{{ route('fonctionnaire.rapport.create', $mission->id) }}"
                                class="btn-create-rapport mt-3">
                                <i class="bi bi-pencil-square"></i> Créer un rapport
                            </a>
                        </div>
                    </div>
                @endif

                <div class="action-buttons">
                    <a href="{{ route('fonctionnaire.dashboard') }}" class="btn-back">
                        <i class="bi bi-arrow-left"></i> Retour au tableau de bord
                    </a>

                    @if (!isset($rapport))
                        <a href="{{ route('fonctionnaire.rapport.create', $mission->id) }}" class="btn-create-rapport">
                            <i class="bi bi-pencil-square"></i> Créer un rapport
                        </a>
                    @endif
                </div>
            </div>
        </body>

        </html>
    @endsection
</x-master>
